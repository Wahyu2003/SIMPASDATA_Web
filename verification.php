<?php
session_start();
require_once "database/koneksi.php";

if (isset($_POST["verifyOTP"])) {
    $enteredOTP = $_POST["otp"];
    $expectedOTP = $_SESSION['otp'];

    if ($enteredOTP == $expectedOTP) {
        // OTP verification successful, update password
        $email = $_SESSION['email'];
        $newPassword = $_SESSION['newPassword'];

        // Update query menggunakan prepared statement
        $updateQuery = "UPDATE siswa SET password = ? WHERE email = ?";
        $stmt = mysqli_prepare($db, $updateQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $newPassword, $email);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                // Password update successful, unset session
                unset($_SESSION['email']);
                unset($_SESSION['otp']);
                unset($_SESSION['newPassword']);

                ?>
                <script>
                    alert("Password updated successfully.");
                     window.location.replace('index.php'); 
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("Failed to update password. Please try again.");
                </script>
                <?php
            }

            mysqli_stmt_close($stmt);
        } else {
            ?>
            <script>
                alert("Failed to prepare statement. Please try again.");
            </script>
            <?php
        }
    } else {
        ?>
        <script>
            alert("Incorrect OTP. Please try again.");
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (head section) -->
    <link rel="stylesheet" href="forgot.css">
</head>
<body>

<!-- ... (navigation bar) -->

<div class="login-form-container">
        <form class="login-form" method="post" name="verification">
            <h4>Masukkan OTP yang Sudah di Kirim ke Email Anda</h4>
            <div class="form-group">
                <input type="text" name="otp" id="otp" placeholder="Masukan KODE OTP" required autofocus>
            </div>
            <div class="button-sign-in">
                    <button type="submit" name="verifyOTP" value="verifyOTP">Send OTP</button>
            </div>
        </form>
    </div>

</body>
</html>
