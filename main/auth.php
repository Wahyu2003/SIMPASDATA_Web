<?php 
session_start();
require_once("../database/koneksi.php");

if(!isset($_SESSION['nipAdmin']) AND !isset($_SESSION['roleAdmin']) == 'admin'){
    header("Location: ../index.php");
    exit;
} elseif (!isset($_SESSION['nipAdmin']) AND !isset($_SESSION['roleAdmin']) == 'pembina') {
    header("Location: ../index.php");
    exit;
} elseif (!isset($_SESSION['nisnSiswa']) AND !isset($_SESSION['roleSiswa']) == 'senior') {
    header("Location: ../index.php");
    exit;
}elseif(isset($_SESSION['nipAdmin']) AND isset($_SESSION['roleAdmin']) == 'admin'){
    $nipAdmin = $_SESSION['nipAdmin'];
    $namaAdmin = $_SESSION['namaAdmin'];
    $usernameAdmin = $_SESSION['usernameAdmin'];
    $passwordAdmin = $_SESSION['passwordAdmin'];
    $roleAdmin = $_SESSION['roleAdmin'];
}elseif(isset($_SESSION['nipAdmin']) AND isset($_SESSION['roleAdmin']) == 'pembina'){
    $nipAdmin = $_SESSION['nipAdmin'];
    $namaAdmin = $_SESSION['namaAdmin'];
    $usernameAdmin = $_SESSION['usernameAdmin'];
    $passwordAdmin = $_SESSION['passwordAdmin'];
    $roleAdmin = $_SESSION['roleAdmin'];
}elseif(isset($_SESSION['nisnSiswa']) AND isset($_SESSION['roleSiswa']) == 'senior'){
    $nisnSiswa = $_SESSION['nisnSiswa'];
    $kelas_idSiswa = $_SESSION['kelas_idSiswa'];
    $namaSiswa = $_SESSION['namaSiswa'];
    $genderSiswa = $_SESSION['genderSiswa'];
    $alamatSiswa = $_SESSION['alamatSiswa'];
    $emailSiswa = $_SESSION['emailSiswa'];
    $passwordSiswa = $_SESSION['passwordSiswa'];
    $angkatanSiswa = $_SESSION['angkatanSiswa'];
    $statusSiswa = $_SESSION['statusSiswa'];
    $roleSiswa = $_SESSION['roleSiswa'];
    $levelSiswa = $_SESSION['levelSiswa'];    
}else{
    echo "Gagal autentifikasi di main/auth";
}
?>