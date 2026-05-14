<?php
require_once __DIR__ . '/../includes/auth_check.php';
include __DIR__ . '/../config/connection.php';

$user_id = $_SESSION['user_id'];
$page_title = 'Notification Settings';
$success = '';

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reminder_day = intval($_POST['reminder_day'] ?? 3);
    if (!in_array($reminder_day, [1, 3, 7])) $reminder_day = 3;

    $stmt = $connection->prepare("UPDATE users SET reminder_day = ?, updated_at = NOW() WHERE id = ?");
    $stmt->bind_param("is", $reminder_day, $user_id);
    if ($stmt->execute()) {
        $success = 'Notification settings saved successfully!';
    }
}

// Get current setting
$stmt = $connection->prepare("SELECT reminder_day FROM users WHERE id = ?");
$stmt->bind_param("s", $user_id);
$stmt->execute();
$current = $stmt->get_result()->fetch_assoc()['reminder_day'] ?? 3;
?>
<?php require_once __DIR__ . '/../includes/header.php'; ?>
<div>
    <?php require_once __DIR__ . '/../includes/sidebar.php'; ?>
    <main class="py-10 lg:pl-72">
      <div class="px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900"><i class="fas fa-bell text-emerald-600 mr-2"></i> Notifications</h1>
            <p class="mt-2 text-sm text-gray-600">Manage your reminder settings to prevent food waste.</p>
        </div>

        <?php if ($success): ?>
            <div class="mb-6 rounded-md bg-emerald-50 p-4 border border-emerald-200">
                <div class="flex">
                    <div class="shrink-0"><i class="fas fa-check-circle text-emerald-400"></i></div>
                    <div class="ml-3"><h3 class="text-sm font-medium text-emerald-800"><?= htmlspecialchars($success) ?></h3></div>
                </div>
            </div>
        <?php endif; ?>

        <div class="bg-white shadow-sm ring-1 ring-gray-200 sm:rounded-xl">
            <div class="px-4 py-6 sm:p-8">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Expiration Reminder Time</h2>
                <p class="mt-1 text-sm leading-6 text-gray-500 mb-6">Choose how many days before the expiration date you want to receive alerts on the Dashboard.</p>

                <form method="POST" action="">
                    <fieldset>
                        <legend class="sr-only">Reminder Settings</legend>
                        <div class="space-y-4">
                            <!-- Option 1 -->
                            <label class="relative block cursor-pointer rounded-lg border bg-white px-6 py-4 shadow-sm focus:outline-none sm:flex sm:justify-between transition-colors <?= $current == 1 ? 'border-emerald-600 ring-1 ring-emerald-600' : 'border-gray-300 hover:bg-gray-50' ?>" onclick="selectRadio(this)">
                                <input type="radio" name="reminder_day" value="1" class="sr-only" <?= $current == 1 ? 'checked' : '' ?>>
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">D-1 (1 Day Before)</p>
                                        <div class="text-gray-500">
                                            <p class="sm:inline">Alert sent 1 day before expiration.</p>
                                            <span class="hidden sm:inline sm:mx-1">&middot;</span>
                                            <p class="sm:inline">Perfect if you check your kitchen daily.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 flex text-sm sm:mt-0 sm:block sm:ml-4 sm:text-right">
                                    <div class="font-medium <?= $current == 1 ? 'text-emerald-600' : 'text-gray-400' ?>"><i class="fas fa-check-circle text-xl"></i></div>
                                </div>
                                <span class="pointer-events-none absolute -inset-px rounded-lg border-2 <?= $current == 1 ? 'border-emerald-600' : 'border-transparent' ?>" aria-hidden="true"></span>
                            </label>

                            <!-- Option 3 -->
                            <label class="relative block cursor-pointer rounded-lg border bg-white px-6 py-4 shadow-sm focus:outline-none sm:flex sm:justify-between transition-colors <?= $current == 3 ? 'border-emerald-600 ring-1 ring-emerald-600' : 'border-gray-300 hover:bg-gray-50' ?>" onclick="selectRadio(this)">
                                <input type="radio" name="reminder_day" value="3" class="sr-only" <?= $current == 3 ? 'checked' : '' ?>>
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">D-3 (3 Days Before)</p>
                                        <div class="text-gray-500">
                                            <p class="sm:inline">Moderate reminder.</p>
                                            <span class="hidden sm:inline sm:mx-1">&middot;</span>
                                            <p class="sm:inline">Gives you enough time to plan a meal.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 flex text-sm sm:mt-0 sm:block sm:ml-4 sm:text-right">
                                    <div class="font-medium <?= $current == 3 ? 'text-emerald-600' : 'text-gray-400' ?>"><i class="fas fa-check-circle text-xl"></i></div>
                                </div>
                                <span class="pointer-events-none absolute -inset-px rounded-lg border-2 <?= $current == 3 ? 'border-emerald-600' : 'border-transparent' ?>" aria-hidden="true"></span>
                            </label>

                            <!-- Option 7 -->
                            <label class="relative block cursor-pointer rounded-lg border bg-white px-6 py-4 shadow-sm focus:outline-none sm:flex sm:justify-between transition-colors <?= $current == 7 ? 'border-emerald-600 ring-1 ring-emerald-600' : 'border-gray-300 hover:bg-gray-50' ?>" onclick="selectRadio(this)">
                                <input type="radio" name="reminder_day" value="7" class="sr-only" <?= $current == 7 ? 'checked' : '' ?>>
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">D-7 (7 Days Before)</p>
                                        <div class="text-gray-500">
                                            <p class="sm:inline">Early warning.</p>
                                            <span class="hidden sm:inline sm:mx-1">&middot;</span>
                                            <p class="sm:inline">Ideal for weekly meal planning.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 flex text-sm sm:mt-0 sm:block sm:ml-4 sm:text-right">
                                    <div class="font-medium <?= $current == 7 ? 'text-emerald-600' : 'text-gray-400' ?>"><i class="fas fa-check-circle text-xl"></i></div>
                                </div>
                                <span class="pointer-events-none absolute -inset-px rounded-lg border-2 <?= $current == 7 ? 'border-emerald-600' : 'border-transparent' ?>" aria-hidden="true"></span>
                            </label>
                        </div>
                    </fieldset>
                    
                    <div class="mt-8 flex justify-end">
                        <button type="submit" class="inline-flex items-center gap-x-2 rounded-md bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600 transition-colors">
                            <i class="fas fa-save"></i>
                            Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </main>
