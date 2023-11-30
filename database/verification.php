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
</head>
<body>

<!-- ... (navigation bar) -->

<main class="verification-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Verification</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="verification">
                            <div class="form-group row">
                                <label for="otp" class="col-md-4 col-form-label text-md-right">Enter OTP</label>
                                <div class="col-md-6">
                                    <input type="text" id="otp" class="form-control" name="otp" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Verify OTP" name="verifyOTP">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
