<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once "koneksi.php";
require __DIR__ . "/vendor/autoload.php";
if (!empty($_POST['email'])) {
    $email = $_POST['email'];


    if ($db) {
        try {
            $otp = random_int(100000, 999999);
        } catch (Exception $e) {
            $otp = rand(100000, 999999);
        }
        $sql = "update siswa set reset_password_otp='".$otp."' , reset_password_create_at = '".date('Y-m-d H:i:s')."' where email ='".$email."'";
        if (mysqli_query($db, $sql)) {
            if (mysqli_affected_rows($db)) {
                $mail = new PHPMailer(true);

try {
    //Server settings

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Port = 465;
    $mail->Username = "rizalmahendra1008@gmail.com";
    $mail->Password = "aypqpqsifwcyrgea";                             //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                     
    //Recipients
    $mail->setFrom('from@example.com', 'SIMPASDATA');
    $mail->addAddress($email);     //Add a recipient
    $mail->addReplyTo('info@example.com', 'Information');



    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password - SIMPASDATA';
    $mail->Body    = 'Your OTP to Reset Password[' . $otp . '].';
    $mail->AltBody = 'Reset Password to Access Application';

    if ($mail->send())
    echo 'Success';
else
    echo 'Failed to Send OTP';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
            }
        }
    }
}
?>
