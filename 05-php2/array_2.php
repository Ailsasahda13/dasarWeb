<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
   <?php
        // $Dosen = [
        //     'nama' => 'Elok Nur Hamdana',
        //     'domisili' => 'Malang',
        //     'jenis_kelamin' => 'Perempuan']; 

        // echo "Nama            : {$Dosen ['nama']} <br>";
        // echo "Domisili        : {$Dosen ['domisili']} <br>";
        // echo "Jenis Kelamin   : {$Dosen ['jenis_kelamin']} <br>";

    ?>
    
</body>
</html> -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Data Dosen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;     
            width: 350px;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #666;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #dd6decff;
            color: white;
        }
        tr:nth-child(even){
            background-color: #f2f2f2;      
        }
    </style>
</head>
<body>
    <?php
        $Dosen = [
            'Nama' => 'Elok Nur Hamdana',
            'Domisili' => 'Malang',
            'Jenis Kelamin' => 'Perempuan'
        ];
    ?>

    <h2>Data Dosen</h2>
    <table>
        <tr>
            <th>Data</th>
            <th>Keterangan</th>
        </tr>
        <?php
            foreach ($Dosen as $key => $value) {
                echo "<tr>";
                echo "<td>$key</td>";
                echo "<td>$value</td>";
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>
