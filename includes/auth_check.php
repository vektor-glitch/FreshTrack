<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['remember_me'])) {
        list($user_id, $token) = explode(':', $_COOKIE['remember_me'], 2);
        $hashed_token = hash('sha256', $token);

        if (!isset($connection) || !$connection) {
            include __DIR__ . '/../config/connection.php';
        }

        $stmt = $connection->prepare("SELECT username, remember_token, remember_token_expiry FROM users WHERE id = ?");
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $now = new DateTime();
            $expiry = new DateTime($user['remember_token_expiry']);

            if ($user['remember_token'] && hash_equals($user['remember_token'], $hashed_token) && $now < $expiry) {
                // Token valid, auto-login user
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $user['username'];
            } else {
                // Token invalid or expired, delete cookie
                setcookie('remember_me', '', time() - 3600, "/");
                header("Location: /Kuis-ResponsiPWD/FreshTrack/index.php", true, 302);
                exit();
            }
        } else {
            // User not found, delete cookie
            setcookie('remember_me', '', time() - 3600, "/");
            header("Location: /Kuis-ResponsiPWD/FreshTrack/index.php", true, 302);
            exit();
        }
    } else {
        // No session and no cookie, redirect to index
        header("Location: /Kuis-ResponsiPWD/FreshTrack/index.php", true, 302);
        exit();
    }
}
?>
