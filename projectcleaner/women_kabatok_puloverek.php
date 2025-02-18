<?php

include "header.php";


require_once 'fetch_product_datas.php';
require_once 'generate_product_card.php';

$womenKabatokPuloverek = fetchWomenKabatokPuloverek();
?>

<section id="ferfitermekcards">
    <div class="container mt-5">
        <div class="row">
            <?php
            foreach ($womenKabatokPuloverek as $product) {
                echo generateProductCard($product);
            }
            ?>
        </div>
    </div>
</section>