<script>
    document.addEventListener("DOMContentLoaded", function() {
        $.ajax({
            url: "app/../global/query_global.php",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Pastikan response.data3 ada dan berupa array
                if (!response || !Array.isArray(response.data3)) {
                    console.error("Response data3 is not an array:", response);
                    return; // Hentikan eksekusi jika tidak sesuai format
                }

                // Tambahkan option SEMUA TAHUN terlebih dahulu
                $('#tahun').html('<option value="">SEMUA TAHUN</option>');

                // Looping hasil dari database untuk menambahkan option
                $.each(response.data3, function(index, item) {
                    // Pastikan item.tahun tidak null sebelum ditambahkan ke select
                    if (item.tahun) {
                        $('#tahun').append('<option value="'+ item.tahun +'">'+ item.tahun +'</option>');
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error mengambil data tahun:", error);
            }
        });
    });
</script>