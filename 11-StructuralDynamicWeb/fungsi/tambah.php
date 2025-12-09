<?php
session_start();
if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

    /* ========== TAMBAH JABATAN ========== */
    if (!empty($_GET['jabatan'])) {
        $jabatan = antiinjection($koneksi, $_POST['jabatan']);
        $keterangan = antiinjection($koneksi, $_POST['keterangan']);

        $query = "INSERT INTO jabatan (jabatan, keterangan) VALUES ('$jabatan', '$keterangan')";
        if (pg_query($koneksi, $query)) {
            pesan('success', "Jabatan Baru Ditambahkan.");
        } else {
            pesan('danger', "Menambah Jabatan Gagal Karena: " . pg_last_error($koneksi));
        }
        header("Location: ../index.php?page=jabatan");
        exit;
    }


    /* ========== TAMBAH ANGGOTA ========== */
    if (!empty($_GET['anggota'])) {

        $username       = antiinjection($koneksi, $_POST['username']);
        $password       = antiinjection($koneksi, $_POST['password']);
        $level          = antiinjection($koneksi, $_POST['level']);
        $jabatan        = antiinjection($koneksi, $_POST['jabatan']);
        $nama           = antiinjection($koneksi, $_POST['nama']);
        $jenis_kelamin  = antiinjection($koneksi, $_POST['jenis_kelamin']);
        $alamat         = antiinjection($koneksi, $_POST['alamat']);
        $no_telp        = antiinjection($koneksi, $_POST['no_telp']);

        // Password handling
        $salt = bin2hex(random_bytes(16));
        $combined_password = $salt . $password;
        $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

        // === PERBAIKAN DI SINI (TABEL USERS + RETURNING user_id) ===
        $query = "INSERT INTO users (username, password, salt, level) 
                  VALUES ('$username', '$hashed_password', '$salt', '$level')
                  RETURNING user_id";

        $result_user = pg_query($koneksi, $query);

        if ($result_user) {
            $user_data = pg_fetch_assoc($result_user);

            // === Pastikan kolomnya 'user_id', bukan 'id' ===
            if ($user_data && isset($user_data['user_id'])) {

                $last_id = $user_data['user_id'];

                $query2 = "INSERT INTO anggota 
                          (nama, jenis_kelamin, alamat, no_telp, user_id, jabatan_id)
                           VALUES ('$nama', '$jenis_kelamin', '$alamat', '$no_telp', '$last_id', '$jabatan')";

                if (pg_query($koneksi, $query2)) {
                    pesan('success', "Anggota Baru Ditambahkan.");
                } else {
                    pesan('warning', "Gagal Menambahkan Anggota. Data Login Tersimpan Karena: " . pg_last_error($koneksi));
                }

            } else {
                pesan('danger', "Gagal Menambahkan Anggota: user_id tidak ditemukan.");
            }

        } else {
            pesan('danger', "Menambahkan Anggota Gagal Karena: " . pg_last_error($koneksi));
        }

        header("Location: ../index.php?page=anggota");
        exit;
    }
}
?>
