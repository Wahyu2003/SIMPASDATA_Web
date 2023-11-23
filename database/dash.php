<?php
// getNama.php

// Koneksi ke database
include 'koneksi.php';

// Ambil NIP/NISN dari permintaan POST
$nipnisn = $_POST['nipnisn'];

// Lakukan kueri ke database untuk mendapatkan nama dari tabel siswa
$querySiswa = $querySiswa = "SELECT nama, nisn, email, no_hp, alamat, role FROM siswa WHERE nisn = '$nipnisn'";;
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
