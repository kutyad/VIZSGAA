<?php
function generateProductCard($product) {
    $html = "
    <div class='col-6 col-sm-6 col-md-6 col-lg-4 col-xl-3'>
        <a href='product_details.php?id=" . $product['product_id'] . "' class='cardslinkek'>
            <div class='card rounded-0'>
                <div id='termek" . $product['product_id'] . "' class='carousel slide' data-bs-interval='false'>
                    <div class='carousel-inner'>
                        <div class='carousel-item active'>
                            <img src='" . $product['product_image_1'] . "' class='d-block w-100 rounded-0' alt='Slide 1'>
                        </div>
                        <div class='carousel-item'>
                            <img src='" . $product['product_image_2'] . "' class='d-block w-100 rounded-0' alt='Slide 2'>
                        </div>
                        <div class='carousel-item'>
                            <img src='" . $product['product_image_3'] . "' class='d-block w-100 rounded-0' alt='Slide 3'>
                        </div>
                        <div class='carousel-item'>
                            <img src='" . $product['product_image_4'] . "' class='d-block w-100 rounded-0' alt='Slide 4'>
                        </div>
                    </div>
                    <button class='carousel-control-prev' type='button' data-bs-target='#termek" . $product['product_id'] . "' data-bs-slide='prev'>
                        <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                    </button>
                    <button class='carousel-control-next' type='button' data-bs-target='#termek" . $product['product_id'] . "' data-bs-slide='next'>
                        <span class='carousel-control-next-icon' aria-hidden='true'></span>
                    </button>
                </div>
                <div class='card-text-box'>
                    <span class='termeknev'>" . $product['product_name'] . "</span>
                    <span class='termekar'>" . $product['product_price'] . " FT</span>
                </div>
                <button type='button' class='btn btn-dark btn-block rounded-0'>Megtekintés</button>
            </div>
        </a>
    </div>
    ";
    return $html;
}
?>