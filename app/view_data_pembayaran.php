<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
if (!isset($_SESSION['nama'])) {
    header('Location: ../index.php?session=expired');
}
include('header.php'); 
include('../conf/config.php'); 
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <?php include('preloader.php'); ?>

    <!-- Navbar -->
    <?php include('navbar.php'); ?>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <?php include('logo.php'); ?>
        <?php include('sidebar.php'); ?>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <?php include('content_header.php'); ?>
        <?php
// Menghindari SQL Injection
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$data = mysqli_query($koneksi, "SELECT * FROM db_tagihan WHERE id = '$id'");
$d = mysqli_fetch_array($data);
?>

<head>
    <title>Invoice Pembayaran</title>
    <style>
        .invoice-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header img {
            width: 150px;
            height: auto;
        }
        .invoice-header h2 {
            font-size: 24px;
            margin: 10px 0;
        }
        .payment-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .invoice-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-details th, .invoice-details td {
            text-align: left;
            padding: 8px 12px;
            border-bottom: 1px solid #ddd;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            background: #007bff;
            color: white;
            border-radius: 5px;
            transition: 0.3s;
        }
        .button:hover {
            background: #0056b3;
        }
        .back-button {
            background: #dc3545;
        }
        .back-button:hover {
            background: #a71d2a;
        }
    </style>
</head>

<div class="content">
    <div class="invoice-container">
        <!-- Header Invoice -->
        <div class="invoice-header">
            <img src="http://localhost/newproject/app/dist/img/logokomdigi.jpg" alt="Logo Perusahaan">
            <h2><strong>SPP BHP 2024</strong></h2>
            <h2><?php echo $d['nama_client']; ?></h2>
        </div>

        <!-- Informasi Tambahan Pembayaran -->
        <div class="payment-info">
            <h3 style="color: #0056b3;">Informasi Pembayaran</h3>
            <p><strong>Tanggal Pembayaran:</strong> <?php echo $d['tgl_pembayaran']; ?></p>
            <p><strong>BHP Terbayar:</strong> Rp <?php echo number_format($d['bhp_terbayar'], 2, ',', '.'); ?></p>
            <p><strong>Denda Tunggakan:</strong> Rp <?php echo number_format($d['denda_tunggakan'], 2, ',', '.'); ?></p>
        </div>

        <!-- Detail Pembayaran -->
        <table class="invoice-details">
            <tr><th>Bulan</th> <td><?php echo $d['bulan']; ?></td></tr>
            <tr><th>No</th> <td><?php echo $d['no']; ?></td></tr>
            <tr><th>Nama Client</th> <td><?php echo $d['nama_client']; ?></td></tr>
            <tr><th>Alamat Client</th> <td><?php echo $d['alamat_client']; ?></td></tr>
            <tr><th>Client ID</th> <td><?php echo $d['client_id']; ?></td></tr>
            <tr><th>ID Invoice Surat</th> <td><?php echo $d['id_invoice_surat']; ?></td></tr>
            <tr><th>No Tagihan</th> <td><?php echo $d['no_tagihan']; ?></td></tr>
            <tr><th>Terbit Surat</th> <td><?php echo ($d['terbit_surat']); ?></td></tr>
            <tr><th>Batas Bayar Surat</th> <td><?php echo ($d['batas_bayar_surat']); ?></td></tr>
            <tr><th>Tagihan</th> <td><?php echo number_format($d['tagihan']); ?></td></tr>
            <tr><th>Status Bayar Surat</th> <td><?php echo $d['status_bayar_surat']; ?></td></tr>
        </table>

        <!-- Tombol Cetak dan Kembali -->
        <div class="button-container">
            <a href="cetak_invoice.php?id=<?php echo $d['id']; ?>" class="button">Download PDF</a>
            <a href="index.php?page=data" class="button back-button">Kembali</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?> <!-- Tambahkan footer -->