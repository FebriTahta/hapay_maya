<?php
include('app/../../../../conf/config.php');
// echo json_encode(["error" => false, "message" => $_POST['app_id']]);
// exit;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $terbit_spp = date("d/m/Y", strtotime($_POST['terbit_spp']));
    $awal_periode_bhp = date("d/m/Y", strtotime($_POST['awal_periode_bhp']));
    $batas_bayar = date("d/m/Y", strtotime($_POST['batas_bayar']));
    $tgl_pembayaran = date("d-M-Y", strtotime($_POST['tgl_pembayaran']));
    
    // Tangkap semua data dari form
    $id = $_POST['id']; // Pastikan ID dikirim
    $wilayah = $_POST['wilayah'];
    $nama_client = $_POST['nama_client'];
    $alamat_client = $_POST['alamat_client'];
    $client_id = $_POST['client_id'];
    $app_id = $_POST['app_id'];
    $no_simf = $_POST['no_simf'];
    $id_invoice = $_POST['id_invoice'];
    $no_spp = $_POST['no_spp'];
    $service = $_POST['service'];
    // $terbit_spp = $_POST['terbit_spp'];
    // $batas_bayar = $_POST['batas_bayar'];
    // $awal_periode_bhp = $_POST['awal_periode_bhp'];
    $potensi_bhp = $_POST['potensi_bhp'];
    $besar_bhp = $_POST['besar_bhp'];
    $tahun_periode = $_POST['tahun_periode'];
    $status_bayar = $_POST['status_bayar'];
    $status_isr = $_POST['status_isr'];
    // $tgl_pembayaran = $_POST['tgl_pembayaran'];
    $bhp_terbayar = $_POST['bhp_terbayar'];
    $bhp_dibatalkan = $_POST['bhp_dibatalkan'];
    $denda_tunggakan = $_POST['denda_tunggakan'];
    $keterangan = $_POST['keterangan'];

    // Pastikan ID ada
    if (empty($id)) {
        die("Error: ID tidak ditemukan.");
    }

    // Gunakan Prepared Statements untuk keamanan
    $query = "UPDATE db_client SET 
        wilayah=?, nama_client=?, alamat_client=?, client_id=?, app_id=? ,
        no_simf=?, id_invoice=?, no_spp=?, service=?, terbit_spp=?, batas_bayar=?, 
        awal_periode_bhp=?, potensi_bhp=?, besar_bhp=?, tahun_periode=?, status_bayar=?, 
        status_isr=?, tgl_pembayaran=?, bhp_terbayar=?, bhp_dibatalkan=?, denda_tunggakan=?, keterangan=? 
        WHERE id=?";

    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("sssissssssssiiisssiiisi", 
        $wilayah,
        $nama_client, 
        $alamat_client, 
        $client_id, 
        $app_id, 
        $no_simf,
        $id_invoice, 
        $no_spp, 
        $service, 
        $terbit_spp, 
        $batas_bayar, 
        $awal_periode_bhp, 
        $potensi_bhp, 
        $besar_bhp, 
        $tahun_periode, 
        $status_bayar, 
        $status_isr,
        $tgl_pembayaran, 
        $bhp_terbayar, 
        $bhp_dibatalkan, 
        $denda_tunggakan, 
        $keterangan, 
        $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Data update successfully."]);
    } else {
        echo json_encode(["error" => false, "message" => "No rows affected."]);
    }
}
?>