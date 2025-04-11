<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('app/../../../../conf/config.php');

// Cek apakah koneksi database valid
if (!$koneksi) {
    die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]));
}

if (isset($_GET['client_id'])) {
    $client_id = trim($_GET['client_id']);
    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $client_id)) {
        die(json_encode(["error" => "Invalid client ID format"]));
    }

    $query = "
        SELECT 
            dt.id AS id_tagihan_client,
            dc.client_id, 
            dc.nama_client, 
            dt.id_invoice_surat, 
            dt.no_tagihan, 
            dt.terbit_surat,
            dt.batas_bayar_surat,
            dt.tagihan,
            dt.status_bayar_surat,
            dc.status_bayar
        FROM 
            db_tagihan dt
        LEFT JOIN db_client dc ON dc.client_id = dt.client_id 
        WHERE 
            dc.status_bayar IS NOT NULL
            AND dt.id_invoice_surat IS NOT NULL
            AND dt.no_tagihan IS NOT NULL
            AND dt.terbit_surat IS NOT NULL
            AND dt.batas_bayar_surat IS NOT NULL
            AND dt.tagihan IS NOT NULL
            AND dt.status_bayar_surat IS NOT NULL
            AND dc.awal_periode_bhp REGEXP '^[0-9]{2}/[0-9]{2}/[0-9]{4}$'
            AND dc.client_id = ?
        ORDER BY dc.id DESC
    ";

    try {
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $client_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $dataTableTagihanClient = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $dataTableTagihanClient[] = $row;
        }

        // Format kolom tagihan setelah semua data masuk
        foreach ($dataTableTagihanClient as &$row) {
            $row['tagihan'] = 'Rp ' . number_format((float)$row['tagihan'], 0, ',', '.');
        }

        echo json_encode(["data" => $dataTableTagihanClient]);

    } catch (\Throwable $th) {
        echo json_encode(['error' => 'An error occurred: ' . $th->getMessage()]);
    } finally {
        mysqli_close($koneksi);
    }
} else {
    die(json_encode(["error" => "Client ID not provided"]));
}