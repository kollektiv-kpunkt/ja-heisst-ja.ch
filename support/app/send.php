<?php
require('../../vendor/fpdf/fpdf.php');
include "../../includes/conn.inc.php";
include "../../includes/functions.inc.php";
include '../../includes/config.inc.php';
include "../../includes/lang/lang.{$lang}.php";

$uuid = $_POST['uuid'];
$email_data = getEmail($conn, $uuid);
$nosubmits = countSubmits($conn);
$thissubmit = $nosubmits + 1;

$addressline0 = iconv('UTF-8', 'windows-1252', $email_data['emails_UUID']);
$addressline1 = iconv('UTF-8', 'windows-1252', $email_data['emails_fname']) . " " . iconv('UTF-8', 'windows-1252', $email_data['emails_lname']);
$addressline2 = iconv('UTF-8', 'windows-1252', $email_data['emails_adresse']);
$addressline3 = "CH-" . iconv('UTF-8', 'windows-1252', $email_data['emails_plz']) . " " . iconv('UTF-8', 'windows-1252', $email_data['emails_ort']);
$datum = date("d.m.Y", strtotime($email_data['emails_timestamp']));
$prehead = iconv('UTF-8', 'windows-1252', $email_data['emails_ort']) . ", " . $datum;
$convort = iconv('UTF-8', 'windows-1252', $email_data['emails_ort']);

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->Image($_SERVER['DOCUMENT_ROOT'] . "/doc/{$lang}/vorlage1.png",0,0,210);
$pdf->SetFont('Arial','',4);
$pdf->Text(131,30, $addressline0);
$pdf->SetFont('Arial','',11);
$pdf->Text(131,34.1, $addressline1);
$pdf->Text(131,39.744, $addressline2);
$pdf->Text(131,45.389, $addressline3);
$pdf->SetFont('Arial','I',11);
$pdf->Text(131,51.033, "Einsendung {$thissubmit}");
$pdf->SetFont('Arial','',11);
$pdf->Text(20,$preheadY, $prehead);
$pdf->AddPage();
$pdf->Image($_SERVER['DOCUMENT_ROOT'] . "/doc/{$lang}/vorlage2.png",0,0,210);
$pdf->SetFont('Arial','B',11);
$pdf->Text(20,$lastY1, "{$addressline1}");
$pdf->SetFont('Arial','',11);
$pdf->Text(20,$lastY2, $convort);
$filename = "Antwort_{$email_data['emails_fname']}-{$email_data['emails_lname']}_{$thissubmit}_.pdf";
$filepath = $_SERVER['DOCUMENT_ROOT'] . "/doc/setup/" . $filename;
// $pdf->Output($filepath,'F');
$attachment = $pdf->Output($filename,'S');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require('../../vendor/mailer/vendor/autoload.php');


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
    $mail->setFrom($emailFromEmail, "{$email_data['emails_fname']} {$email_data['emails_lname']}");
    $mail->addAddress($emailToEmail, $emailTo);
    $mail->addCC("{$email_data['emails_email']}", "{$email_data['emails_fname']} {$email_data['emails_lname']}");
    $mail->ClearReplyTos();
    $mail->addReplyTo("{$email_data['emails_email']}", "{$email_data['emails_fname']} {$email_data['emails_lname']}");
    $mail->CharSet  = 'UTF-8';

    // Attachments
    $mail->AddStringAttachment($attachment, $filename);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $email_data['emails_subject'];
    $mail->Body    = $email_data['emails_content'];

    $mail->send();

    echo("Good");
} catch (Exception $e) {
    alert("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    echo("Bad");
}