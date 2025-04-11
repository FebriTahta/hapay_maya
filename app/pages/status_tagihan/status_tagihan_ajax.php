<script>
    function loadDataTableClient(client_id) {
        $.ajax({
            url: "app/../pages/status_tagihan/status_tagihan_data_table_query.php",
            type: 'GET',
            data: {client_id: client_id},
            dataType: 'json',
            success: function(response) {

                const data = response.data;
                console.log(response);
                
                
                // Hancurkan DataTable jika sudah ada
                if ($.fn.DataTable.isDataTable('#data_tagihan_client')) {
                    $('#data_tagihan_client').DataTable().destroy();
                }

                // Inisialisasi ulang DataTable dengan data baru
                $('#data_tagihan_client').DataTable({
                    "processing": true,
                    "serverSide": false,
                    "pageLength": 5, // ✅ Tampilkan 5 row per halaman
                    "dom": 'Bfrtip', // penting untuk menampilkan tombol
                    "buttons": [
                        "copy", "csv", "excel", "pdf", "print", "colvis" // tombol download CSV
                    ],
                    "data": data, // Pastikan data dimasukkan di sini
                    "columns": [
                        { 
                            data: null, 
                            render: function (data, type, row, meta) {
                                return meta.row + 1; // baris ke-1, ke-2, dst.
                            }
                        },
                        { data: 'client_id' },
                        { data: 'nama_client' },
                        { data: 'id_invoice_surat' },
                        { data: 'no_tagihan' },
                        { data: 'terbit_surat' },
                        { data: 'batas_bayar_surat' },
                        { data: 'tagihan' },
                        { data: 'status_bayar_surat' }
                    ]
                });
            },
            error: function(xhr, status, error) {
                console.error("Error mengambil data:", error);
            }
        });
    }

    function loadDetailClient(id)
    {
        $.ajax({
            url: "app/../pages/status_tagihan/status_tagihan_detail_client_query.php",
            type: 'GET',
            data: {id: id},
            dataType: 'json',
            success: function(response) {
                const data = response.data[0];
                console.log(data);
                $('#nama_client_text').text(data.nama_client);
                $('#besar_bhp_text').text('Rp '+data.besar_bhp.toLocaleString());
                $('#batas_bayar_text').text(data.batas_bayar);
                
                $('#bulan').val(data.bulan);
                $('#no').val(data.no);
                $('#nama_client').val(data.nama_client);
                $('#alamat_client').val(data.alamat_client);
                $('#tagihan').val(data.besar_bhp);
                $('#client_id').val(data.client_id);
                $('#terbit_surat').val(convertToDisplayDateFormat(data.terbit_spp));
                $('#batas_bayar_surat').val(convertToDisplayDateFormat(data.batas_bayar));
                $('#id_client').val(data.id);
                
            },
            error: function(xhr, status, error) {
                console.error("Error mengambil data:", error);
            }
        });
    }

    function convertToDisplayDateFormat(dateStr) {
        const parts = dateStr.split('/'); // Pisahkan berdasarkan "/"
        if (parts.length !== 3) return null;

        const [day, month, year] = parts;

        // Validasi dasar: pastikan day, month, year angka
        if (isNaN(day) || isNaN(month) || isNaN(year)) return null;

        // Format ke "YYYY-MM-DD"
        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
    }

    $('#formAddTagihanClient').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "app/../pages/status_tagihan/status_tagihan_insert_query.php",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // alert("Data berhasil disimpan!");
                    toastr.success(response.message);
                    $('#formAddTagihanClient')[0].reset(); // Reset form
                    
                    loadDataTableClient(client_id); // Reload DataTable setelah menyimpan data
                    
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

    document.addEventListener("DOMContentLoaded", function() {
        const client_id = $('#client_id_text').val();
        const id = $('#id').val();
        console.log(id);
        
        loadDataTableClient(client_id);
        loadDetailClient(id)
    });
</script>