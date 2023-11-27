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

        $nisnSenior = $_SESSION['nisnSiswa'];
        $cekID2 = '';
        if(isset($_GET['action']) && $_GET['action'] == 'add'){
            $queryCekId1 = mysqli_query($db, "SELECT MAX(id_enter) AS id_enter FROM entered");
            while($cekID1 = mysqli_fetch_assoc($queryCekId1)){
                $cekID2 = $cekID1['id_enter'];
            }

            if($cekID2 == null){
                mysqli_query($db, "INSERT INTO entered (nisn_s) VALUES ('$nisnSenior')");
                
            }else{
                $queryCekId2 = mysqli_query($db, "SELECT MAX(id_enter) AS id_enter FROM entered");
                while($cekID3 = mysqli_fetch_assoc($queryCekId2)){
                    $cekID4 = $cekID3['id_enter'];
                }
                mysqli_query($db, "UPDATE entered SET nisn_s = '$nisnSenior' WHERE id_enter = '$cekID4'");
                
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

                    $inputEntered = mysqli_query($db,"UPDATE entered SET nisn_j = '$nisnJunior', sanksi = '$pelanggaran', created_at = NOW() WHERE id_enter = '$idEnter'");

                    //membuat value baru di entered untuk data nilai selanjutnya

                    if($inputEntered){
                        $queryInputNewId = mysqli_query($db, "INSERT INTO entered (nisn_s) VALUES ('$nisnSenior')");

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

<!-- 
    id:
    1. input text : id_enter    = idEntered
    2. dropdown : nama          = nama_siswa
    3. input text : nisn        = nisn
    4. input text : kelas       = kelas
    5. range : nilai sikap      = nilaiSikap
    6. range : nilai pola pikir = nilaiPolaPikir
    7. range : nilai keaktifan  = nilaiKeaktifan
    8. range : nilai PBB        = nilaiPBB
    9. dropdown : sanksi        = pelanggaran
    10. button : simpan         = simpan


    alur program:
    1. ketika tidak ada data di tabel entered, maka ketika menekan tombol tambah akun di nilai_junior.php
    akan memasukkan id senior di kolom nisn_s, id senior tersebut diambil dari senior yang sedang login. misal: (null, null, nisn_s, null, null, null)

    select id terakhir, jika tidak ada maka masukkan value, jika ada maka update value terakhir dengan nisn_s saat ini
    jika update berhasil maka tampilkan id enter terakhir di input text idEntered.

    2.ketika menekan tombol simpan, maka program akan menyimpan ke dalam tabel detail_nilai berdasarkan masing masing nilai
    dan untuk id_enter nya berdasarkan input text idEntered. setelah itu memasukkan data ke tabel entered dengan cara update value terakhirnya.
    jika berhasil maka akan membuat value baru. misal: (null, null, nisn_s, null, null, null)

 -->
    <center>
        <h1>Input Nilai Junior</h1>
        <br>
        <p><?=$notifInput?></p>
        
    </center>
    <center>
    <form method="POST">
        <table>
            <tr>
                <td></td>
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
                    <input type="text" name="nisn" id="nisn" value="<?=$nisn?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="kelas">Kelas</label>
                </td>
                <td>
                    <input type="text" name="kelas" id="kelas" value="<?=$kelas?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nilaiSikap">Nilai Sikap</label>
                </td>
                <td>
                    <input type="number" name="nilaiSikap" id="nilaiSikap" max="10" min="5">
                </td> 
            </tr>
            <tr>
                <td>
                    <label for="nilaiPolaPikir">Nilai Pola Pikir</label>
                </td>
                <td>
                    <input type="number" name="nilaiPolaPikir" id="nilaiPolaPikir" max="10" min="5">
                </td>
            </tr>
            </tr>
                <td>
                    <label for="nilaiKeaktifan">Nilai Keaktifan</label>
                </td>
                <td>
                    <input type="number" name="nilaiKeaktifan" id="nilaiKeaktifan" max="10" min="5">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nilaiPBB">Nilai PBB</label>
                </td>
                <td>
                    <input type="number" name="nilaiPBB" id="nilaiPBB" max="10" min="5">
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
    </form>
    </center>
</body>
</html>

