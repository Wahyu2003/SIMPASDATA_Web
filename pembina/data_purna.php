

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Manajemen Akun purna</title>
    <link rel="stylesheet" href="../assets/css/manajemen.css">
</head>
<?php
include "../main/menu.php";

// Mengambil kriteria pencarian dari sisi klien (JavaScript)
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

// Query SQL dengan kriteria pencarian
$query = mysqli_query($db, "SELECT siswa.nisn, siswa.nama, kelas.nama AS kelas, siswa.alamat, siswa.gender, siswa.no_hp, siswa.email 
                            FROM siswa 
                            JOIN kelas ON siswa.kelas_id = kelas.id_kelas 
                            WHERE role = 'purna' AND status = 'aktif' 
                            AND (siswa.nisn LIKE '%$searchTerm%' OR siswa.nama LIKE '%$searchTerm%' OR siswa.alamat LIKE '%$searchTerm%' OR siswa.gender LIKE '%$searchTerm%' OR siswa.no_hp LIKE '%$searchTerm%' OR siswa.email LIKE '%$searchTerm%')");

if (!$query) {
    die('Error executing query: ' . mysqli_error($db));
}
?>
<body>
<div class="container">
        <?php if (isset($_GET['action']) && $_GET['action'] == 'klik') {?>
        <div class="footer">
            <h1 class="namaform">Data purna</h1>
        <?php } else { ?>
        <h1 class="namaform">Data purna</h1>
        <div class="footerakun ">
            <div class="akun">
                <a class="tambahakun" href="./purna_tambah.php">Tambah purna</a>
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
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Hp</th>
                        <th>Email</th>
                    </tr>

                    <?php while ($a = mysqli_fetch_assoc($query)) {
                        $namaSiswa = $a['nama'];
                        $alamatSiswa = $a['alamat'];
                        $genderSiswa = ($a['gender'] == 'L') ? "Laki - Laki" : "Perempuan";
                        $noHpSiswa = $a['no_hp'];
                        $emailSiswa = $a['email'];
                    ?>
                        <tr>
                            <td><?= $namaSiswa ?></td>
                            <td><?= $alamatSiswa ?></td>
                            <td><?= $genderSiswa ?></td>
                            <td><?= $noHpSiswa ?></td>
                            <td><?= $emailSiswa ?></td>
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
