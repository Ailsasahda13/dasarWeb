<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}

require '../config/koneksi.php';
require '../fungsi/pesan_kilat.php';
require '../fungsi/anti_injection.php';

if (!empty($_GET['jabatan'])) {

    $id = antiinjection($koneksi, $_POST['id']);
    $jabatan = antiinjection($koneksi, $_POST['jabatan']);
    $keterangan = antiinjection($koneksi, $_POST['keterangan']);

    $query = "UPDATE jabatan SET jabatan = '$jabatan', keterangan = '$keterangan'
              WHERE jabatan_id = '$id'";

    if (pg_query($koneksi, $query)) {
        pesan('success', "Jabatan Telah Diubah.");
    } else {
        pesan('danger', "Mengubah Jabatan Gagal Karena: " . pg_last_error($koneksi));
    }

    header("Location: ../index.php?page=jabatan");
    exit;
}

if (!empty($_GET['anggota'])) {

    $user_id = antiinjection($koneksi, $_POST['id']);
    $nama = antiinjection($koneksi, $_POST['nama']);
    $jabatan = antiinjection($koneksi, $_POST['jabatan']);
    $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
    $alamat = antiinjection($koneksi, $_POST['alamat']);
    $no_telp = antiinjection($koneksi, $_POST['no_telp']);
    $username = antiinjection($koneksi, $_POST['username']);

    // UPDATE anggota
    $query_anggota = "
        UPDATE anggota SET
            nama = '$nama',
            jenis_kelamin = '$jenis_kelamin',
            alamat = '$alamat',
            no_telp = '$no_telp',
            jabatan_id = '$jabatan'
        WHERE user_id = '$user_id'
    ";

    $res1 = pg_query($koneksi, $query_anggota);

    if (!$res1) {
        pesan('danger', "Mengubah Anggota Gagal Karena: " . pg_last_error($koneksi));
        header("Location: ../index.php?page=anggota");
        exit;
    }

    // Jika password diubah
    if (!empty($_POST['password'])) {

        $password = $_POST['password'];

        $salt = bin2hex(random_bytes(16));
        $combined = $salt . $password;
        $hashed = password_hash($combined, PASSWORD_BCRYPT);

        $query_user = "
            UPDATE users SET
                username = '$username',
                password = '$hashed',
                salt = '$salt'
            WHERE user_id = '$user_id'
        ";

        if (pg_query($koneksi, $query_user)) {
            pesan('success', "Anggota Telah Diubah.");
        } else {
            pesan('warning', "Anggota diubah, tetapi password gagal diperbarui: " . pg_last_error($koneksi));
        }

    } else {
        // Hanya ubah username
        $query_user = "
            UPDATE users SET
                username = '$username'
            WHERE user_id = '$user_id'
        ";

        if (pg_query($koneksi, $query_user)) {
            pesan('success', "Anggota Telah Diubah.");
        } else {
            pesan('warning', "Anggota diubah, tetapi username gagal diperbarui: " . pg_last_error($koneksi));
        }
    }

    header("Location: ../index.php?page=anggota");
    exit;
}

?>
