<?php
include __DIR__ . "/../includes/config.inc.php";
include __DIR__ . "/../includes/conn.inc.php";
include __DIR__ . "/../i18n/{$lang}.php";

$uuid = $_POST["uuid"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$anrede = $_POST["anrede"];


$sql = "INSERT INTO `activists` (`activist_UUID`, `activist_anrede`, `activist_fname`, `activist_lname`, `activist_email`, `activist_lang`) VALUES (?,?,?,?,?,?) ON DUPLICATE KEY UPDATE `activist_UUID`=`activist_UUID`;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $uuid, $anrede, $fname, $lname, $email, $lang);

$result = $stmt->execute();

if ($result == 1) {
    $response = array(
        "code" => 200,
        "type" => "success",
        "text" => "",
        "uuid" => $uuid
    );
} else {
    $response = array(
        "code" => 1,
        "type" => "error",
        "text" => $i18n["e-unknown"],
        "uuid" => $uuid
    );
}

header('Content-type: application/json');
echo(json_encode($response));

?>