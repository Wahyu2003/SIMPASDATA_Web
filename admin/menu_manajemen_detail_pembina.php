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
    <h1>Detail Pembina</h1>

    <div>
    <center>
            <?php 
            if (!empty($fotoAdmin)) {
                $fotoAdmin = resizeImage($fotoAdmin, 100, 100);
                echo "<img src='data:image/*;base64," . base64_encode($fotoAdmin) . "' alt='Gambar' style='width: 15%; height: auto;'>";
            } else {
              echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 15%; height: auto;'>";
          }
            ?>
            </center>
    </div>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">
        <table class="table" border="1"> <!-- Menambahkan class "table" pada elemen tabel -->
            <?php
                $nip = $_GET['nip'];

                $query = mysqli_query($db, "SELECT nip, nama, email, no_hp, alamat, gender, foto FROM admin WHERE nip = '$nip'");

                while ($a = mysqli_fetch_assoc($query)) { 
                    $nipAdmin  = $a['nip'];
                    $namaAdmin  = $a['nama'];
                    $fotoAdmin  = $a['foto'];
                    $alamatAdmin = $a['alamat'];
                    $genderAdmin = ($a['gender'] == 'L') ? "Laki-laki" : "Perempuan";
                    $noHpAdmin = $a['no_hp'];
                    $emailAdmin = $a['email'];
            ?>
            <!-- Tambahkan foto -->
            
            <tr>
                <th><label>NIP :</label></th>
                <td><p class="p"><?=$nipAdmin?></p></td>
            </tr>
            <tr>
                <th><label>Nama Lengkap :</label></th>
                <td><p class="p"><?=$namaAdmin?></p></td>
            </tr>
            <tr>
                <th><label>Alamat :</label></th>
                <td><p class="p"><?=$alamatAdmin?></p></td>
            </tr>
            <tr>
                <th><label>Jenis Kelamin :</label></th>
                <td><p class="p"><?=$genderAdmin?></p></td>
            </tr>      
            <tr>
                <th><label>Email :</label></th>
                <td><p class="p"><?=$emailAdmin?></p></td>
            </tr>      
            <tr>
                <th><label>Nomor Hp :</label></th>
                <td><p class="p"><?=$noHpAdmin?></p></td>
            </tr>      
            <tr>
                <th></th>
                <td><button><a href="./menu_manajemen_akun_pembina.php">Kembali</a></button></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
