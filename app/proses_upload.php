<?php
require 'vendor/autoload.php'; // Jika pakai Composer
use PhpOffice\PhpSpreadsheet\IOFactory;

$koneksi = new mysqli("localhost", "root", "", "db_hapay");

if (isset($_FILES["file_excel"]["name"])) {
    $file = $_FILES["file_excel"]["tmp_name"];
    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    foreach ($data as $index => $row) {
        if ($index == 0) continue; // Lewati baris pertama (judul)

        $row[0];  // wilayah
        $row[1];  // bulan
        $row[2];  // no
        $row[3];  // nama_client
        $row[4];  // alamat_client
        $row[5];  // client_id
        $row[6];  // app_id
        $row[7];  // no_simf
        $row[8];  // id_invoice
        $row[9];  // no_spp
        $row[10]; // service
        $row[11]; // terbit_spp
        $row[12]; // batas_bayar
        $row[13]; // awal_periode_bhp
        $row[14]; // potensi_bhp
        $row[15]; // besar_bhp
        $row[16]; // tahun_periode
        $row[17]; // status_bayar
        $row[18]; // status_isr
        $row[19]; // tgl_pembayaran
        $row[20]; // bhp_terbayar
        $row[21]; // bhp_dibatalkan
        $row[22]; // denda_tunggakan
        $row[23]; // keterangan
        $row[24]; // id_invoice_surat
        $row[25]; // no_tagihan
        $row[26]; // terbit_surat
        $row[27];  // status_bayar_surat

        $query = "INSERT INTO users (nama, email, no_hp) VALUES ('$nama', '$email', '$no_hp')";
        $koneksi->query($query);
    }
    echo "Import berhasil!";
} else {
    echo "Gagal mengunggah file.";
}
?>
