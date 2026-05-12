<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: /Kuis-ResponsiPWD/FreshTrack/auth/login.php"); exit(); }
include __DIR__ . '/../config/connection.php';

$base = "/Kuis-ResponsiPWD/FreshTrack/pages/inventories.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $user_id = $_SESSION['user_id'];

    if (empty($id)) {
        header("Location: $base?error=ID tidak valid"); exit();
    }

    $stmt = $connection->prepare("DELETE FROM inventories WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ss", $id, $user_id);

    if ($stmt->execute()) {
        header("Location: $base?success=" . urlencode("Bahan berhasil dihapus!"));
    } else {
        header("Location: $base?error=" . urlencode("Gagal menghapus bahan"));
    }
    exit();
}
header("Location: $base");
?>
