<?php
session_start();
include "koneksi.php";
include "csrf.php";

$id = $_POST['id'] ?? '';
$nama = $_POST['nama'] ?? '';
$jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
$alamat = $_POST['alamat'] ?? '';
$no_telp = $_POST['no_telp'] ?? '';

if ($id == "") {
    $query = "INSERT INTO anggota (nama, jenis_kelamin, alamat, no_telp) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($koneksi, $query, array($nama, $jenis_kelamin, $alamat, $no_telp));
} else {
    $query = "UPDATE anggota SET nama=$1, jenis_kelamin=$2, alamat=$3, no_telp=$4 WHERE id=$5";
    $result = pg_query_params($koneksi, $query, array($nama, $jenis_kelamin, $alamat, $no_telp, $id));
}

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => pg_last_error($koneksi)]);
}

pg_close($koneksi);
?>
