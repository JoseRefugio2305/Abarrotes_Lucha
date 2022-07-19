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
        <h1 class="mt-4">Productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item active">Productos</li>
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
                <a class="btn btn-success" href="add_product.php">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Agregar Producto
                </a>
            </div>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Productos Activos
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Existencias</th>
                            <th>Imagen</th>
                            <th>Precio de Compra</th>
                            <th>Precio de Venta</th>
                            <th>Descuento</th>
                            <th>Categoría</th>
                            <th>Fecha de Adición</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $query = "SELECT p.*, c.nombre_cat FROM productos AS p INNER JOIN p_categoria AS c ON p.id_cat=c.id_cat WHERE p.is_active='1';";
            
                            $result = $connect->query($query);
                            while ($row = $result->fetch_array())
                            {
                        ?>
                        <tr>
                            <td><?php echo $row['id_product']?></td>
                            <td><?php echo $row['nombre_pr']?></td>
                            <td><?php echo $row['stock']?></td>
                            <td style="text-align: center;">
                                <a class="btn btn-primary" style="color: white;" onclick="seeImageProduct('<?php echo $row['url_img']?>')">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            <td><?php echo $row['precio_compra']?></td>
                            <td><?php echo $row['precio_uni']?></td>
                            <td><?php echo $row['descuento']*100?>%</td>
                            <td><?php echo $row['nombre_cat']?></td>
                            <td><?php echo $row['fecha_add']?></td>
                            <td>
                                <a class="btn btn-warning" style="color: white;" href="edit_product.php?idproduct=<?php echo $row['id_product'];?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                <a class="btn btn-danger" style="color: white;" onclick="confirmDeleteProduct('<?php echo $row['id_product']?>')">
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

                    function confirmDeleteProduct(id)
                    {
                        Swal.fire({
                            title: '¿Quieres borrar el producto?',
                            showCancelButton: true,
                            confirmButtonText: 'Confirmar',
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            data= new FormData()
                            data.append('idP',id)
                            data.append('operation','deleteP')
                            const params = {
                                body: data,
                                method: "POST"
                            }
                            fetch('php/addeditP.php',params)
                                .then(response => response.json())
                                .then( data => {
                                    console.log(data.message)
                                    if (data.response == "Ok") {
                                        // Swal.fire(
                                        //     'Exito',
                                        //     data.message,
                                        //     'success'
                                        // )
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