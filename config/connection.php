<?php
$host = "localhost";
$port = 8111;
$database = "freshtrack";
$user = "root";
$password = "";

$connection = new mysqli($host, $user, $password, $database, $port);

if ($connection->connect_error) {
    error_log("Connection Failed: " . $connection->connect_error);
    die("Connection Failed! Please Try Again Later.");
}

$connection->set_charset("utf8mb4");
?>