<?php
 session_start();

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;

 require '../lib/vendor/autoload.php';

class sql_registro extends dbconn {
	public function __construct()
	{
		$this->initDBO();
	}

	public function new_registro($Negocio,$Puesto,$Nombre,$Apellido,$Telefono,$Email,$password,$Giro)
	{
		$db = $this->dblocal;
		try
		{
			date_default_timezone_set("America/Mexico_City");
			//$clave  = md5($password);
			$hoy = date('Y-m-d H:i:s');
			$activo = 1;
			

			$rand = rand(4,100); 

			//Funcione para Insertar el usuario
			$stmt = $db->prepare("INSERT INTO th_usuarios (usr_nombrenegocio, usr_idRol, usr_fecharegistro, usr_nombre, usr_giroempresa,
															usr_apellidos, usr_telefono, usr_puesto, usr_email, usr_usuario, usr_contrasena, CodigoVerificacion) 
										values (:usr_nombrenegocio, :usr_idRol, :usr_fecharegistro,:usr_nombre, :usr_giroempresa ,:usr_apellidos, :usr_telefono, 
												:usr_puesto,:usr_email, :usr_usuario, :usr_contrasena, :CodigoVerificacion )");
			$stmt->bindParam("usr_nombrenegocio",$Negocio);
			$stmt->bindParam("usr_idRol",$activo);
			$stmt->bindParam("usr_giroempresa",$Giro);
			$stmt->bindParam("usr_fecharegistro",$hoy);
			$stmt->bindParam("usr_nombre",$Nombre);
			$stmt->bindParam("usr_apellidos",$Apellido);
			$stmt->bindParam("usr_telefono",$Telefono);
			$stmt->bindParam("usr_puesto",$Puesto);
			$stmt->bindParam("usr_email",$Email);
			$stmt->bindParam("usr_usuario",$Email);
			$stmt->bindParam("usr_contrasena",$password);
			$stmt->bindParam("CodigoVerificacion",$rand);
			$stmt->bindParam("CodigoVerificacion",$rand);
			$stmt->execute();
			$lastInsertId = $db->lastInsertId();
			

			if($lastInsertId > 0){

				try {
					$mail = new PHPMailer(true);
					$mail->CharSet = 'UTF-8';
					$mail->isSMTP();
					$mail->Host = 'mail.solhex.com.mx';
					$mail->SMTPAuth = true;
					$mail->Username = 'notificaciones@solhex.com.mx';
					$mail->Password = 'U&vq}Z_1sI+P';
					$mail->SMTPSecure = 'ssl';
					$mail->Port = 465;
			
					$mail->setFrom('notificaciones@solhex.com.mx');
			
			
			
					//$to = $cadena_formateada;
					$nome = 'Thirsty';
					$assunto = "Codigo de Verificacion de Cuenta";
					$mensagem = 'Este tu codigo de verificacion de cuenta '. $rand;				//An HTML or plain text message body"hola mensahe de prueba";
			
					//$reply= $data[email];
				
			
					$mail->AddAddress($Email, $nome);
					//$mail->AddAddress('saule.castro@apar.com.mx', $nome);		//Adds a "To" address
					$mail->ConfirmReadingTo = "notificaciones@solhex.com.mx";
					// $mail->addReplyTo($reply);
					$mail->WordWrap = 50;
					$mail->IsHTML(true);
					//$mail->addStringAttachment($file, $nombrearchiv);
					//$mail->AddAttachment('../../pdf/aseguradoraspdf/condiciones_chubb.pdf', 'condiciones_chubb.pdf');
					//$mail->addStringAttachment($filenuevo, $Nombre_ReciboCobro);   
					$mail->Subject = $assunto;
	
					$tm = '<html>
					<body>
					<h1>Detalles de la cotizacion</h1>
					<p>
					Mensaje: '.$mensagem. ' </br>
					
					 </p>
					</body>
					</html>';
	
					$mail->MsgHTML($tm);
					//$mail->Body = $tm;//'<br/>' . $mensagem . ' Comentarios'. $ComentariosRevision . '<br/>';
					$mail->AltBody = "$mensagem";
			
			
					$mail->send();
					unset($data);
			   
				}catch (Exception $e) {
			  
				}
				
			}

			//Codigo para guardar en una variable el id y poder crear la carpeta
			//$estructura = $lastInsertId;
			
			//Funcion para Insertar el Resturante tomando como variable el Id del usuario por eso se pone en la
			//misma transaccion
			/* $stmt = $db->prepare("insert into Restaurante (Nombre, IdUsuario) values (:Nombre, :IdUsuario)");
			$stmt->bindParam("Nombre",$negocio);
			$stmt->bindParam("IdUsuario",$lastInsertId);
			$stmt->execute(); */
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

	public function verificar_cuenta($Codigo, $Email)
	{
		$db = $this->dblocal;
		try
		{
			
			//Funcione para Insertar el usuario
			$consulta = "SELECT *
						  FROM th_usuarios 
						  WHERE CodigoVerificacion='$Codigo' AND usr_email='$Email' ";

			$stmt = $db->prepare($consulta);
			$stmt->execute();

			//Se valida que existe al menos 1 registro para despues realizar un update a la tabla de usuarios para actizalizar el campo de EmailVerificado
			if($stmt->rowCount() >= 1){

				/* $stat[0] = true;
				$stat[1] = "Verificacion Correcta"; */
				try
				{

					$Estatus=1;

					$stmt1 = $db->prepare("UPDATE th_usuarios set EmailVerificado = :EmailVerificado where CodigoVerificacion = :CodigoVerificacion ");
					$stmt1->bindParam("EmailVerificado",$Estatus);
					$stmt1->bindParam("CodigoVerificacion",$Codigo);
					//$stmt1->execute();

					if($stmt1->execute() !== false && $stmt1->rowCount() > 0)
					{
						$stat[0] = true;
						$stat[1] = "Verificación Correcta";
						return $stat;
					}else
					{
						$stat[0] = true;
						$stat[1] = "No se pudo verificar la cuenta";
						return $stat;
					}


					
				}catch(PDOException $ex)
				{
					$stat[0] = false;
					$stat[1] = $ex->getMessage();
					return $stat;
				}
				
			}else{

				$stat[0] = false;
				$stat[1] = "Código de verificación incorrecto";


				return $stat;

			}
			
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

	public function verificar_email($Email)
	{
		$db = $this->dblocal;
		try
		{
			
			//Funcione para Insertar el usuario
			$consulta = "SELECT *
						  FROM th_usuarios 
						  WHERE usr_email='$Email' ";

			$stmt = $db->prepare($consulta);
			$stmt->execute();

			//Se valida que existe al menos 1 registro para despues realizar un update a la tabla de usuarios para actizalizar el campo de EmailVerificado
			if($stmt->rowCount() >= 1){

				$stat[0] = true;
				$stat[1] = "ya registrado, favor de usar otro correo electrónico";
				return $stat;
				
			}else{

				$stat[0] = false;
				$stat[1] = "El email de usuario es válido";


				return $stat;

			}
			
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

	public function iniciar_sesion($email, $password)
	{
		$db = $this->dblocal;
		try{
			
			// $password = md5($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD
			 $consulta = "SELECT * 
						  FROM th_usuarios 
						  WHERE usr_usuario='$email' AND usr_contrasena='$password' ";
			 $stmt = $db->prepare($consulta);
			 $stmt->execute();
			 
			 if($stmt->rowCount() >= 1){
				 
				 while($row = $stmt->fetch()) {

						if($row['EmailVerificado'] == 0){

							$stat[0] = false;
							$stat[1] = "Aun no haz verificado tu cuenta, favor de verificar para proceder con la activacion de tu cuenta";
							$stat[2] = $row['usr_nombre'].' '.$row['usr_nombre'];
							$stat[3] = $row['EmailVerificado'];
						}else{


							$_SESSION['negocio'] = $row['usr_nombrenegocio'];
							$_SESSION['rol'] = $row['usr_idRol'];
							$_SESSION['nombre'] = $row['usr_nombre'].' '.$row['usr_apellidos'];
							$_SESSION['email'] = $row['usr_email'];
							$_SESSION['tipocosto'] = $row['usr_tipocosto'];
							$_SESSION['sucursales'] = $row['usr_nosucursales'];
							$_SESSION['diascredito'] = $row['usr_diascredito'];
							$_SESSION['montocredito'] = $row['usr_montocredito'];
							$_SESSION['status'] = $row['usr_estatus'];
							$_SESSION['Nombre'] = $row['usr_nombre'];
							$_SESSION['Apellido'] = $row['usr_apellidos'];
							$_SESSION['Id'] = $row['usr_idUsuario'];
   
							$stat[0] = true;
							$stat[1] = "Sesión iniciada correctamente";
							$stat[2] = $row['usr_nombre'].' '.$row['usr_apellidos'];
							$stat[3] = $row['EmailVerificado'];
						}
						 
					}
				 return $stat;
			 }else{
				//$_SESSION["s_usuario"] = null;
				 $stat[0] = false;
				 $stat[1] = "Error Inicio de Sesion";
				 $stat[2] = null;
				 $stat[3] = null;
				 
				 
				 return $stat;
			}
			
		}catch(PDOException $ex){
				 $stat[0] = false;
				 $stat[1] = $ex->getMessage();
				 $stat[2] = null;
				 $stat[3] = null;
				 
			
			return $stat;
		}
	}

	public function list_giro()
	{
		$db = $this->dblocal;
		try
		{
			$stmt = $db->prepare("SELECT * FROM th_cat_girosempresas");
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "List giro";
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

	public function list_sucursales($idUsuario)
	{
		$db = $this->dblocal;
		try
		{

			$item="suc_idCliente";

			$stmt = $db->prepare("SELECT * FROM th_usuariossucursales WHERE suc_idCliente=$idUsuario");

			
			$stmt -> execute();

			$resultado = $stmt -> fetchAll();

		

			$stat[0] = true;
			$stat[1] = "List sucursales";
			$stat[2] = $resultado;
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
	public function list_customer()
	{
		$db = $this->dblocal;
		try
		{
			$stmt = $db->prepare("select * from Categoria");
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "List customer";
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

	public function actualizar_perfil($idUsuario,$nosucursales,$ticket,$nomesas,$noempleados,$files,$plazopago,$price_filter,$nameref1,$telref1,$dirref1,$comment1,$nameref2,$telref2,$dirref2,$comment2)
	{
		$db = $this->dblocal;
		try
		{

			
			$Estatus=2;

			$stmt1 = $db->prepare("UPDATE th_usuarios set usr_nosucursales = :usr_nosucursales, usr_ticketpromedio = :usr_ticketpromedio, 
										usr_numeromesas = :usr_numeromesas, usr_numeroempleados = :usr_numeroempleados, usr_diascredito = :usr_diascredito, 
										usr_montocredito = :usr_montocredito, usr_archivocsf = :usr_archivocsf, usr_nombrereferencia = :usr_nombrereferencia, 
										usr_telefonoreferencia = :usr_telefonoreferencia, usr_dirreferencia = :usr_dirreferencia, usr_comreferencia = :usr_comreferencia,
										usr_nombrereferencia2 = :usr_nombrereferencia2, usr_telefonoreferencia2 = :usr_telefonoreferencia2,usr_dirreferencia2 = :usr_dirreferencia2,
										usr_comreferencia2 = :usr_comreferencia2, usr_estatus = :usr_estatus  where usr_idUsuario = :usr_idUsuario ");
			$stmt1->bindParam("usr_idUsuario",$idUsuario);
			$stmt1->bindParam("usr_nosucursales",$nosucursales);
			
			$stmt1->bindParam("usr_ticketpromedio",$ticket);
			$stmt1->bindParam("usr_numeromesas",$nomesas);
			$stmt1->bindParam("usr_numeroempleados",$noempleados);
			$stmt1->bindParam("usr_diascredito",$plazopago);
			$stmt1->bindParam("usr_montocredito",$price_filter);
			$stmt1->bindParam("usr_archivocsf",$files);
			$stmt1->bindParam("usr_nombrereferencia",$nameref1);
			$stmt1->bindParam("usr_telefonoreferencia",$telref1);
			$stmt1->bindParam("usr_dirreferencia",$dirref1);
			$stmt1->bindParam("usr_comreferencia",$comment1);
			$stmt1->bindParam("usr_nombrereferencia2",$nameref2);
			$stmt1->bindParam("usr_telefonoreferencia2",$telref2);
			$stmt1->bindParam("usr_dirreferencia2",$dirref2);
			$stmt1->bindParam("usr_comreferencia2",$comment2);
			$stmt1->bindParam("usr_estatus",$Estatus);

			if($stmt1->execute() !== false && $stmt1->rowCount() > 0)
			{
				$stat[0] = true;
				$stat[1] = "Información actulizada correctamente";
				return $stat;
			}else{
				$stat[0] = true;
				$stat[1] = "No se pudo actualizar la información";
				return $stat;
			}


		/* 	$stmt = $db->prepare("UPDATE Categoria set Descripcion = :Descripcion where Id = :Id ");
			$stmt->bindParam("Id",$id);
			$stmt->bindParam("Descripcion",$descripcion);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "Success edit customer";
			return $stat; */
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
		
	}

	public function agregar_sucursal($idCliente,$nombresucursal,$contactosuc,$telefonosuc,$emailsuc,$direccion,$latitud,$longitud)
	{
		$db = $this->dblocal;
		try
		{
			
			$activo = 1;
			

			//Funcione para Insertar el usuario
			$stmt = $db->prepare("INSERT INTO th_usuariossucursales (suc_idCliente, suc_nombresucursal, suc_contactosucursal, suc_telefono, suc_email,
																	 suc_direccion, suc_latitud, suc_longitud, suc_estatus) 
										values (:suc_idCliente, :suc_nombresucursal, :suc_contactosucursal, :suc_telefono, :suc_email ,:suc_direccion, :suc_latitud, 
												:suc_longitud,:suc_estatus )");
			$stmt->bindParam("suc_idCliente",$idCliente);
			$stmt->bindParam("suc_nombresucursal",$nombresucursal);
			$stmt->bindParam("suc_contactosucursal",$contactosuc);
			$stmt->bindParam("suc_telefono",$telefonosuc);
			$stmt->bindParam("suc_email",$emailsuc);
			$stmt->bindParam("suc_direccion",$direccion);
			$stmt->bindParam("suc_latitud",$latitud);
			$stmt->bindParam("suc_longitud",$longitud);
			$stmt->bindParam("suc_estatus",$activo);
			
			$stmt->execute();
			$lastInsertId = $db->lastInsertId();
			

			if($lastInsertId > 0){

				$stat[0] = true;
				$stat[1] = "Sucursal agregada correctamente";
			return $stat;
			}else{

				$stat[0] = false;
				$stat[1] = "No se registro la sucursal, favor de intentar de nuevo";
				return $stat;

			}

		
			
		}
		catch(PDOException $ex)
		{
			$lastInsertId = 0;
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
	}

	public function list_pruductosindex()
	{
		$db = $this->dblocal;
		try
		{


			$stmt = $db->prepare("SELECT * FROM th_cat_productos ORDER BY `pro_idProducto` DESC LIMIT 8");
			$stmt->execute();
			$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);


		

			$stat[0] = true;
			$stat[1] = "List Productos";
			$stat[2] = $clientes;
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

	public function obtenerproducto_detalleId($Id)
	{
		$db = $this->dblocal;
		try
		{


			$consulta = "SELECT * 
							FROM th_cat_productos 
							WHERE pro_idProducto=$Id ";
			$stmt = $db->prepare($consulta);
			$stmt->execute();
			$product = $stmt->fetch();

			$stat[0] = true;
			$stat[1] = "Producto";
			$stat[2] = $product;
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

}