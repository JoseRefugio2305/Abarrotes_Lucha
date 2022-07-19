<?php
    include 'templates/navbar.php';
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
                <h1 class="mt-4">Agregar Venta</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Panel Administrador</a></li>
                    <li class="breadcrumb-item active">Agregar Venta</li>
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
                        Agregar Producto
                    </div>
                    <div class="card-body">
                        <form method="POST" id="formCompra">
                            <input type="hidden" name="idsale" id="idsale" value="0">
                            <input type="hidden" name="operation" id="operation" value="addPS">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="productname" class="form-label">Codigo del Producto</label>
                                    <input type="search" class="form-control" id="codpr" name="codpr" require placeholder="Codigo" aria-label="Codigo Producto" aria-describedby="basic-addon1" list="listasugerencias">
                                    <!-- <input type="search" class="form-control" id="codpr1" name="codpr1" aria-label="Codigo Producto" aria-describedby="basic-addon1" list="listasugerencias">-->
                                    <datalist id="listasugerencias">
                                        <!-- Aqui se agregaran las sugerencias -->
                                    </datalist> 
                                </div>
                                <div class="col-md-4">
                                    <label for="productname" class="form-label">Cantidad</label>
                                    <input type="number" class="form-control" id="cantpr" name="cantpr" require placeholder="Cantidad">
                                </div>
                                <!-- <div class="col-md-4">
                                    <label for="productname" class="form-label">Precio</label>
                                    <input type="number" disabled class="form-control" id="preciopr" name="preciopr" require placeholder="Precio">
                                </div> -->
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                <a class="btn btn-success" onclick="addRowProduct()">Agregar Producto</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    include 'templates/svg.html';
                ?>
                <div class="card mb-4" id="divtbllistcompra">
                    <div class="card-header">
                        <i class="fa fa-list me-1"></i>
                        Lista de Compra
                    </div>
                    <div class="card-body">
                        <table  id="datatablesSimple">
                            <thead>
                                <th>Codigo</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Operación</th>
                            </thead>
                            <tbody id="cuerpotblcompra">
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="card-footer">
                        <div class="row">
                                <form id="formtotalsale">
                                    <div class="col-md-3">
                                        <input type="hidden" name="operationsale" id="operationsale" value="paySale">
                                        <input type="hidden" name="idsalepay" id="idsalepay" value="0">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">$</span>
                                            <input type="number" name="totalsale" id="totalsale" value="00" disabled class="form-control" aria-label="Amount (to the nearest dollar)">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 offset-md-1">
                                        <a onclick="paySale()" class="btn btn-success">Realizar Pago</a>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function addRowProduct()
                {
                    if(document.getElementById('cuerpotblcompra').innerHTML=='<tr><td class="dataTables-empty" colspan="6">No entries found</td></tr>')
                    {
                        document.getElementById('cuerpotblcompra').innerHTML=''
                    }   

                    data=document.getElementById('formCompra')
                    data = new FormData(data)
                    const params={
                        body:data,
                        method:'POST'
                    }
                    fetch('php/sales.php',params)
                        .then(response => response.json())
                        .then( data => {
                            console.log(data.message)
                            if (data.response == "Ok") {
                                cuerpo="<tr id='"+data.dataProducto.idpr+"'>"+
                                            "<td>"+
                                                data.dataProducto.idpr+
                                            "</td>"+
                                            "<td>"+
                                                data.dataProducto.nombrepr+
                                            "</td>"+
                                            "<td>"+
                                                data.dataProducto.preciouni+
                                            "</td>"+
                                            "<td>"+
                                                data.dataProducto.cant+
                                            "</td>"+
                                            "<td>"+
                                                data.dataProducto.total+
                                            "</td>"+
                                            "<td class='text-center'>"+
                                                "<a class='btn btn-danger' style='color: white;' onclick='confirmDeleteProductSale("+data.dataProducto.idpr+","+data.dataProducto.id+",`"+data.dataProducto.fecha+"`,"+data.dataProducto.total+")'>"+
                                                    "<i class='fa fa-trash' aria-hidden='true'></i>"+
                                                "</a>"+
                                            "</td>"+
                                        "</tr>"
                                document.getElementById('cuerpotblcompra').innerHTML+=cuerpo
                                document.getElementById('idsale').value=data.dataProducto.id
                                document.getElementById('idsalepay').value=data.dataProducto.id
                                document.getElementById('codpr').value=''
                                document.getElementById('cantpr').value=''
                                document.getElementById('totalsale').value=parseFloat(data.dataProducto.total)+parseFloat(document.getElementById('totalsale').value)
                            } 
                            else if(data.response=='NoStock')
                            {
                                Swal.fire(
                                    'Error',
                                    data.message+". Solo existen "+data.dataProducto+" unidades.",
                                    'error'
                                )
                            }
                            else {
                                Swal.fire(
                                    'Error',
                                    data.message,
                                    'error'
                                )
                            }
                        })
                    
                }

                function paySale()
                {  
                    datas=document.getElementById('formtotalsale')
                    datas = new FormData(datas)
                    console.log(document.getElementById('totalsale').value)
                    datas.append('operation','')
                    datas.append('totalsale',document.getElementById('totalsale').value)
                    const params={
                        body:datas,
                        method:'POST'
                    }
                    document.getElementById("cargando").style.display='';
                    document.getElementById("divtbllistcompra").style.display='none';
                    versvg()
                    fetch('php/sales.php',params)
                        .then(response => response.json())
                        .then( data => {
                            if (data.response == "Ok") {
                                Swal.fire(
                                    'Exito',
                                    data.message,
                                    'success'
                                )
                                generarTicket(data.idcompra)
                                // setTimeout(() => {
                                //     location.reload()
                                // },1000)
                            } else {
                                Swal.fire(
                                    'Error',
                                    data.message,
                                    'error'
                                )
                            }
                        })
                }

                function generarTicket(idcomprapagada)
                {
                    dataTicket=new FormData()
                    dataTicket.append('idcomprat', idcomprapagada)
                    const params={
                        body:dataTicket,
                        method:'POST'
                    }
                    fetch('php/pdf/generarticket.php',params)
                        .then(response => response.json())
                        .then( data => {
                            window.location.href='ticketviewer.php?rutapdf='+data.rutapdf.slice(6)
                            // var win = window.open(data.rutapdf.slice(6), '_blank');
                            // // Cambiar el foco al nuevo tab (punto opcional)
                            // win.focus();
                        })
                }

                function confirmDeleteProductSale(idpr, idc,dates,totalsale)
                {
                    Swal.fire({
                        title: '¿Estas Seguro?',
                        text: "El producto sera borrado de la lista de compra",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Confirmar',
                        cancelButtonText: 'Cancelar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            data=new FormData()
                            data.append('idprod',idpr)
                            data.append('idcomp',idc)
                            data.append('saledate',dates)
                            data.append('operationsale','deletePrComp')
                            data.append('operation','')
                            const paramsdel={
                                body:data,
                                method:'POST'
                            }
                            fetch('php/sales.php',paramsdel)
                                .then(response => response.json())
                                .then( data => {
                                    if(data.response=="Ok")
                                    {
                                        
                                        Swal.fire(
                                        'Borrado!',
                                        data.message,
                                        'success'
                                        )
                                        var cuerpotabla=document.getElementById('cuerpotblcompra')
                                        cuerpotabla.removeChild(document.getElementById(idpr))
                                        document.getElementById('totalsale').value-=totalsale
                                    }
                                    else
                                    {
                                        Swal.fire(
                                        'Error!',
                                        data.message,
                                        'error'
                                        )
                                    }
                                })
                        }
                    })
                }

                document.getElementById('codpr').addEventListener('keyup',(event)=>{
                    textS=document.getElementById('codpr').value
                    data = new FormData()
                    data.append('Spr',textS)
                    data.append('operationsale','searchPr')
                    data.append('operation','')
                    const paramssearchP={
                        body:data,
                        method:'POST'
                    }
                    html=''
                    fetch('php/sales.php',paramssearchP)
                        .then(response => response.json())
                        .then( data => {
                            if(data.sugerencias.length>0)
                            {
                                data.sugerencias.forEach(element => {
                                    html+="<option value='"+element+"'>"
                                });
                            }
                            document.getElementById('listasugerencias').innerHTML=html
                        })
                })
            </script>
        </main>
    </div>
</div>
<?php
    include 'templates/footer.php';
?>