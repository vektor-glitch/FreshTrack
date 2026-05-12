<?php
$current_page = basename($_SERVER['PHP_SELF']);
$base = '/Kuis-ResponsiPWD/FreshTrack';
?>

<!-- Mobile Sidebar Backdrop & Panel -->
<div id="mobile-sidebar" class="relative z-50 lg:hidden hidden" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-900/80 transition-opacity"></div>
  <div class="fixed inset-0 flex">
    <div class="relative mr-16 flex w-full max-w-xs flex-1 transform transition duration-300 ease-in-out">
      <div class="absolute top-0 left-full flex w-16 justify-center pt-5">
        <button type="button" id="close-sidebar-btn" class="-m-2.5 p-2.5">
          <span class="sr-only">Close sidebar</span>
          <i class="fas fa-times text-white text-xl"></i>
        </button>
      </div>

      <!-- Mobile Sidebar Content -->
      <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-emerald-600 px-6 pb-2">
        <div class="flex h-16 shrink-0 items-center gap-3">
          <img src="<?= $base ?>/assets/Logo_FreshTrack.png" alt="FreshTrack" class="h-8 w-auto bg-white rounded p-1" onerror="this.style.display='none'">
          <span class="text-xl font-bold text-white">FreshTrack</span>
        </div>
        <nav class="flex flex-1 flex-col">
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
              <ul role="list" class="-mx-2 space-y-1">
                <li>
                  <a href="<?= $base ?>/pages/dashboard.php" class="<?= $current_page === 'dashboard.php' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white' ?> group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold transition-colors">
                    <i class="fas fa-th-large size-5 shrink-0 pt-1 <?= $current_page === 'dashboard.php' ? 'text-white' : 'text-emerald-200 group-hover:text-white' ?>"></i>
                    Dashboard
                  </a>
                </li>
                <li>
                  <a href="<?= $base ?>/pages/inventories.php" class="<?= $current_page === 'inventories.php' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white' ?> group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold transition-colors">
                    <i class="fas fa-carrot size-5 shrink-0 pt-1 <?= $current_page === 'inventories.php' ? 'text-white' : 'text-emerald-200 group-hover:text-white' ?>"></i>
                    Ingredients
                  </a>
                </li>
                <li>
                  <a href="<?= $base ?>/pages/notification.php" class="<?= $current_page === 'notification.php' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white' ?> group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold transition-colors">
                    <i class="fas fa-bell size-5 shrink-0 pt-1 <?= $current_page === 'notification.php' ? 'text-white' : 'text-emerald-200 group-hover:text-white' ?>"></i>
                    Notifications
                  </a>
                </li>
                <li>
                  <a href="<?= $base ?>/pages/recipe.php" class="<?= $current_page === 'recipe.php' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white' ?> group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold transition-colors">
                    <i class="fas fa-utensils size-5 shrink-0 pt-1 <?= $current_page === 'recipe.php' ? 'text-white' : 'text-emerald-200 group-hover:text-white' ?>"></i>
                    Quick Recipes
                  </a>
                </li>
              </ul>
            </li>
            
            <li class="-mx-6 mt-auto">
              <a href="<?= $base ?>/auth/logout.php" onclick="return confirm('Yakin ingin logout?')" class="flex items-center gap-x-4 px-6 py-3 text-sm/6 font-semibold text-white hover:bg-emerald-700 transition-colors">
                <i class="fas fa-sign-out-alt size-5 pt-1 text-emerald-200"></i>
                <span aria-hidden="true">Logout</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</div>

