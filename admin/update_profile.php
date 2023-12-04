<?php
// update_profile.php

require_once("../database/koneksi.php");


// Mengecek apakah ada permintaan POST
if (isset($_POST['btn_simpan_profil'])) {
    
    // Mengambil data yang dikirim melalui formulir
    $editedNIP = $_POST['editedNIP'];
    $editedNama = $_POST['editedNama'];
    $editedAlamat = $_POST['editedAlamat'];
    $editedEmail = $_POST['editedEmail'];
    $editedNoHp = $_POST['editedNoHp'];
    $editedFoto = $_FILES['editedPhoto']['tmp_name'];

    // Menangani foto profil yang diunggah
    if (isset($_FILES['editedPhoto']) && $_FILES['editedPhoto']['error'] == 0) {
        // Memeriksa apakah file adalah file gambar JPEG
        $allowedExtensions = array("jpeg");
        $targetFileExtension = strtolower(pathinfo($_FILES['editedPhoto']['name'], PATHINFO_EXTENSION));

        if (in_array($targetFileExtension, $allowedExtensions)) {
            // Membaca isi file sebagai blob
            $photoData = file_get_contents($_FILES['editedPhoto']['tmp_name']);
            
            // Update database dengan blob foto yang baru
            $sql = mysqli_query($db, "UPDATE admin SET nama = '$editedNama', alamat = '$editedAlamat', email = '$editedEmail', no_hp = '$editedNoHp', foto = '$editedFoto' WHERE nip = '$editedNIP'");

            if ($sql) {
                // Pembaruan berhasil
                echo "Pembaruan berhasil!";
                header("Location: ./profile.php");
                exit;
            } else {
                // Pembaruan gagal
                echo "Pembaruan gagal: " . $sql->error;
            }

            $sql->close();
        } else {
            // File yang diunggah bukan file gambar JPEG
            echo "Hanya file JPEG yang diizinkan.";
        }
    } else {
        // Tidak ada pembaruan untuk foto, hanya memperbarui data pengguna tanpa foto
        $sql = mysqli_query($db, "UPDATE admin SET nama = '$editedNama', alamat = '$editedAlamat', email = '$editedEmail', no_hp = '$editedNoHp', WHERE nip = '$editedNIP'");

        if ($sql) {
            // Pembaruan berhasil
            echo "Pembaruan berhasil!";
            header("Location: ./profile.php");
            exit;
        } else {
            // Pembaruan gagal
            echo "Pembaruan gagal: " . $sql->error;
        }

        $sql->close();
    }

    // Menutup koneksi
    $db->close();
} else {
    // Jika tidak ada permintaan POST, mungkin akan lebih baik menangani ini sesuai kebutuhan Anda
    echo "Permintaan tidak valid.";
}
?>
