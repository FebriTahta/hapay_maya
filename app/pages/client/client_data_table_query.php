<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('app/../../../../conf/config.php');

$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

// Cek apakah koneksi database valid
if (!$koneksi) {
    die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]));
}

// Query utama
$query = "
    SELECT dc.*
    FROM db_client dc 
    WHERE dc.status_bayar IS NOT NULL 
    AND dc.awal_periode_bhp REGEXP '^[0-9]{2}/[0-9]{2}/[0-9]{4}$'
";

// Menyusun parameter query
$params = [];
$types = "";

if (!empty($tahun)) {
    $query .= " AND DATE_FORMAT(STR_TO_DATE(dc.awal_periode_bhp, '%d/%m/%Y'), '%Y') = ?";
    $params[] = $tahun;
    $types .= "s"; // 's' untuk string
}

if (!empty($status)) {
    $query .= " AND dc.status_bayar = ?";
    $params[] = $status;
    $types .= "s";
}

try {
    // Jika ada parameter, gunakan prepared statement
    if (!empty($params)) {
        $stmt = $koneksi->prepare($query);
        
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $koneksi->error);
        }

        // Bind parameter secara dinamis
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = $koneksi->query($query);
        if (!$result) {
            throw new Exception("Query execution failed: " . $koneksi->error);
        }
    }

    // Fetch hasil query
    $dataTableClient = $result->fetch_all(MYSQLI_ASSOC);

    // Tambahkan tombol action ke setiap baris
    foreach ($dataTableClient as &$row) {
        // tombol action
        $row['action'] = '
            <a href="index.php?page=client-edit&id='.$row['id'].'" class="edit-btn btn btn-sm btn-primary" style="width:100px; margin-bottom:5px"> 
                <i class="fa fa-edit"></i> Edit
            </a>
            <button class="delete-btn btn btn-sm btn-danger" style="width:100px; margin-bottom:5px" data-id="'.$row['id'].'">
                <i class="fa fa-trash"></i> Delete
            </button>
        ';

        // logic pewarnaan status bayar
        $class = ($row['status_bayar'] === 'LUNAS') ? 'btn-success' : (
            ($row['status_bayar'] === 'DENDA') ? 'btn-danger' : (
                ($row['status_bayar'] === 'TUNGGAK') ? 'btn-primary' : (
                    ($row['status_bayar'] === 'BATAL') ? 'btn-secondary' : 'btn-light'
                )
            )
        );

        // status bayar
        $row['akses_status_bayar'] = '
            <a href="index.php?page=status-tagihan&client_id='.$row['client_id'].'&status_bayar='.$row['status_bayar'].'&id='.$row['id'].'"
            class="btn btn-sm '.$class.'"
                style="width:100px; margin-bottom:5px"> 
                '.$row['status_bayar'].'
            </a>
        ';

        // normalisasi app_id dari import csv
        $row['app_id'] = number_format((float)$row['app_id'],0,'','');

        // format tanggal
        $row['terbit_spp'] =  date("j F Y", strtotime($row['terbit_spp']));
        $row['batas_bayar'] = date("j F Y", strtotime($row['batas_bayar']));
        $row['awal_periode_bhp'] = date("j F Y", strtotime($row['awal_periode_bhp']));

        // format number untuk nominal
        $row['potensi_bhp'] = 'Rp '.number_format((float)$row['potensi_bhp']);
        $row['besar_bhp'] = 'Rp '.number_format((float)$row['besar_bhp']);
        $row['bhp_terbayar'] = 'Rp '.number_format((float)$row['bhp_terbayar']);
        $row['denda_tunggakan'] = 'Rp '.number_format((float)$row['denda_tunggakan']);
        $row['bhp_dibatalkan'] = 'Rp '.number_format((float)$row['bhp_dibatalkan']);

        $color = ($row['tahun_periode'] < 6) ? 'badge badge-success' : (
            ($row['tahun_periode'] == 6) ? 'badge badge-danger' : (
                ($row['tahun_periode'] == 10) ? 'badge badge-warning' : ('badge badge-primary')
            )
        );
        // warna tahun
        $row['tahun_periode'] = '
            <p class="'.$color.'">'.$row['tahun_periode'].'</p>
        ';

    }

    // Jika data kosong, kirimkan respons kosong
    if (empty($dataTableClient)) {
        $dataTableClient = [];
    }

    // Set response JSON
    header('Content-Type: application/json');
    echo json_encode([
        "data_table_client" => $dataTableClient,
    ]);

    // Tutup statement jika digunakan
    if (!empty($params)) {
        $stmt->close();
    }
    $koneksi->close();

} catch (Exception $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
