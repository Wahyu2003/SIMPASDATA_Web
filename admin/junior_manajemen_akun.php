<?php
include "../main/menu.php";

// Mengambil kriteria pencarian dari sisi klien (JavaScript)
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

// Query SQL dengan kriteria pencarian
$query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.no_hp, siswa.email 
                            FROM siswa 
                            JOIN kelas ON siswa.kelas_id = kelas.id_kelas 
                            WHERE role = 'junior' AND status = 'aktif' 
                            AND (siswa.nisn LIKE '%$searchTerm%' OR siswa.nama LIKE '%$searchTerm%' OR siswa.alamat LIKE '%$searchTerm%' OR siswa.gender LIKE '%$searchTerm%' OR siswa.no_hp LIKE '%$searchTerm%' OR siswa.email LIKE '%$searchTerm%')");

if (!$query) {
    die('Error executing query: ' . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Manajemen Akun Junior</title>
    <link rel="stylesheet" href="../assets/css/manajemen.css">
</head>

<body>
<div class="container">
        <?php if (isset($_GET['action']) && $_GET['action'] == 'klik') {?>
        <div class="footer">
            <h1 class="namaform">Data Junior</h1>
        <?php } else { ?>
        <h1 class="namaform">Data Junior</h1>
        <div class="footerakun ">
            <div class="akun">
                <a class="tambahakun" href="./junior_manajemen_input_akun.php">Tambah Junior</a>
            </div>
        <?php } ?>
        <div class="search">
            <input type="text" id="searchInput" placeholder="Masukkan data yang ingin anda cari">
            <img id="searchButton" src="../assets/foto/icons8-search-50.png" alt="">
        </div>
    </div>
        <div class="table">
            <?php if (mysqli_num_rows($query) > 0) { ?>
                <table>
                    <tr class="table-header">
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Hp</th>
                        <th>Email</th>
                        <?php if (isset($_GET['action']) && $_GET['action'] == 'klik') {?>
                            <th class="sembunyi">opsi</th>
                        <?php } else { ?>
                            <th>opsi</th>
                        <?php
                        }
                        ?>
                    </tr>

                    <?php while ($a = mysqli_fetch_assoc($query)) {
                        $nisnSiswa = $a['nisn'];
                        $namaSiswa = $a['nama'];
                        $kelasSiswa = $a['kelas'];
                        $alamatSiswa = $a['alamat'];
                        $genderSiswa = ($a['gender'] == 'L') ? "Laki - Laki" : "Perempuan";
                        $noHpSiswa = $a['no_hp'];
                        $emailSiswa = $a['email'];
                    ?>
                        <tr>
                            <td><?= $nisnSiswa ?></td>
                            <td><?= $namaSiswa ?></td>
                            <td><?= $kelasSiswa ?></td>
                            <td><?= $alamatSiswa ?></td>
                            <td><?= $genderSiswa ?></td>
                            <td><?= $noHpSiswa ?></td>
                            <td><?= $emailSiswa ?></td>
                            <?php if (isset($_GET['action']) && $_GET['action'] == 'klik') {?>
                                <td class="sembunyi">
                                    <div class="opsi">
                                    <a href="?update&nisn=<?= $nisnSiswa ?>" class="jadikansenior" onclick="return confirm('Apakah kamu yakin ingin menjadikan data tersebut sebagai senior?')">Jadikan Senior</a>
                                    <a href="./menu_manajemen_detail_senior.php?nisn=<?= $nisnSiswa ?>">Detail</a>
                                    <a href="?delete&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ingin menhapus data tersebut?')">Hapus</a>
                                    </div>
                                </td>
                            <?php } else { ?>
                                <td>
                                    <div class="opsi">
                                    <a href="?update&nisn=<?= $nisnSiswa ?>"  class="jadikansenior" onclick="return confirm('Apakah kamu yakin ingin menjadikan data tersebut sebagai senior?')">Jadikan Senior</a>
                                    <a href="./menu_manajemen_detail_senior.php?nisn=<?= $nisnSiswa ?>"class="detail">Detail</a>
                                    <a href="?delete&nisn=<?= $nisnSiswa ?>" class="hapus"onclick="return confirm('Apakah kamu yakin ingin menhapus data tersebut?')">Hapus</a>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </table>
            <?php } else {
                echo "<center><p>Tidak ada data yang ditemukan</p></center>";
            } ?>
        </div>
    </div>
 
    <script src="../assets/js/search.js"></script>
</body>

</html>

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