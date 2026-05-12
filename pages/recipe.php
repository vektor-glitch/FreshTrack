<?php
include __DIR__ . '/../config/connection.php';
include __DIR__ . '/../includes/auth_check.php';

$page_title = 'Resep Dadakan';

// Ambil semua resep beserta bahan-bahannya dari database
$recipes = $connection->query("SELECT * FROM recipe ORDER BY created_at DESC")->fetch_all(MYSQLI_ASSOC);

foreach ($recipes as &$recipe) {
    $stmt = $connection->prepare("SELECT nama_bahan FROM recipe_ingredients WHERE recipe_id = ?");
    $stmt->bind_param("s", $recipe['id']);
    $stmt->execute();
    $ingredients = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $recipe['ingredients'] = array_column($ingredients, 'nama_bahan');
}
unset($recipe);
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div>
    <?php require_once __DIR__ . '/../includes/sidebar.php'; ?>
    <main class="py-10 lg:pl-72">
      <div class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900"><i class="fas fa-utensils text-emerald-600 mr-2"></i> Quick Recipes</h1>
            <p class="mt-2 text-sm text-gray-600">Inspirasi resep cepat untuk menggunakan bahan yang mendekati kedaluwarsa.</p>
        </div>

        <?php if (empty($recipes)): ?>
        <div class="text-center py-16 bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100">
                <i class="fas fa-book-open text-emerald-600 text-xl"></i>
            </div>
            <h3 class="mt-4 text-sm font-semibold text-gray-900">No recipes yet</h3>
            <p class="mt-2 text-sm text-gray-500">Recipes will be added soon.</p>
        </div>
        <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $delay = 100; foreach ($recipes as $r): ?>
            <div onclick="openRecipe('<?= $r['id'] ?>')" class="group cursor-pointer bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300 animate-slide-up delay-<?= $delay ?>">
                <div class="aspect-[16/9] w-full overflow-hidden bg-gray-200">
                    <img src="../assets/<?= htmlspecialchars($r['gambar']) ?>" alt="<?= htmlspecialchars($r['judul']) ?>" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-emerald-600 transition-colors"><?= htmlspecialchars($r['judul']) ?></h3>
                    <p class="text-sm text-gray-600 mb-4 line-clamp-2"><?= htmlspecialchars($r['deskripsi_singkat']) ?></p>
                    <div class="flex items-center gap-4 text-xs font-medium text-gray-500">
                        <span class="flex items-center gap-1.5"><i class="fas fa-clock text-emerald-500"></i> <?= $r['estimasi_waktu'] ?> mins</span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-leaf text-emerald-500"></i> <?= count($r['ingredients']) ?> ingredients</span>
                    </div>
                </div>
            </div>
            <?php $delay += 100; if($delay > 500) $delay = 100; endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </main>
</div>

<!-- Recipe Detail Modals -->
<?php foreach ($recipes as $r): ?>
<div id="recipe-<?= $r['id'] ?>" class="relative z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-500/75 transition-opacity"></div>
  <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div class="relative transform overflow-hidden rounded-2xl bg-white px-4 pb-4 pt-5 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl sm:p-6">
        <div class="absolute right-0 top-0 hidden pr-4 pt-4 sm:block">
          <button type="button" onclick="closeModal('recipe-<?= $r['id'] ?>')" class="rounded-md bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
            <span class="sr-only">Close</span>
            <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
          </button>
        </div>
        
        <div class="sm:flex sm:items-start">
          <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
            <h2 class="text-2xl font-bold leading-6 text-gray-900" id="modal-title"><?= htmlspecialchars($r['judul']) ?></h2>
            <div class="mt-2">
              <p class="text-sm text-gray-500"><?= htmlspecialchars($r['deskripsi_singkat']) ?></p>
            </div>
            
            <div class="mt-4 flex items-center gap-2 text-sm font-medium text-emerald-600 bg-emerald-50 w-max px-3 py-1.5 rounded-full">
                <i class="fas fa-clock"></i> <?= $r['estimasi_waktu'] ?> minutes
            </div>
            
            <div class="mt-6 border-t border-gray-100 pt-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center gap-2"><i class="fas fa-carrot text-emerald-500"></i> Ingredients</h3>
                <div class="flex flex-wrap gap-2 mb-6">
                    <?php foreach ($r['ingredients'] as $ing): ?>
                    <span class="inline-flex items-center rounded-md bg-gray-50 px-2.5 py-1.5 text-sm font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                        <?= htmlspecialchars($ing) ?>
                    </span>
                    <?php endforeach; ?>
                </div>
                
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2"><i class="fas fa-list-ol text-emerald-500"></i> Instructions</h3>
                <ol class="space-y-4 list-decimal list-inside text-gray-600 text-sm">
                    <?php
                    $steps = explode("\n", $r['langkah_pembuatan']);
                    foreach ($steps as $step):
                        $step = trim($step);
                        if (empty($step)) continue;
                        $step = preg_replace('/^\d+\.\s*/', '', $step);
                    ?>
                    <li class="pl-2 leading-relaxed"><?= htmlspecialchars($step) ?></li>
                    <?php endforeach; ?>
                </ol>
            </div>
          </div>
        </div>
        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse sm:hidden">
          <button type="button" onclick="closeModal('recipe-<?= $r['id'] ?>')" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach; ?>

<script>
function openRecipe(id) { document.getElementById('recipe-' + id).classList.remove('hidden'); }
function closeModal(id) { document.getElementById(id).classList.add('hidden'); }
</script>
</body>
</html>
