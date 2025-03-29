<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "db_hapay");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pastikan form di-submit dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_id = $_POST['nama_client']; // Ambil dari dropdown
    $nama_client_baru = trim($_POST['nama_client_baru']); // Ambil dari input manual

    // Cek apakah user memasukkan nama baru atau memilih dari dropdown
    if (!empty($nama_client_baru)) {
        // Nama baru, simpan ke database
        $query_insert = "INSERT INTO db_client (nama_client) VALUES ('$nama_client_baru')";
        if ($conn->query($query_insert)) {
            // Ambil ID client baru
            $client_id = $conn->insert_id;
            $nama_client = $nama_client_baru;
        } else {
            die("Error saat menyimpan nama client baru: " . $conn->error);
        }
    } else {
        // Gunakan client_id dari dropdown untuk mencari nama client
        $query = "SELECT nama_client FROM db_client WHERE client_id = '$client_id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $nama_client = $row['nama_client'] ?? null; // Jika tidak ditemukan, akan bernilai null

        // Pastikan nama_client tidak kosong
        if (!$nama_client) {
            die("Error: Nama Client tidak ditemukan! Pilih dari dropdown atau masukkan nama baru.");
        }
    }

    // Ambil data lainnya dari form
    $wilayah = $_POST['wilayah'];
    $bulan = $_POST['bulan'];
    $no = $_POST['no'];
    $alamat_client = $_POST['alamat_client'];
    $app_id = $_POST['app_id'];
    $no_simf = $_POST['no_simf'];
    $id_invoice = $_POST['id_invoice'];
    $no_spp = $_POST['no_spp'];
    $service = $_POST['service'];
    $terbit_spp = $_POST['terbit_spp'];
    $batas_bayar = $_POST['batas_bayar'];
    $awal_periode_bhp = $_POST['awal_periode_bhp'];
    $potensi_bhp = $_POST['potensi_bhp'];
    $besar_bhp = $_POST['besar_bhp'];
    $tahun_periode = $_POST['tahun_periode'];
    $status_bayar = $_POST['status_bayar'];
    $status_isr = $_POST['status_isr'];
    $tgl_pembayaran = $_POST['tgl_pembayaran'];
    $bhp_terbayar = $_POST['bhp_terbayar'];
    $bhp_dibatalkan = $_POST['bhp_dibatalkan'];
    $denda_tunggakan = $_POST['denda_tunggakan'];
    $keterangan = $_POST['keterangan'];
    

    // Query untuk menyimpan ke database
    $sql = "INSERT INTO db_client 
        (wilayah, bulan, no, nama_client, alamat_client, client_id, app_id, no_simf, id_invoice, no_spp, service, terbit_spp, batas_bayar, awal_periode_bhp, potensi_bhp, besar_bhp, tahun_periode, status_bayar, status_isr, tgl_pembayaran, bhp_terbayar, bhp_dibatalkan, denda_tunggakan, keterangan) 
        VALUES 
        ('$wilayah', '$bulan', '$no', '$nama_client', '$alamat_client', '$client_id', '$app_id', '$no_simf', '$id_invoice', '$no_spp', '$service', '$terbit_spp', '$batas_bayar', '$awal_periode_bhp', '$potensi_bhp', '$besar_bhp', '$tahun_periode', '$status_bayar', '$status_isr', '$tgl_pembayaran', '$bhp_terbayar', '$bhp_dibatalkan', '$denda_tunggakan', '$keterangan')";

    // Jalankan query
    if ($conn->query($sql)) {
        echo "Data berhasil disimpan!";
        header("Location: ../index.php?page=data"); // Ganti dengan halaman tujuan
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
