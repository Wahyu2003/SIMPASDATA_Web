<?php
require_once("koneksi.php");

// Periksa apakah ada data yang dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pastikan ada nilai NISN yang dikirimkan
    if (isset($_POST['nisn'])) {
        $nisn = $_POST['nisn'];
        $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $no_hp = isset($_POST['no_hp']) ? $_POST['no_hp'] : null;

        // Proses foto
        $gambarBlob = null;

        // Periksa apakah file gambar diunggah dengan benar
        if (isset($_FILES['foto']['tmp_name']) && is_uploaded_file($_FILES['foto']['tmp_name'])) {
            $tmpName = $_FILES['foto']['tmp_name'];
            $gambarBlob = file_get_contents($tmpName);
        }

        // Log sebelum eksekusi query
        error_log("nisn: $nisn, alamat: $alamat, email: $email, no_hp: $no_hp, gambarBlob: " . strlen($gambarBlob));

        // Query Update
        $queryUpdate = "UPDATE `siswa` SET ";
        $params = array();
        if (!is_null($alamat)) {
            $queryUpdate .= "`alamat` = ?, ";
            $params[] = &$alamat;
        }
        if (!is_null($email)) {
            $queryUpdate .= "`email` = ?, ";
            $params[] = &$email;
        }
        if (!is_null($no_hp)) {
            $queryUpdate .= "`no_hp` = ?, ";
            $params[] = &$no_hp;
        }
        if (!is_null($gambarBlob)) {
            $queryUpdate .= "`foto` = ?, ";
            $params[] = &$gambarBlob;
        }

        // Hapus koma terakhir
        $queryUpdate = rtrim($queryUpdate, ', ');

        $queryUpdate .= " WHERE `nisn` = ?";
        $stmtUpdate = mysqli_prepare($db, $queryUpdate);

        // Binding parameter
        $bindTypes = str_repeat('s', count($params)) . 's'; // String, String, Blob, String
        call_user_func_array('mysqli_stmt_bind_param', array_merge(array($stmtUpdate, $bindTypes), $params, array(&$nisn)));

        // Eksekusi statement update
        if (mysqli_stmt_execute($stmtUpdate)) {
            echo json_encode(array('message' => 'Data berhasil diperbarui.'));
        } else {
            echo json_encode(array('error' => 'Error: ' . mysqli_stmt_error($stmtUpdate)));
        }

        // Tutup statement update
        mysqli_stmt_close($stmtUpdate);
    } else {
        // Data NISN tidak ada, tampilkan pesan kesalahan
        echo json_encode(array('error' => 'NISN tidak ditemukan.'));
    }
} else {
    // Metode bukan POST, tampilkan pesan kesalahan
    echo json_encode(array('error' => 'Metode tidak valid.'));
}

mysqli_close($db);
?>
