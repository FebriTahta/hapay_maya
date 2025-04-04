<?php
    include('app/../../../../conf/config.php');

    if (isset($_GET['client_id'])) {
        $client_id = $_GET['client_id'];
        $query = "SELECT * FROM db_client WHERE client_id = '$client_id'";
        $result = mysqli_query($koneksi, $query);
        $data = mysqli_fetch_assoc($result);

        echo json_encode(['data' => $data]);
    }
    else {
        echo json_encode(['error' => 'Client ID not provided']);
    }