<?php
    session_start();
    $_SESSION['id_cliente']=isset($_SESSION['id_cliente'])?$_SESSION['id_cliente']:'';
    $_SESSION['username']=isset($_SESSION['username'])?$_SESSION['username']:'';
    $_SESSION['useremail']=isset($_SESSION['useremail'])?$_SESSION['useremail']:'';
    $_SESSION['userrol']=isset($_SESSION['userrol'])?$_SESSION['userrol']:'';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Abarrotes "Lucha"</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/logopag.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main-shopcart.css">
    <link href="css/util.css" rel="stylesheet">

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
            <div class="col-lg-6 px-5 text-start">
                <b><small><i class="fa fa-map-marker-alt me-2"></i>#2305 Calle Inventada, Cedral, SLP</small></b>
                <b><small class="ms-4"><i class="fa fa-envelope me-2"></i>l18660381@matehuala.tecnm.mx</small></b>
            </div>
            <div class="col-lg-6 px-5 text-end">
                <b>
                    <small>Siguenos:</small>
                    <a class="text-body ms-3" href="https://www.facebook.com/AinzOoalGown2305"><i class="fab fa-facebook-f"></i></a>
                    <a class="text-body ms-3" href="https://twitter.com/Refugio_Rivera"><i class="fab fa-twitter"></i></a>
                    <a class="text-body ms-3" href="https://github.com/JoseRefugio2305"><i class="fab fa-linkedin-in"></i></a>
                    <a class="text-body ms-3" href="https://www.instagram.com/ainzooalgown2305/"><i class="fab fa-instagram"></i></a>
                </b>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.php" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-primary m-0">"Lucha"</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.php" class="nav-item nav-link active ">Inicio</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Acerca de</a>
                        <div class="dropdown-menu m-0">
                            <a href="about.php" class="dropdown-item">¿Quiénes somos?</a>
                            <a href="mision.php" class="dropdown-item">Misión</a>
                            <a href="valores.php" class="dropdown-item">Valores</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Productos</a>
                        <div class="dropdown-menu m-0">
                            <a href="p_fryve.php" class="dropdown-item">Frutas y Verduras</a>
                            <a href="p_lacteos.php" class="dropdown-item">Lácteos</a>
                            <a href="p_despensa.php" class="dropdown-item">Despensa</a>
                            <a href="p_golosinas.php" class="dropdown-item">Golosinas</a>
                        </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link">Contáctanos</a>
                    
                    <div class="p-4 d-lg-flex">
                        <?php
                            if($_SESSION['userrol']==1)
                            {
                        ?>
                        <a class="nav-item  btn-sm-square rounded-circle ms-3 btnnavhov" href="./PanelAdministrador/">
                            <small class="fas fa-user-shield text-body"></small>
                        </a>
                        <?php
                            }
                        ?>
                        <a class="nav-item  btn-sm-square rounded-circle ms-3 btnnavhov" href="">
                            <small class="fa fa-search text-body"></small>
                        </a>
                        <?php
                            if($_SESSION['id_cliente']=='')
                            {
                        ?>
                        
                        <a class="nav-item  btn-sm-square rounded-circle ms-3 btnnavhov" href="siginsignup.php">
                            <small class="fa fa-user text-body"></small>
                        </a>
                        <?php
                            }
                            ?>
                        <?php
                            if($_SESSION['userrol']!='')
                            {
                        ?>
                        <a class="nav-item  btn-sm-square rounded-circle ms-3 btnnavhov js-show-cart">
                            <small class="fa fa-shopping-cart text-body"></small>
                        </a>
                        <div class="nav-item dropdown">
                            <a class="nav-item  btn-sm-square rounded-circle ms-3 btnnavhov dropdown-toggle" data-bs-toggle="dropdown">
                                <small class="fa fa-user text-body"></small>
                            </a>
                            <div class="dropdown-menu m-0">
                                <a href="p_fryve.php" class="dropdown-item">Perfil</a>
                                <a href="php/logout.php" class="dropdown-item">Cerrar Sesion</a>
                            </div>
                        </div>
                        
                        <?php
                            }
                        ?>
                    </div>
                    <!-- <a class="nav-item  btn-sm-square rounded-circle ms-3 btnnavhov" href="">
                        <small class="fa fa-shopping-bag text-body"></small>
                    </a> -->
                    <!-- <div class="nav-item d-none d-lg-flex ms-2 p-4">
                        
                    </div> -->
                </div>
                
            </div>
        </nav>
    </div>
    <!-- Navbar End -->
    <?php
    include 'carrito.html';
?>