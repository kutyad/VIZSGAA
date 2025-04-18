<?php
include "header.php";

include "loginform.php";
?>

    <section id="carouselresz">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="kepek/7efd95c58b0e55276c876895638bfde5.jpg" class="d-block w-100" alt="Férfi kabátok">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h5>Férfi termékek</h5>
                    <h1>Kabátok & Pulóverek</h1>
                    <a href="menpage.php" class="btn btn-primary rounded-0">Vásárlás</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="kepek/no.PNG" class="d-block w-100" alt="Kabátok & Pulóverek">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h5>Női termékek</h5>
                    <h1>Kabátok & Pulóverek</h1>
                    <a href="womenpage.php" class="btn btn-light rounded-0">Vásárlás</a>
                </div>
            </div>
            <div class="carousel-item">
              <img src="kepek/ferfiingek.PNG" class="d-block w-100" alt="Ingek & Pólók">
              <div class="carousel-overlay"></div>
              <div class="carousel-caption">
                  <h5>Férfi termékek</h5>
                  <h1>Ingek & Pólók</h1>
                  <a href="mencategorypolokingek.php" class="btn btn-light rounded-0">Vásárlás</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="kepek/03a0648c8c34dc1cc88066c738746100.jpg" class="d-block w-100" alt="Blúzok & Pólók">
              <div class="carousel-overlay"></div>
              <div class="carousel-caption">
                  <h5>Női termékek</h5>
                  <h1>Blúzok & Pólók</h1>
                  <a href="womenbluzokpolok.php" class="btn btn-light rounded-0">Vásárlás</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="kepek/3e34aaac638eb7d3e1a440ea96fd1d8b.jpg" class="d-block w-100" alt="Nadrágok & Rövidnadrágok">
              <div class="carousel-overlay"></div>
              <div class="carousel-caption">
                  <h5>Férfi termékek</h5>
                  <h1>Nadrágok & Rövidnadrágok</h1>
                  <a href="mencategorynadragok.php" class="btn btn-light rounded-0">Vásárlás</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="kepek/26eb6a18ebe3bf09fd22a8190c1f4d06.jpg" class="d-block w-100" alt="Nadrágok & Rövidnadrágok">
              <div class="carousel-overlay"></div>
              <div class="carousel-caption">
                  <h5>Női termékek</h5>
                  <h1>Nadrágok & Rövidnadrágok</h1>
                  <a href="womennadragok.php" class="btn btn-light rounded-0">Vásárlás</a>
              </div>
            </div>
        </div>
    
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Vissza</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Következő</span>
        </button>
    </div>
    </section>

    <section class="indexferficards">
    <div class="container mt-5">
        <div class="row mb-3">
          <div class="col-md-6">
            <a href="menpage.php" class="cardslinkek">
            <div class="card rounded-0">
              <img src="kepek/ferfi1.avif" class="card-img-top rounded-0" alt="ferfi">
              <div class="card-text-box">
                Férfi ruhák
              </div>
            </div>
            </a>
          </div>
          <div class="col-md-6">
            <a href="womenpage.php" class="cardslinkek">
            <div class="card rounded-0">
              <img src="kepek/no1.avif" class="card-img-top rounded-0" alt="no">
              <div class="card-text-box">
                Női ruhák
              </div>
            </div>
            </a>
          </div>
        </div>
    </section>

    <?php 
      include "men_newest_products.php";
      ?>
      
      <?php
      include "women_newest_products.php"
      ?>

<?php
include "footer.php";
?>