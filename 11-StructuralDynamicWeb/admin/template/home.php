<?php
include __DIR__ . '/menu.php';

$koneksi_path = dirname(__DIR__, 2) . '/config/koneksi.php';
if (!file_exists($koneksi_path)) {
    
    die("File koneksi tidak ditemukan: " . $koneksi_path);
}
include_once $koneksi_path;

// Query PostgreSQL untuk dashboard
$query_anggota = "SELECT COUNT(anggota_id) AS jml FROM anggota";
$result_anggota = pg_query($koneksi, $query_anggota);
if ($result_anggota === false) {
    // jika query gagal
    die("Query anggota gagal: " . pg_last_error($koneksi));
}
$row_anggota = pg_fetch_assoc($result_anggota);

$query_jabatan = "SELECT COUNT(jabatan_id) AS jml FROM jabatan";
$result_jabatan = pg_query($koneksi, $query_jabatan);
if ($result_jabatan === false) {
    die("Query jabatan gagal: " . pg_last_error($koneksi));
}
$row_jabatan = pg_fetch_assoc($result_jabatan);
?>

<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <div class="row">
                <!-- Card Anggota -->
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ANGGOTA</h5>
                            <p class="card-text">
                                Total Anggota sejumlah <?= htmlspecialchars($row_anggota['jml'] ?? 0) ?> orang.
                            </p>
                            <a href="index.php?page=anggota" class="btn btn-primary">
                                <i class="fa fa-users" aria-hidden="true"></i> Kelola
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Jabatan -->
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">JABATAN</h5>
                            <p class="card-text">
                                Total Jabatan sejumlah <?= htmlspecialchars($row_jabatan['jml'] ?? 0) ?>.
                            </p>
                            <a href="index.php?page=jabatan" class="btn btn-primary">
                                <i class="fa fa-puzzle-piece" aria-hidden="true"></i> Kelola
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
