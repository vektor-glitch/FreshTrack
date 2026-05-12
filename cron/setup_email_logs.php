<?php
// Script untuk membuat tabel email_logs
include __DIR__ . '/../config/connection.php';

$sql = "CREATE TABLE IF NOT EXISTS email_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(36),
    email VARCHAR(100),
    subject VARCHAR(255),
    message LONGTEXT,
    created_at DATETIME,
    sent_at DATETIME DEFAULT NULL
)";

if ($connection->query($sql) === TRUE) {
    echo "✓ Tabel email_logs berhasil dibuat atau sudah ada.\n";
} else {
    echo "✗ Error membuat tabel: " . $connection->error . "\n";
}

$connection->close();
?>
