<?php
require_once 'db.php'; 

function fetchMenProducts() {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetMenProducts()");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $products;
}
?>