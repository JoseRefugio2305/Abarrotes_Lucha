<?php
if(!empty($_POST))
{
	if(isset($_POST["registerUsername"]) &&isset($_POST["registerPassword"]))
    {
		if($_POST["registerUsername"]!=""&&$_POST["registerPassword"]!="")
        {
            if($_POST["registerPassword"]==$_POST['registerRepeatPassword'])
            {
                include "../config/bd.php";
                $nombrereg=htmlspecialchars($_POST['registerName']);
                $appatreg=htmlspecialchars($_POST['registerapPat']);
                $apmatreg=htmlspecialchars($_POST['registerapMat']);
                $usernamereg=htmlspecialchars($_POST['registerUsername']);
                $emailreg=htmlspecialchars($_POST['registerEmail']);
                $passreg=htmlspecialchars($_POST['registerPassword']);
                $sqlExists="SELECT IF(EXISTS(SELECT * FROM usuarios WHERE user_name=\"$usernamereg\" OR email=\"$emailreg\"),1,0) AS existencia";
                
                while($row=$connect->query($sqlExists)->fetch_array())
                {
                    if($row['existencia']==0)
                    {
                        $sql1= "INSERT INTO usuarios (nombre, ap_pat, ap_mat, user_name, email, password)
                        VALUES('$nombrereg', '$appatreg', '$apmatreg', '$usernamereg', \"$_POST[registerEmail]\", '$passreg')";
                        if($connect->query($sql1))
                        {
                            $response=array(
                                'response'=>'Ok',
                                'message'=>'Bienvenido, ahora inicia sesion'
            
                            );
                        }
                        else
                        {
                            $response=array(
                                'response'=>'Error',
                                'message'=>'No se pudo llevar a cabo el registro'
            
                            );
                        }
                        die(json_encode($response));
                    }
                    else
                    {
                        $response=array(
                            'response'=>'Error',
                            'message'=>'Ya existe un usuario con ese nombre o correo electronico'
        
                        );
                    }
                    die(json_encode($response));
                }
            }
            else
            {
                $response=array(
                    'response'=>'Error',
                    'message'=>'Las contraseñas ingresadas no coinciden'

                );
            }
            die(json_encode($response));

        }
        else
        {
            $response=array(
                'response'=>'Error',
                'message'=>'Campos vacios'

            );
        }
        die(json_encode($response));
    }
    else
    {
        $response=array(
            'response'=>'Error',
            'message'=>'Campos vacios'

        );
    }
    die(json_encode($response));
}

?>