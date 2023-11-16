<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Nilai Senior </title>
</head>
<body>
    <?php 
    session_start();
    include "../main/menu.php" 
    ?>
    <h1>Halaman Nilai Senior Milik Pembina</h1>

    <div>
        <button><a href="./input_nilai_senior.php">Input Nilai</a></button>
    </div>

    <div class="card-body-table-menu-manajemen-akun-senior">
        <table class="table-data-akun-senior" border=1 cellpadding=5 cellspacing=0>
            <thead>
                <tr>
                    <th>NISN</th>
                    <th>Nama Lengkap</th>
                    <th>Kelas</th>
                    <th>Rata-Rata Nilai Sikap</th>
                    <th>Rata-Rata Nilai Pola Pikir</th>
                    <th>Rata-Rata Nilai Keaktifan</th>
                    <th>Rata-Rata</th>
                    <th>Nilai Alfabet</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                //query untuk menampilkan data nilai senior
                $query = mysqli_query($db, 
                
                "SELECT 
                s.nisn, 
                s.nama, 
                k.nama AS kelas,
                ROUND(AVG(CASE WHEN n.nama = 'sikap' THEN dn.total_nilai END)) AS rata_rata_sikap,
                ROUND(AVG(CASE WHEN n.nama = 'pola pikir' THEN dn.total_nilai END)) AS rata_rata_pola_pikir,
                ROUND(AVG(CASE WHEN n.nama = 'keaktifan' THEN dn.total_nilai END)) AS rata_rata_keaktifan,
                ROUND((ROUND(AVG(CASE WHEN n.nama = 'sikap' THEN dn.total_nilai END)) + ROUND(AVG(CASE WHEN n.nama = 'pola pikir' THEN dn.total_nilai END)) + ROUND(AVG(CASE WHEN n.nama = 'keaktifan' THEN dn.total_nilai END))) / 3) AS rata_rata_keseluruhan,
                CASE
                    WHEN ROUND((ROUND(AVG(CASE WHEN n.nama = 'sikap' THEN dn.total_nilai END)) + ROUND(AVG(CASE WHEN n.nama = 'pola pikir' THEN dn.total_nilai END)) + ROUND(AVG(CASE WHEN n.nama = 'keaktifan' THEN dn.total_nilai END))) / 3) <= 8 THEN 'B'
                    ELSE 'A'
                END AS nilai_alfabet
                FROM
                    siswa s
                JOIN
                    kelas k ON s.kelas_id = k.id_kelas
                JOIN
                    entered_senior es ON s.nisn = es.nisn
                JOIN
                    detail_nilai dn ON es.detail_id = dn.id_detail
                JOIN
                    nilai n ON dn.nilai_id = n.id_nilai
                GROUP BY
                    s.nisn, s.nama, k.nama;");

                
                while ($a = mysqli_fetch_assoc($query)) { 
                    $nisnSiswa = $_SESSION['nisnSiswa'] = $a['nisn'];
                    $namaSiswa = $_SESSION['namaSiswa'] = $a['nama'];
                    $kelasSiswa = $_SESSION['kelasSiswa'] = $a['kelas'];
                    $rataRataSikap = $_SESSION['rataRataSikap'] = $a['rata_rata_sikap'];
                    $rataRataPolaPikir = $_SESSION['rataRataPolaPikir'] = $a['rata_rata_pola_pikir'];
                    $rataRataKeaktifan = $_SESSION['rataRataKeaktifan'] = $a['rata_rata_keaktifan'];
                    $rataRataKeseluruhan = $_SESSION['rataRataKeseluruhan'] = $a['rata_rata_keseluruhan'];
                    $nilaiAlfabet = $_SESSION['nilaiAlfabet'] = $a['nilai_alfabet'];


                    if(!isset($rataRataKeaktifan) && !isset($rataRataPolaPikir) && !isset($rataRataSikap) == null){
                        $rataRataKeaktifan = 0;
                        $rataRataPolaPikir = 0;
                        $rataRataSikap = 0;
                    }
                    ?>
                    <tr>
                        <td><?= $nisnSiswa ?></td>
                        <td><?= $namaSiswa ?></td>
                        <td><?= $kelasSiswa ?></td>
                        <td><?= $rataRataSikap ?></td>    
                        <td><?= $rataRataPolaPikir ?></td>
                        <td><?= $rataRataKeaktifan ?></td>
                        <td><?= $rataRataKeseluruhan ?></td>
                        <td><?= $nilaiAlfabet ?></td>
                        <td>
                            
                            <a href = "?delete&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
if (isset($_GET['delete'])) {
    $nisn = $_GET['nisn'];
    
    $delete = mysqli_query($db, "UPDATE siswa SET status = 'tidak' WHERE siswa.nisn = '$nisn'");
    if ($delete) {
        echo '<META HTTP-EQUIV="Refresh" Content="0; URL=./nilai_senior.php">';
        exit;
    } else {
        echo "<script>alert('Data Gagal Dihapus !!');</script>";
    }
}
?>