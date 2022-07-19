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
        <h1 class="mt-4">Ticket de Venta</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item"><a href="tables_sales.php">Ventas</a></li>
            <li class="breadcrumb-item active">Ticket de Venta</li>
        </ol>
    </div>
    <a href="tables_sales.php" class="btn btn-success">Administrar Ventas</a>
    <a href="add_Sale.php" class="btn btn-success">Agregar Venta</a>
    <!-- <embed src="Tickets/ventas.pdf" type="application/pdf" width="100%" height="100%" />
    <object data="Tickets/ventas.pdf" height="100%" width="100%"></object> -->
    <embed src="<?php echo $_GET['rutapdf'];?>" type="application/pdf" width="100%" height="100%" />
    
</main>
<?php
    include 'templates/footer.php';
?>