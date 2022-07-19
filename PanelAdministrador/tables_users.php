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
        <h1 class="mt-4">Usuarios del Sistema</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item active">Usuarios</li>
        </ol>
        <!-- <div class="card mb-4">
            <div class="card-body">
                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                .
            </div>
        </div> -->
        <div class="card mb-4">
            <div class="col-md-4">
                <a class="btn btn-success" href="add_user.php">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Agregar Usuario
                </a>
            </div>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Usuarios Activos
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Nombre de Usuario</th>
                            <th>Email</th>
                            <th>Permisos</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $query = "SELECT u.id_usuario, CONCAT(nombre,' ',ap_pat,' ',ap_mat) AS nombrecompleto, u.user_name, u.email, r.nombre_rol 
                            FROM usuarios AS u INNER JOIN rol AS r ON u.user_rol=r.id_rol
                            WHERE u.is_active='1'";
            
                            $result = $connect->query($query);
                            while ($row = $result->fetch_array())
                            {
                        ?>
                        <tr>
                            <td><?php echo $row['id_usuario']?></td>
                            <td><?php echo $row['nombrecompleto']?></td>
                            <td><?php echo $row['user_name']?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo $row['nombre_rol']?></td>
                            <td>
                                <a class="btn btn-warning" style="color: white;" href="edit_user.php?iduser=<?php echo $row['id_usuario'];?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-danger" style="color: white;" onclick="confirmDeleteUser('<?php echo $row['id_usuario']?>')">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        
                        <?php
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Existencias</th>
                            <th>Imagen</th>
                            <th>Precio</th>
                            <th>Descuento</th>
                            <th>Categoría</th>
                            <th>Fecha de Adición</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </tfoot>
                </table>
                
                <script>
                    function seeImageProduct(urlimg)
                    {
                        Swal.fire({
                        imageUrl: "../"+urlimg,
                        imageWidth: 600,
                        imageHeight: 400,
                        imageAlt: urlimg
                        })
                    }

                    function confirmDeleteUser(id)
                    {
                        Swal.fire({
                            title: '¿Quieres borrar el usuario?',
                            showCancelButton: true,
                            confirmButtonText: 'Confirmar',
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            data= new FormData()
                            data.append('idUser',id)
                            data.append('operation','deleteUser')
                            const params = {
                                body: data,
                                method: "POST"
                            }
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
                                        location.reload()
                                    } else {
                                        Swal.fire(
                                            'Error',
                                            data.message,
                                            'error'
                                        )
                                    }
                            })
                        } 
                        })
                    }
                </script>
            </div>
        </div>
    </div>
</main>
<?php
    include 'templates/footer.php';
?>