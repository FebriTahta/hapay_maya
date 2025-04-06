<div class="content">
    <div class="container-fluid">
        <?php 
        // Include koneksi database
        
        include('app/../global/dateFormatHelper.php');

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            $query = mysqli_query($koneksi, "SELECT * FROM db_client WHERE id='$id'");
            $data = mysqli_fetch_assoc($query);

            if ($data) {
        ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Edit Data Client</h3>
            </div>
            
            <div class="card-body">
                <form id="formEditClient" method="POST">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nama_client" class="form-label">Nama Client:</label>
                            <input type="text" name="nama_client" id="nama_client" class="form-control" value="<?php echo htmlspecialchars($data['nama_client']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="wilayah" class="form-label">Wilayah:</label>
                            <input type="text" name="wilayah" id="wilayah" class="form-control" value="<?php echo htmlspecialchars($data['wilayah']); ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_client" class="form-label">Alamat Client:</label>
                        <textarea name="alamat_client" id="alamat_client" class="form-control" rows="2"><?php echo htmlspecialchars($data['alamat_client']); ?></textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="client_id" class="form-label">Client ID:</label>
                            <input type="text" name="client_id" id="client_id" class="form-control" value="<?php echo htmlspecialchars($data['client_id']); ?>">

                        </div>
                        <div class="col-md-6">
                            <label for="app_id" class="form-label">App ID:</label>
                            <input type="number" name="app_id" id="app_id" class="form-control" value="<?php echo htmlspecialchars($data['app_id']); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="no_simf" class="form-label">No SIMF:</label>
                            <input type="number" name="no_simf" id="no_simf" class="form-control" value="<?php echo htmlspecialchars($data['no_simf']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="id_invoice" class="form-label">ID Invoice:</label>
                            <input type="number" name="id_invoice" id="id_invoice" class="form-control" value="<?php echo htmlspecialchars($data['id_invoice']); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="no_spp" class="form-label">No SPP:</label>
                            <input type="number" name="no_spp" id="no_spp" class="form-control" value="<?php echo htmlspecialchars($data['no_spp']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="service" class="form-label">Service:</label>
                            <input type="text" name="service" id="service" class="form-control" value="<?php echo htmlspecialchars($data['service']); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="terbit_spp" class="form-label">Terbit SPP:</label>
                            <input type="date" name="terbit_spp" id="terbit_spp" class="form-control" value="<?php echo htmlspecialchars(convertToDisplayDateFormat($data['terbit_spp'])) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="batas_bayar" class="form-label">Batas Bayar:</label>
                            <input type="date" name="batas_bayar" id="batas_bayar" class="form-control" value="<?php echo htmlspecialchars(convertToDisplayDateFormat($data['batas_bayar'])) ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="awal_periode_bhp" class="form-label">Awal Periode BHP:</label>
                            <input type="date" name="awal_periode_bhp" id="awal_periode_bhp" class="form-control" value="<?php echo htmlspecialchars(convertToDisplayDateFormat($data['awal_periode_bhp'])) ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="potensi_bhp" class="form-label">Potensi BHP:</label>
                            <input type="number" name="potensi_bhp" id="potensi_bhp" class="form-control"
                                value="<?php echo $data['potensi_bhp']; ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="besar_bhp" class="form-label">Besar BHP:</label>
                            <input type="number" name="besar_bhp" id="besar_bhp" class="form-control"
                                value="<?php echo $data['besar_bhp']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="tahun_periode" class="form-label">Tahun Periode:</label>
                            <input type="number" name="tahun_periode" id="tahun_periode" class="form-control" value="<?php echo htmlspecialchars($data['tahun_periode']); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="status_bayar" class="form-label">Status Bayar:</label>
                            <input type="text" name="status_bayar" id="status_bayar" class="form-control" value="<?php echo htmlspecialchars($data['status_bayar']); ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="status_isr" class="form-label">Status ISR:</label>
                            <input type="text" name="status_isr" id="status_isr" class="form-control" value="<?php echo htmlspecialchars($data['status_isr']); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="tgl_pembayaran" class="form-label">Tanggal Pembayaran:</label>
                            <input type="date" name="tgl_pembayaran" id="tgl_pembayaran" class="form-control" value="<?php echo htmlspecialchars(convertToDisplayDateFormatMidString($data['tgl_pembayaran'])); ?>">
                        </div>
                        <div class="col-md-6">
                        <label for="bhp_terbayar" class="form-label">BHP Terbayar:</label>
                            <input type="text" name="bhp_terbayar" id="bhp_terbayar" class="form-control"
                                value="<?php echo $data['bhp_terbayar'] ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                        <label for="bhp_dibatalkan" class="form-label">BHP Dibatalkan:</label>
                            <input type="text" name="bhp_dibatalkan" id="bhp_dibatalkan" class="form-control"
                                value="<?php echo $data['bhp_dibatalkan']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="denda_tunggakan" class="form-label">Denda Tunggakan:</label>
                            <input type="text" name="denda_tunggakan" id="denda_tunggakan" class="form-control"
                                value="<?php echo $data['denda_tunggakan']?>">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="keterangan" class="form-label">Keterangan:</label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control" value="<?php echo htmlspecialchars($data['keterangan']); ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12 d-flex justify-content-center"> <!-- Ubah ke text-center -->
                            <button type="submit" class="btn btn-primary m-1">Simpan</button>
                            <a href="index.php?page=client" class="btn btn-secondary m-1">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
            <?php 
                } else {
                    echo "<p class='text-danger'>Data tidak ditemukan.</p>";
                }
            } else {
                echo "<p class='text-danger'>ID tidak ditemukan.</p>";
            }
            ?>
        </div>
    </div>
</div>