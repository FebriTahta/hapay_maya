<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include('app/../../../../conf/config.php');

    // Cek apakah koneksi database valid
    if (!$koneksi) {
        die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]));
    }

    $query ="
        insert into db_tagihan(
            id,
            bulan,
            no,
            nama_client,
            alamat_client,
            client_id,
            id_invoice_surat,
            no_tagihan,
            terbit_surat,
            batas_bayar_surat,
            tagihan,
            status_bayar_surat
        )
        values (?,?,?,?,?,?,?,?,?,?,?,?)
    ";

    try {
        $stmt = $koneksi->prepare($query);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $koneksi->error);
        }
        // $terbit_surat = date("d/m/Y", strtotime($_POST['terbit_surat']));
        // $batas_bayar_surat = date("d/m/Y", strtotime($_POST['batas_bayar_surat']));
        
        $result = $koneksi->query("SELECT MAX(id) AS last_id FROM db_tagihan");
        $row = $result->fetch_assoc();
        $last_id = $row['last_id'] ?? 0; // Jika tidak ada data, mulai dari 0
        $new_id = $last_id + 1; // ID baru

        $stmt->bind_param('iiisssssssis',
            $new_id,
            $_POST['bulan'],
            $_POST['no'],
            $_POST['nama_client'],
            $_POST['alamat_client'],
            $_POST['client_id'],
            $_POST['id_invoice_surat'],
            $_POST['no_tagihan'],
            $_POST['terbit_surat'], // $terbit_surat, // ✅ pakai variabel ini
            $_POST['batas_bayar_surat'], // $batas_bayar_surat, // ✅ pakai variabel ini
            $_POST['tagihan'],
            $_POST['status']
        );
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            // UPDATE status_bayar di db_client
            $updateQuery = "UPDATE db_client SET status_bayar = ? WHERE id = ?";
            $updateStmt = $koneksi->prepare($updateQuery);
            if (!$updateStmt) {
                throw new Exception("Update preparation failed: " . $koneksi->error);
            }
    
            $updateStmt->bind_param('si', $_POST['status'], $_POST['id_client']);
            $updateStmt->execute();
    
            echo json_encode(["success" => true, "message" => "Data inserted and client status updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "No rows affected in insert."]);
        }
    } catch (\Throwable $th) {
        echo json_encode(["error" => false, "message" => $th->getMessage()]);
    }