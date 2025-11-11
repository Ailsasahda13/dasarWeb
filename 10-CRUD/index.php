<?php
include 'auth.php';
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo $_SESSION['csrf_token']; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <title>Data Anggota</title>
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php" style="color:white;">CRUD Dengan Ajax</a>
</nav>

<div class="container mt-4">
    <h2 class="text-center">Data Anggota</h2>

    <form method="post" class="form-data" id="form-data">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Jenis Kelamin</label><br>
            <input type="radio" name="jenis_kelamin" id="jenkel1" value="L"> Laki-laki
            <input type="radio" name="jenis_kelamin" id="jenkel2" value="P"> Perempuan
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>No Telepon</label>
            <input type="number" name="no_telp" id="no_telp" class="form-control" required>
        </div>

        <button type="button" id="simpan" class="btn btn-primary">
            <i class="fa fa-save"></i> Simpan
        </button>
    </form>

    <hr>
    <div class="data"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('.data').load('data.php');
    $.ajaxSetup({ headers: { 'Csrf-Token': $('meta[name="csrf-token"]').attr('content') } });

    $("#simpan").click(function() {
        var data = $('#form-data').serialize();
        $.ajax({
            type: 'POST',
            url: 'form_action.php',
            data: data,
            success: function() {
                $('.data').load('data.php');
                $("#form-data")[0].reset();
                $("#id").val('');
                alert('Data berhasil disimpan!');
            }
        });
    });
});
</script>
</body>
</html>
