<?php
require_once __DIR__ . '/../includes/auth_check.php';
include __DIR__ . '/../config/connection.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Bahan Makanan';

// Ambil semua kategori bahan makanan dari database
$cats = $connection->query("SELECT * FROM categories ORDER BY nama_categories");
$categories = $cats->fetch_all(MYSQLI_ASSOC);

// Filter berdasarkan kategori yang dipilih user
$filter = $_GET['category'] ?? 'all';
$query = "SELECT i.*, c.nama_categories, c.icon,
          DATEDIFF(i.tanggal_kadaluarsa, CURDATE()) AS days_left
          FROM inventories i
          JOIN categories c ON i.category_id = c.id
          WHERE i.user_id = ?";
if ($filter !== 'all') {
    $query .= " AND i.category_id = ?";
}
$query .= " ORDER BY i.tanggal_kadaluarsa ASC";

$stmt = $connection->prepare($query);
if ($filter !== 'all') {
    $stmt->bind_param("ss", $user_id, $filter);
} else {
    $stmt->bind_param("s", $user_id);
}
$stmt->execute();
$items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Ambil preferensi pengingat user untuk menentukan warna badge status
$stmt2 = $connection->prepare("SELECT reminder_day FROM users WHERE id = ?");
$stmt2->bind_param("s", $user_id);
$stmt2->execute();
$reminder_day = $stmt2->get_result()->fetch_assoc()['reminder_day'] ?? 3;

$success = $_GET['success'] ?? '';
$error = $_GET['error'] ?? '';
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div>
    <?php require_once __DIR__ . '/../includes/sidebar.php'; ?>
    <main class="py-10 lg:pl-72">
      <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900"><i class="fas fa-carrot text-emerald-600 mr-2"></i> Ingredients</h1>
                <p class="mt-2 text-sm text-gray-600">Manage all your kitchen inventory and track their expiration dates.</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <button type="button" onclick="openAddModal()" class="inline-flex items-center gap-x-2 rounded-md bg-emerald-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">
                    <i class="fas fa-plus -ml-0.5 size-4"></i>
                    Add Ingredient
                </button>
            </div>
        </div>

        <?php if ($success): ?>
            <div class="mb-6 rounded-md bg-emerald-50 p-4 border border-emerald-200">
                <div class="flex">
                    <div class="shrink-0"><i class="fas fa-check-circle text-emerald-400"></i></div>
                    <div class="ml-3"><h3 class="text-sm font-medium text-emerald-800"><?= htmlspecialchars($success) ?></h3></div>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="mb-6 rounded-md bg-red-50 p-4 border border-red-200">
                <div class="flex">
                    <div class="shrink-0"><i class="fas fa-exclamation-circle text-red-400"></i></div>
                    <div class="ml-3"><h3 class="text-sm font-medium text-red-800"><?= htmlspecialchars($error) ?></h3></div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Category Filter Tabs -->
        <div class="mb-6 border-b border-gray-200 pb-4">
            <nav class="-mb-px flex space-x-4 sm:space-x-8 overflow-x-auto" aria-label="Tabs">
                <a href="?category=all" class="<?= $filter === 'all' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' ?> whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium transition-colors">
                    All
                </a>
                <?php foreach ($categories as $cat): ?>
                <a href="?category=<?= $cat['id'] ?>" class="<?= $filter === $cat['id'] ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' ?> whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium transition-colors">
                    <i class="fas <?= htmlspecialchars($cat['icon']) ?> mr-2"></i> <?= htmlspecialchars($cat['nama_categories']) ?>
                </a>
                <?php endforeach; ?>
            </nav>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-sm ring-1 ring-gray-200 sm:rounded-xl overflow-hidden">
            <div class="border-b border-gray-200 bg-gray-50 px-4 py-4 sm:px-6">
                <h3 class="text-base font-semibold text-gray-900">Inventory List <span class="ml-2 inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800"><?= count($items) ?> items</span></h3>
            </div>
            
            <?php if (empty($items)): ?>
            <div class="text-center py-16">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100">
                    <i class="fas fa-box-open text-emerald-600 text-xl"></i>
                </div>
                <h3 class="mt-4 text-sm font-semibold text-gray-900">No ingredients</h3>
                <p class="mt-2 text-sm text-gray-500">Get started by clicking "Add Ingredient" above.</p>
            </div>
            <?php else: ?>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-white">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Ingredient Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Category</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Expiration Date</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Quick Actions</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Edit</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                    <?php foreach ($items as $item):
                        $d = $item['days_left'];
                        if ($d < 0) { 
                            $badge_class = 'bg-red-50 text-red-700 ring-red-600/10'; 
                            $label = 'Expired'; 
                        } elseif ($d <= $reminder_day) { 
                            $badge_class = 'bg-red-50 text-red-700 ring-red-600/10'; 
                            $label = "Critical ($d days)"; 
                        } elseif ($d <= $reminder_day + 3) { 
                            $badge_class = 'bg-yellow-50 text-yellow-800 ring-yellow-600/20'; 
                            $label = "Soon ($d days)"; 
                        } else { 
                            $badge_class = 'bg-emerald-50 text-emerald-700 ring-emerald-600/20'; 
                            $label = "Safe ($d days)"; 
                        }
                    ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"><?= htmlspecialchars($item['nama_bahan']) ?></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                                <i class="fas <?= htmlspecialchars($item['icon']) ?> mr-1.5 text-gray-400"></i> <?= htmlspecialchars($item['nama_categories']) ?>
                            </span>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?= date('d M Y', strtotime($item['tanggal_kadaluarsa'])) ?></td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset <?= $badge_class ?>"><?= $label ?></span>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <form method="POST" action="/Kuis-ResponsiPWD/FreshTrack/actions/edit_inventories.php" class="inline">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="action" value="status_cooked">
                                    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-50 px-2 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10 hover:bg-indigo-100 transition-colors" title="Cooked">🍳 Cooked</button>
                                </form>
                                <form method="POST" action="/Kuis-ResponsiPWD/FreshTrack/actions/edit_inventories.php" class="inline">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
                                    <input type="hidden" name="action" value="status_discard">
                                    <button type="submit" class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10 hover:bg-gray-100 transition-colors" title="Discarded">🗑️ Discarded</button>
                                </form>
                            </div>
                        </td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <div class="flex items-center justify-end gap-3">
                                <button onclick="openEditModal('<?= $item['id'] ?>', '<?= htmlspecialchars($item['nama_bahan'], ENT_QUOTES) ?>', '<?= $item['category_id'] ?>', '<?= $item['tanggal_kadaluarsa'] ?>')" class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                    <i class="fas fa-pen"></i><span class="sr-only">Edit</span>
                                </button>
                                <button onclick="confirmDelete('<?= $item['id'] ?>', '<?= htmlspecialchars($item['nama_bahan'], ENT_QUOTES) ?>')" class="text-red-600 hover:text-red-900 transition-colors">
                                    <i class="fas fa-trash"></i><span class="sr-only">Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
      </div>
    </main>
