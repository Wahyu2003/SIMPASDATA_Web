<?php
require_once("koneksi.php");

if (isset($_POST['update'])) {
    $nisn = $_POST['nisn'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    $password = $_POST['password'];

    // Proses foto
    $gambarBlob = null;

    if (isset($_FILES['foto']['tmp_name']) && !empty($_FILES['foto']['tmp_name'])) {
        echo json_encode(array('debug_info' => 'File received'));

        $tmpName = $_FILES['foto']['tmp_name'];
        $gambarBlob = file_get_contents($tmpName);
        var_dump($gambarBlob);  // Add this line for debugging
    }

    // Cek apakah data siswa dengan NISN tersebut sudah ada
    $result = mysqli_query($db, "SELECT * FROM siswa WHERE nisn = '$nisn'");
    $cek = mysqli_num_rows($result);

    if ($cek > 0) {
        // Jika gambarBlob tidak null, masukkan ke dalam query
        $gambarQueryPart = isset($gambarBlob) ? "`foto` = ?, " : "";

        $query = "UPDATE `siswa`
        SET `alamat` = ?, 
            `email` = ?, 
            `no_hp` = ?,
            $gambarQueryPart
            `password_siswa` = ?
        WHERE `nisn` = ?";


        $stmt = mysqli_prepare($db, $query);

        // Urutan parameter harus sesuai dengan urutan di dalam query
        if ($gambarBlob) {
            // Jumlah 's' sesuaikan dengan jumlah parameter yang diikat
            mysqli_stmt_bind_param($stmt, 'ssssss', $alamat, $email, $no_hp, $gambarBlob, $password, $nisn);

        } else {
            mysqli_stmt_bind_param($stmt, 'ssss', $alamat, $email, $no_hp, $password, $nisn);
        }

        // Eksekusi statement
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(array('message' => 'Data berhasil diperbarui.'));
        } else {
            echo json_encode(array('error' => 'Error: ' . mysqli_stmt_error($stmt)));
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        // Data siswa dengan NISN tersebut tidak ditemukan, tampilkan pesan kesalahan
        echo json_encode(array('error' => 'Data tidak ditemukan.'));
    }
}

mysqli_close($db);
?>
