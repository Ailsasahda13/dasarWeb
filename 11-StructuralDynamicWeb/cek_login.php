<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

include "config/koneksi.php";
include "fungsi/pesan_kilat.php";
include "fungsi/anti_injection.php";

// Ambil input
$username = antiinjection($koneksi, $_POST['username']);
$password = antiinjection($koneksi, $_POST['password']);

// Query PostgreSQL
$query = "SELECT username, level, salt, password AS hashed_password 
          FROM users 
          WHERE username = '$username'";

$result = pg_query($koneksi, $query);

// Jika user tidak ditemukan
if (!$result || pg_num_rows($result) == 0) {
    pesan('warning', "Username tidak ditemukan.");
    header("Location: login.php");
    exit;
}

$row = pg_fetch_assoc($result);

$salt = $row['salt'];
$hashed_password = $row['hashed_password'];

if ($salt !== null && $hashed_password !== null) {

    // Gabungkan salt + password
    $combined_password = $salt . $password;

    // Verifikasi hash
    if (password_verify($combined_password, $hashed_password)) {

        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];

        header("Location: index.php");
        exit;

    } else {

        pesan('danger', "Login gagal. Password Anda salah.");
        header("Location: login.php");
        exit;

    }

} else {

    pesan('warning', "Data pengguna tidak valid.");
    header("Location: login.php");
    exit;

}
?>
