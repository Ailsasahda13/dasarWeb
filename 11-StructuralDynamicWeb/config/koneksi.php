<?php
$koneksi = pg_connect("host=localhost port=5432 dbname=kantor_db user=postgres password=ailsasahda13");

if (!$koneksi) {
    die("Koneksi database gagal: " . pg_last_error());
}
?>