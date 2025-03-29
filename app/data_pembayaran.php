<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Card -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DATA TAGIHAN</h3>
                        
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
                                <th>BULAN</th>
                                <th>NAMA CLIENT</th>
                                <th>ALAMAT CLIENT</th>
                                <th>CLIENT ID</th>
                                <th>ID INVOICE SURAT</th>
                                <th>NO TAGIHAN</th>
                                <th>TERBIT SURAT</th>
                                <th>BATAS BAYAR SURAT</th>
                                <th>TAGIHAN</th>
                                <th>STATUS BAYAR SURAT</th>
                                <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../conf/config.php';
                                $no = 1;
                                $data = mysqli_query($koneksi, "SELECT * FROM db_tagihan order by nama_client "); 
                                while ($d = mysqli_fetch_array($data)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($d['bulan']); ?></td>
                                        <td><?php echo htmlspecialchars($d['nama_client']); ?></td>
                                        <td><?php echo htmlspecialchars($d['alamat_client']); ?></td>
                                        <td><?php echo htmlspecialchars($d['client_id']); ?></td>
                                        <td><?php echo htmlspecialchars($d['id_invoice_surat']); ?></td>
                                        <td><?php echo htmlspecialchars($d['no_tagihan']); ?></td>
                                        <td><?php echo htmlspecialchars($d['terbit_surat']); ?></td>
                                        <td><?php echo htmlspecialchars($d['batas_bayar_surat']); ?></td>   
                                        <!-- Format angka dengan number_format() -->
                                        <td><?php echo "Rp " . number_format($d['tagihan'], 0, ',', '.'); ?></td>
                                        <td><?php echo htmlspecialchars($d['status_bayar_surat']); ?></td>
                                        <td>
                                        <!-- Tombol View -->
                                        <a href="view_data_pembayaran.php?id=<?php echo $d['id']; ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>

                                        <!-- Tombol Edit -->
                                        <a href="edit_data_pembayaran.php?id=<?php echo $d['id']; ?>" class="btn btn-warning btn-sm">
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
                <h4 class="modal-title">Tambah Data Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Tambah Data -->
                <form action="add/tambah_data.php" method="POST">

                    <!-- No -->
                    <label for="no">No:</label>
                    <input type="text" name="no" id="no" class="form-control" readonly>
                    
                    <!-- Bulan -->
                    <label for="bulan">Bulan:</label>
                    <input type="text" name="bulan" id="bulan" class="form-control" readonly>

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
document.addEventListener("DOMContentLoaded", function () {
    var namaClientDropdown = document.getElementById("nama_client");
    var formClientBaru = document.getElementById("form_client_baru");

    namaClientDropdown.addEventListener("change", function () {
        var clientId = this.value;
        if (clientId === "tambah_baru") {
            formClientBaru.style.display = "block";
        } else {
            formClientBaru.style.display = "none";
        }

        if (clientId !== "" && clientId !== "tambah_baru") {
            fetch("get_client_data.php?client_id=" + clientId)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("no").value = data.no || "";
                    document.getElementById("bulan").value = data.bulan || "";
                    document.getElementById("alamat_client").value = data.alamat_client || "";
                    document.getElementById("client_id").value = data.client_id || "";
                    document.getElementById("id_invoice_surat").value = data.id_invoice_surat || "";
                    document.getElementById("no_tagihan").value = data.no_tagihan || "";
                    document.getElementById("terbit_surat").value = data.terbit_surat || "";
                    document.getElementById("batas_bayar_surat").value = data.batas_bayar_surat || "";
                    document.getElementById("tagihan").value = data.tagihan || "";
                    document.getElementById("status_bayar_surat").value = data.status_bayar_surat || "";
                })
                .catch(error => console.error("Error fetching data:", error));
        }
    });
});
</script>


                    <!-- Script untuk Menampilkan Form Client Baru -->
                    <script>
                    document.addEventListener("DOMContentLoaded", function () {
    var namaClientDropdown = document.getElementById("nama_client");
    var formClientBaru = document.getElementById("form_client_baru");

    namaClientDropdown.addEventListener("change", function () {
        var clientId = this.value;
        
        if (clientId === "tambah_baru") {
            formClientBaru.style.display = "block";
            resetForm();
        } else {
            formClientBaru.style.display = "none";

            if (clientId !== "") {
                fetch("get_client_data.php?client_id=" + clientId)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            document.getElementById("no").value = data.no || "";
                            document.getElementById("bulan").value = data.bulan || "";
                            document.getElementById("alamat_client").value = data.alamat_client || "";
                            document.getElementById("client_id").value = data.client_id || "";
                            document.getElementById("id_invoice_surat").value = data.id_invoice_surat || "";
                            document.getElementById("no_tagihan").value = data.no_tagihan || "";
                            document.getElementById("terbit_surat").value = data.terbit_surat || "";
                            document.getElementById("batas_bayar_surat").value = data.batas_bayar_surat || "";
                            document.getElementById("tagihan").value = data.tagihan || "";
                            document.getElementById("status_bayar_surat").value = data.status_bayar_surat || "";
                        } else {
                            console.error("Data client tidak ditemukan.");
                            resetForm();
                        }
                    })
                    .catch(error => console.error("Error fetching data:", error));
            } else {
                resetForm();
            }
        }
    });

    function resetForm() {
        document.getElementById("no").value = "";
        document.getElementById("bulan").value = "";
        document.getElementById("alamat_client").value = "";
        document.getElementById("client_id").value = "";
        document.getElementById("id_invoice_surat").value = "";
        document.getElementById("no_tagihan").value = "";
        document.getElementById("terbit_surat").value = "";
        document.getElementById("batas_bayar_surat").value = "";
        document.getElementById("tagihan").value = "";
        document.getElementById("status_bayar_surat").value = "";
    }
});


                    </script>

                    <!-- Alamat Client -->
                    <label for="alamat_client">Alamat Client:</label>
                    <textarea name="alamat_client" id="alamat_client" class="form-control" readonly></textarea>

                    <!-- ID Invoice Surat -->
                    <label for="id_invoice_surat">ID Invoice Surat:</label>
                    <input type="number" name="id_invoice_surat" id="id_invoice_surat" class="form-control">

                    <!-- No Tagihan -->
                    <label for="no_tagihan">No Tagihan:</label>
                    <input type="number" name="no_tagihan" id="no_tagihan" class="form-control">

                    <!-- Terbit Surat -->
                    <label for="terbit_surat"> Terbit Surat:</label>
                    <input type="number" name="terbit_surat" id="terbit_surat" class="form-control">

                    <!-- Batas Bayar Surat -->
                    <label for="batas_bayar_surat">Batas Bayar Surat:</label>
                    <input type="date" name="batas_bayar_surat" id="batas_bayar_surat" class="form-control">

                    <!-- Tagihan -->
                    <label for="tagihan"> Tagihan:</label>
                    <input type="number" name="tagihan" id="tagihan" class="form-control">

                    <!-- Status ISR -->
                    <label for="status_bayar_surat">Status Bayar Surat:</label>
                    <input type="text" name="status_bayar_surat" id="status_bayar_surat" class="form-control">

                    <!-- Tombol Submit -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    
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
</div> <!-- modal -->