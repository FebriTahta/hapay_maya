<?php
include '../conf/config.php';

// Menghindari SQL Injection
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$data = mysqli_query($koneksi, "SELECT * FROM db_client WHERE id = '$id'");
$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Client</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .invoice-container {
            max-width: 850px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #0056b3;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .invoice-header img {
            width: 120px;
        }

        .invoice-header h2 {
            color: #0056b3;
            margin: 0;
            font-size: 22px;
        }

        .invoice-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-details th, .invoice-details td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        .invoice-details th {
            background: #0056b3;
            color: white;
            font-weight: bold;
        }

        .total {
            font-size: 18px;
            font-weight: bold;
            color: #d9534f;
        }

        .button-container {
            text-align: center;
            margin-top: 25px;
        }

        .button {
            background-color: #28a745;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            display: inline-block;
            transition: 0.3s;
            font-size: 14px;
        }

        .button:hover {
            background-color: #218838;
        }

        .back-button {
            background-color: #007BFF;
            margin-left: 10px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        .payment-info {
            margin-top: 30px;
            padding: 15px;
            background: #f1f1f1;
            border-left: 5px solid #0056b3;
        }

        .payment-info p {
            margin: 5px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="invoice-container">
    <!-- Header Invoice -->
    <div class="invoice-header">
    <img src="http://localhost/newproject/app/dist/img/logokomdigi.jpg" alt="Logo Perusahaan">
        <h2>Invoice Pembayaran</h2>
    </div>

    <!-- Informasi Tambahan Pembayaran -->
    <div class="payment-info">
        <h3 style="color: #0056b3;">Informasi Pembayaran</h3>
        <p><strong>Tanggal Pembayaran:</strong> <?php echo $d['tgl_pembayaran']; ?></p>
        <p><strong>BHP Terbayar:</strong> Rp <?php echo number_format($d['bhp_terbayar'], 2, ',', '.'); ?></p>
        <p><strong>Denda Tunggakan:</strong> Rp <?php echo number_format($d['denda_tunggakan'], 2, ',', '.'); ?></p>
    </div>

    <!-- Detail Client -->
    <table class="invoice-details">
        <tr><th>Wilayah</th> <td><?php echo $d['wilayah']; ?></td></tr>
        <tr><th>Bulan</th> <td><?php echo $d['bulan']; ?></td></tr>
        <tr><th>No</th> <td><?php echo $d['no']; ?></td></tr>
        <tr><th>Nama Client</th> <td><?php echo $d['nama_client']; ?></td></tr>
        <tr><th>Alamat Client</th> <td><?php echo $d['alamat_client']; ?></td></tr>
        <tr><th>Client ID</th> <td><?php echo $d['client_id']; ?></td></tr>
        <tr><th>App ID</th> <td><?php echo $d['app_id']; ?></td></tr>
        <tr><th>No SIMF</th> <td><?php echo $d['no_simf']; ?></td></tr>
        <tr><th>ID Invoice</th> <td><?php echo $d['id_invoice']; ?></td></tr>
        <tr><th>No SPP</th> <td><?php echo $d['no_spp']; ?></td></tr>
        <tr><th>Service</th> <td><?php echo $d['service']; ?></td></tr>
        <tr><th>Terbit SPP</th> <td><?php echo $d['terbit_spp']; ?></td></tr>
        <tr><th>Batas Bayar</th> <td><?php echo $d['batas_bayar']; ?></td></tr>
        <tr><th>Awal Periode BHP</th> <td><?php echo $d['awal_periode_bhp']; ?></td></tr>
        <tr><th>Potensi BHP</th> <td>Rp <?php echo number_format($d['potensi_bhp']); ?></td></tr>
        <tr><th>Besar BHP</th><td>Rp <?php echo number_format($d['besar_bhp']); ?></td></tr>
        <tr><th>Tahun Periode</th> <td><?php echo $d['tahun_periode']; ?></td></tr>
        <tr><th>Status Bayar</th> <td><?php echo $d['status_bayar']; ?></td></tr>
        <tr><th>Status ISR</th> <td><?php echo $d['status_isr']; ?></td></tr>
        <tr><th>Tanggal Pembayaran</th> <td><?php echo $d['tgl_pembayaran']; ?></td></tr>
        <tr><th>BHP Terbayar</th> <td>Rp <?php echo number_format($d['bhp_terbayar']); ?></td></tr>
        <tr><th>BHP Dibatalkan</th> <td>Rp <?php echo number_format($d['bhp_dibatalkan']); ?></td></tr>
        <tr><th>Denda Ditunggakan</th> <td>Rp <?php echo number_format($d['denda_tunggakan']); ?></td></tr>
        <tr><th>Keterangan</th> <td><?php echo $d['keterangan']; ?></td></tr>
        <!-- <tr><th>ID Invoice Surat</th> <td><?php echo $d['id_invoice_surat']; ?></td></tr>
        <tr><th>No Tagihan</th> <td><?php echo $d['no_tagihan']; ?></td></tr>
        <tr><th>Terbit Surat</th> <td><?php echo $d['terbit_surat']; ?></td></tr>
        <tr><th>Batas Bayar Surat</th> <td><?php echo $d['batas_bayar_surat']; ?></td></tr>
        <tr><th>Tagihan</th><td>Rp <?php echo number_format($d['tagihan']); ?></td></tr>
        <tr><th>Status Bayar Surat</th> <td><?php echo $d['status_bayar_surat']; ?></td></tr> -->
    </table>

    <!-- Tombol Cetak dan Kembali -->
    <div class="button-container">
        <a href="cetak_invoice.php?id=<?php echo $d['id']; ?>" class="button">Download PDF</a>
        <a href="index.php?page=data" class="button back-button">Kembali</a>
    </div>
</div>

</body>
</html>
