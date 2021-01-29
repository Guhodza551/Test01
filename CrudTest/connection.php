<?php

$servername = "localhost";
$username = "eng_thatawat-t";
$password = "64cSAeMAvZ";
$dbname = "eng_thatawat-t";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOEXCEPTION $e) {
    echo "Connection failed". $e->getMessage();
    exit();
        }
?>