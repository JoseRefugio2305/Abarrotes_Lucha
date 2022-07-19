<?php 
if(!empty($_POST))
{
    include '../../config/bd.php';
    if($_POST['operation']=='addCat')
    {
        $CatName=htmlspecialchars($_POST['CatName']);
        $CatDesc=htmlspecialchars($_POST['CatDesc']);
        $sqlInsert="INSERT INTO p_categoria (nombre_cat, desc_cat) VALUES ('$CatName', '$CatDesc')";
        if($connect->query($sqlInsert))
        {
            $response=array(
                'response'=>'Ok',
                'message'=>'La categoria fue agregada'
            );
        }
        else
        {
            $response=array(
                'response'=>'Error',
                'message'=>'La categoria no fue agregada'
            );
        }
        die(json_encode($response));
    }
    else if($_POST['operation']=='editCat')
    {
        $EditCatName=htmlspecialchars($_POST['EditCatName']);
        $EditCatDesc=htmlspecialchars($_POST['EditCatDesc']);
        $sqlUpdate="UPDATE p_categoria SET nombre_cat='$EditCatName',
                                            desc_cat='$EditCatDesc'
                                    WHERE id_cat=\"$_POST[idcatedit]\"";
        if($connect->query($sqlUpdate))
        {
            $response=array(
                'response'=>'Ok',
                'message'=>'Categoria Actualizada'
            );
        }
        else
        {
            $response=array(
                'response'=>'Error',
                'message'=>'Categoria No Actualizada'
            );
        }
        die(json_encode($response));
    }
    else if($_POST['operation']=='deleteCat')
    {
        $sqlDelete="DELETE FROM p_categoria WHERE id_cat=\"$_POST[idC]\"";
        if($connect->query($sqlDelete))
        {
            $response=array(
                'response'=>'Ok',
                'message'=>'Categoria Eliminada'
            );
        }
        else
        {
            $response=array(
                'response'=>'Error',
                'message'=>'No fue posible eliminar la categoria'
            );
        }
        die(json_encode($response));
    }
}
?>

