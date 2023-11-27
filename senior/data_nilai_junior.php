<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Nilai Junior</title>
</head>

<body>
    <?php
    include "../main/menu.php";
    ?>
    <center>
    <h1>Halaman Nilai Junior</h1>
    </center>
    <br>
    <center>
        <button><a href="./data_nilai_junior_cetak.php">Cetak Nilai</a></button>
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
                    $nisnJunior = $a['nisn'];
                    $namaJunior = $a['nama'];
                    $kelasJunior = $a['kelas'];
                    $rataSikapJunior = $a['rata_sikap'];
                    $rataPolaPikirJunior = $a['rata_pola_pikir'];
                    $rataKeaktifanJunior = $a['rata_keaktifan'];
                    $rataPBBJunior = $a['rata_pbb'];
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
                        <td><?=$rataPBBJunior?></td>
                        <td><?=$rataKeseluruhan?></td>
                        <td><?=$rataPelanggaranJunior?></td>
                        <td><?=$nilaiAlfabetJunior?></td>
                
                    </tr>
               <?php }
            ?>
        </table>
    </center>
</body>
</html>
