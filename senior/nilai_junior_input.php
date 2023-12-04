<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM PASDATA | Nilai Junior</title>
    <style>
        
    </style>
</head>

<body>
    <?php
        include "../main/menu.php";

        $nisnSenior = $_SESSION['nisnSiswa'];
        $cekID2 = '';
        if(isset($_GET['action']) && $_GET['action'] == 'add'){
            $queryCekId1 = mysqli_query($db, "SELECT MAX(id_enter) AS id_enter FROM entered");
            while($cekID1 = mysqli_fetch_assoc($queryCekId1)){
                $cekID2 = $cekID1['id_enter'];
            }

            if($cekID2 == null){
                mysqli_query($db, "INSERT INTO entered (id_enter, penginput, nisn_s, nisn_j, sanksi, created_at) VALUES (null, '$nisnSenior', null, null, null, now())");
                
            }else{
                $queryCekId2 = mysqli_query($db, "SELECT MAX(id_enter) AS id_enter FROM entered");
                while($cekID3 = mysqli_fetch_assoc($queryCekId2)){
                    $cekID4 = $cekID3['id_enter'];
                }
                mysqli_query($db, "UPDATE entered SET penginput = '$nisnSenior', nisn_s = null, nisn_j = null, sanksi = null, created_at = now() WHERE id_enter = '$cekID4'");
                
            }

        }

        
        $notifInput = $idEnter = $nisnJunior = $nilaiKeaktifan = $nilaiPBB = $nilaiPolaPikir = $nilaiSikap = $pelanggaran = '';
        if(isset($_POST['simpan'])){
            $idEnter = $_POST['idEntered'];
            $nisnJunior = $_POST['nisn'];
            $nilaiSikap = $_POST['nilaiSikap'];
            $nilaiPolaPikir = $_POST['nilaiPolaPikir'];
            $nilaiKeaktifan = $_POST['nilaiKeaktifan'];
            $nilaiPBB = $_POST['nilaiPBB'];
            $pelanggaran = $_POST['pelanggaran'];

            //cek input agar tidak kosong

            if (!empty($idEnter) && !empty($nisnJunior) && !empty($nilaiSikap) && !empty($nilaiPolaPikir) && !empty($nilaiKeaktifan) && !empty($nilaiPBB) && isset($pelanggaran)) {
                
                //cari id nilai

                $select1 = mysqli_query($db, "SELECT id_nilai FROM nilai WHERE nama = 'Nilai Sikap'");
                $select2 = mysqli_query($db, "SELECT id_nilai FROM nilai WHERE nama = 'Nilai Pola Pikir'");
                $select3 = mysqli_query($db, "SELECT id_nilai FROM nilai WHERE nama = 'Nilai Keaktifan'");
                $select4 = mysqli_query($db, "SELECT id_nilai FROM nilai WHERE nama = 'Nilai PBB'");

                if($row = mysqli_fetch_assoc($select1)){
                    $idNilaiSikap = $row['id_nilai'];
                }
                if($row = mysqli_fetch_assoc($select2)){
                    $idNilaiPolaPikir = $row['id_nilai'];
                }
                if($row = mysqli_fetch_assoc($select3)){
                    $idNilaiKeaktifan = $row['id_nilai'];
                }
                if($row = mysqli_fetch_assoc($select4)){
                    $idNilaiPBB = $row['id_nilai'];
                }

                //memasukkan value ke detail nilai berdasarkan id enter terakhir

                $input1 = mysqli_query($db, "INSERT INTO detail_nilai (enter_id, nilai_id, total_nilai) VALUES ('$idEnter', '$idNilaiSikap', '$nilaiSikap')");
                $input2 = mysqli_query($db, "INSERT INTO detail_nilai (enter_id, nilai_id, total_nilai) VALUES ('$idEnter', '$idNilaiPolaPikir', '$nilaiPolaPikir')");
                $input3 = mysqli_query($db, "INSERT INTO detail_nilai (enter_id, nilai_id, total_nilai) VALUES ('$idEnter', '$idNilaiKeaktifan', '$nilaiKeaktifan')");
                $input4 = mysqli_query($db, "INSERT INTO detail_nilai (enter_id, nilai_id, total_nilai) VALUES ('$idEnter', '$idNilaiPBB', '$nilaiPBB')");

                if($input1 && $input2 && $input3 && $input4){
                    
                    //update value terakhir entered

                    $inputEntered = mysqli_query($db,"UPDATE entered SET penginput = '$nisnSenior', nisn_s = null, nisn_j = '$nisnJunior', sanksi = '$pelanggaran', created_at = NOW() WHERE id_enter = '$idEnter'");

                    //membuat value baru di entered untuk data nilai selanjutnya

                    if($inputEntered){
                        $queryInputNewId = mysqli_query($db, "INSERT INTO entered (id_enter, penginput, nisn_s, nisn_j, sanksi, created_at) VALUES (null, '$nisnSenior', null, null, null, now())");

                        //mengembalikan ke halaman input_junior.php ketika berhasil membuat id baru untuk nilai selanjutnya
                        
                        if($queryInputNewId){
                            header("Location: ./nilai_junior.php");
                            exit;
                        }
                    }
                }
            } else {
                $notifInput = "Tidak Boleh Ada Data Yang Kosong!!";
            }
            
        }
    ?>
    <center>
        <h1>Input Nilai Junior</h1>
        <br>
        <p><?=$notifInput?></p>
        
    </center>
   
    <form method="POST">\
        <div class="container">
        <table>
            <tr>
                <td><label for="idEntered">Id Input</label></td>
                <td><input type="text" name="idEntered" value="<?=$cekID2?>" readonly></td>
            </tr>
            <tr>
                <td><label for="nama_siswa" class="nama_siswa">Nama</label></td>
                <td>
                    <?php
                        $selectNamaSiswa = mysqli_query($db, "SELECT nisn, nama FROM siswa WHERE role = 'junior' AND status = 'aktif' ORDER BY nama asc");
                        $options = '';
                        while ($row = mysqli_fetch_assoc($selectNamaSiswa)) {
                            $selected = (isset($_POST['nama_siswa']) && $_POST['nama_siswa'] == $row['nisn']) ? "selected" : "";
                            $options .= "<option value='" . $row['nisn'] . "' $selected>" . $row['nama'] . "</option>";
                        }  
                    ?>
                    <select name="nama_siswa" id="nama_siswa" onchange="this.form.submit()">
                        <option value="">Pilih siswa</option>
                        <?=$options?>
                    </select>
                </td>
            </tr>
        <?php
            $nisn='';
            $kelas='';
            if(isset($_POST['nama_siswa'])){                                 
                $tampilData = mysqli_query($db, "SELECT siswa.nisn, kelas.nama FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id_kelas WHERE siswa.nisn= $_POST[nama_siswa]");
                    while($row = mysqli_fetch_assoc($tampilData)){
                        $nisn = $row['nisn'];
                        $kelas = $row['nama'];
                    }
            }
        ?>
            <tr>
                <td>
                    <label for="nisn">NISN</label>
                </td>
                <td>
                    <input type="text" name="nisn" id="nisn" value="<?=$nisn?>" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kelas">Kelas</label>
                </td>
                <td>
                    <input type="text" name="kelas" id="kelas" value="<?=$kelas?>" readonly>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nilaiSikap">Nilai Sikap</label>
                </td>
                <td>
                    <input type="number" name="nilaiSikap" id="nilaiSikap" max="10" min="5" onkeydown="return false;">
                </td> 
            </tr>
            <tr>
                <td>
                    <label for="nilaiPolaPikir">Nilai Pola Pikir</label>
                </td>
                <td>
                    <input type="number" name="nilaiPolaPikir" id="nilaiPolaPikir" max="10" min="5" onkeydown="return false;">
                </td>
            </tr>
            </tr>
                <td>
                    <label for="nilaiKeaktifan">Nilai Keaktifan</label>
                </td>
                <td>
                    <input type="number" name="nilaiKeaktifan" id="nilaiKeaktifan" max="10" min="5" onkeydown="return false;">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nilaiPBB">Nilai PBB</label>
                </td>
                <td>
                    <input type="number" name="nilaiPBB" id="nilaiPBB" max="10" min="5" onkeydown="return false;">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="pelanggaran">Pelanggaran</label>
                </td>
                <td>
                    <select name="pelanggaran" id="pelanggaran">
                        <option value="0">Tidak Ada</option>
                        <option value="5">Ringan</option>
                        <option value="7">Sedang</option>
                        <option value="10">Berat</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="simpan" id="simpan">Simpan</button></td>
            </tr>
        </table>
        </div>
       
    </form>
</body>
</html>

