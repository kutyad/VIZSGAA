<?php

include "header.php";


require_once 'fetch_product_datas.php';
require_once 'generate_product_card.php';

$NewestMenProducts = fetchNewestMenProducts(); 
?>

<section id="ferfitermekcards">
    <div class="container mt-5">
        <div class="row">
            <?php
            foreach ($NewestMenProducts as $product) {
                echo generateProductCard($product);
            }
            ?>
        </div>
    </div>
</section>