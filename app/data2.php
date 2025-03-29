<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">SURAT TAGIHAN</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div style="overflow-x: auto;"> <!-- Tambahkan div wrapper -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-lg">
                            Tambah Data
                        </button>
                        <br></br>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>WILAYAH</th>
                                    <th>BULAN</th>
                                    <th>NAMA CLIENT</th>
                                    <th>ALAMAT CLIENT</th>
                                    <th>CLIENT ID</th>
                                    <th>APP ID</th>
                                    <th>NO SIMF</th>
                                    <th>ID INVOICE</th>
                                    <th>NO SPP</th>
                                    <th>SERVICE</th>
                                    <th>TERBIT SPP</th>
                                    <th>BATAS BAYAR</th>
                                    <th>AWAL PERIODE BHP</th>
                                    <th>POTENSI BHP</th>
                                    <th>BESAR BHP</th>
                                    <th>TAHUN PERIODE</th>
                                    <th>STATUS BAYAR</th>
                                    <th>STATUS ISR</th>
                                    <th>TGL PEMBAYARAN</th>
                                    <th>BHP TERBAYAR</th>
                                    <th>BHP DIBATALKAN</th>
                                    <th>DENDA TUNGGAKAN</th>
                                    <th>KETERANGAN</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../conf/config.php';
                                $no = 1;
                                $data = mysqli_query($koneksi, "SELECT * FROM db_client order by nama_client "); 
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($d['wilayah']); ?></td>
                                        <td><?php echo htmlspecialchars($d['bulan']); ?></td>
                                        <td><?php echo htmlspecialchars($d['nama_client']); ?></td>
                                        <td><?php echo htmlspecialchars($d['alamat_client']); ?></td>
                                        <td><?php echo htmlspecialchars($d['client_id']); ?></td>
                                        <td><?php echo htmlspecialchars($d['app_id']); ?></td>
                                        <td><?php echo htmlspecialchars($d['no_simf']); ?></td>
                                        <td><?php echo htmlspecialchars($d['id_invoice']); ?></td>
                                        <td><?php echo htmlspecialchars($d['no_spp']); ?></td>
                                        <td><?php echo htmlspecialchars($d['service']); ?></td>
                                        <td><?php echo htmlspecialchars($d['terbit_spp']); ?></td>
                                        <td><?php echo htmlspecialchars($d['batas_bayar']); ?></td>
                                        <td><?php echo htmlspecialchars($d['awal_periode_bhp']); ?></td> 
                                        <!-- Format angka dengan number_format() -->
                                        <td><?php echo "Rp " . number_format($d['potensi_bhp'], 0, ',', '.'); ?></td>
                                        <td><?php echo "Rp " . number_format($d['besar_bhp'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($d['tahun_periode']); ?></td>
                                        <td><?php echo htmlspecialchars($d['status_bayar']); ?></td>
                                        <td><?php echo htmlspecialchars($d['status_isr']); ?></td>
                                        <td><?php echo htmlspecialchars($d['tgl_pembayaran']); ?></td>
                                        <!-- Format angka dengan number_format() -->
                                        <td><?php echo "Rp " . number_format($d['bhp_terbayar'], 0, ',', '.'); ?></td>
                                        <td><?php echo "Rp " . number_format($d['bhp_dibatalkan'], 0, ',', '.'); ?></td>
                                        <td><?php echo "Rp " . number_format($d['denda_tunggakan'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($d['keterangan']); ?></td>
                                        <td>
                                        <!-- Tombol View -->
                                        <a href="view.php?id=<?php echo $d['id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>

                                        <!-- Tombol Edit -->
                                        <a href="edit.php?id=<?php echo $d['id']; ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <!-- Tombol Delete dengan Konfirmasi -->
                                        <a href="delete.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>

                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Data Surat Tagihan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Data -->
                <form action="add/tambah_data.php" method="POST">
                    
                    <!-- Wilayah -->
                    <label for="wilayah">Wilayah:</label>
                    <input type="text" name="wilayah" id="wilayah" class="form-control" readonly>

                    <!-- Bulan -->
                    <label for="bulan">Bulan:</label>
                    <input type="text" name="bulan" id="bulan" class="form-control" readonly>

                    <!-- No -->
                    <label for="no">No:</label>
                    <input type="text" name="no" id="no" class="form-control" readonly>

                    <!-- Nama Client -->
                    <label for="nama_client">Nama Client:</label>
                    <select name="nama_client" id="nama_client" class="form-control select2">
                    <option value="">-- Pilih Nama Client --</option>
                    <option value="tambah_baru">+ Tambah Client Baru</option>
                    <?php
                    // Koneksi ke database
                    $conn = new mysqli("localhost", "root", "", "db_hapay");

                    // Cek koneksi
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Ambil data client_id dan nama_client dari tabel db_client
                    $sql = "SELECT client_id, nama_client FROM db_client";
                    $result = $conn->query($sql);

                    // Loop data untuk membuat opsi dropdown
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['client_id'] . "'>" . $row['nama_client'] . "</option>";
                    }

                    // Tutup koneksi
                    $conn->close();
                    ?>
                </select>

                    <!-- Form Tambah Client Baru (Tersembunyi) -->
                    <div id="form_client_baru" style="display: none;">
                        <label for="nama_client_baru">Nama Client Baru:</label>
                        <input type="text" name="nama_client_baru" id="nama_client_baru" class="form-control">
                    </div>
                    <script>
document.getElementById("nama_client").addEventListener("change", function() {
    var clientId = this.value;
    if (clientId !== "" && clientId !== "tambah_baru") {
        fetch("get_client_data.php?client_id=" + clientId)
            .then(response => response.json())
            .then(data => {
                document.getElementById("wilayah").value = data.wilayah || "";
                document.getElementById("bulan").value = data.bulan || "";
                document.getElementById("no").value = data.no || "";
                document.getElementById("alamat_client").value = data.alamat_client || "";
                document.getElementById("client_id").value = data.client_id || "";
                document.getElementById("app_id").value = data.app_id || "";
                document.getElementById("no_simf").value = data.no_simf || "";
                document.getElementById("id_invoice").value = data.id_invoice || "";
                document.getElementById("no_spp").value = data.no_spp || "";
                document.getElementById("service").value = data.service || "";
                document.getElementById("terbit_spp").value = data.terbit_spp || "";
                document.getElementById("batas_bayar").value = data.batas_bayar || "";
                document.getElementById("awal_periode_bhp").value = data.awal_periode_bhp || "";
                document.getElementById("potensi_bhp").value = data.potensi_bhp || "";
                document.getElementById("besar_bhp").value = data.besar_bhp || "";
                document.getElementById("tahun_periode").value = data.tahun_periode || "";
                document.getElementById("status_bayar").value = data.status_bayar || "";
                document.getElementById("status_isr").value = data.status_isr || "";
                document.getElementById("tgl_pembayaran").value = data.tgl_pembayaran || "";
                document.getElementById("bhp_terbayar").value = data.bhp_terbayar || "";
                document.getElementById("bhp_dibatalkan").value = data.bhp_dibatalkan || "";
                document.getElementById("denda_tunggakan").value = data.denda_tunggakan || "";
                document.getElementById("keterangan").value = data.keterangan || "";
            })
            .catch(error => console.error("Error fetching data:", error));
    } else if (clientId === "tambah_baru") {
        document.getElementById("form_client_baru").style.display = "block";
    } else {
        document.getElementById("form_client_baru").style.display = "none";
    }
});
</script>

                    <!-- Script untuk Menampilkan Form Client Baru -->
                    <script>
                    document.getElementById("nama_client").addEventListener("change", function() {
                        var formClientBaru = document.getElementById("form_client_baru");
                        if (this.value === "tambah_baru") {
                            formClientBaru.style.display = "block";
                        } else {
                            formClientBaru.style.display = "none";
                            document.getElementById("nama_client_baru").value = "";
                            document.getElementById("alamat_client_baru").value = "";
                        }
                    });
                    </script>

                    <!-- Alamat Client -->
                    <label for="alamat_client">Alamat Client:</label>
                    <textarea name="alamat_client" id="alamat_client" class="form-control" readonly></textarea>

                    <!-- Client ID -->
                    <label for="client_id">Client ID:</label>
                    <input type="text" name="client_id" id="client_id" class="form-control" readonly>

                    <!-- App ID -->
                    <label for="app_id">App ID:</label>
                    <input type="number" name="app_id" id="app_id" class="form-control">

                    <!-- No Simf -->
                    <label for="no_simf">No Simf:</label>
                    <input type="text" name="no_simf" id="no_simf" class="form-control" readonly>

                    <!-- ID Invoice -->
                    <label for="id_invoice">ID Invoice:</label>
                    <input type="number" name="id_invoice" id="id_invoice" class="form-control">

                    <!-- No SPP -->
                    <label for="no_spp">No SPP:</label>
                    <input type="number" name="no_spp" id="no_spp" class="form-control">

                    <!-- Service -->
                    <label for="service">Service:</label>
                    <input type="text" name="service" id="service" class="form-control" readonly>

                    <!-- Tanggal Terbit SPP -->
                    <label for="tanggal_terbit">Terbit SPP:</label>
                    <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control" required>

                    <script>
                document.getElementById("tanggal_terbit").addEventListener("change", function() {
                    let tanggalTerbit = new Date(this.value);
                    if (!isNaN(tanggalTerbit.getTime())) {
                        tanggalTerbit.setDate(tanggalTerbit.getDate() + 60); // Tambah 60 hari
                        let batasBayar = tanggalTerbit.toISOString().split("T")[0]; // Format YYYY-MM-DD
                        document.getElementById("batas_bayar").value = batasBayar;
                    }
                });
                </script>
                    
                    <!-- Batas Bayar (Otomatis Terisi) -->
                    <label for="batas_bayar">Batas Bayar:</label>
                    <input type="date" name="batas_bayar" id="batas_bayar" class="form-control" readonly>

                    <!-- Awal Periode BHP -->
                    <label for="awal_periode_bhp">Awal Periode BHP:</label>
                    <input type="text" name="awal_periode_bhp" id="awal_periode_bhp" class="form-control" readonly>
                    <!-- <input type="date" name="awal_periode_bhp" id="awal_periode_bhp" class="form-control"> -->

                    <!-- Potensi BHP -->
                    <label for="potensi_bhp">Potensi BHP:</label>
                    <input type="number" step="0.0000001" name="potensi_bhp" id="potensi_bhp" class="form-control">

                    <!-- Besar BHP (Otomatis Terisi) -->
                    <label for="besar_bhp">Besar BHP:</label>
                    <input type="text" name="besar_bhp" id="besar_bhp" class="form-control" readonly>

                    <script>
                    document.getElementById("potensi_bhp").addEventListener("input", function() {
                        let potensiBhp = parseFloat(this.value); // Ambil nilai input sebagai angka

                        if (!isNaN(potensiBhp)) {
                            let formattedBhp = Number.isInteger(potensiBhp) 
                                ? potensiBhp.toString()  // Jika bilangan bulat, tampilkan tanpa desimal
                                : potensiBhp.toFixed(7).replace(/\.?0+$/, ""); // Jika ada desimal, hapus nol di belakang

                            document.getElementById("besar_bhp").value = formattedBhp.replace(".", ","); // Gunakan koma untuk desimal
                        } else {
                            document.getElementById("besar_bhp").value = ""; // Kosongkan jika input kosong
                        }
                    });
                    </script>

                    <!-- <label for="potensi_bhp">Potensi BHP:</label>
                    <input type="number" step="0.01" name="potensi_bhp" id="potensi_bhp" class="form-control"> -->

                    <!-- Besar BHP -->
                    <!-- <label for="besar_bhp">Besar BHP:</label>
                    <input type="text" name="besar_bhp" id="besar_bhp" class="form-control" readonly> -->
                    <!-- <input type="number" step="0.01" name="besar_bhp" id="besar_bhp" class="form-control"> -->

                    <!-- Tahun Periode -->
                    <label for="tahun_periode">Tahun Periode:</label>
                    <select name="tahun_periode" id="tahun_periode" class="form-control">
                        <!-- Opsi akan di-generate oleh JavaScript -->
                    </select>

                    <!-- Script jQuery -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script>
                    $(document).ready(function() {
                        let select = $('#tahun_periode');
                        
                        for (let i = 1; i <= 10; i++) {
                            let option = $('<option>', { value: i, text: i });

                            // Beri warna khusus
                            if (i == 6) {
                                option.css('color', 'red'); // Warna merah untuk angka 6
                            } else if (i == 10) {
                                option.css('color', 'yellow'); // Warna kuning untuk angka 10
                                option.css('background-color', 'black'); // Supaya kuning lebih terlihat
                            }

                            select.append(option);
                        }
                    });
                    </script>



                    <!-- Status Bayar -->
                    <label for="status_bayar">Status Bayar:</label>
                    <select name="status_bayar" id="status_bayar" class="form-control status-dropdown" onchange="ubahWarna()">
                        <option value="LUNAS" class="lunas">LUNAS</option>
                        <option value="DENDA" class="denda">DENDA</option>
                        <option value="TUNGGAK" class="tunggak">TUNGGAK</option>
                        <option value="BATAL" class="batal">BATAL</option>
                    </select>

                    <!-- Status ISR -->
                    <label for="status_isr">Status ISR:</label> <!-- ID & name diperbaiki -->
                    <select name="status_isr" id="status_isr" class="form-control status-dropdown" onchange="ubahWarna()">
                        <option value="VALID" class="lunas">VALID</option>
                        <option value="BATAL" class="batal">BATAL</option>
                    </select>

                    <!-- <input type="text" name="status_isr" id="status_isr" class="form-control"> -->

                    <!-- Tanggal Pembayaran -->
                    <label for="tgl_pembayaran">Tanggal Pembayaran:</label>
                    <input type="date" name="tgl_pembayaran" id="tgl_pembayaran" class="form-control">

                    <!-- BHP Terbayar -->
                    <label for="bhp_terbayar">BHP terbayar:</label>
                    <input type="number" name="bhp_terbayar" id="bhp_terbayar" class="form-control">

                    <!-- BHP Dibatalkan -->
                    <label for="bhp_dibatalkan">BHP Dibatalkan:</label>
                    <input type="number" name="bhp_dibatalkan" id="bhp_dibatalkan" class="form-control">

                    <!-- Denda Tunggakan -->
                    <label for="denda_tunggakan">BHP Ditunggakan:</label>
                    <input type="number" name="denda_tunggakan" id="denda_tunggakan" class="form-control">

                    <!-- Keterangan -->
                    <label for="keterangan">Keterangan:</label>
                    <textarea name="keterangan" id="keterangan" class="form-control"></textarea>    
                    
                    <!-- Tombol Submit -->
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="console.log('Form dikirim');">Submit</button>

                            <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                        </div>
                    </form>

                    <!-- <button type="submit" name="submit">Simpan</button> -->
                

                

                

                    <!-- <label for="batas_bayar">Batas Bayar:</label>
                    <input type="date" name="batas_bayar" id="batas_bayar" class="form-control"> -->

                    

                    
               </form>    
                        
                        <script>
$(document).ready(function(){
    $("#nama_client").change(function(){
        var client_id = $(this).val();
        if(client_id !== ""){
            $.ajax({
                url: "get_client_data.php",
                type: "POST",
                data: {client_id: client_id},
                dataType: "json",
                success: function(data){
                    if(data){
                        $("#alamat_client").val(data.alamat_client);
                        $("#client_id").val(data.client_id);
                        $("#app_id").val(data.app_id);
                    }
                }
            });
        } else {
            $("#alamat_client").val("");
            $("#client_id").val("");
            $("#app_id").val("");
        }
    });
});
</script>

                    </div>
                </form> <!-- Pastikan form ditutup di sini -->
            </div> <!-- modal-body -->
        </div> <!-- modal-content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal -->

