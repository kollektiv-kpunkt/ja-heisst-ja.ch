<?php
require "conn.inc.php";

function plzlookup($plz, $conn) {
    $query = "SELECT `ort` FROM `plz` WHERE `plz` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $plz);
    $stmt->execute();
    $result = mysqli_fetch_assoc($stmt->get_result());
    return $result['ort'];
}

function addToSerial($serializedArray, $item)
{
   $array = unserialize($serializedArray);
   $array[] = $item;
   return serialize($array);
}

function getEmail ($conn, $uuid)
{
    $query = "SELECT * FROM `emails` WHERE `emails_UUID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $uuid);
    $stmt->execute();
    $email = mysqli_fetch_assoc($stmt->get_result());
    return $email;
}

function countSubmits ($conn) {
    $query = "SELECT `emails_uuid` FROM emails WHERE `emails_sent` = 1;";
    $result = $conn->query($query);
    $row = mysqli_num_rows($result);
    return $row;
}

function alert ($msg) {
    echo("<script>alert('{$msg}')</script>");
}