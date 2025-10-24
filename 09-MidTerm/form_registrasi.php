<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polinema Student Registration</title>
    <link rel="stylesheet" href="registrasi.css">

<script>
function validateForm() {
    const name = document.forms["regForm"]["name"].value;
    const nim = document.forms["regForm"]["nim"].value;
    const email = document.forms["regForm"]["email"].value;
    const major = document.forms["regForm"]["major"].value;
    const photo = document.forms["regForm"]["photo"].value;

    if (name === "" || nim === "" || email === "" || major === "" || photo === "") {
        alert("Semua field wajib diisi!");
        return false;
    }

    const fileExtension = photo.split('.').pop().toLowerCase();
    if (["jpg", "jpeg", "png"].indexOf(fileExtension) === -1) {
        alert("Format foto harus JPG atau PNG!");
        return false;
    }

    return true;
}
    </script>
</head>

<body>
    <div class="container">
    <h2>Polinema Student Registration</h2>

    <form name="regForm" action="registrasi.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label>Full Name</label>
        <input type="text" name="name" placeholder="Enter your full name">

        <label>Student ID (NIM)</label>
        <input type="text" name="nim" placeholder="Enter your student ID">

        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email">

        <label>Gender</label>
        <div class="gender-group">
            <label><input type="radio" name="gender" value="Male"> Male</label>
            <label><input type="radio" name="gender" value="Female"> Female</label>
        </div>

        <label>Major</label>
        <select name="major">
            <option value="">-- Select Major --</option>
            <option value="Information Technology">Information Technology</option>
            <option value="Commercial Administration">Commercial Administration</option>
            <option value="Mechanical Engineering">Mechanical Engineering</option>
            <option value="Electrical Engineering">Electrical Engineering</option>
            <option value="Chemical Engineering">Chemical Engineering</option>
        </select>

        <label>Address</label>
        <textarea name="address" rows="3" placeholder="Enter your address"></textarea>

        <label>Your KTM Photo</label>
        <input type="file" name="photo" accept=".jpg, .jpeg, .png">

        <button type="submit" name="submit">Submit</button>
    </form>

    <p class="footer-text">Form ini digunakan untuk keperluan registrasi mahasiswa baru.</p>
</div>
</body>
</html>
