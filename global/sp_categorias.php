<?php 

include "dbconn.php";
include "sql.php";
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	$method=$_POST['method'];
	$dtbs = new sql();
	$retval = [];

	if($method == 'list_categoria'){
		$list = $dtbs->list_categoria();
		$retval['status'] = $list[0];
		$retval['message'] = $list[1];
		$retval['data'] = $list[2];
		echo json_encode($retval);
	}

	if($method == 'new_categoria'){
		$descripcion = $_POST['Descripcion'];
		$idrestaurante = $_POST['IdRestaurante'];
		$new = $dtbs->new_categoria($descripcion,$idrestaurante);
		$retval['status'] = $new[0];
		$retval['message'] = $new[1];
		echo json_encode($retval);
	}
	if($method == 'edit_categoria'){
		$Id = $_POST['Id'];
		$Descripcion = $_POST['Descripcion'];
		

		$edit = $dtbs->edit_categoria($Id,$Descripcion);
		$retval['status'] = $edit[0];
		$retval['message'] = $edit[1];
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