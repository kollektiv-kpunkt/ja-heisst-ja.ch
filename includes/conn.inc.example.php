<?php

$host = "";
$dbname = "";
$dbuser = "";
$dbpw = "";

$conn = mysqli_connect($host,$dbuser,$dbpw,$dbname);
$conn->set_charset("utf8");

global $conn;