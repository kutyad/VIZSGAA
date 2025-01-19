<?php
function getDatabaseConnection() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "storedb";

    // Kapcsolat létrehozása
    $connection = new mysqli($servername, $username, $password, $database);

    // Hibakezelés
    if ($connection->connect_error) {
        die("MySQL connect fail: " . $connection->connect_error);
    }

    return $connection;
}
?>
