<?php
	include("./includes/conexion.php");
	session_start();

	/*Validación inicio de sesión*/
	$docum=null;
	$passw=null;
	$alerta=null;
	if(isset($_POST['submitInicio'])) {
		$docum=$_POST['cedula'];
		$passw=$_POST['contra'];

		/*Campos vacíos*/
        if(empty($docum)||empty($passw)){
    	    $alerta = "No se permiten campos vacíos.";

		}else {
			/*Número de identificación*/
			if (!is_numeric($docum)){
				$alerta = "El no. de documento sólo debe contener dígitos.";			
			}else{
				/*Nombres*/		
				if (isset($_POST['cedula']) && isset($_POST['contra'])) {
					$sql="SELECT * FROM usuarios WHERE cedula='$docum'";
					$result= mysqli_query($con,$sql);
					/*Cuando no se encuentre ningún registro con dicha cédula*/
					if (!$result) {
						die("Error al consultar usuarios".mysqli_error($con));
					}else{
						if (mysqli_num_rows($result)>0) {
							$usuarios=array();
							while ($row = mysqli_fetch_array($result)) {
								$usuarios= array(
									"cedula"=>$row["cedula"],
									"contra"=>$row["contrasena"],
									"rol"=>$row["rol"]
								);
							}
							if ($passw == $usuarios["contra"]) {
								$rol=$usuarios["rol"];
								if ($rol == "instructor") {
									$_SESSION['idUser']=$usuarios["cedula"];
									header("Location: home.php");
								}elseif ($rol == "administrador") {
									# code...
								}elseif ($rol == "recepcionista") {
									# code...
								}
							}else{
								$alerta="Contraseña incorrecta.";
							}
						}					
					} 					
				}
			}
		}
	}

	/*Validación formulario de registro*/
	
	if(isset($_POST['submitRegistro'])) {
		$cedul=$_POST['cedular'];
		$name=$_POST['nombrer'];
		$passwRegistro=$_POST['contrar'];
		$passwRegistro2=$_POST['contrar2'];
		$email=$_POST['correor'];

		/*Campos vacíos*/
        if(empty($cedul)||empty($name)||empty($passwRegistro)||empty($passwRegistro2)||empty($email)){
    	    $alerta = "No se permiten campos vacíos.";

		}else {
			/*Número de identificación*/
			if (!is_numeric($cedul)){
				$alerta = "El número de identificación debe consistir de sólo dígitos.";			
			}else{

				/*Nombres*/	
				if (is_numeric($name)){
					$alerta = "El nombre no puede contener números.";
				}else{

					/*Correo*/	
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
						$alerta = "El correo es incorrecto.";			
					}else{

						/*Todos los campos tienen valores*/
						if (isset($_POST['cedular']) && isset(($_POST['nombrer'])) && isset(($_POST['contrar'])) && isset(($_POST['contrar2'])) && isset(($_POST['correor']))) {
							/*Si ambas contraseñas coinciden, se registra al instructor*/ 
							if ($passwRegistro===$passwRegistro2){
								$sql="INSERT INTO usuarios VALUES('','$cedul','$name','$email','$passwRegistro','','instructor')";
								$result= mysqli_query($con,$sql);
								if (!$result) {
									die("Error al guardar usuarios".mysqli_error($con));
								}else{
									'<script>
										Swal.fire({
										icon: "success",
										title: "Genial!",
										text: "¡Registro exitoso!",
										window.location = "login.php";
										});
									</script>';
									// header("Location: login.php");
								}	
							}else {
								$alerta = "Las contraseñas no coinciden.";
							}			       
						} 
					}	
				}
			}		
		}		
	}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingreso Sena</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'>
  <link rel="stylesheet" href="css/login.css">
  <!--SWEETALERT 2 CON CSS-->
  <script src="assets/sweet/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="assets/sweet/sweetalert2.css">
  
</head>
<body>
	<!-- partial:index.partial.html -->
	<div class="login-wrap">
		<div class="login-html">
			<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab cursorHand">Inicio</label>
			<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab cursorHand">Registro</label>
			
			<!--FORMULARIO DE INICIO DE SESIÓN-->
			<div class="login-form">
				<form class="sign-in-htm spaceTop" action="" method="POST">
					<div class="group">
						<label for="user" class="label">Numero de documento</label>
						<input id="user" type="text" class="input" name="cedula" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php if(isset($docum)) echo $docum ?>">
					</div>
					<div class="group">
						<label for="pass" class="label">Contraseña</label>
						<input id="pass" type="password" class="input" data-type="password" name="contra" value="<?php if(isset($passw)) echo $passw; ?>">
					</div>
					<div class="group">
						<input id="check" type="checkbox" class="check">
						<label for="check"><span class="icon"></span> Recuérdame</label>
					</div>
					<div class="group">
						<input type="submit" name="submitInicio" id="btnIngresar" class="button cursorHand" value="Ingresar">
					</div>
					<?php if(isset($alerta)):?>
					<div class="alerta" style="text-align: center;">
						<?php echo $alerta;?>
					</div>
					<?php endif;?>
					<div class="hr"></div>
					<div class="foot-lnk">
						<a href="index.php">Regresar al inicio?</a>
					</div>

					
				</form>

				<!--FORMULARIO DE REGISTRO-->		
				<form class="sign-up-htm spaceTop" action="" method="POST">
					<div class="group">
						<label for="cedula" class="label">Numero de identificacion</label>
						<input id="cedula" type="text" class="input" name="cedular" maxlength="12" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php if(isset($docum)) echo $docum ?>" value="<?php if(isset($cedul)) echo $cedul?>">
					</div>
					<div class="group">
						<label for="user" class="label">Nombre Completo</label>
						<input id="user" type="text" class="input" name="nombrer" value="<?php if(isset($name)) echo $name?>">
					</div>
					<div class="group">
						<label for="pass" class="label">Contraseña</label>
						<input id="pass" type="password" class="input" data-type="password" name="contrar">
					</div>
					<div class="group">
						<label for="pass2" class="label">Repetir Contraseña</label>
						<input id="pass2" type="password" class="input" data-type="password" name="contrar2">
					</div>
					<div class="group">
						<label for="pass" class="label">Correo electronico</label>
						<input id="pass" type="text" class="input" name="correor" value="<?php if(isset($email)) echo $email?>">
					</div>
					<div class="group">
						<input type="submit" name="submitRegistro" id="btnRegistrar" class="button cursorHand" value="Registrarme">
					</div>
					<!-- <div class="hr"></div>
					<div class="foot-lnk">
						<label for="tab-1" class="cursorHand">Ya tengo cuenta?</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>

	<script src="js/alerta.js"></script>
</body>
</html>
