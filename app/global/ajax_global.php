<script>

    function queryGlobal()
    {
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
    }

    function queryNotif()
    {
        $.ajax({
            url: "app/../global/notification_query.php",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                const notif = response.data;
                const counter = response.data2;

                $('#notif_view').empty(); // Menghapus semua isi sebelumnya
                
                $('.counter_notif').html(counter);
                $.each(notif, function(index, item) {
                    let bg_color = ''; // pakai let, bukan const

                    if (item.baca == 1) {
                        bg_color = 'background-color: #d6d6d6;';
                    }
                    
                    // Gunakan data attributes
                    $('#notif_view').append(
                        '<div class="dropdown-divider"></div>' +
                        '<a href="#" data-toggle="modal" data-target="#modal_notif" class="dropdown-item" ' +
                        'data-link="index.php?page=status-tagihan&client_id='+item.client_id+'&id='+item.id_client+'&notif_id='+item.id+'" data-text="'+item.text+'" data-periode="'+item.periode+'" ' +
                        'style="font-size: 14px; max-width: 100%; white-space: normal; word-wrap: break-word; '+bg_color+'">' +
                            '<i class="fas fa-envelope mr-2"></i> ' + item.text +
                        '</a>' +
                        '<div class="dropdown-divider"></div>'
                    );
                });

                // Event listener satu kali di luar loop
                $('#notif_view').on('click', '.dropdown-item', function () {
                    const notifText = $(this).data('text');
                    const notifPeriode = $(this).data('periode');
                    const notifLink = $(this).data('link');

                    $('#modal_notif .modal-body #text').text(notifText);
                    $('#modal_notif .modal-body #periode').text(notifPeriode);
                    $('#modal_notif #link').attr('href', notifLink);
                });
            },
            error: function(error) {
                console.error("error");
            }
        });
    }

    document.addEventListener("DOMContentLoaded", function() {
        queryGlobal();    
        queryNotif();
    });
</script>