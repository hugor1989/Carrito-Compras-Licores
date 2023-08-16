<?php
session_start();
class sql extends dbconn {
	
	
	public function __construct()
	{
		$this->initDBO();
	}

	public function new_categoria($descripcion,$idrestaurante)
	{
		$db = $this->dblocal;
		try
		{
			
			//$IdRestaurante = '16';
			$stmt = $db->prepare("insert into Categoria(Descripcion,Restaurante ) values (:Descripcion, :Restaurante)");
			$stmt->bindParam(':Descripcion',$descripcion);
			$stmt->bindParam(':Restaurante',$idrestaurante);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "Success save categoria";
			return $stat;
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
	}

	public function list_categoria()
	{
		$db = $this->dblocal;
		try
		{
			 $username = $_SESSION['username'];
			$idrestaurante = $_SESSION['IdRestaurante'];
			$stmt = $db->prepare("SELECT * FROM Categoria WHERE Restaurante='$idrestaurante'");
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "List categoria";
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

	public function edit_categoria($id,$descripcion)
	{
		$db = $this->dblocal;
		try
		{
			$idrestaurante = $_SESSION['IdRestaurante'];
			$stmt = $db->prepare("update Categoria set Descripcion = :Descripcion where Id = :Id AND Restaurante = :Restaurante");
			$stmt->bindParam("Id",$id);
			$stmt->bindParam("Descripcion",$descripcion);
			$stmt->bindParam("Restaurante",$idrestaurante);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "Success edit categoria";
			return $stat;
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
	}

	public function delete_categoria($id)
	{
		$db = $this->dblocal;
		try
		{
			$stmt = $db->prepare("delete from Categoria where Id = :Id");
			$stmt->bindParam("Id",$id);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "Success delete categoria";
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