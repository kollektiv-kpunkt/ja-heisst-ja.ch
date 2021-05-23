<?php
include "../../includes/conn.inc.php";
include "../../includes/config.inc.php";
include "../../includes/functions.inc.php";

$uuid = $_POST['uuid'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$plz = $_POST['plz'];
if (isset($_POST['optin'])) {
    $optin = 1;
} else {
    $optin = 0;
}
$ort = plzlookup($_POST['plz'], $conn);

$query = "SELECT * from `signups` WHERE signups_email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$numrows = $stmt->num_rows;

// print_r($numrows);

if ($numrows != 0) {
    echo("403");
    exit();
}

$query = "INSERT into `signups` (signups_UUID, signups_fname, signups_lname, signups_email, signups_plz, signups_ort, signups_optin, signups_lang) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssss", $uuid, $fname, $lname, $email, $plz, $ort, $optin, $lang);
if ($stmt->execute()) {
    $status = "Good";
} else {
    $status = "Bad";
}
echo $status;