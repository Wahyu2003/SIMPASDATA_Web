<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Input Nilai Senior </title>
    <style>
        th, td{
            text-align:left
        }
    </style>
</head>
<body>
    <?php 
    include "../main/menu.php" 
    ?>
    <h1>Halaman Input Nilai Senior Milik Pembina</h1>
    <!-- menampilkan nama pada select dari database -->
    
<?php
    
    $selectNamaSiswa = mysqli_query($db, "SELECT nisn, nama FROM siswa WHERE role = 'senior' AND status = 'aktif' ORDER BY nama asc");
    $options = '';
        while ($row = mysqli_fetch_assoc($selectNamaSiswa)) {
            $selected = ($_POST['nama_siswa'] == $row['nisn']) ? "selected" : "";
            $options .= "<option value='" . $row['nisn'] . "'$selected>" . $row['nama'] . "</option>";
        }
    
        
?>
    <form action="" method="POST" name="nilai_senior">
        <table>
            <tr>
                <th><label for="label" class="label">Nama</label></th>
                <td>
                    <select name="nama_siswa" id="nama_siswa" onchange="this.form.submit()">
                        <option value=0>Pilih siswa</option>
                        <?=$options?>
                    </select>
                </td>
            </tr>
<?php
            if(isset($_POST['nama_siswa'])){
                if($_POST['nama_siswa'] == 0){
                    $nisn = null;
                    $kelas = null;
                }else{
                    $tampilData = mysqli_query($db, "SELECT siswa.nisn, kelas.nama FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id_kelas WHERE nisn= $_POST[nama_siswa]");
                        while($row = mysqli_fetch_assoc($tampilData)){
                            $nisn = $row['nisn'];
                            $kelas = $row['nama'];
                        }
                }

                
            }else{  
                $nisn = null;
                $kelas = null;
            }
?>
            <tr>
                <th><label for="label" class="label">NISN</label></th>
                <td><?=$nisn?></td>
            </tr>
            <tr>
                <th><label for="label" class="label">Kelas</label></th>
                <td><?=$kelas?></td>
            </tr>
            <tr>
                <th><label for="label" class="label">Tahun Pelajaran</label></th>
                <td></td>
            </tr>
            <tr>
                <th><label for="label" class="label">Nilai Sikap</label></th>
                <td></td>
            </tr>
            <tr>
                <th><label for="label" class="label">Nilai Pola Pikir</label></th>
                <td></td>
            </tr>
            <tr>
                <th><label for="label" class="label">Nilai Keaktifan</label></th>
                <td></td>
            </tr>
            <tr>
                <th><label for="label" class="label">Nama</label></th>
                <td></td>
            </tr>
            <tr>
                <th></th>
                <td><button type="submit" name="tambah_nilai_senior">Simpan</button></td>
            </tr>
        </table>
    </form>
</body>
</html>

