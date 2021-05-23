<?php
include "../../includes/conn.inc.php";
$uuid = $_POST['uuid'];
$subject = $_POST['betreff'];
$content = $_POST['content'];

if (strlen($content) > 4000) {
    echo("1");
    exit;
}

$query = "UPDATE `emails` SET emails_subject = ?, emails_content = ?  WHERE emails_UUID = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $subject, $content, $uuid);
if ($stmt->execute()) {
    echo("Good");
} else {
    echo("Bad");
};