<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('app/../../../../conf/config.php');

// Cek apakah koneksi database valid
if (!$koneksi) {
    die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]));
}

if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];

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
            dt.status_bayar_surat 
        FROM 
            db_tagihan dt
        left join db_client dc on dc.client_id = dt.client_id 
        WHERE 
            dc.status_bayar IS NOT NULL
            AND dt.id_invoice_surat IS NOT NULL
            AND dt.no_tagihan IS NOT NULL
            AND dt.terbit_surat IS NOT NULL
            AND dt.batas_bayar_surat IS NOT NULL
            AND dt.tagihan IS NOT NULL
            AND dt.status_bayar_surat IS NOT NULL
            AND dc.awal_periode_bhp REGEXP '^[0-9]{2}/[0-9]{2}/[0-9]{4}$'
            AND dc.client_id = '$client_id'
    ";

    try {
        $result = mysqli_query($koneksi, $query);
        if (!$result) {
            die(json_encode(["error" => "Query execution failed: " . mysqli_error($koneksi)]));
        }

        $dataTableTagihanClient = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $dataTableTagihanClient[] = $row;
        }

        // Format yang sesuai untuk DataTables
        echo json_encode([
            "data" => $dataTableTagihanClient
        ]);

    } catch (\Throwable $th) {
        echo json_encode(['error' => 'An error occurred: ' . $th->getMessage()]);
    } finally {
        mysqli_close($koneksi);
    }
} else {
    die(json_encode(["error" => "Client ID not provided"]));
}
