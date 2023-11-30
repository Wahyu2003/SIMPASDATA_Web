<?php
require_once("../database/koneksi.php");

if (isset($_POST['btn_input_junior'])) {
    $nip = $_POST['nisn'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = $nama;
    $notif = "";
    $cek = mysqli_num_rows(mysqli_query($db, "SELECT * FROM admin WHERE nip = '$nip'"));

    if ($cek > 0) {
        $notif = "failed";
        echo '<script>alert("Data Sudah Ada");</script>';
        echo '<script>window.setTimeout(function(){window.location.href = "menu_manajemen_tambah_pembina.php";}, 1000);</script>';
        
        exit;
    } else {
        $notif = "success";
        echo '<script>alert("Berhasil Menambah Akun Pembina");</script>';
        echo '<script>window.setTimeout(function(){window.location.href = "menu_manajemen_tambah_pembina.php";}, 1000);</script>';
        exit;
    }
}

mysqli_close($db);
?>
