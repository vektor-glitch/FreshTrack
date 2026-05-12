<?php
// Pastikan ini dijalankan lewat CLI/Cron, bukan diakses langsung oleh user sembarangan
// php cron/send_reminders.php

include __DIR__ . '/../config/connection.php';

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

echo "Mulai mengecek bahan makanan...\n";

// 1. Ambil semua user yang mengaktifkan notifikasi email (email_notif = 1)
$user_query = "SELECT id, username, email, reminder_day FROM users WHERE email_notif = 1";
$user_result = $connection->query($user_query);

if ($user_result->num_rows > 0) {
    while ($user = $user_result->fetch_assoc()) {
        $user_id = $user['id'];
        $reminder_day = $user['reminder_day'];
        $email = $user['email'];
        $username = $user['username'];

        // 2. Cek bahan makanan user ini yang kedaluwarsanya kurang dari atau sama dengan reminder_day
        // (contoh: jika reminder_day = 3, maka H-3, H-2, H-1, dan Expired akan masuk)
        $item_query = "SELECT nama_bahan, tanggal_kadaluarsa, DATEDIFF(tanggal_kadaluarsa, CURDATE()) as days_left
                       FROM inventories 
                       WHERE user_id = ? AND DATEDIFF(tanggal_kadaluarsa, CURDATE()) <= ?
                       ORDER BY tanggal_kadaluarsa ASC";
                       
        $stmt = $connection->prepare($item_query);
        $stmt->bind_param("si", $user_id, $reminder_day);
        $stmt->execute();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        // 3. Jika ada bahan yang terdeteksi, susun dan kirim email
        if (count($items) > 0) {
            $subject = "Peringatan Kedaluwarsa Bahan Makanan - FreshTrack";
            
            $message = "Halo " . $username . ",\n\n";
            $message .= "Ini adalah pengingat otomatis dari FreshTrack. Berikut adalah bahan makanan Anda yang mendekati atau sudah kedaluwarsa:\n\n";
            
            foreach ($items as $item) {
                $status = $item['days_left'] < 0 ? "⚠️ SUDAH EXPIRED" : "⏳ H-" . $item['days_left'];
                $tanggal_format = date('d M Y', strtotime($item['tanggal_kadaluarsa']));
                $message .= "- " . $item['nama_bahan'] . " (Tanggal: " . $tanggal_format . " | Status: " . $status . ")\n";
            }
            
            $message .= "\nSegera cek dapur Anda dan masak bahan tersebut sebelum terbuang!\n\n";
            $message .= "Salam hemat,\nTim FreshTrack";
            
            // --- MENGIRIM EMAIL MENGGUNAKAN PHPMAILER ---
            try {
                $mail = new PHPMailer(true);
                
                // SMTP Configuration - Gmail
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'freshtrack2026@gmail.com';
                $mail->Password = 'vfwownsvocmngbaa';  // App password dari Google
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
                
                // Email settings
                $mail->setFrom('freshtrack2026@gmail.com', 'FreshTrack');
                $mail->addAddress($email, $username);
                $mail->Subject = $subject;
                $mail->Body = $message;
                $mail->isHTML(false);
                
                $dikirim = $mail->send();
                
                echo "============================================\n";
                echo "MENGIRIM EMAIL KE: " . $email . "\n";
                echo "STATUS PENGIRIMAN: BERHASIL DIKIRIM\n";
                echo "SUBJECT: " . $subject . "\n";
                echo "PESAN:\n" . $message . "\n";
                echo "============================================\n";
                
            } catch (Exception $e) {
                echo "============================================\n";
                echo "MENGIRIM EMAIL KE: " . $email . "\n";
                echo "STATUS PENGIRIMAN: GAGAL DIKIRIM\n";
                echo "ERROR: " . $mail->ErrorInfo . "\n";
                echo "============================================\n";
            }
        }
    }
}

echo "Selesai mengecek dan mengirim email.\n";
?>
