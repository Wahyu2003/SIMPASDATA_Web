<?php
include "../main/menu.php";

// Mengambil kriteria pencarian dari sisi klien (JavaScript)
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

$query = mysqli_query($db, 
"SELECT
    siswa.nisn,
    siswa.nama,
    kelas.nama AS kelas,
    SUM(CASE WHEN nilai.nama = 'nilai sikap' THEN detail_nilai.total_nilai ELSE 0 END) AS total_nilai_sikap,
    SUM(CASE WHEN nilai.nama = 'nilai pola pikir' THEN detail_nilai.total_nilai ELSE 0 END) AS total_nilai_pola_pikir,
    SUM(CASE WHEN nilai.nama = 'nilai keaktifan' THEN detail_nilai.total_nilai ELSE 0 END) AS total_nilai_keaktifan,
    SUM(CASE WHEN nilai.nama = 'nilai pbb' THEN detail_nilai.total_nilai ELSE 0 END) AS total_nilai_pbb
FROM
    siswa
JOIN kelas ON siswa.kelas_id = kelas.id_kelas
JOIN entered ON siswa.nisn = entered.nisn_j
JOIN detail_nilai ON entered.id_enter = detail_nilai.enter_id
JOIN nilai ON detail_nilai.nilai_id = nilai.id_nilai
WHERE
    siswa.nisn LIKE '%$searchTerm%' OR siswa.nama LIKE '%$searchTerm%'
GROUP BY
    siswa.nisn, siswa.nama, kelas.nama;
");


if (!$query) {
    die('Error executing query: ' . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Input Nilai Junior</title>
    <link rel="stylesheet" href="../assets/css/manajemen.css">
</head>

<body>
<div class="container">
    <h1 class="namaform">Input Nilai Junior</h1>
    <div class="footerakun ">
        <div class="akun">
            <a class="tambahakun" href="./nilai_junior_input.php?action=add">Tambah Nilai</a>
        </div>
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
                        <th>Nilai Sikap</th>
                        <th>Nilai Pola Pikir</th>
                        <th>Nilai Keaktifan</th>
                        <th>Nilai PBB</th>
                    </tr>

                    <?php
                    while($a = mysqli_fetch_assoc($query)){
                        $nisnJunior = $a['nisn'];
                        $namaJunior = $a['nama'];
                        $kelasJunior = $a['kelas'];
                        $nilaiSikapJunior = $a['total_nilai_sikap'];
                        $nilaiPolaPikirJunior = $a['total_nilai_pola_pikir'];
                        $nilaiKeaktifanJunior = $a['total_nilai_keaktifan'];
                        $nilaiPBBJunior = $a['total_nilai_pbb'];?>
    
                    <tr>
                        <td><?=$nisnJunior?></td>
                        <td><?=$namaJunior?></td>
                        <td><?=$kelasJunior?></td>
                        <td><?=$nilaiSikapJunior?></td>
                        <td><?=$nilaiPolaPikirJunior?></td>
                        <td><?=$nilaiKeaktifanJunior?></td>
                        <td><?=$nilaiPBBJunior?></td>
                    
                    </tr>
                <?php }
                ?>
                </table>
            <?php } else {
                echo "<center><p>Tidak ada data yang ditemukan</p></center>";
            } ?>
        </div>
    </div>
    <script src="../assets/js/search.js"></script>
</body>

</html>