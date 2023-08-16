<?php
 session_start();
class sql_personalizar extends dbconn {
	public function __construct()
	{
		$this->initDBO();
	}

	public function new_restaurante($nombre,$username,$negocio,$email,$password)
	{
		$db = $this->dblocal;
		try
		{
			date_default_timezone_set("America/Mexico_City");
			$clave  = md5($password);
			$hoy = date('Y-m-d H:i:s');
			$activo = 1;
			
			$stmt = $db->prepare("insert into Usuario (Nombre, Username, Email, Password, Activo, Fecha) values (:Nombre, :Username, :Email, :Password, :Activo, :Fecha )");
			$stmt->bindParam("Nombre",$nombre);
			$stmt->bindParam("Username",$username);
			$stmt->bindParam("Email",$email);
			$stmt->bindParam("Password",$clave);
			$stmt->bindParam("Fecha",$hoy);
			$stmt->bindParam("Activo",$activo);
			$stmt->execute();
			$lastInsertId = $db->lastInsertId();
			
			$stmt = $db->prepare("insert into Restaurante (Nombre, IdUsuario) values (:Nombre, :IdUsuario)");
			$stmt->bindParam("Nombre",$negocio);
			$stmt->bindParam("IdUsuario",$lastInsertId);
			$stmt->execute();
			//$lastInsertIdRestaurate = $db->lastInsertId();
				 
			$stat[0] = true;
			$stat[1] = "Registro Exitoso";
			//$stat[2] = $lastInsertId;
			//$stat[3] = $lastInsertIdRestaurate;
			return $stat;
		}
		catch(PDOException $ex)
		{
			$lastInsertId = 0;
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			//$stat[2] = $lastInsertId;
			return $stat;
		}
	}
	public function list_restaurante($IdUsuario, $IdRestaurante)
	{
		$db = $this->dblocal;
		try
		{
			 $consulta = "SELECT * 
						  FROM Restaurante
						  WHERE IdUsuario='$IdUsuario' AND Id='$IdRestaurante' ";
			 $stmt = $db->prepare($consulta);
			 $stmt->execute();
			 
			$infor = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stat[0] = true;
			$stat[1] = "Informacion Restaurante";
			$stat[2] = $infor;
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

	public function edit_restaurante($Id,$nombre,$telefono,$direccion,$colonia,$cp,$ciudad,$concepto,$historia,$paginaweb,$municipio )
	{
		$db = $this->dblocal;
		try
		{
			$pais="Pais";
			$stmt = $db->prepare("update Restaurante set Nombre = :Nombre, Direccion = :Direccion, Colonia = :Colonia, CodigoPostal = :CodigoPostal, 
										 Ciudad=:Ciudad, Municipio = :Municipio, Pais = :Pais, Historia = :Historia, Concepto=:Concepto, 
										 Telefono = :Telefono, Pagina = :Pagina
								  WHERE Id = '$Id' ");
			$stmt->bindParam("Nombre",$nombre);
			$stmt->bindParam("Direccion",$direccion);
			$stmt->bindParam("Colonia",$colonia);
			$stmt->bindParam("CodigoPostal",$cp);
			$stmt->bindParam("Ciudad",$ciudad);
			$stmt->bindParam("Municipio",$municipio);
			$stmt->bindParam("Pais",$pais);
			$stmt->bindParam("Historia",$historia);
			$stmt->bindParam("Concepto",$concepto);
			$stmt->bindParam("Telefono",$telefono);
			$stmt->bindParam("Pagina",$paginaweb);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "Informacion Guardada Correctamente";
			return $stat;
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
	}

	public function delete_restaurante($id)
	{
		$db = $this->dblocal;
		try
		{
			$stmt = $db->prepare("delete from Categoria where Id = :Id");
			$stmt->bindParam("Id",$id);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "Success delete customer";
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