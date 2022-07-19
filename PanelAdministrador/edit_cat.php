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
    $query = "SELECT * FROM p_categoria WHERE  id_cat=\"$_GET[idcat]\";";
    $result = $connect->query($query);
    if($result->num_rows==0)
    {
    ?>
        <script>
            window.location.href= 'tables_categorias.php';
        </script>
    <?php
    }
    ?>
    <?php
    $data=$result->fetch_assoc();
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Editar Categoria</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
            <li class="breadcrumb-item"><a href="tables_categorias.php">Categorias</a></li>
            <li class="breadcrumb-item active">Editar Categoria</li>
        </ol>
        <div class="card col-md-8 offset-md-2">
            <div class="card-header text-center">
                <h3>
                Editar Categoria
                </h3>
            </div>
            <div class="card-body">
                <?php
                    include 'templates/svg.html';
                ?>
                <form method="POST" id="formeditCat">
                    <div class="mb-3">
                        <label for="EditCatName" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="EditCatName" name="EditCatName" value="<?php echo $data['nombre_cat']?>" require placeholder="Nombre de la categoria">
                    </div>
                    <div class="mb-3">
                        <label for="EditCatDesc" class="form-label">Descripcion</label>
                        <input type="text" class="form-control" id="EditCatDesc" name="EditCatDesc" value="<?php echo $data['desc_cat']?>" require placeholder="Descripcion de la Categoria">
                    </div>
                    <input type="hidden" name="operation" id="operation" value="editCat">
                    <input type="hidden" name="idcatedit" id="idcatedit" value="<?php echo $_GET['idcat']?>">
                    <div class="mb-3">
                        <a class="btn btn-success" type="submit"onclick="editCat()">Editar</a>
                    </div>
                </form>
            </div>
        </div>
        
        <script>
            function editCat()
            {
                data=document.getElementById('formeditCat')
                data = new FormData(data)
                const params={
                    body:data,
                    method:'POST'
                }
                document.getElementById("cargando").style.display='';
                document.getElementById("formeditCat").style.display='none';
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
