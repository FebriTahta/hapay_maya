<script>
    function loadStatus(tahun='') {
        $.ajax({
            url: "app/../pages/client/client_query.php",
            type: 'GET',
            data: { tahun: tahun },
            dataType: 'json',
            success: function(response) {
                // Pastikan response.data3 ada dan berupa array
                if (!response || !Array.isArray(response.data_client)) {
                    console.error("Response data1 is not an array:", response);
                    return; // Hentikan eksekusi jika tidak sesuai format
                }

                const dataClient = response.data_client;
                const arr = [];
                const arr_val = [];
                
            
                dataClient.forEach(function(item) {
                    arr.push(item.status_bayar); // Atau item.amount_status, sesuai dengan yang Anda butuhkan
                    arr_val.push(item.amount_status);
                });
                
                $('#info').empty(); // Kosongkan dulu konten jika perlu
                arr.forEach(function(status, index) {
                    
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

    // load data 
    document.addEventListener("DOMContentLoaded", function() {
        // function list
        loadStatus();

        document.getElementById("tahun").addEventListener("change", function() {
            console.log("Filter tahun diubah:", this.value); // Debugging
            loadStatus(this.value); // Load ulang grafik berdasarkan tahun
        });
    });
</script>