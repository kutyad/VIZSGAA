<?php
require_once 'fetch_product_datas.php';
require_once 'generate_product_card.php';

$womenBluzokPolok = fetchWomenBluzokPolok();
?>

    <section id="product1" class ="section-p1">
        <h2>Női ruhák</h2>
        <h4>Blúzok & Pólók</h4>
    </section>

<section id="ferfitermekcards">
    <div class="container mt-5">
        <div class="row">
            <?php
            foreach ($womenBluzokPolok as $product) {
                echo generateProductCard($product);
            }
            ?>
        </div>
    </div>
</section>