<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include('app/../../../../conf/config.php');

    $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';

    // Cek apakah koneksi database valid
    if (!$koneksi) {
        die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]));
    }

    // Query Info
    $query = "
        SELECT 
            dc.status_bayar AS status_bayar,
            COUNT(dc.status_bayar) AS amount_status
        FROM db_client dc 
        WHERE dc.status_bayar IS NOT NULL 
        AND dc.awal_periode_bhp REGEXP '^[0-9]{2}/[0-9]{2}/[0-9]{4}$'
    ";

    $params = [];
    if (!empty($tahun)) {
        $query .= " AND DATE_FORMAT(STR_TO_DATE(dc.awal_periode_bhp, '%d/%m/%Y'), '%Y') = ?";
        $params[] = $tahun;
    }

    $query .= " GROUP BY dc.status_bayar";

    try {
        if (!empty($params)) {
            $stmt = $koneksi->prepare($query);
            
            if (!$stmt) {
                throw new Exception("Query preparation failed: " . $koneksi->error);
            }

            $stmt->bind_param("s", ...$params);
            $stmt->execute();

            $result = $stmt->get_result();

        } else {
            $result = $koneksi->query($query);
            if (!$result) {
                throw new Exception("Query execution failed: " . $koneksi->error);
            }
        }

        $infoDataClient = $result->fetch_all(MYSQLI_ASSOC);

        if (empty($infoDataClient)) {
            $infoDataClient = ["message" => "No data found"];
        }

        header('Content-Type: application/json');
        echo json_encode([
            "info_data_client" => $infoDataClient,
        ]);

        if (!empty($params)) {
            $stmt->close();
        }
        $koneksi->close();

    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }

    