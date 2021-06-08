<?php
include __DIR__ . "/../includes/config.inc.php";
include __DIR__ . "/../includes/conn.inc.php";
include __DIR__ . "/../i18n/{$lang}.php";

$uuid = $_POST["uuid"];
$address = $_POST["address"];
$plz = $_POST["plz"];
$place = $_POST["place"];
if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];
} else {
    $phone = "";
}


$sql = "UPDATE `activists` SET `activist_address` = ?, `activist_plz` = ?, `activist_ort` = ?, `activist_phone` = ? WHERE `activist_UUID` = ?;";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $address, $plz, $place, $phone, $uuid);

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