</div>

<!-- ADD MODAL -->
<div id="addModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>
  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-emerald-100 sm:mx-0 sm:size-10">
            <i class="fas fa-plus text-emerald-600"></i>
          </div>
          <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Tambah Bahan Baru</h3>
            <div class="mt-4">
                <form method="POST" action="/Kuis-ResponsiPWD/FreshTrack/actions/add_inventories.php" id="addForm" class="space-y-4">
                    <div>
                        <label for="add_nama" class="block text-sm/6 font-medium text-gray-900">Nama Bahan</label>
                        <div class="mt-2">
                            <input type="text" id="add_nama" name="nama_bahan" placeholder="cth: Bayam Hijau" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-emerald-600 sm:text-sm/6">
                        </div>
                    </div>
                    <div>
                        <label for="add_cat" class="block text-sm/6 font-medium text-gray-900">Kategori</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="add_cat" name="category_id" required class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-emerald-600 sm:text-sm/6">
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nama_categories']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <label for="add_exp" class="block text-sm/6 font-medium text-gray-900">Tanggal Kedaluwarsa</label>
                        <div class="mt-2">
                            <input type="date" id="add_exp" name="tanggal_kadaluarsa" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-emerald-600 sm:text-sm/6">
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
          <button type="button" onclick="document.getElementById('addForm').submit()" class="inline-flex w-full justify-center rounded-md bg-emerald-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 sm:ml-3 sm:w-auto"><i class="fas fa-save mr-2 mt-0.5"></i> Simpan</button>
          <button type="button" onclick="closeModal('addModal')" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>
  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-indigo-100 sm:mx-0 sm:size-10">
            <i class="fas fa-edit text-indigo-600"></i>
          </div>
          <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Edit Bahan</h3>
            <div class="mt-4">
                <form method="POST" action="/Kuis-ResponsiPWD/FreshTrack/actions/edit_inventories.php" id="editForm" class="space-y-4">
                    <input type="hidden" id="edit_id" name="id">
                    <input type="hidden" name="action" value="update">
                    <div>
                        <label for="edit_nama" class="block text-sm/6 font-medium text-gray-900">Nama Bahan</label>
                        <div class="mt-2">
                            <input type="text" id="edit_nama" name="nama_bahan" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                    <div>
                        <label for="edit_cat" class="block text-sm/6 font-medium text-gray-900">Kategori</label>
                        <div class="mt-2 grid grid-cols-1">
                            <select id="edit_cat" name="category_id" required class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pl-3 pr-8 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nama_categories']) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <label for="edit_exp" class="block text-sm/6 font-medium text-gray-900">Tanggal Kedaluwarsa</label>
                        <div class="mt-2">
                            <input type="date" id="edit_exp" name="tanggal_kadaluarsa" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
          <button type="button" onclick="document.getElementById('editForm').submit()" class="inline-flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 sm:ml-3 sm:w-auto"><i class="fas fa-save mr-2 mt-0.5"></i> Update</button>
          <button type="button" onclick="closeModal('editModal')" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- DELETE CONFIRM MODAL -->
<div id="deleteModal" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>
  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg sm:p-6">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
            <i class="fas fa-exclamation-triangle text-red-600"></i>
          </div>
          <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Hapus Item?</h3>
            <div class="mt-2">
              <p class="text-sm text-gray-500">Yakin ingin menghapus <strong id="delete_name" class="text-gray-900"></strong>? Tindakan ini tidak dapat dibatalkan.</p>
              <form method="POST" action="/Kuis-ResponsiPWD/FreshTrack/actions/delete_inventories.php" id="deleteForm">
                  <input type="hidden" id="delete_id" name="id">
              </form>
            </div>
          </div>
        </div>
        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
          <button type="button" onclick="document.getElementById('deleteForm').submit()" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"><i class="fas fa-trash mr-2 mt-0.5"></i> Hapus</button>
          <button type="button" onclick="closeModal('deleteModal')" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function openAddModal() { document.getElementById('addModal').classList.remove('hidden'); }
function openEditModal(id, nama, catId, exp) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_cat').value = catId;
    document.getElementById('edit_exp').value = exp;
    document.getElementById('editModal').classList.remove('hidden');
}
function confirmDelete(id, nama) {
    document.getElementById('delete_id').value = id;
    document.getElementById('delete_name').textContent = nama;
    document.getElementById('deleteModal').classList.remove('hidden');
}
function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
</script>
</body>
</html>
