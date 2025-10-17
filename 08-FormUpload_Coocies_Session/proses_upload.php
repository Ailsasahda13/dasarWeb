<?php
// //Lokasi penyimpanan file yang diunggah
// $targetDirectory = "documents/";

// // Periksa apakah direktori penyimpanan ada, jika tidak maka buat
// if (!file_exists($targetDirectory)) {
//     mkdir($targetDirectory, 0777, true);
// }
// if ($_FILES['files']['name'][0]) {
//     $totalFiles = count($_FILES['files']['name']);

//     // Loop melalui semua file yang diunggah
//     for ($i=0; $i < $totalFiles; $i++) {
//         $fileName = $_FILES['files']['name'][$i];
//         $targetFile = $targetDirectory . $fileName;

//     // Pindahkan file yang diunggah ke direktori penyimpanan
//     if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $targetFile)) {
//         echo "File $fileName berhasil diunggah.<br>";
//     } else {
//         echo "Gagal mengunggah file $fileName.<br>";
//         }
//     }
// } else {
//         echo "Tidak ada file yang diunggah.";
//     }




// Lokasi penyimpanan file gambar yang diunggah
$targetDirectory = "images/";

// Periksa apakah direktori penyimpanan ada, jika tidak maka buat
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

// Periksa apakah ada file yang diunggah
if (!empty($_FILES['images']['name'][0])) {
    $totalFiles = count($_FILES['images']['name']);
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    $maxSize = 5 * 1024 * 1024; // Maksimum 5 MB per file

    // Loop melalui semua file gambar yang diunggah
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['images']['name'][$i];
        $fileTmp = $_FILES['images']['tmp_name'][$i];
        $fileSize = $_FILES['images']['size'][$i];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $targetFile = $targetDirectory . basename($fileName);

        // Validasi ekstensi dan ukuran file
        if (in_array($fileType, $allowedExtensions) && $fileSize <= $maxSize) {
            // Pindahkan file ke direktori penyimpanan
            if (move_uploaded_file($fileTmp, $targetFile)) {
                echo "File berhasil diunggah.<br>";
                echo "<img src='$targetFile' width='150' style='margin:10px; border:1px solid #ccc;'><br>";
            } else {
                echo "Gagal mengunggah file.<br>";
            }
        } else {
            echo "File tidak valid atau melebihi ukuran maksimum.<br>";
        }
    }
} else {
    echo "Tidak ada file gambar yang diunggah.";
}
?>


