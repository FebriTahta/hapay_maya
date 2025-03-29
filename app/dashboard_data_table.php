<section>
    <?php include('dashboard_query.php');?>

    <script>
        const tableData1 = <?php echo $jsonResult1; ?>;
        const tableData2 = <?php echo $jsonResult2; ?>;
        
        $('#data1').DataTable({
            data: tableData1, // Data dari PHP
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
            data: tableData2, // Data dari PHP
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

        // Fungsi format angka dengan ribuan separator
        function formatNumber(data, type, row) {
            if (type === 'display' && data != null) {
                return new Intl.NumberFormat('id-ID').format(data);
            }
            return data;
        }
    </script>
</section>