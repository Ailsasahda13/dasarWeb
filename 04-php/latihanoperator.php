<?php

//Data Kursi
$totalKursi = 45;
$kursiTerisi = 28;

$kursiKosong = $totalKursi - $kursiTerisi;
$persentaseKosong = ($kursiKosong / $totalKursi) * 100;

echo "Total Kursi: $totalKursi <br>";
echo "Kursi Terisi: $kursiTerisi <br>";
echo "Kursi Kosong: $kursiKosong <br>";
echo "Persentase Kursi Kosong: " . round($persentaseKosong, 2) . "%<br>";
?>