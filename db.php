<?php

function getDatabaseConnection() {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "rtmstoredb";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Nem elérhető: " . $conn->connect_error);
    }

    return $conn;
}
?>