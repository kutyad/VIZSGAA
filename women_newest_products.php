<?php
require_once 'fetch_product_datas.php';
require_once 'generate_product_card.php';

$NewestWomenProducts = fetchNewestWomenProducts(); 
?>

    <section id="ferfiujtermekekindex" class ="section-p1">
        <h2>Új Női ruhák</h2>
        <h4>Most érkezett</h4>
    </section>

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