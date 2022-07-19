<?php
if(!empty($_POST))
{
    include '../../config/bd.php';
    if($_POST['operation']=='addUser')
    {
        $usernamepila=htmlspecialchars($_POST['userNamePila']);
        $aptpat=htmlspecialchars($_POST['aptpat']);
        $aptmat=htmlspecialchars($_POST['aptmat']);
        $username=htmlspecialchars($_POST['userName']);
        $userpass=htmlspecialchars($_POST['userpass']);
        $sqlexists="SELECT EXISTS(SELECT * FROM usuarios WHERE user_name LIKE '$username' OR email LIKE \"$_POST[useremail]\") AS existencia";
        $existquery=$connect->query($sqlexists);
        if($existquery->fetch_array()['existencia']==0)
        {
            $sql1= "INSERT INTO usuarios (nombre, ap_pat, ap_mat, user_name, email, password, user_rol)
                VALUES('$usernamepila', '$aptpat', '$aptmat', '$username', \"$_POST[useremail]\", '$userpass', \"$_POST[selectrol]\")";
            if($connect->query($sql1))
            {
                $response = array(
                    'response' => 'Ok',
                    'message' => "Usuario Agregado"
                );
            }
            else
            {
                $response = array(
                    'response' => 'Error',
                    'message' => "No se pudo agregar el usuario"
                );
            }
        }
        else
        {
            $response = array(
                'response' => 'Error',
                'message' => "El nombre de usuario o el correo ingresados ya existen"
            );
        }
        
        die(json_encode($response));
    }
    else if($_POST['operation']=='deleteUser')
    {   
        $sql2="UPDATE usuarios SET is_active='0' WHERE id_usuario=\"$_POST[idUser]\"";
        if($connect->query($sql2))
        {
            $response = array(
                'response' => 'Ok',
                'message' => "Usuario Eliminado"
            );
        }
        else{
            $response = array(
                'response' => 'Error',
                'message' => "Ocurrio un error al eliminar el usuario"
            );
        }
        die(json_encode($response));
    }
    else if($_POST['operation']=='editUser')
    {
        $usernamepila=htmlspecialchars($_POST['userNamePila']);
        $aptpat=htmlspecialchars($_POST['aptpat']);
        $aptmat=htmlspecialchars($_POST['aptmat']);
        $username=htmlspecialchars($_POST['userName']);
        $userpass=htmlspecialchars($_POST['userpass']);
        $sqlexists="SELECT EXISTS(SELECT * FROM usuarios WHERE (user_name LIKE '$username' OR email LIKE \"$_POST[useremail]\" ) 
        AND id_usuario!=\"$_POST[iduseredit]\") AS existencia";
        $existquery=$connect->query($sqlexists);
        if($existquery->fetch_array()['existencia']==0)
        {
            $sql1= "UPDATE usuarios SET 
                    nombre='$usernamepila',
                    ap_pat='$aptpat',
                    ap_mat='$aptmat',
                    user_name='$username',
                    email=\"$_POST[useremail]\",
                    password='$userpass',
                    user_rol=\"$_POST[selectrol]\"
                    WHERE id_usuario=\"$_POST[iduseredit]\"";
            if($connect->query($sql1))
            {
                $response = array(
                    'response' => 'Ok',
                    'message' => "Usuario Editado"
                );
            }
            else
            {
                $response = array(
                    'response' => 'Error',
                    'message' => "No se pudo editar el usuario"
                );
            }
        }
        else
        {
            $response = array(
                'response' => 'Error',
                'message' => "El nombre de usuario o el correo ingresados ya existen"
            );
        }
        die(json_encode($response));
    }
}


?>