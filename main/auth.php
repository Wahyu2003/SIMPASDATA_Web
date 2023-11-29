<?php
session_start();
require_once("../database/koneksi.php");

// Cek apakah admin yang login
if (isset($_SESSION['nipAdmin']) && ($_SESSION['roleAdmin'] == 'admin' || $_SESSION['roleAdmin'] == 'pembina')) {
    $nipAdmin = $_SESSION['nipAdmin'];
    $fotoAdmin = $_SESSION['fotoAdmin'];
    $namaAdmin = $_SESSION['namaAdmin'];
    $alamatAdmin = $_SESSION['alamatAdmin'];
    $genderAdmin = $_SESSION['genderAdmin'];
    $emailAdmin = $_SESSION['emailAdmin'];
    $noHpAdmin = $_SESSION['noHpAdmin'];
    $passwordAdmin = $_SESSION['passwordAdmin'];
    $role = $_SESSION['roleAdmin'];

    // Lanjutkan eksekusi halaman admin atau pembina
} elseif (isset($_SESSION['nisnSiswa']) && $_SESSION['roleSiswa'] == 'senior' && $_SESSION['levelSiswa'] == 'allow' && $_SESSION['statusSiswa'] == 'aktif') {
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

    // Lanjutkan eksekusi halaman siswa senior
} else {
    // Jika tidak memenuhi syarat di atas, redirect ke halaman login
    header("Location: ../index.php");
    exit;
}
?>
