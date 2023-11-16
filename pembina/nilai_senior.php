<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Input Nilai Keaktifan </title>
</head>
<body>
    <?php 
    session_start();
    include "../main/menu.php" 
    ?>
    <h1>Halaman Input Nilai Senior Milik Pembina</h1>

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
                //EDIT DARI SINI

                $query = mysqli_query($db, "SELECT s.nisn, s.nama, ROUND(AVG(dn.total_nilai)) AS rata_rata_keseluruhan, CASE WHEN ROUND(AVG(dn.total_nilai)) <= 8 THEN 'B' ELSE 'A' END AS nilai_alfabet FROM siswa s JOIN entered e ON s.nis = e.nis JOIN detail_nilai dn ON e.detail_id = dn.id_detail WHERE dn.nama IN ('sikap', 'pola pikir', 'keaktifan') GROUP BY s.nis, s.nama;");

                while ($a = mysqli_fetch_assoc($query)) { 
                    $nisnSiswa = $_SESSION['nisnSiswa'] = $a['nisn'];
                    $namaSiswa = $_SESSION['namaSiswa'] = $a['nama'];
                    $kelasSiswa = $_SESSION['kelasSiswa'] = $a['kelas'];
                    $alamatSiswa = $_SESSION['alamatSiswa'] = $a['alamat'];
                    $genderSiswa = $_SESSION['genderSiswa'] = $a['gender'];

                    if($genderSiswa == 'L'){
                        $genderSiswa = "Laki - Laki";
                    }else{
                        $genderSiswa = "Perempuan";
                    }
                    ?>
                    <tr>
                        <td><?= $nisnSiswa ?></td>
                        <td><?= $namaSiswa ?></td>
                        <td><?= $kelasSiswa ?></td>
                        <td><?= $alamatSiswa ?></td>    
                        <td><?= $genderSiswa ?></td>
                        <td>
                            <a href = "./menu_manajemen_detail_senior.php?nisn=<?= $nisnSiswa?>" class='detail'>Detail</a>
                            <a href = "?delete&nisn=<?= $nisnSiswa ?>" onclick="return confirm('Apakah kamu yakin ?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>