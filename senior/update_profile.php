<?php
// update_profile.php

require_once("../database/koneksi.php");


// Mengecek apakah ada permintaan POST
if (isset($_POST['btn_simpan_profil'])) {
    
    // Mengambil data yang dikirim melalui formulir
    $editedNISN = $_POST['editedNISN'];
    $editedAlamat = $_POST['editedAlamat'];
    $editedEmail = $_POST['editedEmail'];
    $editedNoHp = $_POST['editedNoHp'];
    $editedPassword = $_POST['editedPassword'];
    $editedPhoto = $_FILES['editedPhoto']['tmp_name'];

    

    // Menangani foto profil yang diunggah
    if (isset($_FILES['editedPhoto']['tmp_name'])) {
        
        $photoData = addslashes(file_get_contents($editedPhoto));
        $sql = mysqli_query($db, "UPDATE siswa SET alamat = '$editedAlamat', email = '$editedEmail', no_hp = '$editedNoHp', password = '$editedPassword', foto = '$photoData' WHERE nisn = $editedNISN");    

            if ($sql) {
                // Pembaruan berhasil
                echo "Pembaruan berhasil!";
                header("Location: ./profil.php");
                exit;
            } else {
                // Pembaruan gagal
                echo "Pembaruan gagal: " . $sql->error;
            }
    } else {
        // Tidak ada pembaruan untuk foto, hanya memperbarui data pengguna tanpa foto
        $sql = mysqli_query($db, "UPDATE siswa SET alamat = '$editedAlamat', email = '$editedEmail', no_hp = '$editedNoHp', password = '$editedPassword' WHERE nisn = $editedNISN");

        if ($sql) {
            // Pembaruan berhasil
            echo "Pembaruan berhasil!";
            header("Location: ./profil.php");
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
