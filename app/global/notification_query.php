<?php

include('app/../../../conf/config.php');

// Ambil semua data notifikasi
$query = "SELECT * FROM db_notif";
$data = mysqli_query($koneksi, $query);

$result = [];
while ($row = mysqli_fetch_assoc($data)) {
    $result[] = $row;
}

// Ambil jumlah yang sudah dibaca (read = 1)
$query2 = "
    select 
        count(*) as total_read
    from 
        db_notif
    where
        baca = 0
";
$data2 = mysqli_query($koneksi, $query2);
$row2 = mysqli_fetch_assoc($data2);
$totalRead = $row2['total_read'];

echo json_encode([
    "data" => $result,
    "data2" => $totalRead
]);
