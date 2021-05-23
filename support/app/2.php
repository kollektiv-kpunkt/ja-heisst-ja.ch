<?php
include "../../includes/conn.inc.php";
include "../../includes/functions.inc.php";
$uuid = $_POST['uuid'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$adresse = $_POST['adresse'];
$plz = $_POST['plz'];
$ort = $_POST['ort'];

// $dbadresse = "{$adresse}, {$plz} {$ort} CH";
// $lookup = urlencode($dbadresse);

// $responseJSON = file_get_contents("http://api.positionstack.com/v1/forward?access_key=8f76e9b4be96d00bef88dc297452a1a4&query={$lookup}&limit=1&output=json");

// $response = json_decode($responseJSON, true);

// $lat = $response["data"][0]["latitude"];
// $long = $response["data"][0]["longitude"];

// $query = "UPDATE `locations` SET locations_adresse = ?, locations_lat = ?, locations_long = ?  WHERE locations_UUID = ?";

// $stmt = $conn->prepare($query);
// $stmt->bind_param("ssss", $dbadresse, $lat, $long, $uuid);
// $stmt->execute();

$query = "UPDATE `emails` SET emails_fname = ?, emails_lname = ?, emails_email = ?, emails_adresse = ?, emails_plz = ?, emails_ort = ?  WHERE emails_UUID = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("sssssss", $fname, $lname, $email, $adresse, $plz, $ort, $uuid);
if ($stmt->execute()) {
    echo("Good");
} else {
    echo("Bad");
};