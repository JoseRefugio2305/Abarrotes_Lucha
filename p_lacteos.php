<?php 
include 'navbar.php';
include 'config/bd.php';
?>
<!-- Page Header Start -->
<div class="container-fluid page-header-lacteo wow fadeIn" data-wow-delay="0.1s">
    <div class="container">
        <h1 class="display-3 mb-3 animated slideInDown">Lácteos</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a class="text-body" href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a class="text-body" href="#">Productos</a></li>
                <li class="breadcrumb-item text-dark active" aria-current="page">Lácteos</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h1 class="display-5 mb-3">Lácteos</h1>
                    <!-- <p>Tempor ut dolore lorem kasd vero ipsum sit eirmod sit. Ipsum diam justo sed rebum vero dolor duo.</p> -->
                </div>
            </div>
            <!-- <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary border-2 active" data-bs-toggle="pill" href="#tab-1">Vegetable</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-2">Fruits </a>
                    </li>
                    <li class="nav-item me-0">
                        <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-3">Fresh</a>
                    </li>
                </ul>
            </div> -->
        </div>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
                <div class="row g-4">
                            <?php
                                
                                $query = "SELECT * FROM productos WHERE id_cat=2 AND stock>0 AND is_active='1' ORDER BY id_product";
                                
                                $result = $connect->query($query);
                                while ($row = $result->fetch_array())
                                {
                            ?>
                                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="product-item">
                                            <div class="position-relative bg-light overflow-hidden">
                                                <img class="img-fluid w-100" src="<?php echo $row["url_img"];?>" alt="">
                                                <?php
                                                    if($row['descuento']>0)
                                                    {
                                                ?>
                                                        <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Descuento</div>
                                                <?php
                                                    }
                                                ?>
                                                
                                            </div>
                                            <div class="text-center p-4">
                                                <a class="d-block h5 mb-2" href="#"><?php echo $row["nombre_pr"];?></a>
                                                <?php
                                                    if($row['descuento']>0)
                                                    {
                                                ?>
                                                        <span class="text-primary me-1">$<?php echo ($row["precio_uni"]-$row["precio_uni"]*$row['descuento']);?></span>
                                                        <span class="text-body text-decoration-line-through">$<?php echo $row["precio_uni"];?></span>
                                                <?php
                                                    }
                                                    else
                                                    {
                                                ?>
                                                        <span class="text-primary me-1">$<?php echo $row["precio_uni"];?></span>
                                                <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="d-flex border-top">
                                                <!-- <small class="w-50 text-center border-end py-2">
                                                    <a class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>View detail</a>
                                                </small>
                                                <small class="w-50 text-center py-2">
                                                    <a class="text-body" href=""><i class="fa fa-shopping-bag text-primary me-2"></i>Add to cart</a>
                                                </small> -->
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>




<?php include 'footer.html';?>