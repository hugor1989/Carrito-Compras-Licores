<?php 
include "dbconn.php";
include "sql_menu.php";
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
	$method=$_POST['method'];
	$dtbs = new sql();
	$retval = [];

	if($method == 'list_menu'){
		$list = $dtbs->list_menu();
		$retval['status'] = $list[0];
		$retval['message'] = $list[1];
		$retval['data'] = $list[2];
		echo json_encode($retval);
	}

	if($method == 'new_menu'){
        $titulo = $_POST['Titulo'];
        $descripcion = $_POST['Descripcion'];
        $idcategoria = $_POST['IdCategoria'];
        $idrestaurante = $_POST['IdRestaurante'];
        $precio = $_POST['Precio'];
		$new = $dtbs->new_menu($titulo,$descripcion,$idcategoria,$idrestaurante,$precio);
		$retval['status'] = $new[0];
		$retval['message'] = $new[1];
		echo json_encode($retval);
	}
	if($method == 'edit_menu'){
		$Id = $_POST['Id'];
        $Titulo = $_POST['Titulo'];
        $Descripcion = $_POST['Descripcion'];
        $IdCategoria = $_POST['IdCategoria'];
		$Precio = $_POST['Precio'];
		$edit = $dtbs->edit_menu($Id,$Titulo,$Descripcion,$IdCategoria,$Precio);
		$retval['status'] = $edit[0];
		$retval['message'] = $edit[1];
		echo json_encode($retval);
	}

	if($method == 'delete_menu'){
		$Id = $_POST['Id'];
		$delete = $dtbs->delete_menu($Id);
		$retval['status'] = $delete[0];
		$retval['message'] = $delete[1];
 		echo json_encode($retval);
	}



}else{
	header("HTTP/1.1 401 Unauthorized");
    exit;
}