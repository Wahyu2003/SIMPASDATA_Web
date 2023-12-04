<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "rizalmahendra1008@gmail.com";
$mail->Password = "aypqpqsifwcyrgea";
$mail->from = "Admin Simpasdata";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;


$mail->isHtml(true);

return $mail;