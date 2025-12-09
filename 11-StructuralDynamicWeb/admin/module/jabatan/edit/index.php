<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['username'])) {
    header("Location: ../../../../index.php");
    exit;
}

require __DIR__ . '/../../../../config/koneksi.php';
require __DIR__ . '/../../../template/menu.php';

if (!isset($_GET['id'])) {
    die("ID jabatan tidak ditemukan.");
}
$id = $_GET['id'];

$query = "SELECT * FROM jabatan WHERE jabatan_id = $1";
$result = pg_query_params($koneksi, $query, [$id]);

if (!$result) {
    die("Query error: " . pg_last_error($koneksi));
}

$row = pg_fetch_assoc($result);
if (!$row) {
    die("Data jabatan tidak ditemukan.");
}
?>

<div class="container-fluid">
    <div class="row">
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Jabatan</h1>
            </div>

            <div class="card col-md-6">
                <div class="card-header">Form Edit Jabatan</div>
                <div class="card-body">
                   <form action="../../fungsi/edit.php?jabatan=edit" method="POST">
                        <input type="hidden" name="id" value="<?= $row['jabatan_id']; ?>">

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Nama Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" value="<?= htmlspecialchars($row['jabatan']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="keterangan" required><?= htmlspecialchars($row['keterangan']); ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Ubah</button>
                        <a href="../index.php" class="btn btn-secondary"><i class="fa fa-times"></i> Batal</a>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
