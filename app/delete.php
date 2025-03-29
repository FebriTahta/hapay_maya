<?php
include '../conf/config.php';

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM db_client WHERE id='$id'");

header("location:index.php?page=data");
?>
