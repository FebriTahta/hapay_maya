<?php
include('app/../../../../conf/config.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Hapus data dari db_client
    $stmt = $koneksi->prepare("DELETE FROM db_client WHERE id = ?");
    
    if ($stmt) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            // Jika berhasil menghapus dari db_client, hapus juga dari db_notif jika ada
            $stmtNotif = $koneksi->prepare("DELETE FROM db_notif WHERE id_client = ?");
            $stmtNotif->bind_param("i", $id);
            $stmtNotif->execute();
            $stmtNotif->close();

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