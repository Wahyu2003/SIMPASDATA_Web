<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Detail Senior</title>
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
    </style>
</head>

<body>
    <?php
    include "../main/menu.php"
    ?>
    <h1>Detail Senior</h1>

    <div>
        <img src="" alt="">
    </div>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">
        <table class="table" border="1"> <!-- Menambahkan class "table" pada elemen tabel -->
            <?php
                $nisn = $_GET['nisn'];

                $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.level FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE siswa.nisn = '$nisn'");

                while ($a = mysqli_fetch_assoc($query)) { 
                    $nisnSiswa = $a['nisn'];
                    $namaSiswa = $a['nama'];
                    $kelasSiswa = $a['kelas'];
                    $alamatSiswa = $a['alamat'];
                    $genderSiswa = $a['gender'];
                    $levelSiswa = $a['level'];

                    if($genderSiswa == 'L'){
                        $genderSiswa = "Laki - Laki";
                    }else{
                        $genderSiswa = "Perempuan";
                    }
            ?>
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
                <th><label>Hak Akses Web :</label></th>
                <td><p class="p"><?=$levelSiswa?></p></td>
            </tr>      
            <tr>
                <th></th>
                <td><button><a href="./menu_manajemen_akun_senior.php">Kembali</a></button></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>
