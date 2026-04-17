<?php
$host = "localhost";
$port = 8111;
$database = "freshtrack";
$user = "root";
$password = "";
$connection = mysqli_connect($host, $port, $database, $user, $password);
if ($connection) {
    $connection_status = "Connected Sucsessfully";
} else {
    $$connection_status = "Connection Failed! Please Try Again Later.";
    error_log("Connection Failed:".mysqli_connect_error());
}
?>