<!-- Static sidebar for desktop -->
<div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
  <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-emerald-600 px-6 pb-4">
    <div class="flex h-16 shrink-0 items-center gap-3">
        <img src="<?= $base ?>/assets/Logo_FreshTrack.png" alt="FreshTrack" class="h-8 w-auto bg-white rounded p-1" onerror="this.style.display='none'">
        <span class="text-2xl font-bold text-white tracking-tight">FreshTrack</span>
    </div>
    <nav class="flex flex-1 flex-col">
      <ul role="list" class="flex flex-1 flex-col gap-y-7">
        <li>
          <ul role="list" class="-mx-2 space-y-1">
            <li>
                <a href="<?= $base ?>/pages/dashboard.php" class="<?= $current_page === 'dashboard.php' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white' ?> group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold transition-colors">
                <i class="fas fa-th-large size-5 shrink-0 pt-1 <?= $current_page === 'dashboard.php' ? 'text-white' : 'text-emerald-200 group-hover:text-white' ?>"></i>
                Dashboard
                </a>
            </li>
            <li>
                <a href="<?= $base ?>/pages/inventories.php" class="<?= $current_page === 'inventories.php' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white' ?> group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold transition-colors">
                <i class="fas fa-carrot size-5 shrink-0 pt-1 <?= $current_page === 'inventories.php' ? 'text-white' : 'text-emerald-200 group-hover:text-white' ?>"></i>
                Ingredients
                </a>
            </li>
            <li>
                <a href="<?= $base ?>/pages/notification.php" class="<?= $current_page === 'notification.php' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white' ?> group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold transition-colors">
                <i class="fas fa-bell size-5 shrink-0 pt-1 <?= $current_page === 'notification.php' ? 'text-white' : 'text-emerald-200 group-hover:text-white' ?>"></i>
                Notifications
                </a>
            </li>
            <li>
                <a href="<?= $base ?>/pages/recipe.php" class="<?= $current_page === 'recipe.php' ? 'bg-emerald-700 text-white' : 'text-emerald-100 hover:bg-emerald-700 hover:text-white' ?> group flex gap-x-3 rounded-md p-2 text-sm/6 font-semibold transition-colors">
                <i class="fas fa-utensils size-5 shrink-0 pt-1 <?= $current_page === 'recipe.php' ? 'text-white' : 'text-emerald-200 group-hover:text-white' ?>"></i>
                Quick Recipes
                </a>
            </li>
          </ul>
        </li>
        <li class="-mx-6 mt-auto border-t border-emerald-500">
          <a href="<?= $base ?>/auth/logout.php" onclick="return confirm('Yakin ingin logout?')" class="flex items-center gap-x-4 px-6 py-4 text-sm/6 font-semibold text-white hover:bg-emerald-700 transition-colors">
            <i class="fas fa-sign-out-alt size-5 pt-0.5 text-emerald-200 group-hover:text-white"></i>
            <span aria-hidden="true">Logout</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>

<!-- Mobile top navigation bar -->
<div class="sticky top-0 z-40 flex items-center gap-x-6 bg-emerald-600 px-4 py-4 shadow-sm sm:px-6 lg:hidden">
  <button type="button" id="open-sidebar-btn" class="-m-2.5 p-2.5 text-emerald-100 hover:text-white">
    <span class="sr-only">Open sidebar</span>
    <i class="fas fa-bars text-xl"></i>
  </button>
  <div class="flex-1 text-sm/6 font-semibold text-white tracking-wide"><?= htmlspecialchars($page_title ?? 'FreshTrack') ?></div>
  <a href="<?= $base ?>/auth/logout.php" onclick="return confirm('Yakin ingin logout?')">
    <span class="sr-only">Logout</span>
    <i class="fas fa-sign-out-alt text-emerald-100 hover:text-white text-lg"></i>
  </a>
</div>

<script>
// Mobile sidebar toggle logic
document.addEventListener('DOMContentLoaded', () => {
  const openBtn = document.getElementById('open-sidebar-btn');
  const closeBtn = document.getElementById('close-sidebar-btn');
  const sidebar = document.getElementById('mobile-sidebar');

  if(openBtn && closeBtn && sidebar) {
    openBtn.addEventListener('click', () => {
      sidebar.classList.remove('hidden');
    });
    closeBtn.addEventListener('click', () => {
      sidebar.classList.add('hidden');
    });
  }
});
</script>
