<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["username"]) || $_SESSION["is_admin"] != 1) {
    header("Location: index.php");
    exit();
}

require_once 'db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_xs_quantity = $_POST["product_xs_quantity"];
    $product_s_quantity = $_POST["product_s_quantity"];
    $product_m_quantity = $_POST["product_m_quantity"];
    $product_l_quantity = $_POST["product_l_quantity"];
    $product_xl_quantity = $_POST["product_xl_quantity"];
    $gender = $_POST["gender"];
    $category = $_POST["category"];

    $product_image_1 = uploadImage($_FILES["product_image_1"]);
    $product_image_2 = uploadImage($_FILES["product_image_2"]);
    $product_image_3 = uploadImage($_FILES["product_image_3"]);
    $product_image_4 = uploadImage($_FILES["product_image_4"]);

    $conn = getDatabaseConnection();

    $stmt = $conn->prepare("CALL InsertProduct(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sissssiiiiiss",
        $product_name,
        $product_price,
        $product_image_1,
        $product_image_2,
        $product_image_3,
        $product_image_4,
        $product_xs_quantity,
        $product_s_quantity,
        $product_m_quantity,
        $product_l_quantity,
        $product_xl_quantity,
        $gender,
        $category
    );

    if ($stmt->execute()) {
        echo "Termék sikeresen hozzáadva!";
    } else {
        echo "Hiba: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

function uploadImage($file) {
    if ($file["error"] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file["name"]);
        move_uploaded_file($file["tmp_name"], $target_file);
        return $target_file;
    }
    return null;
}
?>

<?php
include "header.php";

include "loginform.php";
?>
<section id="cartpart">
<div class="cart-section">
    <div class="container mt-5">
        <h1>Új termék hozzáadása</h1>
        <form action="add_product.php" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="product_name" class="form-label text-light">Termék neve</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required>
            </div>

            <div class="mb-3">
                <label for="product_price" class="form-label text-light">Ár (HUF)</label>
                <input type="number" class="form-control" id="product_price" name="product_price" required>
            </div>

            <div class="mb-3">
                <label for="product_image_1" class="form-label text-light">1. kép</label>
                <input type="file" class="form-control" id="product_image_1" name="product_image_1" required>
            </div>
            <div class="mb-3">
                <label for="product_image_2" class="form-label text-light">2. kép</label>
                <input type="file" class="form-control" id="product_image_2" name="product_image_2" required>
            </div>
            <div class="mb-3">
                <label for="product_image_3" class="form-label text-light">3. kép</label>
                <input type="file" class="form-control" id="product_image_3" name="product_image_3" required>
            </div>
            <div class="mb-3">
                <label for="product_image_4" class="form-label text-light">4. kép</label>
                <input type="file" class="form-control" id="product_image_4" name="product_image_4" required>
            </div>

            <div class="mb-3">
                <label for="product_xs_quantity" class="form-label text-light">XS méret mennyiség</label>
                <input type="number" class="form-control" id="product_xs_quantity" name="product_xs_quantity" required>
            </div>
            <div class="mb-3">
                <label for="product_s_quantity" class="form-label text-light">S méret mennyiség</label>
                <input type="number" class="form-control" id="product_s_quantity" name="product_s_quantity" required>
            </div>
            <div class="mb-3">
                <label for="product_m_quantity" class="form-label text-light">M méret mennyiség</label>
                <input type="number" class="form-control" id="product_m_quantity" name="product_m_quantity" required>
            </div>
            <div class="mb-3">
                <label for="product_l_quantity" class="form-label text-light">L méret mennyiség</label>
                <input type="number" class="form-control" id="product_l_quantity" name="product_l_quantity" required>
            </div>
            <div class="mb-3">
                <label for="product_xl_quantity" class="form-label text-light">XL méret mennyiség</label>
                <input type="number" class="form-control" id="product_xl_quantity" name="product_xl_quantity" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label text-light">Nem</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="Férfi">Férfi</option>
                    <option value="Nő">Nő</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label text-light">Kategória</label>
                <select class="form-select" id="category" name="category" required>
                    <option value="Kabátok & Pulóverek">Kabátok & Pulóverek</option>
                    <option value="Ingek & Pólók">Ingek & Pólók</option>
                    <option value="Nadrágok & Rövidnadrágok">Nadrágok & Rövidnadrágok</option>
                    <option value="Blúzok & Pólók">Blúzok & Pólók</option>
                </select>
            </div>

            <button type="submit" class="btn btn-dark">Termék hozzáadása</button>
        </form>
    </div>
</div>
</section>

</body>
</html>