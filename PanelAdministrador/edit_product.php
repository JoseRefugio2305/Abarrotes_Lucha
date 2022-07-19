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
    $query = "SELECT p.*, c.nombre_cat FROM productos AS p INNER JOIN p_categoria AS c ON p.id_cat=c.id_cat WHERE p.is_active='1' AND p.id_product=\"$_GET[idproduct]\";";
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
    <?php
    $data=$result->fetch_assoc();
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tables</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item"><a href="tables_products.php">Productos</a></li>
            <li class="breadcrumb-item active">Editar Producto</li>
        </ol>
        <div class="card col-md-8 offset-md-2">
            <div class="card-header text-center">
                <h3>
                Editar Producto
                </h3>
            </div>
            <div class="card-body">
                <?php
                    include 'templates/svg.html';
                ?>
                <form method="POST" id="formEditProduct">
                    <input type="hidden" name="edidproduct" id="edidproduct" value="<?php echo $data['id_product'];?>">
                    <div class="mb-3">
                        <label for="productname" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="edproductname" name="edproductname" require placeholder="Nombre del Producto" value="<?php echo $data['nombre_pr'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="descpro" class="form-label">Descripcion del Producto</label>
                        <input type="text" class="form-control" id="eddescpro" name="eddescpro" require placeholder="Descripcion del Producto" value="<?php echo $data['desc_pr'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="imageproduct" class="form-label">Imagen del Producto</label><br>
                        <img width="50%" src="../<?php echo $data['url_img'];?>" alt="">
                        <input type="file" class="form-control" accept="image/png,image/jpeg" id="edimageproduct" name="edimageproduct" placeholder="Imagen Producto">
                        <input type="hidden" name="imgnoedit" id="imgnoedit" value="<?php echo $data['url_img'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="stockproduct" class="form-label">Existencias</label>
                        <input type="number" class="form-control" id="edstockproduct" name="edstockproduct" require placeholder="Existencias del Producto" value="<?php echo $data['stock'];?>">
                        <label for="preciocomppr" class="form-label">Precio de Compra</label>
                        <input type="number" class="form-control" id="edpreciocomppr" name="edpreciocomppr"require placeholder="Precio de Compra" value="<?php echo $data['precio_compra'];?>">
                        <label for="precioventpr" class="form-label">Precio de Venta</label>
                        <input type="number" class="form-control" id="edprecioventpr" name="edprecioventpr"require placeholder="Precio de Venta" value="<?php echo $data['precio_uni'];?>">
                        <label for="descupro" class="form-label">Descuento</label>
                        <input type="number" class="form-control" id="eddescupro" name="eddescupro" require placeholder="Porcentaje de Descuento" value="<?php echo $data['descuento']*100;?>">
                        <input type="hidden" name="operation" id="operation" value="editP">
                    </div>
                    <div class="mb-3">
                        <select class="form-select" aria-label="Default select example" require name="edselectcatpr">
                            <!-- <option selected>Categoria</option> -->
                            <?php 
                                $querycat = "SELECT * FROM p_categoria";
                                $categorias = $connect->query($querycat);
                                while ($categoria = $categorias->fetch_array())
                                {
                                    if($data['id_cat']== $categoria['id_cat'])
                                    {
                            ?>
                                        <option selected value="<?php echo $categoria['id_cat']?>"><?php echo $categoria['nombre_cat']?></option>
                            <?php
                                    }
                                    else
                                    {
                            ?>
                                        <option value="<?php echo $categoria['id_cat']?>"><?php echo $categoria['nombre_cat']?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-success" type="submit"onclick="EditProduct()">Editar</a>
                    </div>
                </form>
            </div>
        </div>
        
        <script>
            function EditProduct()
            {
                data=document.getElementById('formEditProduct')
                data = new FormData(data)
                const params={
                    body:data,
                    method:'POST'
                }
                document.getElementById("cargando").style.display='';
                document.getElementById("formEditProduct").style.display='none';
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
