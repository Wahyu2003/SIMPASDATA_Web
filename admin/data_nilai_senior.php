

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Nilai Senior</title>
    <link rel="stylesheet" href="../assets/css/manajemen.css">
</head>
<?php
include "../main/menu.php";

// Mengambil kriteria pencarian dari sisi klien (JavaScript)
$searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';

$query = mysqli_query($db, 
"SELECT
    siswa.nisn,
    siswa.nama,
    kelas.nama AS kelas,
    ROUND(AVG(CASE WHEN nilai.nama = 'nilai sikap' THEN detail_nilai.total_nilai END), 2) AS rata_sikap,
    ROUND(AVG(CASE WHEN nilai.nama = 'nilai pola pikir' THEN detail_nilai.total_nilai END), 2) AS rata_pola_pikir,
    ROUND(AVG(CASE WHEN nilai.nama = 'nilai keaktifan' THEN detail_nilai.total_nilai END), 2) AS rata_keaktifan,
    ROUND(AVG((COALESCE(detail_nilai.total_nilai, 0) * 3) / 3), 2) AS rata_keseluruhan,
    ROUND(AVG(entered.sanksi), 2) AS rata_pelanggaran,
    CASE WHEN ROUND(AVG((COALESCE(detail_nilai.total_nilai, 0) * 3) / 3), 2) < 8 THEN 'B' ELSE 'A' END AS nilai_alfabet
FROM
    siswa
JOIN kelas ON siswa.kelas_id = kelas.id_kelas
JOIN entered ON siswa.nisn = entered.nisn_s
LEFT JOIN detail_nilai ON entered.id_enter = detail_nilai.enter_id
LEFT JOIN nilai ON detail_nilai.nilai_id = nilai.id_nilai
WHERE
    siswa.nisn LIKE '%$searchTerm%' OR siswa.nama LIKE '%$searchTerm%'
GROUP BY
    siswa.nisn, siswa.nama, kelas.nama;
");


if (!$query) {
    die('Error executing query: ' . mysqli_error($db));
}
?>
<body>
<div class="container">
    <h1 class="namaform">Data Nilai Senior</h1>
    <div class="footerakun ">
        <div class="akun">
            <a class="cetaknilai" href="./data_nilai_senior_cetak.php">Cetak Nilai</a>
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
                        <th>Rata-Rata Nilai Sikap</th>
                        <th>Rata-Rata Nilai Pola Pikir</th>
                        <th>Rata-Rata Nilai Keaktifan</th>
                        <th>Rata-Rata Nilai</th>
                        <th>Rata-Rata Pelanggaran</th>
                        <th>Nilai Alfabet</th>
                    </tr>

                    <?php
                    while($a = mysqli_fetch_assoc($query)){
                        $nisnJunior = $a['nisn'];
                        $namaJunior = $a['nama'];
                        $kelasJunior = $a['kelas'];
                        $rataSikapJunior = $a['rata_sikap'];
                        $rataPolaPikirJunior = $a['rata_pola_pikir'];
                        $rataKeaktifanJunior = $a['rata_keaktifan'];
                        $rataKeseluruhan = $a['rata_keseluruhan'];
                        $rataPelanggaranJunior = $a['rata_pelanggaran'];
                        $nilaiAlfabetJunior = $a['nilai_alfabet'];?>
    
                        <tr>
                            <td><?=$nisnJunior?></td>
                            <td><?=$namaJunior?></td>
                            <td><?=$kelasJunior?></td>
                            <td><?=$rataSikapJunior?></td>
                            <td><?=$rataPolaPikirJunior?></td>
                            <td><?=$rataKeaktifanJunior?></td>
                            <td><?=$rataKeseluruhan?></td>
                            <td><?=$rataPelanggaranJunior?></td>
                            <td><?=$nilaiAlfabetJunior?></td>
                    
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