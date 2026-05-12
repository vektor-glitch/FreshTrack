<?php
session_start();

// Hapus cookie "Ingat Saya"
if (isset($_COOKIE['remember_me'])) {
    include __DIR__ . '/../config/connection.php';
    
    // Hapus token dari database
    $stmt = $connection->prepare("UPDATE users SET remember_token = NULL, remember_token_expiry = NULL WHERE id = ?");
    $stmt->bind_param("s", $_SESSION['user_id']);
    $stmt->execute();

    // Hapus cookie dari browser
    setcookie('remember_me', '', time() - 3600, "/");
}

session_destroy();
header("Location: /Kuis-ResponsiPWD/FreshTrack/index.php");
exit();
?>
