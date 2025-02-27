<?php
    if (isset($_SESSION["username"])) {
    ?>
    <footer class="mt-auto bg-black text-center">
        <div class="container p-4">
          <div class="row">
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
              <h5 class="text-uppercase">KONTAKT</h5>
              <p><strong>Cím: </strong> Budapest, pitypang utca.</p>
              <p><strong>Telefonszám: </strong> +06 20 465 4465</p>
              <p><strong>Nyitvatartás: </strong> 10:00 - 18:00, Hétfő - Szombat</p>
            </div>
      
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
              <h5 class="text-uppercase">FIÓKOM</h5>
              <p><a class="footerlinkek" href="logout.php">Kijelentkezés</a></p>
              <p><a class="footerlinkek" href="cartpage.php">Kosár</a>
            </div>

            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
              <h5 class="text-uppercase">Vásárlás</h5>
              <p><a class="footerlinkek" href="womenpage.php">Női</a></p>
              <p><a class="footerlinkek" href="menpage.php">Férfi</a></p>
            </div>
          </div>
        </div>
        <a href="index.html"><img src="kepek/logo.PNG" width="150" height="40" class="logo "alt="Logo" style="filter: invert(1);"></a>
        <div class="text-center p-3" ><p>© 2025 Copyright: R&T&M</p></div>
    </footer>
    <?php
    } else {
    ?>
    <footer class="mt-auto bg-black text-center">
        <div class="container p-4">
          <div class="row">
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
              <h5 class="text-uppercase">KONTAKT</h5>
              <p><strong>Cím: </strong> Budapest, pitypang utca.</p>
              <p><strong>Telefonszám: </strong> +06 20 465 4465</p>
              <p><strong>Nyitvatartás: </strong> 10:00 - 18:00, Hétfő - Szombat</p>
            </div>
      
            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
              <h5 class="text-uppercase">FIÓKOM</h5>
              <p><a class="footerlinkek" href="registerform.php">Regisztráció</a></p>
              <p><a class="footerlinkek" href="cartpage.php">Kosár</a>
            </div>

            <div class="col-lg-4 col-md-12 mb-4 mb-md-0">
              <h5 class="text-uppercase">Vásárlás</h5>
              <p><a class="footerlinkek" href="womenpage.php">Női</a></p>
              <p><a class="footerlinkek" href="menpage.php">Férfi</a></p>
            </div>
          </div>
        </div>
        <a href="index.html"><img src="kepek/logo.PNG" width="150" height="40" class="logo "alt="Logo" style="filter: invert(1);"></a>
        <div class="text-center p-3" ><p>© 2025 Copyright: R&T&M</p></div>
    </footer>
    <?php } ?>
</body>
</html>