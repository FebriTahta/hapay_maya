<?php

    include('app/../../../conf/config.php');

    $query3 = "
        SELECT DISTINCT DATE_FORMAT(STR_TO_DATE(awal_periode_bhp, '%d/%m/%Y'), '%Y') AS tahun
        FROM db_client
        ORDER BY tahun ASC;
    ";

    $data3 = mysqli_query($koneksi, query: $query3);
    $result3 = [];
    while ($row = mysqli_fetch_assoc($data3)) {
        $result3[] = $row;
    }

    $jsonResult3 = json_encode($result3);

    echo json_encode(["data3" => $result3]);