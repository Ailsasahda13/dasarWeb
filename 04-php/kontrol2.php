<?php

$harga = 120000;
$diskon = 0;

if ($harga > 100000) {
    $diskon = 0.20 * $harga;
}

$hargaAkhir = $harga - $diskon;

echo "Harga awal: Rp " . number_format($harga, 0, ',', ',') . "<br>";
echo "Diskon: Rp " . number_format($diskon, 0, ',', ',') . "<br>";
echo "Harga yang harus dibayar: Rp " . number_format($hargaAkhir, 0, ',', ',');
?>