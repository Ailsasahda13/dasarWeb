<!-- <?php
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $nama = $_POST['nama'];
//     $email = $_POST['email'];
//     $errors = array();

//     // Validasi Nama
//     if (empty($nama)) {
//         $errors[] = "Nama harus diisi.";
//     }

//     // Validasi Email
//     if (empty($email)) {
//         $errors[] = "Email harus diisi.";
//     } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         $errors[] = "Format email tidak valid.";
//     }

//     // Jika ada error tampilkan pesan
//     if (!empty($errors)) {
//         foreach ($errors as $error) {
//             echo "<p style='color:red;'>$error</p>";
//         }
//         echo "<a href='javascript:history.back()'>Kembali ke Form</a>";
//     } else {
//         // Jika tidak ada error, tampilkan data
//         echo "<h2>Data Berhasil Dikirim!</h2>";
//         echo "<p><strong>Nama:</strong> $nama</p>";
//         echo "<p><strong>Email:</strong> $email</p>";
//     }
// }
?> -->

<?php
// Pastikan form dikirim lewat POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil data dari form dengan aman
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $errors = [];

    if (empty($nama)) {
        $errors[] = "Nama harus diisi.";
    }

    if (empty($email)) {
        $errors[] = "Email harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    if (empty($password)) {
        $errors[] = "Password harus diisi.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter.";
    }

    if (!empty($errors)) {
        echo "<h2 style='color:red;'>Validasi Gagal!</h2>";
        echo "<ul style='color:red;'>";
        foreach ($errors as $err) {
            echo "<li>$err</li>";
        }
        echo "</ul>";
        echo "<p><a href='index.html'>Kembali ke form</a></p>";
    } else {
        echo "<h2 style='color:green;'>Data berhasil dikirim!</h2>";
        echo "<p><b>Nama:</b> $nama</p>";
        echo "<p><b>Email:</b> $email</p>";
        echo "<p><b>Password:</b> (disembunyikan demi keamanan)</p>";
        echo "<p><a href='index.html'>Kembali ke form</a></p>";
    }
} else {
    echo "<h3>Silakan akses form melalui <a href='index.html'>index.html</a>.</h3>";
}
?>
