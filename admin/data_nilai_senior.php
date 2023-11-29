<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Nilai SENIOR</title>
</head>

<body>
    <?php
    include "../main/menu.php";
    ?>
    <center>
    <h1>Halaman Nilai Senior</h1>
    </center>
    <br>
    <center>
        <button><a href="./data_nilai_senior_cetak.php">Cetak Nilai</a></button>
    </center>
    <center>
        <table border=1 cellspacing=0 cellpadding=5>
            <tr>
                <th>NISN</th>
                <th>Nama Lengkap</th>
                <th>Kelas</th>
                <th>Rata-Rata Nilai Sikap</th>
                <th>Rata-Rata Nilai Pola Pikir</th>
                <th>Rata-Rata Nilai Keaktifan</th>
                <th>Rata-Rata Nilai PBB</th>
                <th>Rata-Rata Nilai</th>
                <th>Rata-Rata Pelanggaran</th>
                <th>Nilai Alfabet</th>
            </tr>
            <?php
                $query = mysqli_query($db, 
                "SELECT
                    siswa.nisn,
                    siswa.nama,
                    kelas.nama AS kelas,
                    ROUND(AVG(CASE WHEN nilai.nama = 'nilai sikap' THEN detail_nilai.total_nilai END), 2) AS rata_sikap,
                    ROUND(AVG(CASE WHEN nilai.nama = 'nilai pola pikir' THEN detail_nilai.total_nilai END), 2) AS rata_pola_pikir,
                    ROUND(AVG(CASE WHEN nilai.nama = 'nilai keaktifan' THEN detail_nilai.total_nilai END), 2) AS rata_keaktifan,
                    ROUND(AVG(CASE WHEN nilai.nama = 'nilai pbb' THEN detail_nilai.total_nilai END), 2) AS rata_pbb,
                    ROUND(AVG((COALESCE(detail_nilai.total_nilai, 0) * 4) / 4), 2) AS rata_keseluruhan,
                    ROUND(AVG(entered.sanksi), 2) AS rata_pelanggaran,
                    CASE WHEN ROUND(AVG((COALESCE(detail_nilai.total_nilai, 0) * 4) / 4), 2) < 8 THEN 'B' ELSE 'A' END AS nilai_alfabet
                FROM
                    siswa
                JOIN kelas ON siswa.kelas_id = kelas.id_kelas
                JOIN entered ON siswa.nisn = entered.nisn_j
                LEFT JOIN detail_nilai ON entered.id_enter = detail_nilai.enter_id
                LEFT JOIN nilai ON detail_nilai.nilai_id = nilai.id_nilai
                GROUP BY
                    siswa.nisn, siswa.nama, kelas.nama;
                ");

                while($a = mysqli_fetch_assoc($query)){
                    $nisnsenior = $a['nisn'];
                    $namasenior = $a['nama'];
                    $kelassenior = $a['kelas'];
                    $rataSikapsenior = $a['rata_sikap'];
                    $rataPolaPikirsenior = $a['rata_pola_pikir'];
                    $rataKeaktifansenior = $a['rata_keaktifan'];
                    $rataPBBsenior = $a['rata_pbb'];
                    $rataKeseluruhan = $a['rata_keseluruhan'];
                    $rataPelanggaransenior = $a['rata_pelanggaran'];
                    $nilaiAlfabetsenior = $a['nilai_alfabet'];?>

                    <tr>
                        <td><?=$nisnsenior?></td>
                        <td><?=$namasenior?></td>
                        <td><?=$kelassenior?></td>
                        <td><?=$rataSikapsenior?></td>
                        <td><?=$rataPolaPikirsenior?></td>
                        <td><?=$rataKeaktifansenior?></td>
                        <td><?=$rataPBBsenior?></td>
                        <td><?=$rataKeseluruhan?></td>
                        <td><?=$rataPelanggaransenior?></td>
                        <td><?=$nilaiAlfabetsenior?></td>
                
                    </tr>
               <?php }
            ?>
        </table>
    </center>
</body>
</html>
