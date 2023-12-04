<?php
require_once "koneksi.php";

if (!empty($_POST['email']) && !empty($_POST['otp']) && !empty($_POST['new_password'])) {
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $newPassword = $_POST['new_password']; 

    if ($db) {
        $sql = "UPDATE siswa SET password='" . $newPassword . "', reset_password_otp='', reset_password_create_at=
        '' WHERE email='" . $email . "' AND reset_password_otp='" . $otp . "'";

        if (mysqli_query($db, $sql)) {
            if (mysqli_affected_rows($db)) {
                echo "success";
            } else {
                echo "Reset Password Gagal";
            }
        } else {
            echo "Reset Password Gagal";
        }
    } else {
        echo "Database Gagal Konek";
    }
} else {
    echo "Semua kolom harus diisi";
}
?>
