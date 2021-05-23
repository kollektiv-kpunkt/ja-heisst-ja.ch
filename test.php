<?php
include "./includes/functions.inc.php";
include './includes/config.inc.php';
include "./includes/lang/lang.{$lang}.php";

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require('./vendor/mailer/vendor/autoload.php');


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = $emailHost;
    $mail->SMTPAuth   = true;
    $mail->Username   = $emailUser;
    $mail->Password   = $emailPwd;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $emailPort;

    //Recipients
    $mail->setFrom($emailFromEmail, "Testing {$_SERVER['HTTP_HOST']}");
    $mail->addAddress("timothy@kpunkt.ch", "Timothy Justin Oesch");
    $mail->CharSet  = 'UTF-8';

    // Content
    $mail->isHTML(true);
    $mail->Subject = "Test {$_SERVER['HTTP_HOST']}";
    $mail->Body    = "This Email is a test for the domain {$_SERVER['HTTP_HOST']}. If you recieve this E-Mail, everything is going well.";

    $mail->send();

    echo("Good");
} catch (Exception $e) {
    alert("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    echo("Bad");
}