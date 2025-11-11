<!-- <?php
// $koneksi = pg_connect("host=localhost port=5432 dbname=prakwebdb user=postgres password=ailsasahda13");

// if (!$koneksi) {
//     die("Koneksi database gagal: " . pg_last_error());
// } 
?> -->
<!-- 
<?php
// define('HOST', 'localhost');
// define('USER', 'postgres');
// define('PASS', 'ailsasahda13');
// define('DB1', 'prakwebdb');


//     $db1 = new PDO("pgsql:host=".HOST.";dbname=".DB1, USER, PASS);
//     $db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?> -->

<?php
$host = "localhost";
$port = "5432";
$dbname = "prakwebdb"; 
$user = "postgres";
$password = "ailsasahda13";

$koneksi = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$koneksi) {
    die("Koneksi gagal: " . pg_last_error());
}
?>

