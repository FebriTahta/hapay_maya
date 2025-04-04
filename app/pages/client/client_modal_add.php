<div class="modal fade" id="modal_add_client">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <!-- Form Tambah Data -->
                <form action="add/tambah_data.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
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
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Wilayah -->
                                <label for="wilayah">Wilayah:</label>
                                <input type="text" name="wilayah" id="wilayah" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Alamat Client -->
                                <label for="alamat_client">Alamat Client:</label>
                                <textarea name="alamat_client" id="alamat_client" class="form-control" readonly></textarea>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Client ID -->
                                <label for="client_id">Client ID:</label>
                                <input type="text" name="client_id" id="client_id" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- App ID -->
                                <label for="app_id">App ID:</label>
                                <input type="number" name="app_id" id="app_id" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                 <!-- No Simf -->
                                <label for="no_simf">No Simf:</label>
                                <input type="text" name="no_simf" id="no_simf" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                 <!-- ID Invoice -->
                                <label for="id_invoice">ID Invoice:</label>
                                <input type="number" name="id_invoice" id="id_invoice" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- No SPP -->
                                <label for="no_spp">No SPP:</label>
                                <input type="number" name="no_spp" id="no_spp" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Service -->
                                <label for="service">Service:</label>
                                <!-- <input type="text" name="service" id="service" class="form-control" readonly> -->
                                <select name="status_bayar" id="status_bayar" class="form-control status-dropdown" onchange="ubahWarna()">
                                    <option value="" selected disabled>-- Pilih Status Bayar--</option>
                                    <option value="BROADCAST" class="broadcast">Broadcast</option>
                                    <option value="FIXED SERVICE" class="fixed service">Fixed Service</option>
                                    <option value="LAND MOBILE (PRIVATE)" class="land mobile (private)">Land Mobile (Private)</option>
                                    <option value="LAND MOBILE (PUBLIC)" class="land mobile (public)">Land Mobile (Public)</option>
                                    <option value="SATELLITE" class="satelite">Satellite</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                 <!-- Batas Bayar (Otomatis Terisi) -->
                                <label for="batas_bayar">Batas Bayar:</label>
                                <input type="date" name="batas_bayar" id="batas_bayar" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Awal Periode BHP -->
                                <label for="awal_periode_bhp">Awal Periode BHP:</label>
                                <!-- <input type="text" name="awal_periode_bhp" id="awal_periode_bhp" class="form-control" readonly> -->
                                <input type="date" name="awal_periode_bhp" id="awal_periode_bhp" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <label for="besar_bhp">Besar BHP:</label>
                                <input type="number" step="0.0000001" name="potensi_bhp" id="potensi_bhp" class="form-control">
                                <!-- <input type="text" name="besar_bhp" id="besar_bhp" class="form-control" readonly> -->
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                            <!-- Tanggal Terbit SPP -->
                            <label for="terbit_spp">Terbit SPP:</label>
                            <input type="date" name="terbit_spp" id="terbit_spp" class="form-control" required>
                            <script>
                                function hitungBatasBayar() {
                                    let tanggalTerbitInput = document.getElementById("terbit_spp");
                                    let batasBayarInput = document.getElementById("batas_bayar");
                                    let namaClient = document.getElementById("nama_client").value;

                                    if (!tanggalTerbitInput.value) {
                                        batasBayarInput.value = ""; // Kosongkan batas bayar jika tanggal belum diisi
                                        return;
                                    }

                                    let tanggalTerbit = new Date(tanggalTerbitInput.value);

                                    if (!isNaN(tanggalTerbit.getTime())) {
                                        let tambahanHari = (namaClient === "tambah_baru") ? 30 : 60; 
                                        tanggalTerbit.setDate(tanggalTerbit.getDate() + tambahanHari);

                                        batasBayarInput.value = tanggalTerbit.toISOString().split("T")[0]; 
                                    }
                                }

                                document.getElementById("terbit_spp").addEventListener("change", hitungBatasBayar);

                                document.getElementById("nama_client").addEventListener("change", function() {
                                    document.getElementById("terbit_spp").value = "";  // Kosongkan Terbit SPP saat client berubah
                                    document.getElementById("batas_bayar").value = ""; // Kosongkan Batas Bayar juga
                                });
                            </script>

                            

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
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Tahun Periode -->
                                <label for="tahun_periode">Tahun Periode:</label>
                                <select id="tahun_periode" class="form-control">
                                    <option value="" selected disabled>-- Pilih Tahun --</option>
                                </select>

                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                $(document).ready(function() {
                                    let select = $('#tahun_periode');

                                    // Bersihkan isi dropdown biar nggak duplikat
                                    select.empty();

                                    // Tambahkan opsi default
                                    select.append('<option value="" selected disabled>-- Pilih Tahun --</option>');

                                    // Tambahkan opsi tahun dengan warna
                                    for (let i = 1; i <= 10; i++) {
                                        let option = $('<option>', { value: i, text: i });

                                        // Atur warna khusus untuk angka tertentu
                                        if (i == 6) {
                                            option.css('color', 'red'); // Warna merah untuk angka 6
                                        } else if (i == 10) {
                                            option.css({ 'color': 'yellow', 'background-color': 'black' }); // Warna kuning dengan latar hitam
                                        }

                                        select.append(option);
                                    }
                                });
                                </script>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Status Bayar -->
                                <label for="status_bayar">Status Bayar:</label>
                                <select name="status_bayar" id="status_bayar" class="form-control status-dropdown" onchange="ubahWarna()">
                                <option value="" selected disabled>-- Pilih Status Bayar--</option>    
                                    <option value="LUNAS" class="lunas">LUNAS</option>
                                    <option value="DENDA" class="denda">DENDA</option>
                                    <option value="TUNGGAK" class="tunggak">TUNGGAK</option>
                                    <option value="BATAL" class="batal">BATAL</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Status ISR -->
                                <label for="status_isr">Status ISR:</label> <!-- ID & name diperbaiki -->
                                <select name="status_isr" id="status_isr" class="form-control status-dropdown" onchange="ubahWarna()">
                                    <option value="" selected disabled>-- Pilih Status ISR --</option>
                                    <option value="VALID" class="lunas">VALID</option>
                                    <option value="BATAL" class="batal">BATAL</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Tanggal Pembayaran -->
                                <label for="tgl_pembayaran">Tanggal Pembayaran:</label>
                                <input type="date" name="tgl_pembayaran" id="tgl_pembayaran" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- BHP Terbayar -->
                                <label for="bhp_terbayar">BHP terbayar:</label>
                                <input type="number" name="bhp_terbayar" id="bhp_terbayar" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- BHP Dibatalkan -->
                                <label for="bhp_dibatalkan">BHP Dibatalkan:</label>
                                <input type="number" name="bhp_dibatalkan" id="bhp_dibatalkan" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Denda Tunggakan -->
                                <label for="denda_tunggakan">BHP Ditunggakan:</label>
                                <input type="number" name="denda_tunggakan" id="denda_tunggakan" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group mb-2">
                                <!-- Keterangan -->
                                <label for="keterangan">Keterangan:</label>
                                <textarea name="keterangan" id="keterangan" class="form-control"></textarea>    
                            </div>
                        </div>
                    </div>
                    
                    <!-- TAMBAH CLIENT BARU -->
                    <div class="col-md-6 col-12">
                        <div class="form-group mb-2">
                            <!-- Form Tambah Client Baru (Tersembunyi) -->
                            <div id="form_client_baru" style="display: none;">
                                <label for="nama_client_baru">Nama Client Baru:</label>
                                <input type="text" name="nama_client_baru" id="nama_client_baru" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        document.getElementById("nama_client").addEventListener("change", function() {
                            var clientId = this.value;
            
                            if (clientId !== "" && clientId !== "tambah_baru") {
                                fetch("get_client_data.php?client_id=" + clientId)
                                    .then(response => response.json())
                                    .then(data => {
                                        document.getElementById("wilayah").value = data.wilayah || "";
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
                                // Tampilkan form tambah client baru
                                document.getElementById("form_client_baru").style.display = "block";
                                
                                // Reset semua field form agar kosong
                                document.getElementById("wilayah").value = "";
                                document.getElementById("no").value = "";
                                document.getElementById("alamat_client").value = "";
                                document.getElementById("client_id").value = "";
                                document.getElementById("app_id").value = "";
                                document.getElementById("no_simf").value = "";
                                document.getElementById("id_invoice").value = "";
                                document.getElementById("no_spp").value = "";
                                document.getElementById("service").value = "";
                                document.getElementById("terbit_spp").value = "";
                                document.getElementById("batas_bayar").value = "";
                                document.getElementById("awal_periode_bhp").value = "";
                                document.getElementById("potensi_bhp").value = "";
                                document.getElementById("besar_bhp").value = "";
                                document.getElementById("tahun_periode").value = "";
                                document.getElementById("status_bayar").value = "";
                                document.getElementById("status_isr").value = "";
                                document.getElementById("tgl_pembayaran").value = "";
                                document.getElementById("bhp_terbayar").value = "";
                                document.getElementById("bhp_dibatalkan").value = "";
                                document.getElementById("denda_tunggakan").value = "";
                                document.getElementById("keterangan").value = "";
                                
                            } else {
                                // Sembunyikan form tambah client baru kalau dropdown kembali ke default
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

                    <!-- Tombol Submit -->
                    <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="console.log('Form dikirim');">Submit</button>

                        </div>
                    </form>
                    <script>
                            document.getElementById("nama_client").addEventListener("change", function() {
                                let clientId = this.value;
                                let formClientBaru = document.getElementById("form_client_baru");
                                let inputFields = ["wilayah", "alamat_client", "client_id", "app_id", "no_simf", "id_invoice", "no_spp", "service", "besar_bhp"];

                                if (clientId !== "" && clientId !== "tambah_baru") {
                                    fetch("get_client_data.php?client_id=" + clientId)
                                        .then(response => response.json())
                                        .then(data => {
                                            document.getElementById("wilayah").value = data.wilayah || "";
                                            document.getElementById("alamat_client").value = data.alamat_client || "";
                                            document.getElementById("client_id").value = data.client_id || "";
                                            document.getElementById("app_id").value = data.app_id || "";
                                            document.getElementById("no_simf").value = data.no_simf || "";
                                            document.getElementById("id_invoice").value = data.id_invoice || "";
                                            document.getElementById("no_spp").value = data.no_spp || "";
                                            document.getElementById("service").value = data.service || "";
                                            document.getElementById("besar_bhp").value = data.besar_bhp || "";

                                            // Set input readonly jika memilih dari database
                                            inputFields.forEach(id => {
                                                document.getElementById(id).readOnly = true;
                                            });

                                            // Sembunyikan form tambah client baru
                                            formClientBaru.style.display = "none";
                                        })
                                        .catch(error => console.error("Error fetching data:", error));
                                } else if (clientId === "tambah_baru") {
                                    // Tampilkan form tambah client baru
                                    formClientBaru.style.display = "block";

                                    // Kosongkan semua field yang perlu diisi
                                    inputFields.forEach(id => {
                                        document.getElementById(id).value = "";
                                        document.getElementById(id).readOnly = false;
                                    });
                                } else {
                                    // Sembunyikan form tambah client baru jika tidak ada pilihan
                                    formClientBaru.style.display = "none";
                                }
                            });
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