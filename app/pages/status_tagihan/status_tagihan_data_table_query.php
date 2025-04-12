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
            dt.client_id, 
            dt.nama_client, 
            dt.id_invoice_surat, 
            dt.no_tagihan, 
            dt.terbit_surat,
            dt.batas_bayar_surat,
            dt.tagihan,
            dt.status_bayar_surat
        FROM 
            db_tagihan dt 
        WHERE dt.client_id = ?
        ORDER BY dt.id DESC;
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