<?php
include "../../includes/conn.inc.php";
$uuid = $_POST['uuid'];
if (isset($_POST['reaosns'])){
    $reasons = $_POST['reasons'];
} else {
    $reasons = 0;
}

$query = "UPDATE `emails` SET emails_reasons = ?  WHERE emails_UUID = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $reasons, $uuid);
if ($stmt->execute()) {
    echo("Good");
} else {
    echo("Bad");
};