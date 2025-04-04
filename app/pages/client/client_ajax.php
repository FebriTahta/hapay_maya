<script>
    function loadStatus(tahun='') {
        $.ajax({
            url: "app/../pages/client/client_view_info_query.php",
            type: 'GET',
            data: { tahun: tahun },
            dataType: 'json',
            success: function(response) {

                const infoDataClient = response.info_data_client;
                const tableDataClient = response.table_data_client;

                // Pastikan response.data3 ada dan berupa array
                if (!response || !Array.isArray(infoDataClient)) {
                    console.error("Response infoDataClient is not an array:", response);
                    return; // Hentikan eksekusi jika tidak sesuai format
                }

                // if (!response || !Array.isArray(tableDataClient)) {
                //     console.error("Response tableDataClient is not an array:", response);
                //     return; // Hentikan eksekusi jika tidak sesuai format
                // }

                const arr = [];
                const arr_val = [];                
            
                infoDataClient.forEach(function(item) {
                    arr.push(item.status_bayar); // Atau item.amount_status, sesuai dengan yang Anda butuhkan
                    arr_val.push(item.amount_status);
                });
                
                $('#status').html('<option value="">SEMUA STATUS</option>');

                
                $('#info').empty();

                arr.forEach(function(status, index) {
                    
                    if (status) {
                        $('#status').append('<option value="'+ status +'">'+ status +'</option>');
                    }

                    let display_icon = '';
                    let background_icon = '';

                    if (status === 'LUNAS') {
                        display_icon = '<i class="fas fa-thumbs-up"></i>';
                        background_icon = 'bg-success'
                    } else if (status === 'DENDA') {
                        display_icon = '<i class="fas fa-exclamation-triangle"></i>';
                        background_icon = 'bg-danger'
                    } else if (status === 'TUNGGAK') {
                        display_icon = '<i class="fas fa-exclamation-circle"></i>';
                        background_icon = 'bg-primary'
                    } else if (status === 'BATAL') {
                        display_icon = '<i class="fas fa-times-circle"></i>';
                        background_icon = 'bg-secondary'
                    } else {
                        display_icon = '<i class="fas fa-question-circle"></i>'; // Default icon      
                        background_icon = 'bg-secondary'                  
                    }

                    $('#info').append(
                        '<div class="col-12 col-sm-6 col-md-3">'
                            +'<div class="info-box">'
                                +'<span class="info-box-icon '+background_icon+' elevation-1">'+display_icon+'</span>'
                                +'<div class="info-box-content">'
                                    +'<span class="info-box-text">'+status+'</span>' // Menampilkan status
                                    +'<span class="info-box-number">'+arr_val[index]+'</span>' // Data persentase, bisa diganti sesuai kebutuhan
                                +'</div>'
                            +'</div>'
                        +'</div>'
                    );
                });
                
            },
            error: function(xhr, status, error) {
                console.error("Error mengambil data:", error);
            }
        });
    }

    function loadDataTableClient(tahun = '', status = '') {
        $.ajax({
            url: "app/../pages/client/client_data_table_query.php",
            type: 'GET',
            data: { 
                tahun: tahun,
                status: status
            },
            dataType: 'json',
            success: function(response) {
                const data = response.data_table_client;
                // console.log(data);
                
                // Hancurkan DataTable jika sudah ada
                if ($.fn.DataTable.isDataTable('#data_table_client')) {
                    $('#data_table_client').DataTable().destroy();
                }

                // Inisialisasi ulang DataTable dengan data baru
                $('#data_table_client').DataTable({
                    "processing": true,
                    "serverSide": false,
                    "data": data, // Pastikan data dimasukkan di sini
                    "columns": [
                        { "data": "id" },
                        { "data": "wilayah" },
                        { "data": "nama_client" },
                        { "data": "alamat_client" },
                        { "data": "client_id" },
                        { "data": "app_id" },
                        { "data": "no_simf" },
                        { "data": "id_invoice" },
                        { "data": "no_spp" },
                        { "data": "service" },
                        { "data": "terbit_spp" },
                        { "data": "batas_bayar" },
                        { "data": "awal_periode_bhp" },
                        { "data": "potensi_bhp" },
                        { "data": "besar_bhp" },
                        { "data": "tahun_periode" },
                        { "data": "status_bayar" },
                        { "data": "status_isr" },
                        { "data": "tgl_pembayaran" },
                        { "data": "bhp_terbayar" },
                        { "data": "bhp_dibatalkan" },
                        { "data": "denda_tunggakan" },
                        { "data": "keterangan" },
                        { "data": "action" }
                    ]
                });
            },
            error: function(xhr, status, error) {
                console.error("Error mengambil data:", error);
            }
        });
    }

    $('#formInsertClient').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "app/../pages/client/client_insert_query.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // alert("Data berhasil disimpan!");
                    toastr.success(response.message);
                    $('#modal_add_client').modal('hide');
                    loadDataTableClient(); // Reload DataTable setelah menyimpan data
                    loadStatus(); // reload info status
                } else {
                    // alert("Gagal menyimpan data: " + response.error);
                    toastr.warning(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                toastr.error(error);
            }
        });
    });
    

    // load data 
    document.addEventListener("DOMContentLoaded", function() {
        // function list
        loadStatus();
        loadDataTableClient();

        let tahunFiltered , statusFiltered;

        document.getElementById("tahun").addEventListener("change", function() {
            tahunFiltered = this.value
            loadStatus(tahunFiltered); // Load ulang grafik berdasarkan tahun
            loadDataTableClient(tahunFiltered);
        });

        document.getElementById("status").addEventListener("change", function() {
            statusFiltered = this.value;
            loadDataTableClient(tahunFiltered,statusFiltered);
        });
    });
</script>