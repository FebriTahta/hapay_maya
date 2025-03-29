<?php
require '../vendor/autoload.php'; // Pastikan Composer & Dompdf sudah terinstall
use Dompdf\Dompdf;
use Dompdf\Options;

include '../conf/config.php';

// Ambil data dari database
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM db_client WHERE id = '$id'");
$d = mysqli_fetch_array($data);

// Inisialisasi Dompdf dengan opsi
$options = new Options();
$options->set('defaultFont', 'Arial');
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true); // Penting jika pakai URL gambar
$dompdf = new Dompdf($options);

// Format nominal Rupiah
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 2, ',', '.');
}

// Path Gambar: Gunakan URL atau Base64
$logoPath = 'http://localhost/newproject/app/dist/img/logokomdigi.jpg'; // Pastikan ini bisa diakses dari browser

// Buat tampilan HTML Invoice dengan desain profesional
$html = "
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; color: #333; }
        .invoice-container { width: 100%; padding: 20px; }
        .invoice-header { text-align: center; margin-bottom: 20px; }
        .invoice-header h2 { margin: 5px 0; }
        .logo { max-width: 150px; margin-bottom: 10px; }
        .invoice-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .invoice-table th, .invoice-table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .invoice-table th { background-color: #f2f2f2; }
        .footer { text-align: center; font-size: 12px; margin-top: 20px; color: #777; }
    </style>
</head>
<body>
    <div class='invoice-container'>
        <div class='invoice-header'>
            <img src='{$logoPath}' class='logo'>
            <h2>SPP BHP 2024</h2>
            <p><strong>Nama Client:</strong> {$d['nama_client']}</p>
        </div>
        <table class='invoice-table'>
            <tr><th>Wilayah</th><td>{$d['wilayah']}</td></tr>
            <tr><th>Bulan</th><td>{$d['bulan']}</td></tr>
            <tr><th>No</th><td>{$d['no']}</td></tr>
            <tr><th>Alamat Client</th><td>{$d['alamat_client']}</td></tr>
            <tr><th>Client ID</th><td>{$d['client_id']}</td></tr>
            <tr><th>App ID</th><td>{$d['app_id']}</td></tr>
            <tr><th>No SIMF</th><td>{$d['no_simf']}</td></tr>
            <tr><th>ID Invoice</th><td>{$d['id_invoice']}</td></tr>
            <tr><th>No SPP</th><td>{$d['no_spp']}</td></tr>
            <tr><th>Service</th><td>{$d['service']}</td></tr>
            <tr><th>Terbit SPP</th><td>{$d['terbit_spp']}</td></tr>
            <tr><th>Batas Bayar</th><td>{$d['batas_bayar']}</td></tr>
            <tr><th>Awal Periode BHP</th><td>{$d['awal_periode_bhp']}</td></tr>
            <tr><th>Potensi BHP</th><td>" . formatRupiah($d['potensi_bhp']) . "</td></tr>
            <tr><th>Besar BHP</th><td>" . formatRupiah($d['besar_bhp']) . "</td></tr>
            <tr><th>Tahun Periode</th><td>{$d['tahun_periode']}</td></tr>
            <tr><th>Status Bayar</th><td>{$d['status_bayar']}</td></tr>
            <tr><th>Status ISR</th><td>{$d['status_isr']}</td></tr>
            <tr><th>Tanggal Pembayaran</th><td>{$d['tgl_pembayaran']}</td></tr>
            <tr><th>BHP Terbayar</th><td>" . formatRupiah($d['bhp_terbayar']) . "</td></tr>
            <tr><th>BHP Dibatalkan</th><td>" . formatRupiah($d['bhp_dibatalkan']) . "</td></tr>
            <tr><th>Denda Tunggakan</th><td>" . formatRupiah($d['denda_tunggakan']) . "</td></tr>
            <tr><th>Keterangan</th><td>{$d['keterangan']}</td></tr>
        </table>
        <div class='footer'>
            Terima kasih telah menggunakan layanan kami.<br>
            Jika ada pertanyaan, hubungi <strong>@BalmonTangerang</strong>
        </div>
    </div>
</body>
</html>
";

// Load HTML ke Dompdf
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Output PDF tanpa download otomatis
$dompdf->stream("invoice_{$d['id_invoice']}.pdf", ["Attachment" => false]);
?>
