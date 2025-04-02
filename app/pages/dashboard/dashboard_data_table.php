
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function loadTable(tahun = '') {
            $.ajax({
                url: "app/../pages/dashboard/dashboard_query.php",
                type: "GET",
                data: { tahun: tahun },
                dataType: "json",
                success: function(response) {
                    // Fungsi format angka dengan ribuan separator
                    function formatNumber(data, type, row) {
                        if (type === 'display' && data != null) {
                            return new Intl.NumberFormat('id-ID').format(data);
                        }
                        return data;
                    }
                    $('#data1').DataTable({
                        data: response.data1, // Data dari PHP
                        pageLength: 12,
                        lenghMenu: false,
                        paging: false,
                        columns: [
                            { data: 'bulan_bhp_num', title: 'NO' },
                            { data: 'bulan_bhp', title: 'BULAN' },
                            { data: 'tertagih', title: 'TERTAGIH' , render: formatNumber, class: "text-right" },
                            { data: 'terbayar_lancar', title: 'LANCAR' , render: formatNumber, class: "text-right" },
                            { data: 'terbayar_lewat_batas', title: 'LEWAT BATAS' , render: formatNumber, class: "text-right" },
                            { data: 'tertunggak', title: 'TERTUNGGAK' , render: formatNumber, class: "text-right" },
                            { data: 'tagihan_dibatalkan', title: 'DIBATALKAN' , render: formatNumber, class: "text-right" },
                            { data: 'tunggu_dibayar', title: 'MENUNGGU' , render: formatNumber, class: "text-right" },
                            { data: 'perolehan_denda', title: 'DENDA' , render: formatNumber, class: "text-right" }
                        ]
                    });

                    $('#data2').DataTable({
                        data: response.data2, // Data dari PHP
                        pageLength: 12,
                        lenghMenu: false,
                        paging: false,
                        columns: [
                            { data: 'bulan_bhp_num', title: 'NO' },
                            { data: 'bulan_bhp', title: 'BULAN' },
                            { data: 'terbit', title: 'TERBIT' , class: "text-right" },
                            { data: 'spp_terbayar_lancar', title: 'SPP LANCAR' , class: "text-right" },
                            { data: 'spp_terbayar_lewat_batas', title: 'SPP LEWAT BATAS' , class: "text-right" },
                            { data: 'spp_tertunggak', title: 'SPP TERTUNGGAK' , class: "text-right" },
                            { data: 'spp_dibatalkan', title: 'SPP DIBATALKAN' , class: "text-right" },
                            { data: 'spp_tunggu_dibayar', title: 'MENUNGGU' , class: "text-right" }
                        ]
                    });
                },
                error: function(error) {
                    console.error("Error fetching data:", error);
                }
            });
        }

        loadTable();

        document.getElementById("tahun").addEventListener("change", function() {
            console.log("FILTER TABEL:", this.value); // Debugging
            $('#data1').DataTable().destroy(); // Hancurkan tabel sebelumnya
            $('#data2').DataTable().destroy(); // Hancurkan tabel sebelumnya
            loadTable(this.value); // Load ulang grafik berdasarkan tahun
        });
    });
</script>