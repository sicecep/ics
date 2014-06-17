<?php
/* 
 *  author : sicecep (bradercep[at]yahoo[dot]com)
 *  description : helper convert to indonesia date
 * 
 * 
 */

function bulanindo($x){
    $x = abs($x);
    switch($x){
        case "01":
            $bulan = "Januari";
            break;
        case "02":
            $bulan = "Februari";
            break;
        case "03":
            $bulan = "Maret";
            break;
        case "04":
            $bulan = "April";
            break;
        case "05":
            $bulan = "Mei";
            break;
        case "06":
            $bulan = "Juni";
            break;
        case "07":
            $bulan = "Juli";
            break;
        case "08":
            $bulan = "Agustus";
            break;
        case "09":
            $bulan = "September";
            break;
        case "10":
            $bulan = "Oktober";
            break;
        case "11":
            $bulan = "November";
            break;
        case "12":
            $bulan = "Desember";
            break;
    }
    return $bulan;
    
}

function date2indo($str) {
setlocale (LC_TIME, 'id_ID');
$date = strftime("%d %B %Y", strtotime($str));

return $date;
}

?>
