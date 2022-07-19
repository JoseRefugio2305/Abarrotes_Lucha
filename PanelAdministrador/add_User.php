<?php
    include 'templates/navbar.php';
    include "../config/bd.php"
?>
<div id="layoutSidenav">
<div id="layoutSidenav_nav">
<?php
    include 'templates/menulateral.php';
?>
</div>
<div id="layoutSidenav_content">
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Agregar Usuario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item"><a href="tables_users.php">Usuarios</a></li>
            <li class="breadcrumb-item active">Agregar Usuarios</li>
        </ol>
        <div class="card col-md-8 offset-md-2">
            <div class="card-header text-center">
                <h3>
                Agregar Usuarios
                </h3>
            </div>
            <div class="card-body">
                <?php
                    include 'templates/svg.html';
                ?>
                <form method="POST" id="formaddUser">
                    <div class="mb-3">
                        <label for="userNamePila" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="userNamePila" name="userNamePila" require placeholder="Nombre del Usuario">
                    </div>
                    <div class="mb-3">
                        <label for="aptpat" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="aptpat" name="aptpat" require placeholder="Apellido Paterno">
                    </div>
                    <div class="mb-3">
                        <label for="aptmat" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="aptmat" name="aptmat" require placeholder="Apellido Materno">
                    </div>
                    <div class="mb-3">
                        <label for="userName" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="userName" name="userName" require placeholder="Nombre de Usuario">
                        <label for="useremail" class="form-label">Correo Electronico</label>
                        <input type="email" class="form-control" id="useremail" name="useremail"require placeholder="Email">
                        <label for="userpass" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="userpass" name="userpass"require placeholder="Contraseña">
                        
                        <input type="hidden" name="operation" id="operation" value="addUser">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" require name="selectrol">
                            <option selected>Rol de Usuario</option>
                            <?php 
                                $querycat = "SELECT * FROM rol";
                                $categorias = $connect->query($querycat);
                                while ($categoria = $categorias->fetch_array())
                                {
                            ?>
                                <option value="<?php echo $categoria['id_rol']?>"><?php echo $categoria['nombre_rol']?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-success" type="submit"onclick="addUser()">Agregar</a>
                    </div>
                </form>
            </div>
        </div>
        
        <script>
            function addUser()
            {
                data=document.getElementById('formaddUser')
                data = new FormData(data)
                const params={
                    body:data,
                    method:'POST'
                }
                document.getElementById("cargando").style.display='';
                document.getElementById("formaddUser").style.display='none';
                versvg()
                fetch('php/addeditUser.php',params)
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
                                window.location.href= 'tables_users.php'
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

    </div>
</main>

<?php
    include 'templates/footer.php';
?>
