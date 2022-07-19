<?php
    include 'templates/navbar.php';
    include "../config/bd.php";
?>
<div id="layoutSidenav">
<div id="layoutSidenav_nav">
<?php
    include 'templates/menulateral.php';
?>
</div>
<div id="layoutSidenav_content">
<main>
    <?php
    $query = "SELECT u.id_usuario, u.nombre,u.ap_pat,u.ap_mat, u.user_name, u.email,r.id_rol, r.nombre_rol, u.password 
    FROM usuarios AS u INNER JOIN rol AS r ON u.user_rol=r.id_rol
    WHERE u.is_active='1' AND u.id_usuario=\"$_GET[iduser]\"";
    $result = $connect->query($query);
    if($result->num_rows==0)
    {
    ?>
        <script>
            window.location.href= 'tables_users.php';
        </script>
    <?php
    }
    ?>
    <?php
    $data=$result->fetch_assoc();
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Usuario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item"><a href="tables_users.php">Usuarios</a></li>
            <li class="breadcrumb-item active">Editar Usuario</li>
        </ol>
        <div class="card col-md-8 offset-md-2">
            <div class="card-header text-center">
                <h3>
                Editar Usuario
                </h3>
            </div>
            <div class="card-body">
                <?php
                    include 'templates/svg.html';
                ?>
                <form method="POST" id="formEditUser">
                    <div class="mb-3">
                        <label for="userNamePila" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="userNamePila" name="userNamePila" require placeholder="Nombre del Usuario" value="<?php echo $data['nombre'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="aptpat" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="aptpat" name="aptpat" require placeholder="Apellido Paterno" value="<?php echo $data['ap_pat'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="aptmat" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="aptmat" name="aptmat" require placeholder="Apellido Materno" value="<?php echo $data['ap_mat'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="userName" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="userName" name="userName" require placeholder="Nombre de Usuario" value="<?php echo $data['user_name'];?>">
                        <label for="useremail" class="form-label">Correo Electronico</label>
                        <input type="email" class="form-control" id="useremail" name="useremail"require placeholder="Correo Electronico" value="<?php echo $data['email'];?>">
                        <label for="userpass" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="userpass" name="userpass"require placeholder="Contraseña" value="<?php echo $data['password'];?>">
                        
                        <input type="hidden" name="operation" id="operation" value="editUser">
                        <input type="hidden" name="iduseredit" id="iduseredit" value="<?php echo $_GET['iduser'];?>">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" require name="selectrol">
                
                            <?php 
                                $querycat = "SELECT * FROM rol";
                                $roles = $connect->query($querycat);
                                while ($rol = $roles->fetch_array())
                                {
                                    if($data['id_rol']== $rol['id_rol'])
                                    {
                            ?>
                                <option selected value="<?php echo $rol['id_rol']?>"><?php echo $rol['nombre_rol']?></option>
                            <?php
                                    }
                                    else
                                    {
                            ?>
                                <option value="<?php echo $rol['id_rol']?>"><?php echo $rol['nombre_rol']?></option>
                            <?php            
                                    } 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-success" type="submit"onclick="editUser()">Agregar</a>
                    </div>
                </form>
            </div>
        </div>
        
        <script>
            function editUser()
            {
                data=document.getElementById('formEditUser')
                data = new FormData(data)
                const params={
                    body:data,
                    method:'POST'
                }
                document.getElementById("cargando").style.display='';
                document.getElementById("formEditUser").style.display='none';
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
