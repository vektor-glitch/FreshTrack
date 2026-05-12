<?php
require_once __DIR__ . '/../includes/auth_check.php';
include __DIR__ . '/../config/connection.php';

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$page_title = 'Dashboard';

// Get user's reminder_day preference
$stmt = $connection->prepare("SELECT reminder_day FROM users WHERE id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$user_data = $stmt->get_result()->fetch_assoc();
$reminder_day = $user_data['reminder_day'] ?? 3;

// Get all user inventories with category
$query = "SELECT i.*, c.nama_categories, c.icon,
          DATEDIFF(i.tanggal_kadaluarsa, CURDATE()) AS days_left
          FROM inventories i
          JOIN categories c ON i.category_id = c.id
          WHERE i.user_id = ?
          ORDER BY i.tanggal_kadaluarsa ASC";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$inventories = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Calculate stats
$total = count($inventories);
$safe = 0; $warning_count = 0; $critical = 0;
$alerts = [];
foreach ($inventories as $item) {
    $d = $item['days_left'];
    if ($d < 0) { $critical++; }
    elseif ($d <= $reminder_day) {
        $critical++;
        $alerts[] = $item;
    } elseif ($d <= $reminder_day + 3) {
        $warning_count++;
    } else {
        $safe++;
    }
}

// Priority list (next 7 expiring items that are not yet expired)
$priority = array_filter($inventories, fn($i) => $i['days_left'] >= 0);
$priority = array_slice($priority, 0, 7);
?>
<?php $page_title = 'Dashboard'; require_once __DIR__ . '/../includes/header.php'; ?>
<div>
    <?php require_once __DIR__ . '/../includes/sidebar.php'; ?>
    <main class="py-10 lg:pl-72">
      <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard</h1>
            <p class="mt-2 text-sm/6 text-gray-600">Selamat datang kembali, <strong><?= htmlspecialchars($username) ?></strong>! 👋</p>
        </div>

        <!-- Notification Banner -->
        <?php if (!empty($alerts)): ?>
        <div class="mb-8 rounded-md p-4 <?= $alerts[0]['days_left'] <= 1 ? 'bg-red-50 border border-red-200' : 'bg-yellow-50 border border-yellow-200' ?>">
          <div class="flex">
            <div class="shrink-0">
              <i class="fas fa-exclamation-triangle <?= $alerts[0]['days_left'] <= 1 ? 'text-red-400' : 'text-yellow-400' ?>"></i>
            </div>
            <div class="ml-3">
              <p class="text-sm font-medium <?= $alerts[0]['days_left'] <= 1 ? 'text-red-800' : 'text-yellow-800' ?>">
                ⚠️ Ada <strong><?= count($alerts) ?></strong> bahan makanan yang mendekati/melewati kedaluwarsa! Segera cek inventaris Anda.
              </p>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Stats Grid -->
        <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4 mb-8">
          <div class="relative overflow-hidden rounded-xl bg-white px-4 pb-12 pt-5 shadow-sm border border-gray-200 sm:px-6 sm:pt-6 animate-slide-up delay-100">
            <dt>
              <div class="absolute rounded-xl bg-blue-100 p-3">
                <i class="fas fa-box text-blue-600 size-6 text-center text-xl"></i>
              </div>
              <p class="ml-16 truncate text-sm font-medium text-gray-500">Total Bahan</p>
            </dt>
            <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
              <p class="text-2xl font-semibold text-gray-900"><?= $total ?></p>
            </dd>
          </div>

          <div class="relative overflow-hidden rounded-xl bg-white px-4 pb-12 pt-5 shadow-sm border border-gray-200 sm:px-6 sm:pt-6 animate-slide-up delay-200">
            <dt>
              <div class="absolute rounded-xl bg-emerald-100 p-3">
                <i class="fas fa-check-circle text-emerald-600 size-6 text-center text-xl"></i>
              </div>
              <p class="ml-16 truncate text-sm font-medium text-gray-500">Aman</p>
            </dt>
            <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
              <p class="text-2xl font-semibold text-gray-900"><?= $safe ?></p>
            </dd>
          </div>

          <div class="relative overflow-hidden rounded-xl bg-white px-4 pb-12 pt-5 shadow-sm border border-gray-200 sm:px-6 sm:pt-6 animate-slide-up delay-300">
            <dt>
              <div class="absolute rounded-xl bg-yellow-100 p-3">
                <i class="fas fa-clock text-yellow-600 size-6 text-center text-xl"></i>
              </div>
              <p class="ml-16 truncate text-sm font-medium text-gray-500">Mendekati Batas</p>
            </dt>
            <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
              <p class="text-2xl font-semibold text-gray-900"><?= $warning_count ?></p>
            </dd>
          </div>

          <div class="relative overflow-hidden rounded-xl bg-white px-4 pb-12 pt-5 shadow-sm border border-gray-200 sm:px-6 sm:pt-6 animate-slide-up delay-100">
            <dt>
              <div class="absolute rounded-xl bg-red-100 p-3">
                <i class="fas fa-exclamation-circle text-red-600 size-6 text-center text-xl"></i>
              </div>
              <p class="ml-16 truncate text-sm font-medium text-gray-500">Kritis / Expired</p>
            </dt>
            <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
              <p class="text-2xl font-semibold text-gray-900"><?= $critical ?></p>
            </dd>
          </div>
        </dl>

        <!-- Priority List -->
        <div class="bg-white shadow-sm border border-gray-200 sm:rounded-xl">
          <div class="border-b border-gray-200 px-4 py-5 sm:px-6 flex items-center gap-2">
            <i class="fas fa-fire text-red-500"></i>
            <h3 class="text-base font-semibold text-gray-900">Prioritas Segera Digunakan</h3>
          </div>
          
          <?php if (empty($priority)): ?>
          <div class="text-center py-12">
            <i class="fas fa-leaf text-gray-300 text-4xl mb-3"></i>
            <h3 class="text-sm font-semibold text-gray-900">Belum ada bahan makanan</h3>
            <p class="mt-1 text-sm text-gray-500">Tambahkan bahan makanan pertama Anda di halaman Inventaris.</p>
          </div>
          <?php else: ?>
          <ul role="list" class="divide-y divide-gray-200">
            <?php foreach ($priority as $item):
                $d = $item['days_left'];
                if ($d < 0) { 
                    $badge_class = 'bg-red-50 text-red-700 ring-red-600/10'; 
                    $label = 'Expired'; 
                } elseif ($d <= $reminder_day) { 
                    $badge_class = 'bg-red-50 text-red-700 ring-red-600/10'; 
                    $label = "H-$d"; 
                } elseif ($d <= $reminder_day + 3) { 
                    $badge_class = 'bg-yellow-50 text-yellow-800 ring-yellow-600/20'; 
                    $label = "H-$d"; 
                } else { 
                    $badge_class = 'bg-emerald-50 text-emerald-700 ring-emerald-600/20'; 
                    $label = "H-$d"; 
                }
            ?>
            <li class="flex items-center justify-between gap-x-6 py-5 px-4 sm:px-6 hover:bg-gray-50 transition-colors">
              <div class="flex min-w-0 gap-x-4 items-center">
                <div class="size-12 flex-none rounded-xl bg-gray-50 flex items-center justify-center border border-gray-100">
                    <i class="fas <?= htmlspecialchars($item['icon']) ?> text-emerald-600 text-xl"></i>
                </div>
                <div class="min-w-0 flex-auto">
                  <p class="text-sm/6 font-semibold text-gray-900"><?= htmlspecialchars($item['nama_bahan']) ?></p>
                  <p class="mt-1 truncate text-xs/5 text-gray-500"><?= htmlspecialchars($item['nama_categories']) ?></p>
                </div>
              </div>
              <div class="flex flex-col items-end">
                <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset <?= $badge_class ?> mb-1"><?= $label ?></span>
                <p class="text-xs/5 text-gray-500">Exp: <?= date('d M Y', strtotime($item['tanggal_kadaluarsa'])) ?></p>
              </div>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php endif; ?>
        </div>
      </div>
    </main>
</div>
</body>
</html>
