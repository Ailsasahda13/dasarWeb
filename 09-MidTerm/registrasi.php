<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Result</title>
    <link rel="stylesheet" href="registrasi.css">
    </head>
<body>

<div class="result-box">
<?php
if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $nim = htmlspecialchars($_POST['nim']);
    $email = htmlspecialchars($_POST['email']);
    $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : '-';
    $major = htmlspecialchars($_POST['major']);
    $address = htmlspecialchars($_POST['address']);

    $target_dir = "uploads/";
    if (!is_dir($target_dir)) 
        mkdir($target_dir, 0777, true);

    $target_file = $target_dir . basename($_FILES["photo"]["name"]);

    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        echo "<h2>💫Registration Successful!💫</h2>";
        echo "<div class='info'>";
        echo "<p><b>Full Name:</b> $name</p>";
        echo "<p><b>Student ID (NIM):</b> $nim</p>";
        echo "<p><b>Email:</b> $email</p>";
        echo "<p><b>Gender:</b> $gender</p>";
        echo "<p><b>Major:</b> $major</p>";
        echo "<p><b>Address:</b> $address</p>";
        echo "</div>";
        echo "<img src='$target_file' alt='Student Photo'>";
        echo "<p class='thankyou'>Thank you, Registrasimu berhasil! <br> Ingat, setiap hari adalah kesempatan baru untuk belajar, berkembang, dan menjadi versi terbaik dirimu.</p>";
    } else {
        echo "<h2 style='color:red;'>Upload Failed!</h2>";
        echo "<p>Please try again.</p>";
    }
    } else {
        echo "<h2>No Data Submitted</h2>";
    }
    ?>
<br><br>
    <a href="form_registrasi.php">Back to Form</a>
    </div>
</body>
</html>
