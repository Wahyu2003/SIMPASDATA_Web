<?php
require_once("../database/koneksi.php");

if (isset($_POST['btn_input_junior'])) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];
    $kelas_id = $_POST['kelas']; // Menggunakan NULL jika opsi "Pilih Siswa" dipilih
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = $nisn;
    //proses foto
    $tmpName = $_FILES['foto']['tmp_name'];
    $gambarBlob = addslashes(file_get_contents($tmpName));


    $cek = mysqli_num_rows(mysqli_query($db, "SELECT * FROM siswa WHERE nisn = '$nisn'"));

    if($cek > 0){
        echo "Data Sudah Ada";
        header("Location: junior_manajemen_input_akun.php");
        exit;
    }else{
        $query = "INSERT INTO siswa (NISN, kelas_id, nama, gender, alamat, email, no_hp, foto, password, status, role, level) 
        VALUES ('$nisn', '$kelas_id', '$nama', '$jenis_kelamin', '$alamat', '$email', '$no_hp', '$gambarBlob', '$password', 'aktif', 'junior', 'denied')";
    }

    

    if (mysqli_query($db, $query)) {
        echo "Data berhasil ditambahkan.";
        header("Location: junior_manajemen_akun.php");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($db);
    }
}

mysqli_close($db);
?>
