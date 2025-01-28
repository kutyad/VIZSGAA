<?php
session_start();

$authenticated = false;
if (isset($_SESSION["email"])) {
  $authenticated = true;
}?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R&T&M</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <section id="header2">
        <a href="index.html"><img src="usedkepek/logo.PNG" width="150" height="40" class="logo "alt="Logo"></a>

    </section>


    <section id="header">
        <div>
            <ul id="navbar">
                <li><a href="index.php">Főoldal</a></li>
                <li><a href="ferfi.php">Férfi ruhák</a></li>
                <li><a href="no.php">Női ruhák</a></li>
            </ul>
        </div>
        <div>   
            <ul id="navbar2">    
                <div class="dropdown-center">
                  <li class="nav-item dropdown dropdown-center">
                    <?php
                    if ($authenticated) {
                    ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $_SESSION["first_name"] ?>&nbsp;<?= $_SESSION["last_name"] ?></a>
                    <div class="dropdown-menu rounded-0 border border-dark" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="logout.php">Kijelentkezés</a>
                      <?php
                      } else {
                      ?>
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/></svg></a>
                    <div class="dropdown-menu rounded-0 border border-dark" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="Bejelentkezes.php">Bejelentkezés</a>
                        <a class="dropdown-item" href="Regisztracio.php">Regisztráció</a>
                      <?php } ?>
                      </div>
                    </li>
                </div>
                <li><a href="kosar.html"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16"><path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/></svg></a></li>
            </ul>
        </div>
        <div class="container-fluid mt-3">
            <button class="btn bg-transparent border-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-list" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/></svg></button>
          </div>
          <div class="offcanvas offcanvas-start" id="demo">
            <div class="offcanvas-header">
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul>
                    <li><a href="index.php">Főoldal</a></li>
                    <li><a href="ferfi.php">Férfi ruhák</a></li>
                    <li><a href="no.php">Női ruhák</a></li>
                </ul>
            </div>
          </div>
    </section>