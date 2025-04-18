<?php
include "header.php";
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: registerform.php");
    exit();
}

if (isset($_GET['delete'])) {
    $conn = getDatabaseConnection();
    $stmt = $conn->prepare("CALL RemoveFromCart(?)");
    $stmt->bind_param("i", $_GET['delete']);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: cartpage.php");
    exit();
}

$conn = getDatabaseConnection();
$stmt = $conn->prepare("CALL GetUserCart(?)");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$cart_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();

$total_price = 0;
foreach ($cart_items as $item) {
    $total_price += $item['product_price'] * $item['quantity'];
}
?>

<section id="cartpart">
    <div class="cart-section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="p-4 bg-light border rounded-0 shadow-sm cartbigbox">
                        <h2 class="mb-3">Kosár</h2>

                        <?php if (empty($cart_items)): ?>
                            <div class="text-center py-4">
                                <h4>A kosár üres!</h4>
                            </div>
                        <?php else: ?>
                            <div class="cart-items-container">
                                <?php foreach ($cart_items as $item): ?>
                                    <div class="cart-item border-top pt-3 border-bottom pb-3">
                                        <div class="d-flex flex-nowrap overflow-x-auto">
                                            <img src="<?= $item['product_image_1'] ?>" alt="Termék képe" class="me-3" style="width: 80px; height: 105px; flex-shrink: 0;">
                                            <div class="d-flex flex-nowrap align-items-center gap-4" style="flex-shrink: 0;">
                                                <span class="fw-bold"><?= htmlspecialchars($item['product_name']) ?></span>
                                                <span>Ár: <?= number_format($item['product_price'], 0, ',', ' ') ?> Ft</span>
                                                <span>Mennyiség: <?= $item['quantity'] ?></span>
                                                <span>Méret: <?= strtoupper($item['size']) ?></span>
                                                <a href="cartpage.php?delete=<?= $item['cart_id'] ?>" class="btn rounded-0 btn-dark">Törlés</a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="p-4 bg-light border rounded-0 shadow-sm">
                        <h4>Összegzés</h4>
                        <p><b>Ár:</b> <?= number_format($total_price, 0, ',', ' ') ?> Ft</p>
                        <p><b>Teljes ár:</b> <?= number_format($total_price, 0, ',', ' ') ?> Ft</p>
                        <a href="checkoutpage.php" class="btn btn-dark rounded-0 w-100 pt-3 pb-3 <?= empty($cart_items) ? 'disabled' : '' ?>">Fizetés</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include "footer.php"; ?>
