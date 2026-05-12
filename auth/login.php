<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: /Kuis-ResponsiPWD/FreshTrack/pages/dashboard.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include __DIR__ . '/../config/connection.php';

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Email dan password wajib diisi.';
    } else {
        $stmt = $connection->prepare("SELECT id, username, password_hash FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password_hash']) || $password === $user['password_hash']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                if (isset($_POST['remember-me'])) {
                    $token = bin2hex(random_bytes(32));
                    $hashed_token = hash('sha256', $token);
                    $expiry = date('Y-m-d H:i:s', time() + (30 * 24 * 60 * 60)); // 30 days

                    $update_stmt = $connection->prepare("UPDATE users SET remember_token = ?, remember_token_expiry = ? WHERE id = ?");
                    $update_stmt->bind_param("sss", $hashed_token, $expiry, $user['id']);
                    $update_stmt->execute();

                    setcookie('remember_me', $user['id'] . ':' . $token, time() + (30 * 24 * 60 * 60), "/");
                }

                header("Location: /Kuis-ResponsiPWD/FreshTrack/pages/dashboard.php");
                exit();
            } else {
                $error = 'Password salah.';
            }
        } else {
            $error = 'Email tidak ditemukan.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-emerald-800">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FreshTrack</title>
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
          <a href="login.php" class="flex-1 rounded-lg bg-white/20 py-2.5 text-center text-sm font-semibold text-white shadow-sm transition-all">Sign In</a>
          <a href="register.php" class="flex-1 rounded-lg py-2.5 text-center text-sm font-medium text-white/80 hover:text-white hover:bg-white/5 transition-all">Create Account</a>
        </div>
      </div>

      <!-- Bottom White Form Section -->
      <div class="px-6 py-8 sm:px-12">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Welcome back!</h2>
        <p class="mt-2 text-sm text-gray-500 mb-8">Sign in to manage your kitchen inventory</p>

        <?php if ($error): ?>
            <div class="mb-6 rounded-md bg-red-50 p-4 border border-red-200">
              <div class="flex">
                <div class="shrink-0"><i class="fas fa-exclamation-circle text-red-400"></i></div>
                <div class="ml-3"><h3 class="text-sm font-medium text-red-800"><?= htmlspecialchars($error) ?></h3></div>
              </div>
            </div>
        <?php endif; ?>
        <?php if (isset($_GET['registered'])): ?>
            <div class="mb-6 rounded-md bg-emerald-50 p-4 border border-emerald-200">
              <div class="flex">
                <div class="shrink-0"><i class="fas fa-check-circle text-emerald-400"></i></div>
                <div class="ml-3"><h3 class="text-sm font-medium text-emerald-800">Registration successful! Please login.</h3></div>
              </div>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="space-y-5">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
            <div class="mt-1">
              <input id="email" type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required autocomplete="email" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="sarah@example.com" />
            </div>
          </div>

          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <div class="mt-1 relative">
              <input id="password" type="password" name="password" required autocomplete="current-password" class="block w-full rounded-xl border border-gray-200 bg-white px-4 py-3 pr-10 text-sm text-gray-900 outline-none transition-all placeholder:text-gray-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Enter your password" />
              <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

          <div class="flex items-center">
            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-600">
            <label for="remember-me" class="ml-3 block text-sm text-gray-700">Remember me</label>
          </div>

          <div>
            <button type="submit" class="flex w-full justify-center rounded-xl bg-emerald-600 px-3 py-3 text-sm font-semibold text-white shadow-sm transition-all hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600">Sign in</button>
          </div>
        </form>
        </form>

        <p class="mt-8 text-center text-sm text-gray-500">
          Don't have an account?
          <a href="register.php" class="font-semibold text-emerald-600 hover:text-emerald-500 transition-colors">Create one free</a>
        </p>
      </div>
    </div>
  </div>
</div>
<script src="../js/login.js"></script>
</body>
</html>
