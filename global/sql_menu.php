<?php
session_start();
class sql extends dbconn {
	
	
	public function __construct()
	{
		$this->initDBO();
	}

	public function new_menu($titulo,$descripcion, $idcategoria, $idrestaurante,  $precio)
	{
		$db = $this->dblocal;
		try
		{
			
			//$IdRestaurante = '16';
			$stmt = $db->prepare("insert into Menu(Titulo, Descripcion, Categoria, Restaurante, Precio ) values (:Titulo,:Descripcion, :Categoria, :IdRestaurante, :Precio)");
            $stmt->bindParam(':Titulo', $titulo);
            $stmt->bindParam(':Descripcion', $descripcion);
            $stmt->bindParam(':Categoria', $idcategoria);
            $stmt->bindParam(':Restaurante', $idrestaurante);
            $stmt->bindParam(':Precio', $precio);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "Menu Guardado Correctamente";
			return $stat;
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
	}

	public function list_menu()
	{
		$db = $this->dblocal;
		try
		{
			 $username = $_SESSION['username'];
			 $idrestaurante = $_SESSION['IdRestaurante'];
			
			$stmt = $db->prepare("SELECT MN.Id AS MenuId, MN.Titulo AS MenuTitulo, 
										 MN.Descripcion AS MenuDescripcion, CT.Id AS CategoriaId,
										 CT.Descripcion AS CategoriaDescripcion,
								  		 MN.Precio, MN.Restaurante, MN.Imagen 
								  FROM Menu AS MN 
								  INNER JOIN Categoria AS CT ON CT.Id=MN.Categoria
								  WHERE MN.Restaurante='$idrestaurante'");
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "List menu";
			$stat[2] = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $stat;
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			$stat[2] = [];
			return $stat;
		}
	}

	public function edit_menu($id, $titulo, $descripcion, $categoria, $precioventa)
	{
		$db = $this->dblocal;
		try
		{
			$idrestaurante = $_SESSION['IdRestaurante'];
			$stmt = $db->prepare("UPDATE Menu SET Titulo = :Titulo, Descripcion = :Descripcion, Precio = :Precio, Categoria = :Categoria
								  WHERE Id = :Id 
								  AND Restaurante = :Restaurante");
			$stmt->bindParam("Id",$id);
			$stmt->bindParam("Titulo",$titulo);
			$stmt->bindParam("Descripcion",$descripcion);
			$stmt->bindParam("Precio",$precioventa);
			$stmt->bindParam("Categoria",$categoria);
			$stmt->bindParam("Restaurante",$idrestaurante);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "Actualizado Correctamente";
			return $stat;
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
	}

	public function delete_menu($id)
	{
		$db = $this->dblocal;
		try
		{
			$stmt = $db->prepare("DELETE FROM Menu WHERE Id = :Id");
			$stmt->bindParam("Id",$id);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "Success delete menu";
			return $stat;
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
	}

}