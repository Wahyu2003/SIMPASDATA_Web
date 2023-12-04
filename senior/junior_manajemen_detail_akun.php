<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Detail Junior</title>
    <style>
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: var(--red);
            color: #fff;
            padding: 15px;
            text-align: center;
        }

        h1 {
            color:black;
            margin-bottom: 20px;
        }

        .profile-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        img {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        p {
            margin: 0;
        }

        button {
            background-color: #58AFEE;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: block;
            margin: 20px auto;
        }

        button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
<?php 
    include "../main/menu.php"
    ?>
    <header>
    
        <h1>Detail Junior</h1>
    </header>

   

    <div class="profile-container">
        <?php
        $nisn = $_GET['nisn'];
        $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, siswa.foto, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.no_hp, siswa.email FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE siswa.nisn = '$nisn'");
        
        while ($a = mysqli_fetch_assoc($query)) { 
            $nisnSiswa = $a['nisn'];
            $namaSiswa = $a['nama'];
            $fotoSiswa = $a['foto'];
            $kelasSiswa = $a['kelas'];
            $alamatSiswa = $a['alamat'];
            $genderSiswa = ($a['gender'] == 'L') ? "Laki - Laki" : "Perempuan";
            $noHpSiswa = $a['no_hp'];
            $emailSiswa = $a['email'];
        ?>
        <?php 
            if (!empty($fotoSiswa)) {
                $fotoSiswa = resizeImage($fotoSiswa, 100, 100);
                echo "<img src='data:image/*;base64," . base64_encode($fotoSiswa) . "' alt='Gambar' style='width: 25%; height: auto;'>";
            } else {
              echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 25%; height: auto;'>";
          }
            ?>
        
        <table>
            <tr>
                <th>NISN:</th>
                <td><?=$nisnSiswa?></td>
            </tr>
            <tr>
                <th>Nama Lengkap:</th>
                <td><?=$namaSiswa?></td>
            </tr>
            <tr>
                <th>Kelas:</th>
                <td><?=$kelasSiswa?></td>
            </tr>
            <tr>
                <th>Alamat:</th>
                <td><?=$alamatSiswa?></td>
            </tr>
            <tr>
                <th>Jenis Kelamin:</th>
                <td><?=$genderSiswa?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?=$emailSiswa?></td>
            </tr>
            <tr>
                <th>Nomor Hp:</th>
                <td><?=$noHpSiswa?></td>
            </tr>
            
              
           
        </table>
        <form  action="./junior_manajemen_akun.php">
         <button>Kembali</button>
        </form>
        
        <?php } ?>
    </div>
</body>
</html>
