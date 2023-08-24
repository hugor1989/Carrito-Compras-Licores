<?php 

include "dbconn.php";
include "sql_registro.php";
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	$method=$_POST['method'];
	$dtbs = new sql_registro();
	$retval = [];

	if($method == 'obtener_informacion_usuario'){

		$Id = $_POST['Id'];

		$list = $dtbs->list_usuarios($Id);
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
		$retval['verificacion'] = $list[3];
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
		echo json_encode($retval);
	}

	if($method == 'verificar_cuenta'){

		

		$Codigo = $_POST['Codigo'];
		$Email = $_POST['Email'];

		

		$new = $dtbs->verificar_cuenta($Codigo,$Email);
		$retval['status'] = $new[0];
		$retval['message'] = $new[1];
		echo json_encode($retval);
	}

	if($method == 'verificar_email'){
		
		$Email = $_POST['Email'];

		$new = $dtbs->verificar_email($Email);
		$retval['status'] = $new[0];
		$retval['message'] = $new[1];
		echo json_encode($retval);
	}

	if($method == 'actualizar_perfil'){

		$idUsuario = $_POST['idUsuario'] ;
		$nosucursales = $_POST['nosucursales'];
		$ticket = $_POST['ticket'] ;
		$nomesas = $_POST['nomesas'] ;
		$noempleados = $_POST['noempleados'] ;
		$files = $_POST['files'];
		$plazopago = $_POST['plazopago'] ;
		$price_filter = $_POST['price_filter'] ;
		$nameref1 = $_POST['nameref1'] ;
		$telref1 = $_POST['telref1'] ;
		$dirref1 = $_POST['dirref1'] ;
		$comment1 = $_POST['comment1'] ;
		$nameref2 = $_POST['nameref2'] ;
		$telref2 = $_POST['telref2'] ;
		$dirref2 = $_POST['dirref2'] ;
		$comment2 = $_POST['comment2'] ;
		$giro = $_POST['giro'] ;

		

		$edit = $dtbs->actualizar_perfil($idUsuario,$nosucursales,$ticket,$nomesas,$noempleados,$files,$plazopago,$price_filter,$nameref1,$telref1,$dirref1,$comment1,$nameref2,$telref2,$dirref2,$comment2,$giro);
		$retval['status'] = $edit[0];
		$retval['message'] = $edit[1];
		echo json_encode($retval);
	}

	if($method == 'list_giro'){
		$list = $dtbs->list_giro();
		$retval['status'] = $list[0];
		$retval['message'] = $list[1];
		$retval['data'] = $list[2];
		echo json_encode($retval);
	}
}else{
	header("HTTP/1.1 401 Unauthorized");
    exit;
}