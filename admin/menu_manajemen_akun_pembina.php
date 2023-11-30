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
    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
</head>

<body>
    <div class="container">
        <?php if (isset($_GET['action']) && $_GET['action'] == 'klik') {?>
        <div class="footer">
            <h1 class="namaform">Data Pembina</h1>
            <?php } else { ?>
            <h1 class="namaform">Data Pembina</h1>
                 <div class="footerakun ">
                    <div class="akun">
                    <a class="tambahakun" href="./menu_manajemen_tambah_pembina.php">Tambah Pembina</a>
                 </div>
                     <?php } ?>
                    <div class="search">
                        <input type="text" id="searchInput" placeholder="Masukkan data yang ingin anda cari">
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
                    <th>Status</th>
                    <?php if (isset($_GET['action']) && $_GET['action'] == 'klik') {?>
                        <th class="sembunyi">opsi</th>
                    <?php } else { ?>
                        <th>opsi</th>
                    <?php
                    }
                    ?>
                    
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

                            <td>
                                <div class="opsi">
                                <a href="?update1&nip=<?= $nipPembina ?>"class="jadikanadmin" onclick="return confirm('Apakah kamu yakin ingin menjadikan data tersebut menjadi admin?')">Jadikan Admin Web</a>
                                        <a href="?delete&nip=<?= $nipPembina ?>"class="hapus" onclick="return confirm('Apakah kamu yakin ingin menonaktifkan data tersebut ?')">Nonaktifkan</a>
                                       
                                        
                                         
                                </div>
                            </td>
                         
                     

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
<script>
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
    $nipPembina = $_GET['nip'];

    $delete = mysqli_query($db, "UPDATE admin SET level = 'allow' WHERE admin.nip = '$nipPembina'");
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
</script>