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
<?php
    $query = "SELECT dc.id_product, p.nombre_pr, dc.qty, p.precio_uni, dc.total 
    FROM detalles_compra AS dc INNER JOIN productos AS p ON dc.id_product=p.id_product
    WHERE dc.id_compra=\"$_GET[idcomprad]\";";
    $result = $connect->query($query);
    if($result->num_rows==0)
    {
    ?>
        <script>
            window.location.href= 'tables_products.php';
        </script>
    <?php
    }
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detalles de Venta</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item"><a href="tables_sales.php">Ventas</a></li>
            <li class="breadcrumb-item active">Detalles de Venta</li>
        </ol>
        <!-- <div class="card mb-4">
            <div class="card-body">
                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                .
            </div>
        </div> -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Lista de Productos
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                            while ($row = $result->fetch_array())
                            {
                        ?>
                        <tr>
                            <td><?php echo $row['id_product']?></td>
                            <td><?php echo $row['nombre_pr']?></td>
                            <td>$<?php echo $row['precio_uni']?></td>
                            <td><?php echo $row['qty']?></td>
                            <td>$<?php echo $row['total']?></td>
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
</main>
<?php
    include 'templates/footer.php';
?>