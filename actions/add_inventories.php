<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: /Kuis-ResponsiPWD/FreshTrack/auth/login.php"); exit(); }
include __DIR__ . '/../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $nama = trim($_POST['nama_bahan'] ?? '');
    $category_id = $_POST['category_id'] ?? '';
    $tanggal = $_POST['tanggal_kadaluarsa'] ?? '';

    if (empty($nama) || empty($category_id) || empty($tanggal)) {
        header("Location: /Kuis-ResponsiPWD/FreshTrack/pages/inventories.php?error=Semua field wajib diisi");
        exit();
    }

    $id = bin2hex(random_bytes(18));
    $stmt = $connection->prepare("INSERT INTO inventories (id, user_id, category_id, nama_bahan, tanggal_kadaluarsa) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $id, $user_id, $category_id, $nama, $tanggal);

    if ($stmt->execute()) {
        header("Location: /Kuis-ResponsiPWD/FreshTrack/pages/inventories.php?success=Bahan berhasil ditambahkan!");
    } else {
        header("Location: /Kuis-ResponsiPWD/FreshTrack/pages/inventories.php?error=Gagal menambahkan bahan");
    }
    exit();
}
header("Location: /Kuis-ResponsiPWD/FreshTrack/pages/inventories.php");
?>
