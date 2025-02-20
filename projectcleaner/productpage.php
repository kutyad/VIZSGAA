<?php
include "header.php";


require_once 'db.php';

// id benne van e a urlbe
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Érvénytelen termék azonosító.");
}

// id url bol
$product_id = intval($_GET['id']);

require_once 'fetch_product_datas.php';

// fetch adatok
$product = fetchProductById($product_id);

// letezik e
if (!$product) {
    die("A termék nem található.");
}

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_size = $_POST['size'];
    $quantity = $_POST['quantity'];

    if (empty($quantity)) {
        $_SESSION['error'] = "Kérjük, adjon meg egy mennyiséget.";
    } else {
        $quantity = intval($quantity);
        $size_column = 'product_' . $selected_size . '_quantity';
        $available_stock = $product[$size_column];

        if ($quantity > $available_stock) {
            $_SESSION['error'] = "Nincs ennyi termék raktáron a kiválasztott méretben.";
        } else {
            // add to cart majd ide jon
            $_SESSION['success'] = "A termék sikeresen hozzáadva a kosárhoz!";
        }
    }

    // ujra bekuldest miatt ujra iranyitas
    echo "<script>window.location.href = 'productpage.php?id=$product_id';</script>";
    exit();
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // error szoveg tisztitasa oldal frissites utan
}

if (isset($_SESSION['success'])) {
    $success = $_SESSION['success'];
    unset($_SESSION['success']); // succes szoveg tisztitasa oldal frissites utan
}
?>
    <section id="termekpage">
        <div class="container mt-5">
            <div class="row justify-content-center align-items-center">
                <div class="productermekkepadat">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php
                                    $images = [
                                        $product['product_image_1'],
                                        $product['product_image_2'],
                                        $product['product_image_3'],
                                        $product['product_image_4']
                                    ];
                                    foreach ($images as $index => $image) {
                                        if (!empty($image)) {
                                            $active = ($index === 0) ? 'active' : '';
                                            echo "
                                            <div class='carousel-item $active'>
                                                <a href='$image' target='_blank'>
                                                    <img src='$image' class='d-block w-100' alt='Image " . ($index + 1) . "'>
                                                </a>
                                            </div>";
                                        }
                                    }
                                    ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                </button>
                            </div>

                            <div class="row mt-3 thumbnails">
                                <?php
                                foreach ($images as $index => $image) {
                                    if (!empty($image)) {
                                        echo "
                                        <div class='col-3'>
                                            <img
                                                src='$image'
                                                alt='Thumbnail " . ($index + 1) . "'
                                                class='thumbnail w-100'
                                                data-bs-target='#productCarousel'
                                                data-bs-slide-to='$index'
                                            />
                                        </div>";
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex" id="productpageadatok">
                            <div class="w-100">
                                <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                                <p class="h4"><?php echo number_format($product['product_price'], 0, ',', ' '); ?> FT</p>

                                <?php if (!empty($error)): ?>
                                    <div class="alert alert-danger mt-3">
                                        <?php echo $error; ?>
                                    </div>
                                <?php endif; ?>

                                <?php if (!empty($success)): ?>
                                    <div class="alert alert-success mt-3">
                                        <?php echo $success; ?>
                                    </div>
                                <?php endif; ?>                             

                                <form method="POST" action="">
                                    <div class="productpageform-group">
                                        <div class="form-group mb-3">
                                            <label for="sizeSelect">Méret</label>
                                            <select class="form-control rounded-0 text-center" id="sizeSelect" name="size">
                                                <option value="xs">XS &nbsp; | &nbsp;<?php echo $product['product_xs_quantity']; ?> darab</option>
                                                <option value="s">S &nbsp; | &nbsp;<?php echo $product['product_s_quantity']; ?> darab</option>
                                                <option value="m">M &nbsp; | &nbsp;<?php echo $product['product_m_quantity']; ?> darab</option>
                                                <option value="l">L &nbsp; | &nbsp;<?php echo $product['product_l_quantity']; ?> darab</option>
                                                <option value="xl">XL &nbsp; | &nbsp;<?php echo $product['product_xl_quantity']; ?> darab</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="productpageform-group">
                                        <div class="form-group mb-3">
                                            <label for="quantityInput">Hány darab</label>
                                            <input type="number" class="form-control rounded-0" id="quantityInput" name="quantity" value="1" min="1">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-dark rounded-0 w-100">Kosárba tesz</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include "footer.php";
?>