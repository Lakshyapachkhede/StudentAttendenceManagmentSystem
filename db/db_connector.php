<?php

date_default_timezone_set("Asia/Kolkata");

$host = 'sql111.infinityfree.com';
$db   = 'if0_39300006_samdb';
$user = 'if0_39300006';
$pass = 'xE6SAre5wACFKP';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>




