<?php

session_start();

if(!empty($_POST))
{//\"$_SESSION['id_cliente']\"
    include '../../config/bd.php';
    if($_POST['operation']=='addPS')
    {
        if($_POST['idsale']=='0')
        {
            $idcliente=$_SESSION['id_cliente'];
            $idproducto = explode(" | ", $_POST['codpr'])[0];
            $insertSale="CALL insertcompra(\"$idcliente\",\"$idproducto\",\"$_POST[cantpr]\",1,0)";
            if($results=$connect->query($insertSale))
            {
                while($row=$results->fetch_array())
                {
                    if($row['cantStock']=='Realizada')
                    {
                        $datanewpr=array(
                            'id'=>$row['id_compra'],
                            'idpr'=>$row['id_product'],
                            'nombrepr'=>$row['nombre_pr'],
                            'preciouni'=>$row['precio_uni'],
                            'cant'=>$row['qty'],
                            'total'=>$row['total'],
                            'fecha'=>$row['fecha_add']
                            );
                        $resp='Ok';
                        $message="Producto Agregado";
                    }
                    else
                    {
                        $datanewpr=$row['cantStock'];
                        $resp='NoStock';
                        $message="No hay suficiente en stock";
                    }
                }
                $response = array(
                    'response' => $resp,
                    'message' => $message,
                    'dataProducto'=>$datanewpr
                );
            }
            else
            {
                $response = array(
                    'response' => 'Error',
                    'message' => "Error al agregar el producto"
                );
            }
            die(json_encode($response));
        }
        else
        {
            $idproducto = explode(" | ", $_POST['codpr'])[0];
            $insertPr="CALL insertcompra(0,\"$idproducto\",\"$_POST[cantpr]\",2,\"$_POST[idsale]\")";

            if($results=$connect->query($insertPr))
            {
                while($row=$results->fetch_array())
                {
                    if($row['cantStock']=='Realizada')
                    {
                        $datanewpr=array(
                        'id'=>$row['id_compra'],
                        'idpr'=>$row['id_product'],
                        'nombrepr'=>$row['nombre_pr'],
                        'preciouni'=>$row['precio_uni'],
                        'cant'=>$row['qty'],
                        'total'=>$row['total'],
                        'fecha'=>$row['fecha_add']
                        );
                        $resp='Ok';
                        $message="Producto Agregado";
                    }
                    else
                    {
                        $datanewpr=$row['cantStock'];
                        $resp='NoStock';
                        $message="No hay suficiente en stock";
                    }

                }
                $response = array(
                    'response' => $resp,
                    'message' => $message,
                    'dataProducto'=>$datanewpr
                );
            }
            else
            {
                $response = array(
                    'response' => 'Error',
                    'message' => "Error al agregar el producto"
                );
            }
            die(json_encode($response));
        }
    }
    else if($_POST['operationsale']=='paySale')
    {   
        
        $endsale="UPDATE compra 
            SET total=\"$_POST[totalsale]\",
            is_pend='1',
            sale_date=CURRENT_TIMESTAMP()
            WHERE id_compra=\"$_POST[idsalepay]\"";
        if($connect->query($endsale))
        {
            $response=array(
                'response' => 'Ok',
                'message' => "Pago Realizado",
                'idcompra' => $_POST['idsalepay']
            );
        }
        else
        {
            $response=array(
                'response' => 'Error',
                'message' => "No se pudo registrar el pago"
            );
        }

        die(json_encode($response));
    }
    else if($_POST['operationsale']=='deletePrComp')
    { 
        $querydel="CALL deletePrSale(\"$_POST[idcomp]\",\"$_POST[idprod]\",\"$_POST[saledate]\")";
        if($connect->query($querydel))
        {
            $response=array(
                'response' => 'Ok',
                'message' => "Producto borrado de la lista"
            );
        }
        else
        {
            $response=array(
                'response' => 'Error',
                'message' => "No se pudo eliminar el producto"
            );
        }
        die(json_encode($response));
    }
    else if($_POST['operationsale']=='searchPr')
    {
        $search=htmlspecialchars($_POST['Spr']);
        $querySearch="SELECT CONCAT(p.id_product,' | ',p.nombre_pr) as Search
                    FROM productos AS p 
                    WHERE p.id_product LIKE '%$search%' OR p.nombre_pr LIKE '%$search%' LIMIT 5";
        $results=$connect->query($querySearch);
        $arraySearch=array();
        while($row=$results->fetch_array())
        {
            array_push($arraySearch,$row['Search']);
        }
        $response=array(
            'response'=>'Ok',
            'sugerencias'=>$arraySearch
        );
        die(json_encode($response));
    }
}

?>