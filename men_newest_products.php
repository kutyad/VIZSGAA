<?php
require_once 'fetch_product_datas.php';
require_once 'generate_product_card.php';

$NewestMenProducts = fetchNewestMenProducts(); 
?>

    <section id="ferfiujtermekekindex" class ="section-p1">
        <h2>Új Férfi ruhák</h2>
        <h4>Most érkezett</h4>
    </section>

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