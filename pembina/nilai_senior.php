<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Nilai Senior</title>
    <style>
        .card-body-table-menu-manajemen-akun-senior {
            margin: 20px auto;
        }

        .table-data-akun-senior {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        .table-data-akun-senior th,
        .table-data-akun-senior td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table-data-akun-senior th {
            background-color: #f2f2f2;
        }

        .table-data-akun-senior a {
            text-decoration: none;
            color: blue;
        }

        .table-data-akun-senior a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    include "../main/menu.php" 
    ?>
    <center>
        <h1>Halaman Nilai Senior Milik Pembina</h1>

    <div>
        <button><a href="./input_nilai_senior.php">Input Nilai</a></button>
    </div>

    <div class="card-body-table-menu-manajemen-akun-senior">
        <table class="table-data-akun-senior" border="1" cellpadding="5" cellspacing="0">
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk menampilkan data nilai senior
                $query = mysqli_query($db, "
                SELECT 
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
                    s.nisn, s.nama;");

                while ($a = mysqli_fetch_assoc($query)) { 
                    $nisnSiswa = $_SESSION['nisnSiswa'] = $a['nisn'];
                    $namaSiswa = $_SESSION['namaSiswa'] = $a['nama'];
                    $kelasSiswa = $_SESSION['kelasSiswa'] = $a['kelas'];
                    $rataRataSikap = $_SESSION['rataRataSikap'] = $a['rata_rata_sikap'];
                    $rataRataPolaPikir = $_SESSION['rataRataPolaPikir'] = $a['rata_rata_pola_pikir'];
                    $rataRataKeaktifan = $_SESSION['rataRataKeaktifan'] = $a['rata_rata_keaktifan'];
                    $rataRataKeseluruhan = $_SESSION['rataRataKeseluruhan'] = $a['rata_rata_keseluruhan'];
                    $nilaiAlfabet = $_SESSION['nilaiAlfabet'] = $a['nilai_alfabet'];

                    if (!isset($rataRataKeaktifan) && !isset($rataRataPolaPikir) && !isset($rataRataSikap) == null) {
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
                            <a href="?delete&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    </center>
    
</body>

</html>
