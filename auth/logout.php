<?php
session_start();

// Delete "Remember Me" cookie
if (isset($_COOKIE['remember_me'])) {
    include __DIR__ . '/../config/connection.php';
    
    // Delete token from database
    $stmt = $connection->prepare("UPDATE users SET remember_token = NULL, remember_token_expiry = NULL WHERE id = ?");
    $stmt->bind_param("s", $_SESSION['user_id']);
    $stmt->execute();

    // Delete cookie from browser
    setcookie('remember_me', '', time() - 3600, "/");
}

session_destroy();

// Clear browser history and prevent going back
header("Location: ../index.php", true, 302);
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
exit();
?>
