<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Manajemen Akun Junior</title>
</head>

<body>
    <?php
    include "../main/menu.php";
    ?>
    <center>
    <h1>Halaman Manajemen Akun Junior Milik Senior</h1>
    </center>
    <br>
    <center>
    <button type="submit" name="btnTambahSenior" class="custom"><a href="./junior_manajemen_input_akun.php">Tambah Akun</a></button>
    </center>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">
        <?php
        //query menampilkan data junior
        $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.no_hp, siswa.email FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE role = 'junior' AND status = 'aktif'");

        if (mysqli_num_rows($query) > 0) { // Periksa apakah ada data
            ?>
            <table style="margin-left:auto;margin-right:auto" border=1 cellspacing=0>
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
                            <a href="?update&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ingin menjadikan data tersebut sebagai senior?')">Jadikan Senior</a>
                            <a href="./junior_manajemen_detail_akun.php?nisn=<?= $nisnSiswa ?>" class='detail'>Detail</a>
                            <a href="?delete&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ingin menghapus data tersebut?')">Hapus</a>
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