<div class="container-fluid">
    <div class="row">
        <?php
        require 'admin/template/menu.php';
        require 'config/koneksi.php'; // pastikan koneksi PostgreSQL

        if (!isset($_GET['id'])) {
            die("ID anggota tidak ditemukan");
        }

        $id = $_GET['id'];

        // QUERY AMBIL DATA ANGGOTA + JABATAN + USER
        $query = "
            SELECT a.*, j.jabatan, j.jabatan_id, u.username
            FROM anggota a
            LEFT JOIN jabatan j ON a.jabatan_id = j.jabatan_id
            LEFT JOIN users u ON a.user_id = u.user_id
            WHERE a.user_id = $1
        ";

        $result = pg_query_params($koneksi, $query, [$id]);

        if (!$result) {
            die("Query gagal: " . pg_last_error($koneksi));
        }

        $row = pg_fetch_assoc($result);

        if (!$row) {
            die("Data tidak ditemukan!");
        }
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Anggota</h1>
            </div>

            <form action="fungsi/edit.php?anggota=edit" method="POST">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                Form Edit Anggota
                            </div>
                            <div class="card-body">

                                <input type="hidden" value="<?php echo $row['user_id']; ?>" name="id">

                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $row['nama']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Jabatan:</label>
                                    <select class="form-select" name="jabatan">
                                        <option selected>Pilih Jabatan</option>

                                        <?php
                                        // ambil semua jabatan
                                        $query2 = "SELECT * FROM jabatan ORDER BY jabatan ASC";
                                        $result2 = pg_query($koneksi, $query2);

                                        while ($row2 = pg_fetch_assoc($result2)) {
                                        ?>
                                            <option value="<?= $row2['jabatan_id']; ?>" 
                                                <?= ($row['jabatan_id'] == $row2['jabatan_id']) ? 'selected' : '' ?>>
                                                <?= $row2['jabatan']; ?>
                                            </option>
                                        <?php } ?>

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Jenis Kelamin:</label><br>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="L" 
                                        <?= ($row['jenis_kelamin'] === "L") ? 'checked' : '' ?>>
                                        <label class="form-check-label">Laki-Laki</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="P"
                                        <?= ($row['jenis_kelamin'] === "P") ? 'checked' : '' ?>>
                                        <label class="form-check-label">Perempuan</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <textarea class="form-control" name="alamat"><?= $row['alamat']; ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">No Telepon</label>
                                    <input type="number" class="form-control" name="no_telp" value="<?= $row['no_telp']; ?>">
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                Form Edit Login Anggota
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" value="<?= $row['username']; ?>">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password">
                                    <div class="form-text">Kosongi password jika tidak ingin menggantinya.</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-floppy-o"></i> Ubah
                                </button>

                                <a href="index.php?page=anggota" class="btn btn-secondary">
                                    <i class="fa fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </main>
    </div>
</div>
