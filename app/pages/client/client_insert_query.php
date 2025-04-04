<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include('app/../../../../conf/config.php');

    // Cek apakah koneksi database valid
    if (!$koneksi) {
        die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()]));
    }

    $query = "
        insert into db_client (
            id,
            wilayah,
            bulan,
            no,
            nama_client,
            alamat_client,
            client_id, 
            app_id, 
            no_simf,
            id_invoice,
            no_spp,
            service,
            terbit_spp,
            batas_bayar,
            awal_periode_bhp,
            potensi_bhp,
            besar_bhp,
            tahun_periode,
            status_bayar,
            status_isr,
            tgl_pembayaran,
            bhp_terbayar,
            bhp_dibatalkan,
            denda_tunggakan,
            keterangan
        )
        values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
    ";

    try {
        //code...
        $stmt = $koneksi->prepare($query);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $koneksi->error);
        }

        // Validasi integer wajib dan harus angka
        $intFields = ['client_id', 'besar_bhp'];
        foreach ($intFields as $field) {
            if (!isset($_POST[$field]) || !is_numeric($_POST[$field])) {
                die(json_encode(["success" => false, "error" => "Field '$field' harus diisi dan berupa angka."]));
            }
        }

        // contoh validasi wajib isi untuk nama_client dan client_id
        if (empty($_POST['nama_client'])) {
            die(json_encode(["success" => false, "error" => "Field 'nama_client' wajib diisi."]));
        }

        if (empty($_POST['client_id'])) {
            die(json_encode(["success" => false, "error" => "Field 'client_id' wajib diisi."]));
        }

        if (empty($_POST['awal_periode_bhp'])) {
            die(json_encode(["success" => false, "error" => "Field 'awal periode bhp' wajib diisi."]));
        }

        // Ambil ID terakhir
        $result = $koneksi->query("SELECT MAX(id) AS last_id FROM db_client");
        $row = $result->fetch_assoc();
        $last_id = $row['last_id'] ?? 0; // Jika tidak ada data, mulai dari 0
        $new_id = $last_id + 1; // ID baru

        $terbit_spp = date("d/m/Y", strtotime($_POST['terbit_spp']));
        $awal_periode_bhp = date("d/m/Y", strtotime($_POST['awal_periode_bhp']));
        $batas_bayar = date("d/m/Y", strtotime($_POST['batas_bayar']));
        $tgl_pembayaran = date("d/m/Y", strtotime($_POST['tgl_pembayaran']));

        $stmt->bind_param(
            'isiisssisssssssiiisssiiis',
            $new_id,  // ID baru hasil dari MAX(id) + 1
            $_POST['wilayah'],
            $new_id,  // ID baru hasil dari MAX(id) + 1
            $new_id,  // ID baru hasil dari MAX(id) + 1
            $_POST['nama_client_ini'], //$_POST['nama_client'],
            $_POST['alamat_client'],
            $_POST['client_id'], 
            $_POST['app_id'], 
            $_POST['no_simf'],
            $_POST['id_invoice'],
            $_POST['no_spp'],
            $_POST['service'],
            $terbit_spp,
            $batas_bayar,
            $awal_periode_bhp,
            $_POST['besar_bhp'], // $_POST['potensi_bhp'], ambil dari besar_bhp
            $_POST['besar_bhp'],
            $_POST['tahun_periode'],
            $_POST['status_bayar'],
            $_POST['status_isr'],
            $tgl_pembayaran,
            $_POST['bhp_terbayar'],
            $_POST['bhp_dibatalkan'],
            $_POST['denda_tunggakan'],
            $_POST['keterangan']
        );

        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Data inserted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "No rows affected."]);
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo json_encode(["success" => false, "message" => $th->getMessage()]);
    }