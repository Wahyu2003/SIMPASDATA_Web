<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Tambah Akun Senior</title>
    <style>
        body {
            text-align: center;
        }

        .card-body-table-menu-manajemen-akun-senior {
            margin: 20px auto; /* Menambahkan margin dan mengatur otomatis ke tengah */
        }

        .table-data-akun-senior {
            width: 80%; /* Menentukan lebar tabel */
            margin: 0 auto; /* Mengatur otomatis ke tengah */
            border-collapse: collapse;
        }

        .table-data-akun-senior th,
        .table-data-akun-senior td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table-data-akun-senior th {
            background-color: #f2f2f2;
        }

        .custom {
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            display: inline-block;
            text-decoration: none; /* Menghilangkan garis bawah default pada tautan */
            background-color: #2196F3; /* Warna biru */
        }
    </style>
</head>

<body>
    <?php 
    include "../main/menu.php" 
    ?>
    <h1>Halaman Tambah Akun Senior Milik Admin</h1>

    <div>
        <button type="submit" name="btnTambahSenior" class="custom"><a href="./menu_manajemen_akun_senior.php">Kembali</a></button>
    </div>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">
        <table class="table-data-akun-senior" border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>No. Hp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.email, siswa.no_hp FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE role = 'junior' AND status = 'aktif'");

                while ($a = mysqli_fetch_assoc($query)) { 
                    $nisnSiswa = $a['nisn'];
                    $namaSiswa = $a['nama'];
                    $kelasSiswa = $a['kelas'];
                    $alamatSiswa = $a['alamat'];
                    $genderSiswa = $a['gender'];
                    $emailSiswa = $a['email'];
                    $noHpSiswa = $a['no_hp'];

                    if($genderSiswa == 'L'){
                        $genderSiswa = "Laki - Laki";
                    }else{
                        $genderSiswa = "Perempuan";
                    }
                    ?>
                    <tr>
                        <td><?= $nisnSiswa ?></td>
                        <td><?= $namaSiswa ?></td>
                        <td><?= $kelasSiswa ?></td>
                        <td><?= $alamatSiswa ?></td>    
                        <td><?= $genderSiswa ?></td>
                        <td><?= $emailSiswa ?></td>
                        <td><?= $noHpSiswa ?></td>
                        <td>
                            <a href="?update&nisn=<?= $nisnSiswa ?>" class="custom" onclick="return confirm('Apakah kamu yakin ?')">Jadikan Senior</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
if (isset($_GET['update'])) {
    $nisn = $_GET['nisn'];

    $update = mysqli_query($db, "UPDATE siswa SET role = 'senior', status='aktif', level='denied' WHERE siswa.nisn = '$nisn'");
    if ($update) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./menu_manajemen_akun_senior.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Diupdate!!');</script>";
    }
}
?>
