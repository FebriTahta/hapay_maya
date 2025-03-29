<section>
    <?php include('dashboard_query.php');?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // BAR CHART 1 //
            // Ambil data dari PHP
            const chartData = <?php echo $jsonResult1; ?>;

            // Fungsi untuk mengonversi angka ke satuan juta
            function toJuta(value) {
                return (parseInt(value) / 1000000).toFixed(2); // Dibagi 1jt dan dibulatkan 2 desimal
            }

            // Ubah data ke format yang bisa dipakai oleh Chart.js
            const labels = chartData.map(item => item.bulan_bhp);
            const tertagihData = chartData.map(item => toJuta(item.tertagih));
            const terbayarLancarData = chartData.map(item => toJuta(item.terbayar_lancar));
            const terbayarLewatBatasData = chartData.map(item => toJuta(item.terbayar_lewat_batas));
            const tertunggakData = chartData.map(item => toJuta(item.tertunggak));
            const tagihanDibatalkan = chartData.map(item => toJuta(item.tagihan_dibatalkan));
            const tungguDibayar = chartData.map(item => toJuta(item.tunggu_dibayar));
            const perolehanDenda = chartData.map(item => toJuta(item.perolehan_denda));

            var areaChartData = {
                labels: labels,
                datasets: [
                    {
                        label: 'Tertagih',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        data: tertagihData
                    },
                    {
                        label: 'Terbayar Lancar',
                        backgroundColor: 'rgba(0,166,90,0.9)',
                        borderColor: 'rgba(0,166,90,0.8)',
                        data: terbayarLancarData
                    },
                    {
                        label: 'Terbayar Lewat Batas',
                        backgroundColor: 'rgba(255,193,7,0.9)',
                        borderColor: 'rgba(255,193,7,0.8)',
                        data: terbayarLewatBatasData
                    },
                    {
                        label: 'Tertunggak',
                        backgroundColor: 'rgba(255, 30, 0, 0.9)',
                        borderColor: 'rgba(255, 30, 0, 0.8)',
                        data: tertunggakData
                    },
                    {
                        label: 'Tagihan Dibatalkan',
                        backgroundColor: 'rgba(190, 190, 190, 0.9)',
                        borderColor: 'rgba(190, 190, 190, 0.9)',
                        data: tagihanDibatalkan
                    },
                    {
                        label: 'Tunggu Dibayar',
                        backgroundColor: 'rgba(255, 81, 0, 0.9)',
                        borderColor: 'rgba(255, 81, 0, 0.9)',
                        data: tungguDibayar
                    },
                    {
                        label: 'Perolehan Denda',
                        backgroundColor: 'rgba(255, 0, 247, 0.9)',
                        borderColor: 'rgba(255, 0, 247, 0.9)',
                        data: perolehanDenda
                    }
                ]
            };

            var barChartCanvas = $('#barChart').get(0).getContext('2d');
            var barChartData = $.extend(true, {}, areaChartData);

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false
            };

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            });

            // BAR CHART 2 //
            const chartData2 = <?php echo $jsonResult2; ?>;
            const bulan = chartData2.map(item => item.bulan_bhp);
            const sppTerbit = chartData2.map(item => item.terbit);
            const sppTerbayarLancar = chartData2.map(item => item.spp_terbayar_lancar);
            const sppTerbayarLewatBatas = chartData2.map(item => item.spp_terbayar_lewat_batas);
            const sppTertunggak = chartData2.map(item => item.spp_tertunggak);
            const sppDibatalkan = chartData2.map(item => item.spp_dibatalkan);
            const sppTungguDibayar = chartData2.map(item => item.spp_tunggu_dibayar);

            var areaChartData2 = {
                labels: bulan,
                datasets: [
                    {
                        label: 'SPP Terbit',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        data: sppTerbit
                    },
                    {
                        label: 'SPP Terbayar Lancar',
                        backgroundColor: 'rgba(0,166,90,0.9)',
                        borderColor: 'rgba(0,166,90,0.8)',
                        data: sppTerbayarLancar
                    },
                    {
                        label: 'SPP Terbayar Lewat Batas',
                        backgroundColor: 'rgba(255,193,7,0.9)',
                        borderColor: 'rgba(255,193,7,0.8)',
                        data: sppTerbayarLewatBatas
                    },
                    {
                        label: 'SPP Tertunggak',
                        backgroundColor: 'rgba(255, 30, 0, 0.9)',
                        borderColor: 'rgba(255, 30, 0, 0.8)',
                        data: sppTertunggak
                    },
                    {
                        label: 'SPP Dibatalkan',
                        backgroundColor: 'rgba(190, 190, 190, 0.9)',
                        borderColor: 'rgba(190, 190, 190, 0.9)',
                        data: sppDibatalkan
                    },
                    {
                        label: 'SPP Dibayar',
                        backgroundColor: 'rgba(174, 177, 31, 0.9)',
                        borderColor: 'rgba(174, 177, 31, 0.9)',
                        data: sppTungguDibayar
                    }
                ]
            };

            var barChartCanvas2 = $('#barChart2').get(0).getContext('2d');
            var barChartData2 = $.extend(true, {}, areaChartData2);

            var barChartOptions2 = {
                responsive: true,
                maintainAspectRatio: false
            };

            new Chart(barChartCanvas2, {
                type: 'bar',
                data: barChartData2,
                options: barChartOptions2
            });

            // PIE CHART 1 //
            const pieData = [
                tertagihData.reduce((sum, value) => sum + parseInt(value), 0),
                terbayarLancarData.reduce((sum, value) => sum + parseInt(value), 0),
                terbayarLewatBatasData.reduce((sum, value) => sum + parseInt(value), 0),
                tertunggakData.reduce((sum, value) => sum + parseInt(value), 0),
                tagihanDibatalkan.reduce((sum, value) => sum + parseInt(value), 0),
                tungguDibayar.reduce((sum, value) => sum + parseInt(value), 0),
                perolehanDenda.reduce((sum, value) => sum + parseInt(value), 0)
            ];

            const pieLabels = [
                'Tertagih',
                'Lancar',
                'Lewat Batas',
                'Tertunggak',
                'Dibatalkan',
                'Menunggu',
                'Denda'
            ];

            const pieColors = [
                'rgba(60,141,188,0.9)', // Biru
                'rgba(0,166,90,0.9)', // Hijau
                'rgba(255,193,7,0.9)', // Kuning
                'rgba(255, 30, 0, 0.9)', // Merah
                'rgba(190, 190, 190, 0.9)', // Abu-Abu
                'rgba(255, 81, 0, 0.9)', // Oranye
                'rgba(255, 0, 247, 0.9)' // Pink
            ];

            // Hitung total untuk persentase
            const totalValue = pieData.reduce((sum, value) => sum + value, 0);

            var ctx = document.getElementById("pieChart").getContext("2d");
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: pieLabels.map((label, index) => {
                        let percentage = ((pieData[index] / totalValue) * 100).toFixed(1);
                        return `${label} (${percentage}%)`; // Tambahkan persentase ke legend
                    }),
                    datasets: [{
                        data: pieData,
                        backgroundColor: pieColors
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right', // Legend di sebelah kanan
                            labels: {
                                boxWidth: 15,
                                padding: 10,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    let value = tooltipItem.raw;
                                    let percentage = ((value / totalValue) * 100).toFixed(1);
                                    return `${pieLabels[tooltipItem.dataIndex]}: ${value.toLocaleString()} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });

            // DOUGHTNUT CHART 1 //
            const doughnutData = [
                sppTerbit.reduce((sum, value) => sum + parseInt(value), 0),
                sppTerbayarLancar.reduce((sum, value) => sum + parseInt(value), 0),
                sppTerbayarLewatBatas.reduce((sum, value) => sum + parseInt(value), 0),
                sppTertunggak.reduce((sum, value) => sum + parseInt(value), 0),
                sppDibatalkan.reduce((sum, value) => sum + parseInt(value), 0),
                sppTungguDibayar.reduce((sum, value) => sum + parseInt(value), 0)
            ];

            const doughnutLabels = [
                'Terbit',
                'Lancar',
                'Lewat Batas',
                'Tertunggak',
                'Dibatalkan',
                'Tunggu Dibayar'
            ];

            const doughnutColors = [
                'rgba(60,141,188,0.9)', // Biru
                'rgba(0,166,90,0.9)', // Hijau
                'rgba(255,193,7,0.9)', // Kuning
                'rgba(255, 30, 0, 0.9)', // Merah
                'rgba(190, 190, 190, 0.9)', // Abu-Abu
                'rgba(255, 0, 247, 0.9)' // Pink
            ];

            // Hitung total untuk persentase
            const totalValue2 = doughnutData.reduce((sum, value) => sum + value, 0);

            var ctx = document.getElementById("doughnutChart").getContext("2d");
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: doughnutLabels.map((label, index) => {
                        let percentage = ((doughnutData[index] / totalValue2) * 100).toFixed(1);
                        return `${label} (${percentage}%)`; // Tambahkan persentase ke legend
                    }),
                    datasets: [{
                        data: doughnutData,
                        backgroundColor: doughnutColors
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '50%', // Ukuran hole di tengah
                    plugins: {
                        legend: {
                            position: 'right', // Legend di sebelah kanan
                            labels: {
                                boxWidth: 15,
                                padding: 10,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    let value = tooltipItem.raw;
                                    let percentage = ((value / totalValue2) * 100).toFixed(1);
                                    return `${doughnutLabels[tooltipItem.dataIndex]}: ${value.toLocaleString()} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });

    </script>
</section>