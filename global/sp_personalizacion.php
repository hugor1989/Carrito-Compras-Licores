<?php 

include "dbconn.php";
include "sql_personalizar.php";
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	$method=$_POST['method'];
	$dtbs = new sql_personalizar();
	$retval = [];

	if($method == 'list_restaurante'){
		$idusuario = $_POST['IdUsuario'];
		$idrestaurante = $_POST['IdRestaurante'];
		
		$list = $dtbs->list_restaurante($idusuario, $idrestaurante);
		$retval['status'] = $list[0];
		$retval['message'] = $list[1];
		$retval['data'] = $list[2];
		echo json_encode($retval);
	}

	if($method == 'new_restaurante'){
		$descripcion = $_POST['Descripcion'];
		$new = $dtbs->new_categoria($descripcion);
		$retval['status'] = $new[0];
		$retval['message'] = $new[1];
		echo json_encode($retval);
	}
	if($method == 'edit_restaurante'){
		$id = $_POST['id'];
		$nombre = $_POST['nomnre'];
		// $telefono = $_POST['Telefono'];
	    // $direccion = $_POST['Direccion'];
		// $colonia = $_POST['Colonia'];
		// $cp = $_POST['CodigoPostal'];
		// $ciudad = $_POST['Ciudad'];
		// $municipio = $_POST['Municipio'];
		// $concepto = $_POST['Concepto'];
		// $historia = $_POST['Historia'];
		// $paginaweb = $_POST['PaginaWeb'];
		
		$retval ['message'] = $id." ".$nombre;

		// $edit = $dtbs->edit_restaurante($id,$nombre,$telefono,$direccion,$colonia,$cp,$ciudad,$concepto,$historia,$paginaweb,$municipio );
		// $retval['status'] = $edit[0];
		// $retval['message'] = $edit[1];
		echo json_encode($retval);
	}

	if($method == 'delete_categoria'){
		$Id = $_POST['Id'];
		$delete = $dtbs->delete_categoria($Id);
		$retval['status'] = $delete[0];
		$retval['message'] = $delete[1];
 		echo json_encode($retval);
	}



}else{
	header("HTTP/1.1 401 Unauthorized");
    exit;
}