<?php
    include '../conf/config.php';

    $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';
    
    $query1= "
        select 
            date_format(STR_TO_DATE(awal_periode_bhp, '%d/%m/%Y'), '%m') as `bulan_bhp_num`,
            date_format(STR_TO_DATE(awal_periode_bhp, '%d/%m/%Y'), '%b') as `bulan_bhp`,
            sum(besar_bhp) as `tertagih`,
            sum(
                case 
                    when status_bayar = 'LUNAS' THEN potensi_bhp
                    else 0
                end
            ) as `terbayar_lancar`,
            sum(
                case 
                    when status_bayar = 'DENDA' then potensi_bhp 
                    else 0
                end
            ) as `terbayar_lewat_batas`,
            sum(
                case 
                    when status_bayar = 'TUNGGAK' then potensi_bhp 
                    else 0
                end
            ) as `tertunggak`,
            SUM(
                case 
                    when bhp_dibatalkan is not null then bhp_dibatalkan
                    else 0
                end
            ) as `tagihan_dibatalkan`,
            sum(besar_bhp)
            - sum(
                case 
                    when status_bayar = 'LUNAS' THEN potensi_bhp
                    else 0
                end
            )
            - sum(
                case 
                    when status_bayar = 'DENDA' then potensi_bhp 
                    else 0
                end
            )
            - sum(
                case 
                    when status_bayar = 'TUNGGAK' then potensi_bhp 
                    else 0
                end
            )
            - sum(
                case 
                    when bhp_dibatalkan is not null then bhp_dibatalkan
                    else 0
                end
            ) as `tunggu_dibayar`,
            SUM(
                case 
                    when denda_tunggakan is not null then denda_tunggakan
                    else 0
                end
            ) as `perolehan_denda`
        from db_client
        where awal_periode_bhp REGEXP '^[0-9]{2}/[0-9]{2}/[0-9]{4}$'
    ";

    $query2 = "
        select 
            date_format(STR_TO_DATE(awal_periode_bhp, '%d/%m/%Y'), '%m') as `bulan_bhp_num`,
            date_format(STR_TO_DATE(awal_periode_bhp, '%d/%m/%Y'), '%b') as `bulan_bhp`,
            count(besar_bhp) as `terbit`,
            count(
                case 
                    when status_bayar = 'LUNAS' then 1
                    else null
                end
            ) as `spp_terbayar_lancar`,
            count(
                case 
                    when status_bayar = 'DENDA' then 1 
                    else null
                end
            ) as `spp_terbayar_lewat_batas`,
            count(
                case 
                    when status_bayar = 'TUNGGAK' then 1 
                    else null
                end
            ) as `spp_tertunggak`,
            count(
                case 
                    when status_bayar = 'BATAL' then 1 
                    else null
                end
            ) as `spp_dibatalkan`,
            count(besar_bhp)
            - count(
                case 
                    when status_bayar = 'LUNAS' then 1
                    else null
                end
            )
            - count(
                case 
                    when status_bayar = 'DENDA' then 1 
                    else null
                end
            )
            - count(
                case 
                    when status_bayar = 'TUNGGAK' then 1 
                    else null
                end
            )
            - count(
                case 
                    when status_bayar = 'BATAL' then 1 
                    else null
                end
            ) as `spp_tunggu_dibayar`
        from db_client
        where awal_periode_bhp REGEXP '^[0-9]{2}/[0-9]{2}/[0-9]{4}$'
    ";

    // tambahkan query untuk filter tahun jika ada
    if (!empty($tahun)) {
        $query1 .= "AND DATE_FORMAT(STR_TO_DATE(awal_periode_bhp, '%d/%m/%Y'), '%Y') = '$tahun'";
        $query2 .= "AND DATE_FORMAT(STR_TO_DATE(awal_periode_bhp, '%d/%m/%Y'), '%Y') = '$tahun'";
    }
    // tambahkan query untuk group by bulan
    $query1 .= " GROUP BY DATE_FORMAT(STR_TO_DATE(awal_periode_bhp, '%d/%m/%Y'), '%m') ASC";
    $query2 .= " GROUP BY DATE_FORMAT(STR_TO_DATE(awal_periode_bhp, '%d/%m/%Y'), '%m') ASC";

    $data1 = mysqli_query($koneksi, query: $query1);
    $data2 = mysqli_query($koneksi, query: $query2);
    
    // Simpan hasil query dalam array
    $result1 = [];
    $result2 = [];

    while ($row = mysqli_fetch_assoc($data1)) {
        $result1[] = $row;
    }

    while ($row = mysqli_fetch_assoc($data2)) {
        $result2[] = $row;
    }

    // Encode hasil dalam JSON
    $jsonResult1 = json_encode($result1);
    $jsonResult2 = json_encode($result2);

    echo json_encode(["data1" => $result1, "data2" => $result2]);