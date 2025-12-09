<?php
session_start();

if (!empty($_SESSION['username'])) {

    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

if (!empty($_GET['anggota'])) {

    $anggota_id = (int) $_GET['id'];

    $cek = pg_query($koneksi, "SELECT user_id FROM anggota WHERE anggota_id = $anggota_id");
    $data = pg_fetch_assoc($cek);
    $user_id = $data['user_id'];

    // Hapus data anggota
    pg_query($koneksi, "DELETE FROM anggota WHERE anggota_id = $anggota_id");

    // Jika ada akun user, hapus juga
    if (!empty($user_id)) {
        pg_query($koneksi, "DELETE FROM users WHERE user_id = $user_id");
    }

    pesan('success', "Anggota berhasil dihapus.");
    header("Location: ../index.php?page=anggota");
    exit;
}

    if (!empty($_GET['jabatan'])) {

        $id = antiinjection($koneksi, $_GET['id']);

        $query = "DELETE FROM jabatan WHERE jabatan_id = '$id'";
        pg_query($koneksi, $query);

        pesan('success', 'Jabatan berhasil dihapus.');
        header("Location: ../index.php?page=jabatan");
        exit;
    }
}
?>