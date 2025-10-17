<!-- <?php
// if (isset($_POST["submit"])) {
//     $targetdir = "uploads/"; //direktori tujuan untuk menyimpan file
//     $targetfile = $targetdir . basename($_FILES["myfile"]["name"]);

//     if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $targetfile)) {
//         echo "File berhasil diunggah.";
//     } else {
//         echo "Gagal mengunggah file.";
//     }
// }
?> -->

<!-- 
<?php
// if (isset($_POST["submit"])) {
//     $targetdir = "uploads/"; // Direktori tujuan untuk menyimpan file
//     $targetfile = $targetdir . basename($_FILES["myfile"]["name"]);
//     $fileType = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

//     $allowedExtensions = array("jpg", "jpeg", "png", "gif");
//     $maxsize = 5*1024*1024;

//     if (in_array($fileType, $allowedExtensions) && $_FILES["myfile"]["size"]<=$maxsize) {
//         if (move_uploaded_file($_FILES["myfile"]["tmp_name"],$targetfile)) {
//             echo "File berhasil diunggah";

//             // Menampilkan thumbnail gambar
//             echo "<img src='$targetfile' width='200' style='height:auto; margin-top:10px; border:1px solid #ccc;'>";
//         } else {
//             echo "Gagal mengunggah file.";
//         }
//     }
//     else {
//         echo "File tidak valid atau melebihi ukuran maksimum yang diizinkan";
//     }
// }
?> -->

<?php
if (isset($_POST["submit"])) {
    $targetdir = "uploads/"; // Direktori tujuan untuk menyimpan file
    $targetfile = $targetdir . basename($_FILES["myfile"]["name"]);
    $fileType = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

    $allowedExtensions = array("txt", "pdf", "doc", "docx");
    $maxsize = 3*1024*1024;

    if (in_array($fileType, $allowedExtensions) && $_FILES["myfile"]["size"]<=$maxsize) {
        if (move_uploaded_file($_FILES["myfile"]["tmp_name"],$targetfile)) {
            echo "File berhasil diunggah";
        } else {
            echo "Gagal mengunggah file.";
        }
    }
    else {
        echo "File tidak valid atau melebihi ukuran maksimum yang diizinkan";
    }
}
?>