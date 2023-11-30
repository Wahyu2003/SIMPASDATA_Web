<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Profil</title>
    <style>
    .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 80%;
            max-width: 600px;
        }

        .profile-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .profile-header img {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 2px solid #fff;
        }

        .profile-info {
            padding: 20px;
        }

        .profile-info table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .profile-info th,
        .profile-info td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .profile-info th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php
    include "../main/menu.php"
    ?>
    <center>
    <h1>Profil Anda</h1>

    <div>
        <img src="" alt="">
    </div>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">
        <table class="table" border="1"> <!-- Menambahkan class "table" pada elemen tabel -->
            <?php

            if(isset($_SESSION['nipAdmin']) AND isset($_SESSION['roleAdmin']) == 'admin' || 'pembina'){
                $nipAdmin = $_SESSION['nipAdmin'];

                $a = mysqli_query($db, "SELECT * FROM admin WHERE nip = '$nipAdmin'");

                while($admin = mysqli_fetch_assoc($a)){
                    $nipA = $admin['nip'];
                    $fotoA = $admin['foto'];
                    $namaA = $admin['nama'];
                    $alamatA = $admin['alamat'];
                    $genderA = $admin['gender'];
                    $emailA = $admin['email'];
                    $noHpA = $admin['no_hp'];
                    $passwordA = $admin['password'];
                    $roleA = $admin['role'];
                    if (!empty($fotoA)) {
                        $fotoA = resizeImage($fotoA, 100, 100);
                        echo "<img src='data:image/*;base64," . base64_encode($fotoA) . "' alt='Gambar'>";
                    } else {
                      echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 100px; height: 100px;'>";
                  }      
                    ?>
                    <br>
                    <table class="table" border=1>
                        <tr>
                            <th>NIP</th>
                            <td><?=$nipA?></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?=$namaA?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?=$alamatA?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?=$genderA?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?=$emailA?></td>
                        </tr>
                        <tr>
                            <th>No. Hp</th>
                            <td><?=$noHpA?></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><?=$passwordA?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?=$roleA?></td>
                        </tr>
                    </table>
                <?php
            }?>
            

            <?php
            } elseif(isset($_SESSION['nisnSiswa']) AND isset($_SESSION['roleSiswa']) == 'senior'){
                $nisnSiswa = $_SESSION['nisnSiswa'];

                $s = mysqli_query($db, "SELECT siswa.nisn, kelas.nama AS kelas, siswa.nama, siswa.gender, siswa.alamat, siswa.email, siswa.no_hp, siswa.password, siswa.role, siswa.foto FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id_kelas WHERE nisn = '$nisnSiswa';");

                while($siswa = mysqli_fetch_assoc($s)){
                    $nisnS = $siswa['nisn'];
                    $fotoS = $siswa['foto'];
                    $kelasS = $siswa['kelas'];
                    $namaS = $siswa['nama'];
                    $alamatS = $siswa['alamat'];
                    $genderS = $siswa['gender'];
                    $emailS = $siswa['email'];
                    $noHpS = $siswa['no_hp'];
                    $passwordS = $siswa['password'];
                    $roleS = $siswa['role'];
                    
                    if (!empty($fotoS)) {
                        $fotoS = resizeImage($fotoS, 100, 100);
                        echo "<img src='data:image/*;base64," . base64_encode($fotoS) . "' alt='Gambar'>";
                    } else {
                      echo "<img src='../assets/foto/user-solid-240.png' alt='' style='width: 100px; height: 100px;'>";
                  }      
                    
                    ?>
                    <br>
                    <table class="table" border=1>
                        <tr>
                            <th>NISN</th>
                            <td><?=$nisnS?></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td><?=$namaS?></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td><?=$kelasS?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td><?=$alamatS?></td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td><?=$genderS?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?=$emailS?></td>
                        </tr>
                        <tr>
                            <th>No. Hp</th>
                            <td><?=$noHpS?></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td><?=$passwordS?></td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td><?=$roleS?></td>
                        </tr>
                    </table>
                <?php
            }?>
            <?php
            }else{
                echo "<script>alert('Gagal Menampilkan Profil !!');</script>";
            }

            
            ?>
        </table>
    </div>
    </center>
    
</body>
</html>
