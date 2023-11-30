<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Nilai Junior</title>
</head>


<body>
<style>
    .container {
    margin : 0 40px;
    padding : 0;
}
       .container .table {
    width: 100%;
    box-sizing: border-box;
    text-align : left;
}

.container .table table {
    width: 100%;
    border-collapse: collapse;
    border-left : 1px solid #a5a5a5;
    border-right : 1px solid #a5a5a5;
}

.container .table th, .container .table td {
    padding : 10px 5px;
    border-bottom: 1px solid #a5a5a5;
    border-top: 1px solid #a5a5a5;
}
    .tambah{
    
                /* background-color: var(--red); */
                font-size: 14px;
                border-radius: 3px;
                padding: 10px;
                color: white;
                background-color: #58AFEE;
                
            }
            .tambah:hover {
                font-size: 14px;
                border-radius: 3px;
                padding: 10px;
                color: white;
                background-color: #3c83b6;
            }

</style>
    <?php
    include "../main/menu.php";
    ?>
    <center>
    <h1>Halaman Nilai Junior</h1>
    </center>
    <br>
<div class="container">
    <button class="tambah"><a href="./nilai_junior_input.php?action=add">Tambah Nilai</a></button>
    
     <div class=" table">
         <table>
            <tr>
                <th>NISN</th>
                <th>Nama Lengkap</th>
                <th>Kelas</th>
                <th>Nilai Sikap</th>
                <th>Nilai Pola Pikir</th>
                <th>Nilai Keaktifan</th>
                <th>Nilai PBB</th>
            </tr>
            <?php
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
                GROUP BY
                    siswa.nisn, siswa.nama, kelas.nama;
                ");

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
    </div>
       
    </div>
        
        <br>
        <button><a href="./data_nilai_junior.php">Data Nilai Junior</a></button>

</body>
</html>
