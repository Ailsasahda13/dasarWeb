<?php
session_start();
include 'koneksi.php';
include 'csrf.php';

header('Content-Type: application/json');

if (!isset($_POST['id'])) {
    echo json_encode(['error' => 'ID tidak dikirim dari AJAX']);
    exit;
}

$id = (int)$_POST['id'];
$query = "SELECT * FROM anggota WHERE id = $1";
$result = pg_query_params($koneksi, $query, array($id));

if (!$result) {
    echo json_encode(['error' => pg_last_error($koneksi)]);
    exit;
}

$row = pg_fetch_assoc($result);

if ($row) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Data tidak ditemukan']);
}

pg_close($koneksi);
?>
