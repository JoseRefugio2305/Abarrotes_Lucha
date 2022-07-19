<?php
include '../../config/bd.php';

if($_POST['opgraf']=='Barras')
{
    $year=date('Y');
    $consulbar="SELECT COUNT(c.id_compra) AS conteomensual, MONTH(c.sale_date) AS messale
    FROM compra AS c
    WHERE YEAR(c.sale_date)='$year'
    GROUP BY messale
    ORDER BY MONTH(c.sale_date) ASC";
    $results=$connect->query($consulbar);
    $arreglodata = array(0,0,0,0,0,0,0,0,0,0,0,0);
    $ant=0;
    while($row=$results->fetch_array())
    {
        $arreglodata[$row['messale']-1]=intval($row['conteomensual']);
        if(intval($row['conteomensual'])>$ant)
        {
            $ant=intval($row['conteomensual']);
        }
    }
    $response=array(
        'response'=>'Ok',
        'datagraf'=>$arreglodata,
        'maximo'=>$ant
    );
    die(json_encode($response));
}
else if($_POST['opgraf']=='Histograma')
{
    $year=date('Y');
    $month=date('m');
    $cantidadDias = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    $consultahist="SELECT COUNT(c.id_compra) AS conteodiario, DAY(c.sale_date) AS daysale
    FROM compra AS c
    WHERE YEAR(c.sale_date)='$year' AND MONTH(c.sale_date)='$month'
    GROUP BY daysale
    ORDER BY DAY(c.sale_date) ASC";
    $results=$connect->query($consultahist);
    $arreglodata = array();
    $cont=0;
    while($cont<$cantidadDias)
    {
        array_push($arreglodata,0);
        $cont+=1;
    }
    $ant=0;
    while($row=$results->fetch_array())
    {
        $arreglodata[$row['daysale']]=intval($row['conteodiario']);
        if(intval($row['conteodiario'])>$ant)
        {
            $ant=intval($row['conteodiario']);
        }
    }
    $response=array(
        'response'=>'Ok',
        'datagraf'=>$arreglodata,
        'maximo'=>$ant,
        'dias'=>$cantidadDias
    );
    die(json_encode($response));
}
else if($_POST['opgraf']=='Pie')
{
    $year=date('Y');
    $consultahist="SELECT p.nombre_pr, SUM(dc.qty) AS sumacantidad
    FROM detalles_compra AS dc 
    INNER JOIN productos AS p ON dc.id_product=p.id_product 
    INNER JOIN compra AS c ON dc.id_compra=c.id_compra
    WHERE c.is_pend='1' AND YEAR(c.sale_date)='$year'
    GROUP BY p.id_product
    ORDER BY sumacantidad DESC
    LIMIT 10";
    $results=$connect->query($consultahist);
    $arregloPrN = array();
    $arregloPrCant = array();
    while($row=$results->fetch_array())
    {
        array_push($arregloPrN,$row['nombre_pr']);
        array_push($arregloPrCant,$row['sumacantidad']);
    }
    $response=array(
        'response'=>'Ok',
        'datapr'=>$arregloPrN,
        'dataprcant'=>$arregloPrCant
    );
    die(json_encode($response));
}
else if($_POST['opgraf']=='Doughnut')
{
    $year=date('Y');
    $consulcompcats="SELECT pc.nombre_cat, COUNT(c.id_compra) AS conteocompras 
    FROM p_categoria AS pc INNER JOIN productos AS p ON pc.id_cat=p.id_cat
    INNER JOIN detalles_compra AS dc ON p.id_product=dc.id_product
    INNER JOIN compra AS c ON dc.id_compra=c.id_compra
    WHERE c.is_pend='1' AND YEAR(c.sale_date)='$year'
    GROUP BY pc.id_cat";
    $results=$connect->query($consulcompcats);
    $arregloCats = array();
    $arregloCanCC = array();
    while($row=$results->fetch_array())
    {
        array_push($arregloCats,$row['nombre_cat']);
        array_push($arregloCanCC,$row['conteocompras']);
    }
    $response=array(
        'response'=>'Ok',
        'datacats'=>$arregloCats,
        'datacantcomp'=>$arregloCanCC
    );
    die(json_encode($response));
}
?>