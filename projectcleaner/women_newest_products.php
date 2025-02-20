<?php

include "header.php";


require_once 'fetch_product_datas.php';
require_once 'generate_product_card.php';

$NewestWomenProducts = fetchNewestWomenProducts(); 
?>

<section id="ferfitermekcards">
    <div class="container mt-5">
        <div class="row">
            <?php
            foreach ($NewestWomenProducts as $product) {
                echo generateProductCard($product);
            }
            ?>
        </div>
    </div>
</section>