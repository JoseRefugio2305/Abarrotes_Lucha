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
        <h1 class="mt-4">Agregar Categoria</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item"><a href="tables_products.php">Productos</a></li>
            <li class="breadcrumb-item active">Agregar Categorias</li>
        </ol>
        <div class="card col-md-8 offset-md-2">
            <div class="card-header text-center">
                <h3>
                Agregar Categoria
                </h3>
            </div>
            <div class="card-body">
                <?php
                    include 'templates/svg.html';
                ?>
                <form method="POST" id="formaddCat">
                    <div class="mb-3">
                        <label for="CatName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="CatName" name="CatName" require placeholder="Nombre de la categoria">
                    </div>
                    <div class="mb-3">
                        <label for="CatDesc" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="CatDesc" name="CatDesc" require placeholder="Descripcion de la Categoria">
                    </div>
                    <input type="hidden" name="operation" id="operation" value="addCat">
                    <div class="mb-3">
                        <a class="btn btn-success" type="submit"onclick="addCat()">Agregar</a>
                    </div>
                </form>
            </div>
        </div>
        
        <script>
            function addCat()
            {
                data=document.getElementById('formaddCat')
                data = new FormData(data)
                const params={
                    body:data,
                    method:'POST'
                }
                document.getElementById("cargando").style.display='';
                document.getElementById("formaddCat").style.display='none';
                versvg()
                fetch('php/addeditCat.php',params)
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
                                window.location.href= 'tables_categorias.php'
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