</div>
<script>
function selectRadio(el) {
    // Reset all labels
    document.querySelectorAll('label.relative').forEach(label => {
        label.classList.remove('border-emerald-600', 'ring-1', 'ring-emerald-600');
        label.classList.add('border-gray-300', 'hover:bg-gray-50');
        
        const iconContainer = label.querySelector('.mt-2.flex > div');
        iconContainer.classList.remove('text-emerald-600');
        iconContainer.classList.add('text-gray-400');
        
        const borderSpan = label.querySelector('span[aria-hidden="true"]');
        borderSpan.classList.remove('border-emerald-600');
        borderSpan.classList.add('border-transparent');
    });
    
    // Set active label
    el.classList.remove('border-gray-300', 'hover:bg-gray-50');
    el.classList.add('border-emerald-600', 'ring-1', 'ring-emerald-600');
    
    const activeIconContainer = el.querySelector('.mt-2.flex > div');
    activeIconContainer.classList.remove('text-gray-400');
    activeIconContainer.classList.add('text-emerald-600');
    
    const activeBorderSpan = el.querySelector('span[aria-hidden="true"]');
    activeBorderSpan.classList.remove('border-transparent');
    activeBorderSpan.classList.add('border-emerald-600');
    
    // Check inner radio button
    const radio = el.querySelector('input[type="radio"]');
    radio.checked = true;
}
</script>
</body>
</html>
