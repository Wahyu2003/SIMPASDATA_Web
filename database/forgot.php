<?php
session_start();
require_once "koneksi.php";


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

            $mail = require __DIR__. "/mailer.php";

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
            $mail->Body = "<p>Dear user, </p> <h3>Your verify OTP code is $otp <br></h3>";
                

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

?>