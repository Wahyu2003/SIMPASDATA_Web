<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Halaman Cetak Nilai Junior</title>
    <link rel="stylesheet" href="../assets/css/cetak.css">
    <style>
        
    </style>
</head>
<body>
    <?php
        include "../database/koneksi.php";

        // Mendapatkan tahun sekarang
        $tahunSekarang = date("Y");

        // Membuat judul H3
        $judulH3 = "DAFTAR NILAI EKSTRAKULIKULER PASKIBRA SMA NEGERI 2 TANGGUL KELAS X TAHUN PELAJARAN $tahunSekarang-" . ($tahunSekarang + 1);
    ?>
    <div class="container">
        <div class="noPrint">
            <button onclick="window.print()">Cetak Halaman</button><br>
        </div>
        <div class="header">
            <div class="logo1">
                <img src="../assets/foto/logoSMAN2Tanggul.png" alt="">
            </div>
            <div class="judul">
                <h3>PASUKAN PENGIBAR BENDERA SEKOLAH MENENGAH ATAS NEGERI 2 TANGGUL</h3>
                <h2>PASDATA</h2>
                <p>Jl. Salak 126 Telp. (0336) 441014 Tanggul-Jember NPSN: 20523848</p>
            </div>
            <div class="logo2">
                <img src="../assets/foto/logoPasdata.png" alt="">
            </div>
        </div>
        <div class="tahunpelajaran">
            <h3><?=$judulH3?></h3>
        </div>
        <div class="table">
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
                    siswa.nisn, siswa.nama, kelas.nama
                ORDER BY
                    kelas
                ASC;
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
        </div>
    </div>  
</body>
</html>
