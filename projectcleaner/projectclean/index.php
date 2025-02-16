<?php
include "header.php";
?>

    <section id="carouselresz">
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="kepek/ferfi.PNG" class="d-block w-100" alt="Férfi kabátok">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h5>Férfi termékek</h5>
                    <h1>Kabátok & Pulóverek</h1>
                    <a href="#" class="btn btn-primary rounded-0">Vásárlás</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="kepek/no.PNG" class="d-block w-100" alt="Női kábatok">
                <div class="carousel-overlay"></div>
                <div class="carousel-caption">
                    <h5>Női termékek</h5>
                    <h1>Kabátok & Pulóverek</h1>
                    <a href="#" class="btn btn-light rounded-0">Vásárlás</a>
                </div>
            </div>
            <div class="carousel-item">
              <img src="kepek/ferfiingek.PNG" class="d-block w-100" alt="Női kábatok">
              <div class="carousel-overlay"></div>
              <div class="carousel-caption">
                  <h5>Férfi termékek</h5>
                  <h1>Ingek & Pólók</h1>
                  <a href="#" class="btn btn-light rounded-0">Vásárlás</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="kepek/no.PNG" class="d-block w-100" alt="Női kábatok">
              <div class="carousel-overlay"></div>
              <div class="carousel-caption">
                  <h5>Női termékek</h5>
                  <h1>Blúzok & Pólók</h1>
                  <a href="#" class="btn btn-light rounded-0">Vásárlás</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="no.PNG" class="d-block w-100" alt="Női kábatok">
              <div class="carousel-overlay"></div>
              <div class="carousel-caption">
                  <h5>Férfi termékek</h5>
                  <h1>Nadrágok & Rövidnadrágok</h1>
                  <a href="#" class="btn btn-light rounded-0">Vásárlás</a>
              </div>
            </div>
            <div class="carousel-item">
              <img src="no.PNG" class="d-block w-100" alt="Női kábatok">
              <div class="carousel-overlay"></div>
              <div class="carousel-caption">
                  <h5>Női termékek</h5>
                  <h1>Nadrágok & Rövidnadrágok</h1>
                  <a href="#" class="btn btn-light rounded-0">Vásárlás</a>
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
            <a href="ferfi.php" class="cardslinkek">
            <div class="card rounded-0">
              <img src="kepek/ferfi1.avif" class="card-img-top rounded-0" alt="ferfi">
              <div class="card-text-box">
                Férfi ruhák
              </div>
            </div>
            </a>
          </div>
          <div class="col-md-6">
            <a href="no.php" class="cardslinkek">
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
      include "mannew.php";
      ?>
      
      <?php
    include "nonew.php"
      ?>




<?php
include "footer.php";
?>