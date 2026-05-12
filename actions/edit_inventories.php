<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: /Kuis-ResponsiPWD/FreshTrack/auth/login.php"); exit(); }
include __DIR__ . '/../config/connection.php';

$base = "/Kuis-ResponsiPWD/FreshTrack/pages/inventories.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $action = $_POST['action'] ?? '';
    $user_id = $_SESSION['user_id'];

    if (empty($id)) {
        header("Location: $base?error=ID tidak valid"); exit();
    }

    // Status quick actions (cooked/discard) - delete the item as it's been used
    if ($action === 'status_cooked' || $action === 'status_discard') {
        $stmt = $connection->prepare("DELETE FROM inventories WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ss", $id, $user_id);
        $stmt->execute();
        $msg = $action === 'status_cooked' ? 'Bahan ditandai sudah dimasak!' : 'Bahan ditandai sudah dibuang.';
        header("Location: $base?success=" . urlencode($msg));
        exit();
    }

    // Update action
    if ($action === 'update') {
        $nama = trim($_POST['nama_bahan'] ?? '');
        $category_id = $_POST['category_id'] ?? '';
        $tanggal = $_POST['tanggal_kadaluarsa'] ?? '';

        if (empty($nama) || empty($category_id) || empty($tanggal)) {
            header("Location: $base?error=Semua field wajib diisi"); exit();
        }

        $stmt = $connection->prepare("UPDATE inventories SET nama_bahan = ?, category_id = ?, tanggal_kadaluarsa = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
        $stmt->bind_param("sssss", $nama, $category_id, $tanggal, $id, $user_id);

        if ($stmt->execute()) {
            header("Location: $base?success=" . urlencode("Bahan berhasil diupdate!"));
        } else {
            header("Location: $base?error=" . urlencode("Gagal mengupdate bahan"));
        }
        exit();
    }
}
header("Location: $base");
?>
