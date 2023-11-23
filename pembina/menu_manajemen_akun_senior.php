<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Manajemen Akun Senior</title>
</head>

<body>
    <?php
    include "../main/menu.php"
    ?>
    <center>
    <h1>Halaman Manajemen Akun Senior Milik Pembina</h1>
    </center>
    <br>
    <center>
        <button type="submit" name="btnTambahSenior" class="custom"><a href="./menu_manajemen_tambah_senior.php">Tambah Akun</a></button>
    </center>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">

        <?php
        $query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.no_hp, siswa.email, siswa.level FROM siswa join kelas on siswa.kelas_id = kelas.id_kelas WHERE role = 'senior' AND status = 'aktif'");

        if (mysqli_num_rows($query) > 0) { // Periksa apakah ada data
            ?>
            <table style="margin-left:auto;margin-right:auto" border="1">
                <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>No. Hp</th>
                    <th>Admin Web</th>
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
                    $levelSiswa = $a['level'];

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
                        <td><?= $emailSiswa ?></td>
                        <td><?= $noHpSiswa ?></td>
                        <td><?= $levelSiswa ?></td>
                        <td>
                            <a href="?update1&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ingin menjadikan data tersebut menjadi admin?')">Jadikan Admin Web</a>
                            <a href="?update2&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ingin menjadikan data tersebut menjadi purna?')">Jadikan Purna</a>
                            <a href="./menu_manajemen_detail_senior.php?nisn=<?= $nisnSiswa ?>" class='detail'>Detail</a>
                            <a href="?delete&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ?')">Hapus</a>
                        </td>
                    </tr>

                <?php } ?>
            </table>
        <?php } else {
            echo "<p>Tidak ada data yang ditemukan</p>";
        } ?>
    </div>
</body>

</html>

<?php
if (isset($_GET['delete'])) {
    $nisn = $_GET['nisn'];
    $nip_p = $_SESSION['nipAdmin'];
    $tanggal = date("d-m-Y");

    $delete = mysqli_query($db, "UPDATE siswa SET status = 'tidak' WHERE siswa.nisn = '$nisn'");
    $insert = mysqli_query($db, "INSERT INTO deleted_data ('id_deleted','nip_a','nip_p','nisn_s','nisn_j','waktu_penghapusan') VALUES ('$nip_p',null,'$nip_p','$nisn',null,'$tanggal')");

    if ($delete AND $insert) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./menu_manajemen_akun_senior.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Dihapus !!');</script>";
    }
}
?>

<?php
if (isset($_GET['update1'])) {
    $nisn = $_GET['nisn'];

    $delete = mysqli_query($db, "UPDATE siswa SET level = 'allow' WHERE siswa.nisn = '$nisn'");
    if ($delete) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./menu_manajemen_akun_senior.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Diupdate !!');</script>";
    }
}
?>

<?php
if (isset($_GET['update2'])) {
    $nisn = $_GET['nisn'];

    $delete = mysqli_query($db, "UPDATE siswa SET role = 'purna', level = 'denied' WHERE siswa.nisn = '$nisn'");
    if ($delete) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./menu_manajemen_akun_senior.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Diupdate !!');</script>";
    }
}
?>
