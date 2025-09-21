<?php

$nilaiSiswa = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
sort($nilaiSiswa);
$nilaiTerpakai = array_slice($nilaiSiswa, 2, count($nilaiSiswa) - 4);

$total = array_sum($nilaiTerpakai);

echo "Daftar nilai setelah membuang 2 tertinggi dan 2 terendah: " . implode(", ", $nilaiTerpakai) . "<br>";
echo "Total nilai yang dipakai: $total";
?>
