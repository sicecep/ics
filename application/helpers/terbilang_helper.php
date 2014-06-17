<?php
function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = kekata($x/10)." puluh". kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . kekata($x - 100);
    } else if ($x <1000) {
        $temp = kekata($x/100) . " ratus" . kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = kekata($x/1000) . " ribu" . kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = kekata($x/1000000) . " juta" . kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = kekata($x/1000000000) . " milyar" . kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = kekata($x/1000000000000) . " trilyun" . kekata(fmod($x,1000000000000));
    }      
        return $temp;
}

function tkoma($x){
    $x = stristr($x, '.'); // digunakan untuk menemukan bilangan setelah koma
     $z = substr($x, 1);
    $angka = array("nol", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"); // identifikasi nilai array
    
    
//    $temp = " ";
//    $pjg = strlen($x); // menghitung panjang nilai $x
//    $pos = 1;
//    
//    while($pos < $pjg){
//        $char = substr($x, $pos, 1); // mengambil karakter pada posisi 1 sebanyak 1 karakter
//        $pos++;
//        $temp .= " ".$angka[$char]; // menampung konversi kata sesuai dengan angka yg didapat dari $char
//    }
//    return $temp;
    $temp = "";
    if ($z <12) {
        $temp = " ". $angka[$z];
    } else if ($z <20) {
        $temp = kekata($z - 10). " belas";
    } else if ($z <100) {
        $temp = kekata($z/10)." puluh". kekata($z % 10);
    }  else if ($x <200) {
        $temp = " seratus" . kekata($z - 100);
    }   
        return $temp;
        
}

function terbilang($x, $style=4, $cur="") {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $poin   = trim(tkoma($x));
        $hasil = trim(kekata($x));
    }      
    switch ($style) {
        case 1:
            if($poin){
                $hasil = strtoupper($hasil).' '.$cur.' '. strtoupper($poin).' SEN ';
            } else {
                $hasil = strtoupper($hasil);
            }
            break;
        case 2:
            if($poin){
                $hasil = strtolower($hasil).' '.$cur. ' '. strtolower($poin). ' sen ';
            } else {
                $hasil = strtolower($hasil);
            }
            break;
        case 3:
            if($poin){
                $hasil = ucwords($hasil).' '.$cur. ' '. $hasil = ucwords($poin). ' Sen';
            } else {
                $hasil = ucwords($hasil);
            }
            break;
        default:
            if($poin){
                $hasil = ucfirst($hasil).' '.$cur.' '.$hasil = strtolower($poin). ' sen ';
            } else {
                $hasil = ucfirst($hasil);
            }
            break;
    }      
    return $hasil;
}




function terbilang_rupiah($x, $style=4, $cur="") {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }      
    switch ($style) {
        case 1:
            
                $hasil = strtoupper($hasil).' '.$cur.' ';
            
            break;
        case 2:
            
                $hasil = strtolower($hasil).' '.$cur. ' ';
            
            break;
        case 3:
            
                $hasil = ucwords($hasil).' '.$cur. ' ';
            
            break;
        default:
            
                $hasil = ucfirst($hasil).' '.$cur.' ';
            
            break;
    }      
    return $hasil;
}



function terbilang_angka($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim(kekata($x));
    } else {
        $hasil = trim(kekata($x));
    }      
    switch ($style) {
        case 1:
            
                $hasil = strtoupper($hasil);
            
            break;
        case 2:
            
                $hasil = strtolower($hasil);
            
            break;
        case 3:
            
                $hasil = ucwords($hasil);
            
            break;
        default:
            
                $hasil = ucfirst($hasil);
            
            break;
    }      
    return $hasil;
}

function keKL($x) {
    $x = abs($x);   
    $temp = "";
    if ($x <1000) {
        $temp = $x." Liter";
    } else if ($x > 1000) {
        $temp = ($x / 1000)." KL";
    }              
    return $temp;
}
?>