<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('app/../../../../conf/config.php');

// Cek apakah koneksi database valid
if (!$koneksi) {
    die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]));
}

if (isset($_GET['id'])) {
    $id = trim($_GET['id']);
    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $id)) {
        die(json_encode(["error" => "Invalid client ID format"]));
    }

    $query = "select * from db_client dc  where  dc.id = ?";

    try {

        if (isset($_GET['notif_id'])) {
            $notif_id = intval($_GET['notif_id']); // pastikan integer
        
            // Cek apakah notif dengan id tersebut ada dan belum dibaca
            $checkQuery = "SELECT 1 FROM db_notif WHERE id = ? AND baca != 1 LIMIT 1";
            $checkStmt = mysqli_prepare($koneksi, $checkQuery);
            mysqli_stmt_bind_param($checkStmt, "i", $notif_id);
            mysqli_stmt_execute($checkStmt);
            $checkResult = mysqli_stmt_get_result($checkStmt);
        
            if (mysqli_num_rows($checkResult) > 0) {
                // Jika ada, update baca = 1
                $updateQuery = "UPDATE db_notif SET baca = 1 WHERE id = ?";
                $updateStmt = mysqli_prepare($koneksi, $updateQuery);
                mysqli_stmt_bind_param($updateStmt, "i", $notif_id);
                mysqli_stmt_execute($updateStmt);
            }
        }        
        
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $dataTableTagihanClient = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $dataTableTagihanClient[] = $row;
        }

        echo json_encode(["data" => $dataTableTagihanClient]);

    } catch (\Throwable $th) {
        echo json_encode(['error' => 'An error occurred: ' . $th->getMessage()]);
    } finally {
        mysqli_close($koneksi);
    }

}else{
    die(json_encode(value: ["error" => "ID not provided"]));
}