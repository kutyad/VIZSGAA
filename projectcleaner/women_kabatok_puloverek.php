<?php
require_once 'fetch_product_datas.php';
require_once 'generate_product_card.php';

$womenKabatokPuloverek = fetchWomenKabatokPuloverek();
?>

    <section id="ferfiujtermekekindex" class ="section-p1">
        <h2>Női ruhák</h2>
        <h4>Kabátok & Pulóverek</h4>
    </section>

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