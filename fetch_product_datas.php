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

function fetchWomenProducts() {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetWomenProducts()");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $products;
}

function fetchMenKabatokPuloverek() {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetMenKabatokPuloverek()");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $products;
}

function fetchMenIngekPolok() {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetMenIngekPolok()");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $products;
}

function fetchMenNadragokRovidnadragok() {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetMenNadragokRovidnadragok()");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $products;
}

function fetchWomenNadragokRovidnadragok() {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetWomenNadragokRovidnadragok()");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $products;
}

function fetchWomenKabatokPuloverek() {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetWomenKabatokPuloverek()");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $products;
}

function fetchWomenBluzokPolok() {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetWomenBluzokPolok()");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $products;
}

function fetchNewestMenProducts() {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetNewestMenProducts()");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $products;
}

function fetchNewestWomenProducts() { 
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetNewestWomenProducts()");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
    $conn->close();
    return $products;
}

function fetchProductById($product_id) {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL GetProductById(?)");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $product;
}
?>