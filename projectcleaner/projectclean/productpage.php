<?php
include "header.php"
?>

    <section id="termekpage">
    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
        <div class="productermekkepadat">
        <div class="row">
            <div class="col-md-6">
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">   <!--a id="productCarousel" majd át kell írni a product Id-re mindenhol-->
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                          <a href="https://cdn.aboutstatic.com/file/images/030eb2348575a7a7edccae63eaf03903.png" target="_blank" > <!--oldal amin csak a fullscreen kep van-->
                            <img src="https://cdn.aboutstatic.com/file/images/030eb2348575a7a7edccae63eaf03903.png" class="d-block w-100" alt="Image 1">
                          </a>
                        </div>
                        <div class="carousel-item">
                          <a href="https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg" target="_blank" > <!--oldal amin csak a fullscreen kep van-->
                            <img src="https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg" class="d-block w-100" alt="Image 2">
                          </a>
                        </div>
                        <div class="carousel-item">
                          <a href="https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg" target="_blank" > <!--oldal amin csak a fullscreen kep van-->
                            <img src="https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg" class="d-block w-100" alt="Image 3">
                          </a>
                        </div>
                        <div class="carousel-item">
                          <a href="https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg" target="_blank" > <!--oldal amin csak a fullscreen kep van-->
                            <img src="https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg" class="d-block w-100" alt="Image 4">
                          </a>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </button>
                </div>

                <div class="row mt-3 thumbnails">
                    <div class="col-3">
                        <img
                            src="https://cdn.aboutstatic.com/file/images/030eb2348575a7a7edccae63eaf03903.png"
                            alt="Thumbnail 1"
                            class="thumbnail w-100"
                            data-bs-target="#productCarousel"
                            data-bs-slide-to="0"
                        />
                    </div>
                    <div class="col-3">
                        <img
                            src="https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg"
                            alt="Thumbnail 2"
                            class="thumbnail w-100"
                            data-bs-target="#productCarousel"
                            data-bs-slide-to="1"
                        />
                    </div>
                    <div class="col-3">
                        <img
                            src="https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg"
                            alt="Thumbnail 3"
                            class="thumbnail w-100"
                            data-bs-target="#productCarousel"
                            data-bs-slide-to="2"
                        />
                    </div>
                    <div class="col-3">
                        <img
                            src="https://cdn.aboutstatic.com/file/images/8a634155aad10789727ef0d73ea11816.jpeg"
                            alt="Thumbnail 4"
                            class="thumbnail w-100"
                            data-bs-target="#productCarousel"
                            data-bs-slide-to="3"
                        />
                    </div>
                </div>
            </div>
    
            <div class="col-md-6 d-flex" id="productpageadatok">
                <div class="w-100">
                    <h2>Cipzáros kapucnis felső Loose Fit</h2>
                    <p class="h4">8 495 Ft</p>
                    
                    <div class="productpageform-group">
                        <div class="form-group mb-3">
                            <label for="sizeSelect">Méret</label>
                            <select class="form-control rounded-0" id="sizeSelect">
                                <option>XS</option>
                                <option>S</option>
                                <option>M</option>
                                <option>L</option>
                                <option>XL</option>
                                <option>XXL</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="productpageform-group">
                        <div class="form-group mb-3">
                            <label for="quantityInput">Hány darab</label>
                            <input type="number" class="form-control rounded-0" id="quantityInput" value="1" min="1">
                        </div>
        
                        <p>Ebből a termékből még elérhető 50 darab</p>
                    </div>
    
                    <button class="btn btn-dark rounded-0 w-100">Kosárba tesz</button>
                </div>
            </div>
        </div>
        </div>
        </div>
    </div>
    </section>

<?php
include "footer.php"
?>