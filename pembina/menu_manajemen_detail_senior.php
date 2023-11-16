<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Detail Senior</title>
    <style>
        .table{
            text-align:left;
        }
        .p{
            pointer-events:none;
        }
    </style>
</head>
<body>
    <?php 
    session_start();
    include "../main/menu.php" 
    ?>
    <h1>Halaman Detail Senior Milik Pembina</h1>

    <div>
        <img src="" alt="">
    </div>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">
        <table class="table-data-akun-senior" border=0 cellpadding=1 cellspacing=0>
            <?php
                $nisn = $_GET['nisn'];

                $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE siswa.nisn = '$nisn'");

                while ($a = mysqli_fetch_assoc($query)) { 
                    $nisnSiswa = $_SESSION['nisnSiswa'] = $a['nisn'];
                    $namaSiswa = $_SESSION['namaSiswa'] = $a['nama'];
                    $kelasSiswa = $_SESSION['kelasSiswa'] = $a['kelas'];
                    $alamatSiswa = $_SESSION['alamatSiswa'] = $a['alamat'];
                    $genderSiswa = $_SESSION['genderSiswa'] = $a['gender'];

                    if($genderSiswa == 'L'){
                        $genderSiswa = "Laki - Laki";
                    }else{
                        $genderSiswa = "Perempuan";
                    }
                    ?>
                <?php } ?>
            <tr>
                <th><label>NISN  :</label></th>
                <td><p class="p"><?=$nisnSiswa?></p></td>
            </tr>
            <tr>
                <th><label>Nama Lengkap  :</label></th>
                <td><p class="p"><?=$namaSiswa?></p></td>
            </tr>
            <tr>
                <th><label>Kelas  :</label></th>
                <td><p class="p"><?=$kelasSiswa?></p></td>
            </tr>
            <tr>
                <th><label>Alamat  :</label></th>
                <td><p class="p"><?=$alamatSiswa?></p></td>
            </tr>
            <tr>
                <th><label>Jenis Kelamin  :</label></th>
                <td><p class="p"><?=$genderSiswa?></p></td>
            </tr>      
            <tr>
                <th></th>
                <td><button><a href="./menu_manajemen_akun_senior.php">Kembali</a></button></td>
            </tr>      
        </table>
    </div>
</body>
</html>