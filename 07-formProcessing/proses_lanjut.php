<?php
// Pastikan form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $buah = $_POST['buah'];
    $warna = isset($_POST['warna']) ? implode(", ", $_POST['warna']) : "Tidak memilih warna";
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : "Belum memilih";

    // Tampilkan hasil
    echo "<h3>Hasil Pilihan:</h3>";
    echo "Buah yang dipilih: $buah<br>";
    echo "Warna favorit: $warna<br>";
    echo "Jenis kelamin: $jenis_kelamin";
}
?>
