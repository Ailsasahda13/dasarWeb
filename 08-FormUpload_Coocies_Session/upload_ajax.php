<?php
// if (isset($_FILES['file'])) {
//     $errors = array();
//     $file_name = $_FILES['file']['name'];
//     $file_size = $_FILES['file']['size'];
//     $file_tmp = $_FILES['file']['tmp_name'];
//     $file_type = $_FILES['file']['type'];
//     @$file_ext = strtolower("" . end(explode('.', $_FILES['file']['name'])) . "");
//     $extensions = array("pdf", "doc", "docx", "txt");

//     if (in_array($file_ext, $extensions) === false) {
//         $errors[] = "Ekstensi file yang diizinkan adalah PDF, DOC, DOCX, atau TXT.";
//     }

//     if ($file_size > 2097152) {
//         $errors[] = 'Ukuran file tidak boleh lebih dari 2 MB';
//     }

//     if (empty($errors) == true) {
//         move_uploaded_file($file_tmp, "documents/" . $file_name);
//         echo "File berhasil diunggah.";
//     } else {
//         echo implode(" ", $errors);
//     }
// }


// if (isset($_FILES['images'])) {
//     $errors = [];
//     $total_files = count($_FILES['images']['name']);
//     $allowed_ext = array("jpg", "jpeg", "png", "gif");
//     $maxsize = 5 * 1024 * 1024; // 5 MB

//     for ($i = 0; $i < $total_files; $i++) {
//         $file_name = $_FILES['images']['name'][$i];
//         $file_size = $_FILES['images']['size'][$i];
//         $file_tmp  = $_FILES['images']['tmp_name'][$i];
//         $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

//         // Cek ekstensi file
//         if (!in_array($file_ext, $allowed_ext)) {
//             $errors[] = "File memiliki ekstensi tidak diizinkan.";
//             continue;
//         }

//         // Cek ukuran file
//         if ($file_size > $maxsize) {
//             $errors[] = "File melebihi batas ukuran 5 MB.";
//             continue;
//         }

//         // Jika lolos validasi, pindahkan file ke folder tujuan
//         if (move_uploaded_file($file_tmp, "uploads/" . $file_name)) {
//             echo "File berhasil diunggah.<br>";
//         } else {
//             $errors[] = "Gagal mengunggah file <b>$file_name</b>.";
//         }
//     }

//     // Tampilkan pesan error jika ada
//     if (!empty($errors)) {
//         echo "<br><b>Hasil Upload:</b><br>";
//         foreach ($errors as $error) {
//             echo "$error<br>";
//         }
//     }
// }


if (isset($_FILES['file'])) {
    $errors = array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    
    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    $upload_dir = "uploads/";

    if (!in_array($file_ext, $allowed_extensions)) {
        $errors[] = "File yang diizinkan hanya JPG, JPEG, PNG, atau GIF.";
    }

    if ($file_size > 5 * 1024 * 1024) {
        $errors[] = "Ukuran file tidak boleh lebih dari 5 MB.";
    }

    if (empty($errors)) {
        // Pastikan folder uploads sudah ada
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Pindahkan file ke folder tujuan
        move_uploaded_file($file_tmp, $upload_dir . $file_name);

        // Tampilkan pesan dan preview gambar
        echo "<p>File berhasil diunggah</p>";
        echo "<img src='" . $upload_dir . $file_name . "' width='250' style='margin-top:10px; border-radius:8px;'>";
    } else {
        echo implode("<br>", $errors);
    }
}
?>
