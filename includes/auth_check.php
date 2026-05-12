<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /Kuis-ResponsiPWD/FreshTrack/auth/login.php");
    exit();
}
?>
