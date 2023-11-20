<?php 
require_once("../database/koneksi.php");

if(!isset($_SESSION['nipAdmin']) AND !isset($_SESSION['roleAdmin']) != 'admin'){
    header("Location: ../index.php");
    exit;
} elseif (!isset($_SESSION['nipAdmin']) AND !isset($_SESSION['roleAdmin']) != 'pembina') {
    header("Location: ../index.php");
    exit;
} elseif (!isset($_SESSION['nisnSiswa']) AND !isset($_SESSION['roleSiswa']) != 'senior') {
    header("Location: ../index.php");
    exit;
} elseif(isset($_SESSION['nipAdmin']) AND isset($_SESSION['roleAdmin']) == 'admin' || 'pembina'){
    $nipAdmin = $_SESSION['nipAdmin'];
    $fotoAdmin = $_SESSION['fotoAdmin'];
    $namaAdmin = $_SESSION['namaAdmin'];
    $alamatAdmin = $_SESSION['alamatAdmin'];
    $genderAdmin = $_SESSION['genderAdmin'];
    $emailAdmin = $_SESSION['emailAdmin'];
    $noHpAdmin = $_SESSION['noHpAdmin'];
    $passwordAdmin = $_SESSION['passwordAdmin'];
    $role = $_SESSION['roleAdmin'];
} elseif(isset($_SESSION['nisnSiswa']) AND isset($_SESSION['roleSiswa']) == 'senior'){
    $nisnSiswa = $_SESSION['nisnSiswa'];
    $kelas_idSiswa = $_SESSION['kelas_idSiswa'];
    $fotoSiswa = $_SESSION['fotoSiswa'];
    $namaSiswa = $_SESSION['namaSiswa'];
    $genderSiswa = $_SESSION['genderSiswa'];
    $alamatSiswa = $_SESSION['alamatSiswa'];
    $emailSiswa = $_SESSION['emailSiswa'];
    $noHpSiswa = $_SESSION['noHpSiswa'];
    $passwordSiswa = $_SESSION['passwordSiswa'];
    $statusSiswa = $_SESSION['statusSiswa'];
    $role = $_SESSION['roleSiswa'];
    $levelSiswa = $_SESSION['levelSiswa'];  
} else {
    echo "Gagal autentifikasi di main/auth";
}
?>