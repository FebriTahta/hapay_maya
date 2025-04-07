<script>
    function loadDataTableClient() {
        $.ajax({
            url: "app/../pages/status_tagihan/status_tagihan_data_table_query.php",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                const data = response.data;
                
                // Hancurkan DataTable jika sudah ada
                if ($.fn.DataTable.isDataTable('#data_tagihan_client')) {
                    $('#data_tagihan_client').DataTable().destroy();
                }

                // Inisialisasi ulang DataTable dengan data baru
                $('#data_tagihan_client').DataTable({
                    "processing": true,
                    "serverSide": false,
                    "data": data, // Pastikan data dimasukkan di sini
                    "columns": [
                        { data: 'id_tagihan_client' },
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

    document.addEventListener("DOMContentLoaded", function() {
        loadDataTableClient();
    });
</script>