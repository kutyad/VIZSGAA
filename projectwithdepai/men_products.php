<?php

include "header.php";


require_once 'fetch_men_products.php';
require_once 'generate_product_card.php';

$menProducts = fetchMenProducts();
?>

<section id="ferfitermekcards">
    <div class="container mt-5">
        <div class="row">
            <?php
            foreach ($menProducts as $product) {
                echo generateProductCard($product);
            }
            ?>
        </div>
    </div>
</section>