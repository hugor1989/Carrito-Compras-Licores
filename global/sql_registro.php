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

	public function new_registro($Negocio,$Nombre,$Apellido,$Telefono,$Email,$password)
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
			$stmt = $db->prepare("INSERT INTO th_usuarios (usr_nombrenegocio, usr_idRol, usr_fecharegistro, usr_nombre,
															usr_apellidos, usr_telefono, usr_puesto, usr_email, usr_usuario, usr_contrasena, CodigoVerificacion) 
										values (:usr_nombrenegocio, :usr_idRol, :usr_fecharegistro,:usr_nombre,:usr_apellidos, :usr_telefono, 
												:usr_puesto,:usr_email, :usr_usuario, :usr_contrasena, :CodigoVerificacion )");
			$stmt->bindParam("usr_nombrenegocio",$Negocio);
			$stmt->bindParam("usr_idRol",$activo);
			$stmt->bindParam("usr_fecharegistro",$hoy);
			$stmt->bindParam("usr_nombre",$Nombre);
			$stmt->bindParam("usr_apellidos",$Apellido);
			$stmt->bindParam("usr_telefono",$Telefono);
			$stmt->bindParam("usr_puesto",$activo);
			$stmt->bindParam("usr_email",$Email);
			$stmt->bindParam("usr_usuario",$Email);
			$stmt->bindParam("usr_contrasena",$password);
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

	public function verificar_cuenta($Codigo)
	{
		$db = $this->dblocal;
		try
		{
			
			//Funcione para Insertar el usuario
			$consulta = "SELECT *
						  FROM th_usuarios 
						  WHERE CodigoVerificacion='$Codigo' ";

			$stmt = $db->prepare($consulta);
			$stmt->execute();

			if($stmt->rowCount() >= 1){

				$stat[0] = true;
				$stat[1] = "Verificacion Correcta";
				
			}else{

				$stat[0] = true;
				$stat[1] = "Codigo de verificacion incorrecto";

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
			/* 	 
			$stat[0] = true;
			$stat[1] = "Registro Exitoso"; */
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

	public function iniciar_sesion($email, $password)
	{
		$db = $this->dblocal;
		try{
			
			 $password = md5($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD
			 $consulta = "SELECT US.Id as IdUsuario, US.Nombre as NombreUsuario, US.Email as EmailUsuario, 
								 RT.Id as IdRestaurante 
						  FROM Usuario US 
						  INNER JOIN Restaurante RT ON RT.IdUsuario=US.Id
						  WHERE US.Email='$email' AND US.Password='$password' ";
			 $stmt = $db->prepare($consulta);
			 $stmt->execute();
			 
			 if($stmt->rowCount() >= 1){
				 //$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
				 while($row = $stmt->fetch()) {
						//$thisdir = getcwd();
						 $_SESSION['usuario'] = $row['NombreUsuario'];
						 $_SESSION['email'] = $row['EmailUsuario'];
						 $_SESSION['IdUsuario'] = $row['IdUsuario'];
						 $_SESSION['IdRestaurante'] = $row['IdRestaurante'];
						 $stat[0] = true;
						 $stat[1] = "Sesion Iniciada Correctamente";
						 $stat[2] = $row['NombreUsuario'];
						 
						 // //Codigo para abrir la carpeta y crear un subdirectorio
						 $idus = $row['IdUsuario'];
						 $idrest= $row['IdRestaurante'];
						 $path = $idus.'/';
						 
						// $dir = $path;
						 if (is_dir($path)) {
							if ($dh = opendir($path)) {
								
								if(!is_dir($path.$idrest)){
									mkdir($path.$idrest,  0777, true);
								}
								closedir($dh);
							}
						}
						 
					}
				 return $stat;
			 }else{
				//$_SESSION["s_usuario"] = null;
				 $stat[0] = false;
				 $stat[1] = "Error Inicio de Sesion";
				 $stat[2] = null;
				 
				 
				 return $stat;
			}
			
		}catch(PDOException $ex){
				 $stat[0] = false;
				 $stat[1] = $ex->getMessage();
				 $stat[2] = null;
				 
			
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

	public function edit_customer($id,$descripcion)
	{
		$db = $this->dblocal;
		try
		{
			$stmt = $db->prepare("update Categoria set Descripcion = :Descripcion where Id = :Id ");
			$stmt->bindParam("Id",$id);
			$stmt->bindParam("Descripcion",$descripcion);
			$stmt->execute();
			$stat[0] = true;
			$stat[1] = "Success edit customer";
			return $stat;
		}
		catch(PDOException $ex)
		{
			$stat[0] = false;
			$stat[1] = $ex->getMessage();
			return $stat;
		}
	}

	public function delete_customer($id)
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