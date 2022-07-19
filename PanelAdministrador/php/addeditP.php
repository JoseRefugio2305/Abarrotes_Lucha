<?php
if(!empty($_POST))
{
    include '../../config/bd.php';
    if($_POST['operation']=='deleteP')
    {
        $sql1= "UPDATE productos
                SET is_active='0'
                WHERE id_product=\"$_POST[idP]\"";
		if($connect->query($sql1))
        {
            $response = array(
                'response' => 'Ok',
                'message' => "Producto Eliminado"
            );
        }
        else
        {
            $response = array(
                'response' => 'Error',
                'message' => "No se pudo borrar el producto"
            );
        }
        die(json_encode($response));
    }
    else if($_POST['operation']=='addP')
    {   
        $descuento=$_POST['descupro']/100;
        $prname=htmlspecialchars($_POST['productname']);
        $prdesc=htmlspecialchars($_POST['descpro']);
        $imageroute=UploadFile($_FILES['imageproduct']);
        $sql2="INSERT INTO productos (nombre_pr, desc_pr, stock, url_img, precio_compra, precio_uni, descuento, id_cat)
        VALUES (\"$prname\",\"$prdesc\", \"$_POST[stockproduct]\", \"$imageroute\",\"$_POST[preciocomppr]\",\"$_POST[precioventpr]\",\"$descuento\",\"$_POST[selectcatpr]\")";
        if($connect->query($sql2))
        {
            $response = array(
                'response' => 'Ok',
                'message' => "Producto Agregado"
            );
        }
        else{
            $response = array(
                'response' => 'Error',
                'message' => "Ocurrio un error al agregar el producto"
            );
        }
        die(json_encode($response));
    }
    else if($_POST['operation']=='editP')
    {
        $descuento=$_POST['eddescupro']/100;
        if($_FILES['edimageproduct']['name'] != null)
        {
            $imageroute=UploadFile($_FILES['edimageproduct']);
        }
        else
        {
            $imageroute=$_POST['imgnoedit'];
        }
        $prname=htmlspecialchars($_POST['edproductname']);
        $prdesc=htmlspecialchars($_POST['eddescpro']);
        $sql3="UPDATE productos 
                SET nombre_pr=\"$prname\",
                    desc_pr=\"$prdesc\", 
                    stock=\"$_POST[edstockproduct]\",
                    url_img=\"$imageroute\",
                    precio_compra=\"$_POST[edpreciocomppr]\",
                    precio_uni=\"$_POST[edprecioventpr]\",
                    descuento=\"$descuento\",
                    id_cat=\"$_POST[edselectcatpr]\"
                    WHERE id_product=\"$_POST[edidproduct]\"";
        if($connect->query($sql3))
        {
            $response = array(
                'response' => 'Ok',
                'message' => "Producto Editado"
            );
        }
        else{
            $response = array(
                'response' => 'Error',
                'message' => "Ocurrio un error al editar el producto"
            );
        }
        die(json_encode($response));
    }
}

function UploadFile($upfile)
{
    $archivo = $upfile['name'];
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $upfile['type'];
      $tamano = $upfile['size'];
      $temp = $upfile['tmp_name'];
      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
     if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")))) {
        echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
     }
     else {
        //Si la imagen es correcta en tamaño y tipo
        //Se intenta subir al servidor
        $actualdate=date('m_d_Y_h_i_s', time());
        if (move_uploaded_file($temp, '../../img/products/'."p".$actualdate.".png")) {
            //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
            // chmod('images/'.$archivo, 0777);
            // //Mostramos el mensaje de que se ha subido co éxito
            // echo '<div><b>Se ha subido correctamente la imagen.</b></div>';
            // //Mostramos la imagen subida
            // echo '<p><img src="images/'.$archivo.'"></p>';
        }
        else {
           //Si no se ha podido subir la imagen, mostramos un mensaje de error
           echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
        }
      }
      return 'img/products/'."p".$actualdate.".png";
   }
   
}

?>