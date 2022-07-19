<?php
if(!empty($_POST))
{
    
    if($_POST['asunto']!='' && $_POST['comentario']!='')
    {
        include '../config/bd.php';
        $nombre=htmlspecialchars($_POST['name']);
        $lastname=htmlspecialchars($_POST['lastname']);
        $asunto=htmlspecialchars($_POST['asunto']);
        $comentario=htmlspecialchars($_POST['comentario']);
        $sqlInsertCom="INSERT INTO comentarios (nombre, apellidos, email, asunto, comentario)
                    VALUES(\"$nombre\",\"$lastname\",\"$_POST[email]\",\"$asunto\",\"$comentario\")";
        if($connect->query($sqlInsertCom))
        {
            $response=array(
                'response'=>'Ok',
                'message'=>'Recibimos tu comentrio, puedes observarlo en la pagina principal.'
            );
        }
        else
        {
            $response=array(
                'response'=>'Error',
                'message'=>'Hubo un problema al insertar el comentario'
            );
        }
    }
    else
    {
        $response=array(
            'response'=>'Error',
            'message'=>'Campos Vacios'
        );
    }
    die(json_encode($response));
}
?>