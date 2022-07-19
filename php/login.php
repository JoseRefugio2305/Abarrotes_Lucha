<?php
if(!empty($_POST)){
	if(isset($_POST["usuario"]) &&isset($_POST["password"])){
		if($_POST["usuario"]!=""&&$_POST["password"]!=""){
			include "../config/bd.php";
			
			$id_cliente=null;
			$sql1= "select * from usuarios where(user_name=\"$_POST[usuario]\" or email=\"$_POST[usuario]\") and password=\"$_POST[password]\" ";
			$query = $connect->query($sql1);
			while ($r=$query->fetch_array()) {
				$id_cliente=$r["id_usuario"];
				$username=$r["user_name"];
				$useremail=$r["email"];
				$userrol=$r["user_rol"];
				break;
			}
			if($id_cliente==null){
				$response = array(
                    'response' => 'Error',
                    'message' => "Usuario o Contraseña Incorrectos"
                );
			}else{
                $response = array(
                    'response' => 'Ok',
                    'message' => "Bienvenido de Nuevo, En un Momento Serás Redirigido",
                    'url' => 'index.php'
                );
				session_start();
				$_SESSION["id_cliente"]=$id_cliente;
				$_SESSION["username"]=$username;
				$_SESSION["useremail"]=$useremail;
				$_SESSION["userrol"]=$userrol;
						
			}
			die(json_encode($response));
		}
	}

}

?>