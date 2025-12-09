<?php
function antiinjection($koneksi, $data)
{
    // Tahapan sanitasi input
    $data = htmlspecialchars($data, ENT_QUOTES); // filter karakter HTML berbahaya
    $data = strip_tags($data);                    // hapus tag HTML
    $data = stripslashes($data);                  // hapus backslash
    $data = pg_escape_string($koneksi, $data);    // escape string untuk PostgreSQL

    return $data;
}
?>
