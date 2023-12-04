<?php
require_once("../database/koneksi.php");

if (isset($_POST['btn_input_pembina'])) {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = $nama;
    $notif = "";
    $role="pembina";
    $cek = mysqli_num_rows(mysqli_query($db, "SELECT * FROM admin WHERE nip = '$nip'"));

    if ($cek > 0) {
        $notif = "failed";
        echo '<script>alert("Data Sudah Ada");</script>';
        echo '<script>window.setTimeout(function(){window.location.href = "menu_manajemen_akun_pembina.php";}, 1000);</script>';
        
        exit;
    } else {
        $query = "INSERT INTO admin (nip, nama, gender, alamat, email, no_hp,password,role) 
        VALUES ('$nip', '$nama', '$jenis_kelamin', '$alamat', '$email', '$no_hp', '$password','$role')";
        $notif = "success";
        echo '<script>alert("Berhasil Menambah Akun Pembina");</script>';
      
    }
    if (mysqli_query($db, $query)) {
        echo "Data berhasil ditambahkan.";
        header("Location: menu_manajemen_akun_pembina.php");
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($db);
    }
}

mysqli_close($db);
?>
