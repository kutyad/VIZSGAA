<?php
require_once 'fetch_product_datas.php';
require_once 'generate_product_card.php';

$menProducts = fetchMenProducts();
?>

    <section id="product1" class ="section-p1">
      <h2>Férfi ruhák</h2>
    </section>

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