<?php
session_start();
require_once "database/koneksi.php";

if (isset($_POST["updatePassword"])) {
    $email = $_POST["email"];
    $newPassword = $_POST["newPassword"];

    $checkEmailQuery = "SELECT * FROM siswa WHERE email = ?";
    $checkStmt = mysqli_prepare($db, $checkEmailQuery);
    

    if ($checkStmt) {
        mysqli_stmt_bind_param($checkStmt, "s", $email);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);

        if (mysqli_stmt_num_rows($checkStmt) > 0) {
            $_SESSION['newPassword'] = $newPassword;
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $email;

            $mail = require __DIR__ . "/mailer.php";

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';

            $mail->Username = 'rizalmahendra1008@gmail.com';
            $mail->Password = 'aypqpqsifwcyrgea';

            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Your verify code";
            $mail->Body = "<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>
                <br><br>
                <p>With regards,</p>
                <b>Programming with Lam</b>
                https://www.youtube.com/channel/UCKRZp3mkvL1CBYKFIlxjDdg";

            if (!$mail->send()) {
                ?>
                <script>
                    alert("Failed to send OTP. Please try again.");
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("OTP sent to <?php echo $email ?>. Please check your email.");
                    window.location.replace('verification.php');
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Email not found in the database.");
                window.location.replace('forgot_password.php');
            </script>
            <?php
        }

        mysqli_stmt_close($checkStmt);
    } else {
        ?>
        <script>
            alert("Failed to prepare statement. Please try again.");
            window.location.replace('forgot_password.php');
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

<main class="login-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form action="#" method="POST" name="register">
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email" class="form-control" name="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="form-control" name="newPassword" required>
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </div>
                            </div>

                            <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Update Password" name="updatePassword">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- ... (script to toggle password visibility) -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.16.0/dist/bootstrap-icons.min.js"></script>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function () {
        if (password.type === "password") {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
        this.classList.toggle('bi-eye-slash');
    });
</script>
</body>
</html>
