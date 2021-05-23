<?php
require('../../vendor/fpdf/fpdf.php');
include "../../includes/conn.inc.php";
include "../../includes/functions.inc.php";
include '../../includes/config.inc.php';

$uuid = $_GET['uuid'];
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
$pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/doc/vorlage1.png',0,0,210);
$pdf->SetFont('Arial','',4);
$pdf->Text(131,30, $addressline0);
$pdf->SetFont('Arial','',11);
$pdf->Text(131,34.1, $addressline1);
$pdf->Text(131,39.744, $addressline2);
$pdf->Text(131,45.389, $addressline3);
$pdf->SetFont('Arial','I',11);
$pdf->Text(131,51.033, "Einsendung {$thissubmit}");
$pdf->SetFont('Arial','',11);
$pdf->Text(20,75.545, $prehead);
$pdf->AddPage();
$pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/doc/vorlage2.png',0,0,210);
$pdf->SetFont('Arial','B',11);
$pdf->Text(20,193.5, "{$addressline1}");
$pdf->SetFont('Arial','',11);
$pdf->Text(20,199.144, $convort);
$filename = "Antwort_{$email_data['emails_fname']}-{$email_data['emails_lname']}_{$thissubmit}_.pdf";
$filepath = $_SERVER['DOCUMENT_ROOT'] . "/doc/setup/" . $filename;
$pdf->Output($filepath,'F');
?>