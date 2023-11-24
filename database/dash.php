<?php
// getNama.php

// Koneksi ke database
include 'koneksi.php';

// Ambil NIP/NISN dari permintaan POST
$nipnisn = $_POST['nipnisn'];

// Lakukan kueri ke database untuk mendapatkan nama dari tabel siswa
$querySiswa = $querySiswa = "SELECT siswa.nama, siswa.nisn, siswa.email, siswa.no_hp, siswa.alamat, siswa.role, siswa.kelas_id, siswa.foto, kelas.nama_kelas
                             FROM siswa JOIN kelas ON siswa.kelas_id = kelas.id_kelas WHERE siswa.nisn = '$nipnisn'";

$resultSiswa = mysqli_query($db, $querySiswa);



// Gabungkan hasil query menggunakan UNION
$result = array();
if ($resultSiswa) {
    while ($row = mysqli_fetch_assoc($resultSiswa)) {
        $result[] = $row;
    }
}


// Kirim nama sebagai respons JSON
echo json_encode(['profile' => $result]);


?>
