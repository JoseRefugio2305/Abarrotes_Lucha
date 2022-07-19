<?php
    include 'navbar.php';
?>
<!-- Page Header Start -->
<div class="container-fluid page-header-contact wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Inicio de Sesión</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="#">Inicio</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Inicio de Sesión</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
<div class="container row" id="containerloginregist">
    <!-- <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: (500px);">
        <h1 class="display-5 mb-3">Contáctanos</h1>
        <p>Deja un mensaje o comentario acerca de la tienda</p>
    </div> -->
    <div class="col-md-6 offset-md-4" id="colloginregist">
        <div style="text-align:center;">
            <h1 class="display-5 mb-3">Bienvenido a Abarrotes "Lucha"</h1>
        </div>
        <!-- Pills navs -->
        <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <!-- <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
                aria-controls="pills-login" aria-selected="true">Login</a> -->
                <a class="list-group-item list-group-item-action active" id="tab-login" data-bs-toggle="pill" 
                href="#pills-login" role="tab" aria-controls="pills-register">Inicia Sesión</a>
            </li>
            <li class="nav-item" role="presentation">
                <!-- <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
                aria-controls="pills-register" aria-selected="false">Register</a> -->
                <a class="list-group-item list-group-item-action" id="tab-register" data-bs-toggle="pill" 
                href="#pills-register" role="tab" aria-controls="pills-register">Registrate</a>
            </li>
        </ul>
        <!-- Pills content -->
        <div class="tab-content">
        <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
            <form method="post" id="login-form"> 
                <!-- <div class="text-center mb-3">
                    <p>Sign in with:</p>
                    <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-google"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                    <i class="fab fa-github"></i>
                    </button>
                </div>

                <p class="text-center">or:</p> -->

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input require type="email" id="usuario" name="usuario" class="form-control" />
                    <label class="form-label" for="usuario">Correo o Nombre de Usuario</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input require type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Contraseña</label>
                </div>

                <!-- 2 column grid layout -->
                <div class="row mb-4">
                    <div class="col-md-6 d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-3 mb-md-0">
                        <input class="form-check-input" type="checkbox" value="" id="loginCheck" checked />
                        <label class="form-check-label" for="loginCheck"> Recuerdame </label>
                    </div>
                    </div>

                    <div class="col-md-6 d-flex justify-content-center">
                    <!-- Simple link -->
                    <a href="#!">¿Olvidaste la contraseña?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">Iniciar Sesión</a>

                <!-- Register buttons -->
                <!-- <div class="text-center">
                    <p>¿No estás resgistrado? <a class="list-group-item list-group-item-action" id="tab-register" 
                    data-bs-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register">Register</a></p>
                    
                    <p>Not a member? <a href="#pills-register">Register</a></p>
                </div> -->
            </form>
        </div>
        <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
            <form method="POST" id="formRegister">
            <!-- <div class="text-center mb-3">
                <p>Sign up with:</p>
                <button type="button" class="btn btn-link btn-floating mx-1">
                <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                <i class="fab fa-github"></i>
                </button>
            </div>

            <p class="text-center">or:</p> -->

            <!-- Name input -->
            <div class="form-outline mb-4">
                <input type="text" id="registerName" name="registerName" class="form-control" />
                <label class="form-label" for="registerName">Nombre(s)</label>
            </div>
            <div class="form-outline mb-4">
                <input type="text" id="registerapPat" name="registerapPat"class="form-control" />
                <label class="form-label" for="registerapPat">Apellido Paterno</label>
            </div>
            <div class="form-outline mb-4">
                <input type="text" id="registerapMat" name="registerapMat" class="form-control" />
                <label class="form-label" for="registerapMat">Apellido Materno</label>
            </div>

            <!-- Username input -->
            <div class="form-outline mb-4">
                <input type="text" id="registerUsername" name="registerUsername" class="form-control" />
                <label class="form-label" for="registerUsername">Nombre de Usuario</label>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="registerEmail" name="registerEmail" class="form-control" />
                <label class="form-label" for="registerEmail">Correo Electrónico</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="registerPassword" name="registerPassword" class="form-control" />
                <label class="form-label" for="registerPassword">Contraseña</label>
            </div>

            <!-- Repeat Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="registerRepeatPassword" name="registerRepeatPassword" class="form-control" />
                <label class="form-label" for="registerRepeatPassword">Repetir Contraseña</label>
            </div>

            <!-- Checkbox -->
            <!-- <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked
                aria-describedby="registerCheckHelpText" />
                <label class="form-check-label" for="registerCheck">
                Acepto términos y coniciones de uso
                </label>
            </div> -->

            <!-- Submit button -->
            <a onclick="RegisterUser()" class="btn btn-primary btn-block mb-3">Registrar</a>
            </form>
        </div>
        </div>
        <!-- Pills content -->
    </div>
</div>
<script>
    function RegisterUser()
    {
        let data = document.getElementById("formRegister")
        data = new FormData(data)
        
        const paramsregist = {
            body: data,
            method: "POST"
        }
        fetch('php/register.php',paramsregist)
            .then(response => response.json())
            .then( data => {
                console.log(data.message)
                if (data.response == "Ok") {
                    Swal.fire(
                        'Exito',
                        data.message,
                        'success'
                    )
                    setTimeout(() => {
                        location.reload()
                    },1000)
                } else {
                    Swal.fire(
                        'Error',
                        data.message,
                        'error'
                    )
                }
        })
    }
</script>
<?php
    include 'footer.html';
?>