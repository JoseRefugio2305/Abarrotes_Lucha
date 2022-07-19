<?php
    include 'navbar.php';
    include 'config/bd.php';
?>


    <!-- Page Header Start -->
    <div class="container-fluid page-header-contact wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Contáctanos</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Inicio</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Contáctanos</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Contáctanos</h1>
                <p>Deja un mensaje o comentario acerca de la tienda</p>
            </div>
            <div class="row g-5 justify-content-center">
                <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-primary text-white d-flex flex-column justify-content-center h-100 p-5">
                        <h5 class="text-white">Llamanos</h5>
                        <p class="mb-5"><i class="fa fa-phone-alt me-3"></i>(+52) 488 123 94 68</p>
                        <h5 class="text-white">Nuestro correo</h5>
                        <p class="mb-5"><i class="fa fa-envelope me-3"></i>l18660381@matehuala.tecnm.mx</p>
                        <h5 class="text-white">Dirección de la tienda</h5>
                        <p class="mb-5"><i class="fa fa-map-marker-alt me-3"></i>#267, Gral. Anaya, Zona Centro</p>
                        <h5 class="text-white">Siguenos</h5>
                        <div class="d-flex pt-2">
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <!-- <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p> -->
                    <form method="POST" id="formComment">
                        <div class="row g-3">
                            <?php
                                if($_SESSION['id_cliente']=='')
                                {
                            ?>
                                <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text"  require class="form-control" id="name" name="name" placeholder="Nombre(s)">
                                    <label for="name">Nombre(s)</label>
                                </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text"  require class="form-control" id="lastname" name="lastname" placeholder="Apellido(s)">
                                        <label for="lastname">Apellido(s)</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="email" require  class="form-control" id="email" name="email" placeholder="Correo">
                                        <label for="email">Correo</label>
                                    </div>
                                </div>
                            <?php
                                }
                                else
                                {
                                    $queryuser="SELECT * FROM usuarios WHERE id_usuario=\"$_SESSION[id_cliente]\"";
                                    $results=$connect->query($queryuser);
                                    while($row=$results->fetch_array())
                                    {
                                        
                            ?>
                                <input type="hidden" id="name" name="name" value="<?php echo $row['nombre'];?>">
                                <input type="hidden" id="lastname" name="lastname" value="<?php echo $row['ap_pat'].' '.$row['ap_mat'];?>">
                                <input type="hidden" id="email" name="email" value="<?php echo $row['email'];?>">
                                <p>Publicando comentario como: <?php echo $row['nombre'].' '.$row['ap_pat'].' '.$row['ap_mat'];?></p>

                            <?php
                                    }
                                }
                            ?>
                            
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text"  require class="form-control" id="asunto" name="asunto" placeholder="Asunto">
                                    <label for="asunto">Asunto</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" require placeholder="Deja tu comentario" id="comentario" name="comentario" style="height: 200px;resize: none;"></textarea>
                                    <label for="comentario">Mensaje</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <a class="btn btn-primary rounded-pill py-3 px-5" onclick="Comment()">Enviar Mensaje</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Google Map Start -->
    <div class="container-xxl px-0 wow fadeIn" data-wow-delay="0.1s" style="margin-bottom: -6px;">
        <iframe class="w-100" style="height: 450px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1564.3990575018167!2d-100.73096486242338!3d23.824491338314957!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x868753becabd79d1%3A0xead0ee597e3c023!2sAbarrotes%20Lucha!5e0!3m2!1ses-419!2smx!4v1652319358122!5m2!1ses-419!2smx"
            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            
    </div>
    <!-- Google Map End -->

    <script>
        function Comment()
        {
            data = document.getElementById('formComment')
            data= new FormData(data)
            const paramsCom={
                body:data,
                method:"POST"
            }
            fetch('php/addComent.php', paramsCom)
                .then(response => response.json())
                .then( data => {
                    if(data.response=='Ok')
                    {
                        Swal.fire(
                            'Exito',
                            data.message,
                            'success'
                        )
                        setTimeout(() => {
                            window.location.href= 'index.php'
                        },1000)
                    }
                    else
                    {
                        Swal.fire(
                            'Error',
                            data.message,
                            'error'
                        )
                    }
                })
        }
    </script>
    <?php include 'footer.html';?>