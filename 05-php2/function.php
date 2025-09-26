<!-- <?php

// function perkenalan() {
//     echo "Assalamualaikum, ";
//     echo "Perkenalkan, nama saya Ailsa<br/>";
//     echo "Senang berkenalan dengan anda<br/>"; 
// }

// //memanggil fungsi yang sudah dibuat
// perkenalan();
// echo "<br>";
// perkenalan();

?> -->

<?php
//membuat fungsi
function perkenalan($nama, $salam){
    echo $salam.", ";
    echo "Perkenalkan, nama saya ".$nama."<br/>";
    echo "Senang berkenalan dengan Anda<br/>";
}

//memanggil fungsi yang sudah dibuat
perkenalan("Sahda", "Hallo");

echo "<hr>";

$saya = "Ailsa";
$ucapanSalam = "Selamat pagi";

//memanggil lagi
perkenalan($saya, $ucapanSalam);
?>

<!-- <?php
//membuat fungsi
// function perkenalan($nama, $salam="Assalamualaikum"){
//     echo $salam.", ";
//     echo "Perkenalkan nama saya ".$nama."<br/>";
//     echo "Senang berkenalan dengan Anda<br/>";
// }

// //memanggil fungsi yang sudah dibuat
// perkenalan("Sahda","Hallo");

// echo "<hr>";

// $saya = "Ailsa";
// $ucapanSalam = "Selamat pagi";

// //memanggil lagi tanpa mengisi parameter salam
// perkenalan($saya);
?> -->