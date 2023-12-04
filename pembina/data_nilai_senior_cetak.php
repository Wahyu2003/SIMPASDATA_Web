<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Halaman Cetak Nilai Senior</title>
    <style>
        @media print {
            
            .noPrint{
                display:none;
            }
            /* Set lebar tabel agar sesuai dengan lebar kertas A4 */
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }

            th {
                background-color: #f2f2f2;
            }

            /* Set font ukuran dan jenis untuk mencetak */
            body {
                font-size: 12pt;
                font-family: Arial, sans-serif;
            }
        }
    </style>
</head>
<body>
    <?php
        include "../database/koneksi.php";

        // Mendapatkan tahun sekarang
        $tahunSekarang = date("Y");

        // Membuat judul H3
        $judulH3 = "Data Nilai Senior Tahun Pelajaran $tahunSekarang-" . ($tahunSekarang + 1);
    ?>
    <center>
        <div class="noPrint">
            <button onclick="window.print()">Cetak Halaman</button><br>
        </div>
        
    </center>
    <center>
    <h3><?=$judulH3?></h3>
    <br>
    <table border=1 cellspacing=0 cellpadding=5>
        <tr>
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
            GROUP BY
                siswa.nisn, siswa.nama, kelas.nama
            ORDER BY
                kelas
            ASC;");

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
    </center>
</body>
</html>
