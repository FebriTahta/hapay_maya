<?php
include('app/../../../../conf/config.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $koneksi->prepare("DELETE FROM db_client WHERE id = ?");
    
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo json_encode(["success" => 201, "message" => "Data deleted successfully."]);
        } else {
            echo json_encode(["error" => 500, "message" => "Failed to execute delete query."]);
        }
        $stmt->close();
    } else {
        echo json_encode(["error" => 500, "message" => "Failed to prepare statement."]);
    }
} else {
    echo json_encode(["error" => 500, "message" => "ID not set in request."]);
}