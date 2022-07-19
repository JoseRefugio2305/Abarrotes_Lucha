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
        <h1 class="mt-4">Agregar Producto</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item"><a href="tables_products.php">Productos</a></li>
            <li class="breadcrumb-item active">Agregar Productos</li>
        </ol>
        <div class="card col-md-8 offset-md-2">
            <div class="card-header text-center">
                <h3>
                Agregar Productos
                </h3>
            </div>
            <div class="card-body">
                <?php
                    include 'templates/svg.html';
                ?>
                <form method="POST" id="formaddProduct">
                    <div class="mb-3">
                        <label for="productname" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="productname" name="productname" require placeholder="Nombre del Producto">
                    </div>
                    <div class="mb-3">
                        <label for="descpro" class="form-label">Descripcion del Producto</label>
                        <input type="text" class="form-control" id="descpro" name="descpro" require placeholder="Descripcion del Producto">
                    </div>
                    <div class="mb-3">
                        <label for="imageproduct" class="form-label">Imagen del Producto</label>
                        <input type="file" class="form-control" accept="image/png,image/jpeg" id="imageproduct" name="imageproduct" require placeholder="Imagen Producto">
                    </div>
                    <div class="mb-3">
                        <label for="stockproduct" class="form-label">Existencias</label>
                        <input type="number" class="form-control" id="stockproduct" name="stockproduct" require placeholder="Existencias del Producto">
                        <label for="preciocomppr" class="form-label">Precio de Compra</label>
                        <input type="number" class="form-control" id="preciocomppr" name="preciocomppr"require placeholder="Precio de Compra">
                        <label for="precioventpr" class="form-label">Precio de Venta</label>
                        <input type="number" class="form-control" id="precioventpr" name="precioventpr"require placeholder="Precio de Venta">
                        <label for="descupro" class="form-label">Descuento</label>
                        <input type="number" class="form-control" id="descupro" name="descupro" require placeholder="Porcentaje de Descuento">
                        <input type="hidden" name="operation" id="operation" value="addP">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" require name="selectcatpr">
                            <option selected>Categoria</option>
                            <?php 
                                $querycat = "SELECT * FROM p_categoria";
                                $categorias = $connect->query($querycat);
                                while ($categoria = $categorias->fetch_array())
                                {
                            ?>
                                <option value="<?php echo $categoria['id_cat']?>"><?php echo $categoria['nombre_cat']?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-success" type="submit"onclick="addProduct()">Agregar</a>
                    </div>
                </form>
            </div>
        </div>
        
        <script>
            function addProduct()
            {
                data=document.getElementById('formaddProduct')
                data = new FormData(data)
                const params={
                    body:data,
                    method:'POST'
                }
                document.getElementById("cargando").style.display='';
                document.getElementById("formaddProduct").style.display='none';
                versvg()
                    fetch('php/addeditP.php',params)
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
                                window.location.href= 'tables_products.php'
                            },2000)
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
