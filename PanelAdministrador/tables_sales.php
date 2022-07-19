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
        <h1 class="mt-4">Administrar Ventas</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item active">Administrar Ventas</li>
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
                <a class="btn btn-success" href="add_Sale.php">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    Agregar Venta
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
                            <th>Código Compra</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th colspan="2">Opciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            $query = "SELECT c.*, u.user_name FROM compra AS c INNER JOIN usuarios AS u ON c.id_user=u.id_usuario";
            
                            $result = $connect->query($query);
                            while ($row = $result->fetch_array())
                            {
                        ?>
                        <tr>
                            <td><?php echo $row['id_compra']?></td>
                            <td><?php echo $row['user_name']?></td>
                            <td><?php echo $row['sale_date']?></td>
                            
                            <td>$<?php echo $row['total']?></td>
                            <td><?php if($row['is_pend']==1){echo 'Pagada';}else{echo 'Sin Pagar';}?></td>
                            <td class="text-center">
                                <a class="btn btn-primary" style="color: white;" href="sale_details.php?idcomprad=<?php echo $row['id_compra'];?>">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-success" style="color: white;" onclick="viewTicket('<?php echo $row['pdf_ticket'];?>')">
                                    <i class="fa fa-file" aria-hidden="true"></i>
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
                            <th>Opciones</th>
                        </tr>
                    </tfoot>
                </table>
                
                
            </div>
        </div>
    </div>
    <script>
        function viewTicket(rutapdf)
        { 
            window.location.href='ticketviewer.php?rutapdf='+rutapdf.slice(6)
            // var win = window.open(rutapdf.slice(6), '_blank');
            // // Cambiar el foco al nuevo tab (punto opcional)
            // win.focus();
        }
    </script>
</main>
<?php
    include 'templates/footer.php';
?>