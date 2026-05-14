<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: /Kuis-ResponsiPWD/FreshTrack/pages/dashboard.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include __DIR__ . '/../config/connection.php';

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $error = 'All fields are required.';
    } elseif ($password !== $confirm) {
        $error = 'Password and confirmation password do not match.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        // Check duplikasi email
        $stmt = $connection->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $error = 'Email is already registered. Please login.';
        } else {
            $id = bin2hex(random_bytes(18));
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt2 = $connection->prepare("INSERT INTO users (id, username, password_hash, email) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("ssss", $id, $username, $hash, $email);
            if ($stmt2->execute()) {
                $success = 'Registration successful! Please login.';
            } else {
                $error = 'An error occurred. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-emerald-800">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FreshTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="h-full antialiased bg-emerald-800">
<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-[480px]">
    <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-emerald-700/30">
      
      <!-- Top Green Section -->
      <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 px-6 py-8 sm:px-12">
        <!-- Logo -->
        <div class="flex items-center gap-3 mb-8">
          <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white/20 backdrop-blur-sm overflow-hidden p-2">
            <img src="../assets/Logo_FreshTrack.png" alt="FreshTrack" class="h-full w-full object-contain filter brightness-0 invert" onerror="this.outerHTML='<i class=\'fas fa-leaf text-white text-xl\'></i>'" />
          </div>
          <span class="text-2xl font-bold text-white tracking-tight">FreshTrack</span>
        </div>

        <!-- Auth Tabs -->
        <div class="flex rounded-xl bg-white/10 p-1 backdrop-blur-sm">
          <a href="login.php" class="flex-1 rounded-lg py-2.5 text-center text-sm font-medium text-white/80 hover:text-white hover:bg-white/5 transition-all">Sign In</a>
          <a href="register.php" class="flex-1 rounded-lg bg-white/20 py-2.5 text-center text-sm font-semibold text-white shadow-sm transition-all">Create Account</a>
        </div>
      </div>

      <!-- Bottom White Form Section -->
      <div class="px-6 py-8 sm:px-12">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Create New Account</h2>
        <p class="mt-2 text-sm text-gray-500 mb-8">Start managing your kitchen smartly</p>

        <?php if ($error): ?>
            <div class="mb-6 rounded-md bg-red-50 p-4 border border-red-200">
              <div class="flex">
                <div class="shrink-0"><i class="fas fa-exclamation-circle text-red-400"></i></div>
                <div class="ml-3"><h3 class="text-sm font-medium text-red-800"><?= htmlspecialchars($error) ?></h3></div>
              </div>
            </div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="mb-6 rounded-md bg-emerald-50 p-4 border border-emerald-200">
              <div class="flex">
                <div class="shrink-0"><i class="fas fa-check-circle text-emerald-400"></i></div>
                <div class="ml-3"><h3 class="text-sm font-medium text-emerald-800"><?= htmlspecialchars($success) ?></h3></div>
              </div>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-5">
          <div>
            <label for="username" class="block text-sm font-medium text-gray-700">Full Name</label>
            <div class="mt-1">
              <input id="username" type="text" name="username" value="<?= htmlspecialchars($username ?? '') ?>" required class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Enter your name" />
            </div>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <div class="mt-1">
              <input id="email" type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required autocomplete="email" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="email@example.com" />
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="mt-1 relative">
              <input id="password" type="password" name="password" required class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 pr-10" placeholder="Minimum 6 characters" />
              <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition-colors togglePasswordBtn" data-target="password">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

          <div>
            <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <div class="mt-1 relative">
              <input id="confirm_password" type="password" name="confirm_password" required class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 pr-10" placeholder="Repeat password" />
              <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-gray-600 transition-colors togglePasswordBtn" data-target="confirm_password">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

          <div class="pt-2">
            <button type="submit" class="flex w-full justify-center items-center gap-2 rounded-xl bg-emerald-500 px-4 py-3.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-500 transition-all">
              <i class="fas fa-user-plus"></i> Create Account
            </button>
          </div>
        </form>

        <p class="mt-8 text-center text-sm text-gray-500">
          Already have an account?
          <a href="login.php" class="font-semibold text-emerald-600 hover:text-emerald-500 transition-colors">Login here</a>
        </p>
      </div>
    </div>
  </div>
</div>
<script src="../js/register.js"></script>
</body>
</html>
