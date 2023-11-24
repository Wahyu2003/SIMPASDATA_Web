<?php
include "../main/menu.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Manajemen Akun Junior</title>
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Manajemen Akun Junior</title>
    <style>
   
    table {
        width: 80%;
        border-collapse: collapse;
        margin: auto;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
        color: white;
    }

    th {
        background-color: #FF0000; /* Warna merah untuk header */
    }

    .card-body-table-menu-manajemen-akun-senior {
        margin-top: 20px;
        text-align: center;
    }
    table, th, td {
            border: 1px solid black;
            color: black; 
        }

    .jadikansenior,
    .detail,
    .hapus {
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 5px;
        display: inline-block;
        width: 100px;
    }

    .jadikansenior {
        background-color: #0a0a23; /* Warna biru tua */
    }

    .detail {
        background-color: #2196F3; /* Warna biru */
    }

    .hapus {
        background-color: #FF0000; /* Warna merah */
    }
</style>


</head>



</html>


</head>

<body>
    <center>
        <h1>Halaman Manajemen Akun Junior Milik Senior</h1>
    </center>
    <br>
    <center>
        <style>
            .custom {
                background-color: var(--red);
                color: #fff;
                padding: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                display: inline-block;
            }
        </style>
        <form action="./junior_manajemen_input_akun.php">
            <button type="submit" name="btnTambahSenior" class="custom">Tambah Akun</button>
        </form>
    </center>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">
        <?php
        $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.no_hp, siswa.email FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE role = 'junior' AND status = 'aktif'");

        if (!$query) {
            die('Error executing query: ' . mysqli_error($db));
        }

        if (mysqli_num_rows($query) > 0) {
        ?>
            <table>
                <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>No. Hp</th>
                    <th>Email</th>
                    <th>Opsi</th>
                </tr>

                <?php
                while ($a = mysqli_fetch_assoc($query)) {
                    $nisnSiswa = $a['nisn'];
                    $namaSiswa = $a['nama'];
                    $kelasSiswa = $a['kelas'];
                    $alamatSiswa = $a['alamat'];
                    $genderSiswa = $a['gender'];
                    $noHpSiswa = $a['no_hp'];
                    $emailSiswa = $a['email'];

                    if ($genderSiswa == 'L') {
                        $genderSiswa = "Laki - Laki";
                    } else {
                        $genderSiswa = "Perempuan";
                    }
                ?>

                    <tr>
                        <td><?= $nisnSiswa ?></td>
                        <td><?= $namaSiswa ?></td>
                        <td><?= $kelasSiswa ?></td>
                        <td><?= $alamatSiswa ?></td>
                        <td><?= $genderSiswa ?></td>
                        <td><?= $noHpSiswa ?></td>
                        <td><?= $emailSiswa ?></td>
                        <td>
                            <form method="POST" action="?update&nisn=<?= $nisnSiswa ?>" onsubmit="return confirm('Apakah kamu yakin ingin menjadikan data tersebut sebagai senior?')">
                                <button type="submit" class="jadikansenior">Jadikan Senior</button>
                            </form>
                            <form method="POST" action="./junior_manajemen_detail_akun.php?nisn=<?= $nisnSiswa ?>">
                                <button type="submit" class="detail">Detail</button>
                            </form>
                            <form method="POST" action="?delete&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ingin menghapus data tersebut?')">
                                <button type="submit" class="hapus">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else {
            echo "<center><p>Tidak ada data yang ditemukan</p></center>";
        } ?>
    </div>
</body>

</html>

<?php
if (isset($_GET['delete'])) {
    $nisn = $_GET['nisn'];

    $delete = mysqli_query($db, "UPDATE siswa SET status = 'tidak' WHERE siswa.nisn = '$nisn'");

    if ($delete) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./junior_manajemen_akun.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Dihapus !!');</script>";
    }
}
?>

<?php
if (isset($_GET['update'])) {
    $nisn = $_GET['nisn'];

    $update = mysqli_query($db, "UPDATE siswa SET role = 'senior', status='aktif', level='denied' WHERE siswa.nisn = '$nisn'");
    if ($update) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./junior_manajemen_akun.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Diupdate!!');</script>";
    }
}
?>
