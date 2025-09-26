<!-- <?php
//membuat fungsi
// function hitungUmur($thn_lahir, $thn_sekarang) {
//     $umur= $thn_sekarang - $thn_lahir;
//     return $umur;
// }

//     echo "umur saya adalah ". hitungUmur(2006, 2023) . " tahun"

?> -->

<?php
//membuat fungsi 
function hitungUmur($thn_lahir, $thn_sekarang) {
    $umur = $thn_sekarang - $thn_lahir;
    return $umur;
}

function perkenalan ($nama, $salam="Assalamualaikum") {
    echo $salam.",";
    echo "Perkenalkan, nama saya ".$nama."</br>";

    //memanggil fungsi lain
    echo "Saya berusia ". hitungUmur(2006, 2023) ." tahun<br/>";
    echo "Senang berkenalan dengan anda<br/>";
}

    //memanggil fungsi perkenalan
    perkenalan ("Ailsa");

?>