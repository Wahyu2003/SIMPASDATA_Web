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
    <h1>Halaman Manajemen Akun Senior Milik Admin</h1>
    </center>
    <br>
    <center>
        <button type="submit" name="btnTambahPembina" class="custom"><a href="./menu_manajemen_tambah_pembina.php">Tambah Akun</a></button>
    </center>
    <br>
    <div class="card-body-table-menu-manajemen-akun-senior">

        <?php
        $query = mysqli_query($db, "SELECT * FROM admin WHERE role = 'pembina'");

        if (mysqli_num_rows($query) > 0) { // Periksa apakah ada data
            ?>
            <table style="margin-left:auto;margin-right:auto" border="1">
                <tr>
                    <th>NIP</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>No. Hp</th>
                    <th>Admin Web</th>
                    <th>Opsi</th>
                </tr>

                <?php
                while ($a = mysqli_fetch_assoc($query)) {
                    $nipPembina  = $a['nip'];
                    $namaPembina  = $a['nama'];
                    $alamatPembina  = $a['alamat'];
                    $genderPembina  = $a['gender'];
                    $noHpPembina =  $a['no_hp'];
                    $emailPembina =  $a['email'];
                    $levelPembina =  $a['level'];

                    if ($genderPembina == 'L') {
                        $genderPembina = "Laki - Laki";
                    } else {
                        $genderPembina = "Perempuan";
                    }
                    ?>

                    <tr>
                        <td><?= $nipPembina ?></td>
                        <td><?= $namaPembina ?></td>
                        <td><?= $genderPembina ?></td>
                        <td><?= $alamatPembina ?></td>
                        <td><?= $emailPembina ?></td>
                        <td><?= $noHpPembina ?></td>
                        <td><?= $levelPembina ?></td>
                        <td>
                            <a href="?update1&nip=<?= $nipPembina ?>" onclick="return confirm('Apakah kamu yakin ingin menjadikan data tersebut menjadi admin?')">Jadikan Admin Web</a>
                            <a href="./menu_manajemen_detail_senior.php?nip=<?= $nipPembina ?>" class='detail'>Detail</a>
                            <a href="?delete&nip=<?= $nipPembina ?>" onclick="return confirm('Apakah kamu yakin ?')">Hapus</a>
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

    $nip = $_GET['nip'];

    $delete = mysqli_query($db, "UPDATE admin SET status = 'tidak' WHERE nip = '$nip'");

    if ($delete) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./menu_manajemen_akun_pembina.php">';
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
