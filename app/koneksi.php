<?php
// Koneksi ke database
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username database
$password = ""; // Sesuaikan dengan password database
$database = "db_hapay"; // Sesuaikan dengan nama database

$conn = new mysqli($servername, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
