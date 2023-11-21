<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Detail Junior</title>
    <style>
        body {
            text-align: center; /* Untuk mengatur text-align menjadi center */
        }

        .table {
            text-align: left;
            margin: 0 auto; /* Untuk membuat margin tabel otomatis dan membuatnya berada di tengah */
        }

        .p {
            pointer-events: none;
        }
        img{
            width:100%;
        }
    </style>
</head>

<body>
    <?php
    include "../main/menu.php"
    ?>
    <h1>Halaman Detail Junior Milik Admin</h1>

    <div>
        <img src="" alt="">
    </div>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">
        <table class="table" border="1"> <!-- Menambahkan class "table" pada elemen tabel -->
            <?php
                $nisn = $_GET['nisn'];

                $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, siswa.foto, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.no_hp, siswa.email FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE siswa.nisn = '$nisn'");

                while ($a = mysqli_fetch_assoc($query)) { 
                    $nisnSiswa = $_SESSION['nisnSiswa'] = $a['nisn'];
                    $namaSiswa = $_SESSION['namaSiswa'] = $a['nama'];
                    $fotoSiswa = $_SESSION['fotoSiswa'] = $a['foto'];
                    $kelasSiswa = $_SESSION['kelasSiswa'] = $a['kelas'];
                    $alamatSiswa = $_SESSION['alamatSiswa'] = $a['alamat'];
                    $genderSiswa = $_SESSION['genderSiswa'] = $a['gender'];
                    $noHpSiswa = $_SESSION['noHpSiswa'] = $a['no_hp'];
                    $emailSiswa = $_SESSION['emailSiswa'] = $a['email'];

                    if($genderSiswa == 'L'){
                        $genderSiswa = "Laki - Laki";
                    }else{
                        $genderSiswa = "Perempuan";
                    }
            ?>
            <!-- Tambahkan foto -->
            <center>
                <img src="../assets/foto/<?=$fotoSiswa?>;">
            </center>
            <tr>
                <th><label>NISN :</label></th>
                <td><p class="p"><?=$nisnSiswa?></p></td>
            </tr>
            <tr>
                <th><label>Nama Lengkap :</label></th>
                <td><p class="p"><?=$namaSiswa?></p></td>
            </tr>
            <tr>
                <th><label>Kelas :</label></th>
                <td><p class="p"><?=$kelasSiswa?></p></td>
            </tr>
            <tr>
                <th><label>Alamat :</label></th>
                <td><p class="p"><?=$alamatSiswa?></p></td>
            </tr>
            <tr>
                <th><label>Jenis Kelamin :</label></th>
                <td><p class="p"><?=$genderSiswa?></p></td>
            </tr>      
            <tr>
                <th><label>Email :</label></th>
                <td><p class="p"><?=$emailSiswa?></p></td>
            </tr>      
            <tr>
                <th><label>Nomor Hp :</label></th>
                <td><p class="p"><?=$noHpSiswa?></p></td>
            </tr>      
            <tr>
                <th></th>
                <td><button><a href="./junior_manajemen_akun.php">Kembali</a></button></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
