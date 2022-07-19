<?php
    include 'navbar.php';
?>
    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Error 404</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Inicio</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="#">Páginas</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Error 404</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- 404 Start -->
    <div class="container-xxl py-6 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
                    <h1 class="display-1">404</h1>
                    <h1 class="mb-4">Página no encontrada</h1>
                    <p class="mb-4">Lo sentimos. La página que intentas búscar no existe. ¿Quieres regresar al inicio?</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php">Regresar al Inicio</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 End -->
        

    <?php include 'footer.html';?>