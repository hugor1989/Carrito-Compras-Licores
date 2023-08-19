<?php 

include "dbconn.php";
include "sql_registro.php";
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	$method=$_POST['method'];
	$dtbs = new sql_registro();
	$retval = [];

	if($method == 'list_usarios'){
		$list = $dtbs->list_usuarios();
		$retval['status'] = $list[0];
		$retval['message'] = $list[1];
		$retval['data'] = $list[2];
		echo json_encode($retval);
	}
	
	if($method == 'iniciar_sesion'){
		$email = $_POST['Email'];
		$pass = $_POST['Password'];
		
		$list = $dtbs->iniciar_sesion($email,$pass);
		$retval['status'] = $list[0];
		$retval['message'] = $list[1];
		$retval['usuario'] = $list[2];
		//$retval['url'] = $list[3];
		echo json_encode($retval);
	}

	if($method == 'new_registro'){

		

		$Negocio = $_POST['Negocio'];
		$Nombre = $_POST['Nombre'];
		$Apellido = $_POST['Apellido'];
		$Telefono = $_POST['Telefono'];
		$Email = $_POST['Email'];
		$password = $_POST['Password'];
		

		$new = $dtbs->new_registro($Negocio,$Nombre,$Apellido,$Telefono,$Email,$password);
		$retval['status'] = $new[0];
		$retval['message'] = $new[1];
		//$retval['lastInsertId'] = $new[2];
		//$retval['lastInsertIdRestaurate'] = $new[3];
		echo json_encode($retval);
	}

	if($method == 'verificar_cuenta'){

		

		$Codigo = $_POST['Codigo'];
		$Email = $_POST['Email'];

		

		$new = $dtbs->verificar_cuenta($Codigo,$Email);
		$retval['status'] = $new[0];
		$retval['message'] = $new[1];
		//$retval['lastInsertId'] = $new[2];
		//$retval['lastInsertIdRestaurate'] = $new[3];
		echo json_encode($retval);
	}

	if($method == 'edit_registro'){
		$Id = $_POST['Id'];
		$Descripcion = $_POST['Descripcion'];
		

		$edit = $dtbs->edit_customer($Id,$Descripcion);
		$retval['status'] = $edit[0];
		$retval['message'] = $edit[1];
		echo json_encode($retval);
	}
}else{
	header("HTTP/1.1 401 Unauthorized");
    exit;
}