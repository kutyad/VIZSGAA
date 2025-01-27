<?php
include "layout/header.php";
?>

    <section id="noibanner">
        <h4>Női termékék</h4>
        <h2>Keresd meg amire vágysz!</h2>
    </section>

    <section id="horscrollmenuferfi">
        <div class="ferfigorgmenu">
            <a href="#">Kabátok & Pulóverek</a>
            <a href="#">Blúzok & Pólók</a>
            <a href="#">Nadrágok & Rövidnadrágok</a>
          </div>
    </section>

    <section id="product1" class ="section-p1">
      <h2>Női termékék</h2>
      <div class="pro-container">
      </div>
    </section>

    <section id="ferfitermekcards">
      <div class="container mt-5">
        <div class="row">
          <!-- termek kartyak -->
          <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-3">
            <a href="ferfikabatok.html" class="cardslinkek">
              <div class="card rounded-0">
                <div id="termek1" class="carousel slide" data-bs-interval="false"> <!--id="termek1" ide majd a product id-t kell beilleszteni hogy a képet és a carousel müködjön -->
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="https://cdn.aboutstatic.com/file/images/030eb2348575a7a7edccae63eaf03903.png?bg=F4F4F5&quality=75&trim=1&height=160&width=120%20120w,%20https://cdn.aboutstatic.com/file/images/030eb2348575a7a7edccae63eaf03903.png?bg=F4F4F5&quality=75&trim=1&height=294&width=220%20220w,%20https://cdn.aboutstatic.com/file/images/030eb2348575a7a7edccae63eaf03903.png?bg=F4F4F5&quality=75&trim=1&height=480&width=360%20360w,%20https://cdn.aboutstatic.com/file/images/030eb2348575a7a7edccae63eaf03903.png?bg=F4F4F5&quality=75&trim=1&height=534&width=400%20400w,%20https://cdn.aboutstatic.com/file/images/030eb2348575a7a7edccae63eaf03903.png?bg=F4F4F5&quality=75&trim=1&height=800&width=600%20600w,%20https://cdn.aboutstatic.com/file/images/030eb2348575a7a7edccae63eaf03903.png?bg=F4F4F5&quality=75&trim=1&height=1067&width=800%20800w,%20https://cdn.aboutstatic.com/file/images/030eb2348575a7a7edccae63eaf03903.png?bg=F4F4F5&quality=75&trim=1&height=1280&width=960%20960w" class="d-block w-100 rounded-0" alt="Slide 1">
                    </div>
                    <div class="carousel-item">
                      <img src="https://cdn.aboutstatic.com/file/images/f1e621cd63f4e1b733151372ffddc6ab.jpeg?quality=75&height=160&width=120%20120w,%20https://cdn.aboutstatic.com/file/images/f1e621cd63f4e1b733151372ffddc6ab.jpeg?quality=75&height=294&width=220%20220w,%20https://cdn.aboutstatic.com/file/images/f1e621cd63f4e1b733151372ffddc6ab.jpeg?quality=75&height=480&width=360%20360w,%20https://cdn.aboutstatic.com/file/images/f1e621cd63f4e1b733151372ffddc6ab.jpeg?quality=75&height=534&width=400%20400w,%20https://cdn.aboutstatic.com/file/images/f1e621cd63f4e1b733151372ffddc6ab.jpeg?quality=75&height=800&width=600%20600w,%20https://cdn.aboutstatic.com/file/images/f1e621cd63f4e1b733151372ffddc6ab.jpeg?quality=75&height=1067&width=800%20800w,%20https://cdn.aboutstatic.com/file/images/f1e621cd63f4e1b733151372ffddc6ab.jpeg?quality=75&height=1280&width=960%20960w" class="d-block w-100 rounded-0" alt="Slide 2">
                    </div>
                    <div class="carousel-item">
                      <img src="https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg?quality=75&height=160&width=120%20120w,%20https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg?quality=75&height=294&width=220%20220w,%20https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg?quality=75&height=480&width=360%20360w,%20https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg?quality=75&height=534&width=400%20400w,%20https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg?quality=75&height=800&width=600%20600w,%20https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg?quality=75&height=1067&width=800%20800w,%20https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg?quality=75&height=1280&width=960%20960w" class="d-block w-100 rounded-0" alt="Slide 3">
                    </div>
                  </div>
                  <button class="carousel-control-prev" type="button" data-bs-target="#termek1" data-bs-slide="prev">   <!-- ide is-->
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  </button>
                  <button class="carousel-control-next" type="button" data-bs-target="#termek1" data-bs-slide="next">   <!-- ide is-->
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  </button>
                </div>
                <div class="card-text-box">
                  <span class="termeknev">Férfi Kabát</span>
                  <span class="termekar">5000FT</span>
                </div>
                <button type="button" class="btn btn-dark btn-block rounded-0">Megtekintés</button>
              </div>
            </a>
          </div>
          
        </div>
      </div>
    </section>

<?php
include "layout/footer.php";
?>