<?php
include "../main/menu.php";

// Mengambil kriteria pencarian dari sisi klien (JavaScript)
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

// Query SQL dengan kriteria pencarian
$query = mysqli_query($db, "SELECT * FROM admin WHERE role = 'pembina' AND (nip LIKE '%$searchTerm%' OR nama LIKE '%$searchTerm%')");

if (!$query) {
    die('Error executing query: ' . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Manajemen Akun Pembina</title>
    <link rel="stylesheet" href="../assets/css/manajemen.css">
</head>

<body>
    <div class="container">
        <h1 class="namaform">Data Terhapus</h1>
    <div class="footerakun">
        <div class="akun">
            <a class="hapusemua" href="?delete&status=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ?')">Hapus Semua</a>
        </div>
        <div class="search">
            <input type="text" placeholder="Masukan NIS atau nama">
            <img id="searchButton" src="../assets/foto/icons8-search-50.png" alt="">
        </div>
    </div>
    <div class="table">
        <?php
        if (mysqli_num_rows($query) > 0) { // Periksa apakah ada data
            ?>
            <table>
                <tr class="table-header">
                    <th>NIP</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>No. Hp</th>
                    <th>Admin Web</th>
                </tr>

                <?php
                while ($a = mysqli_fetch_assoc($query)) {
                    $nipPembina  = $a['nip'];
                    $namaPembina  = $a['nama'];
                    $alamatPembina  = $a['alamat'];
                    $genderPembina  = $a['gender'];
                    $noHpPembina =  $a['no_hp'];
                    $emailPembina =  $a['email'];

                    if ($genderPembina == 'L') {
                        $genderPembina = "Laki - Laki";
                    } else {
                        $genderPembina = "Perempuan";
                    }
                    $status = $a['status'];
                    ?>

                    <tr>
                        <td><?= $nipPembina ?></td>
                        <td><?= $namaPembina ?></td>
                        <td><?= $genderPembina ?></td>
                        <td><?= $alamatPembina ?></td>
                        <td><?= $emailPembina ?></td>
                        <td><?= $noHpPembina ?></td>
                        <td><?= $status ?></td>
                    </tr>

                <?php } ?>
            </table>
        <?php } else {
            echo "<p>Tidak ada data yang ditemukan</p>";
        } ?>
    </div>
    </div>
    <script src="../assets/js/search.js"></script>
</body>
</html>

<?php
// if (isset($_GET['delete'])) {
//     $nisn = $_GET['nisn'];
//     $nip_p = $_SESSION['nipAdmin'];
//     $tanggal = date("d-m-Y");

//     $delete = mysqli_query($db, "UPDATE siswa SET status = 'tidak' WHERE siswa.nisn = '$nisn'");
//     $insert = mysqli_query($db, "INSERT INTO deleted_data ('id_deleted','nip_a','nip_p','nisn_s','nisn_j','waktu_penghapusan') VALUES ('$nip_p',null,'$nip_p','$nisn',null,'$tanggal')");

//     if ($delete AND $insert) {
//         echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./menu_manajemen_akun_senior.php">';
//         exit;
//     } else {
//         echo "<script>alert('Data Gagal Dihapus !!');</script>";
//     }
// }
?>