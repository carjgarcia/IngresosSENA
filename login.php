<?php
	include("./includes/conexion.php");
	session_start();

	$alerta=null;

	if (isset($_POST['cedular']) && isset($_POST['nombrer']) && isset($_POST['contrar']) && isset($_POST['correor'])) {
		$cedul=$_POST['cedular'];
		$name=$_POST['nombrer'];
		$passw=$_POST['contrar'];
		$email=$_POST['correor'];
		
		$sql="INSERT INTO usuarios VALUES('','$cedul','$name','$email','$passw','','instructor')";
		$result= mysqli_query($con,$sql);
		if (!$result) {
			die("Error al guardar usuarios".mysqli_error($con));
		}else{
			header("Location: login.php");
		}
	}

	$cedul=null;
	$passw=null;
	if (isset($_POST['cedula']) && isset($_POST['contra'])) {
		$cedul=$_POST['cedula'];
		$passw=$_POST['contra'];

		$sql="SELECT * FROM usuarios WHERE cedula='$cedul'";
		$result= mysqli_query($con,$sql);
		if (!$result) {
			die("Error al consultar usuarios".mysqli_error($con));
		}

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
				$alerta="contraseña incorrecta";
			}
		} else {
			$alerta="Este usuario no existe!";
		}
		
	}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Ingreso Sena</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans:600'><link rel="stylesheet" href="css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-wrap">
	<div class="login-html">
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab cursorHand">Inicio</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab cursorHand">Registro</label>
		<div class="login-form">
			<form class="sign-in-htm spaceTop" action="" method="POST">
				<div class="group">
					<label for="user" class="label">Numero de documento</label>
					<input id="user" type="text" class="input" name="cedula" value="<?php if(isset($cedul)) echo $cedul; ?>">
				</div>
				<div class="group">
					<label for="pass" class="label">Contraseña</label>
					<input id="pass" type="password" class="input" data-type="password" name="contra" value="<?php if(isset($passw)) echo $passw; ?>">
				</div>
				<div class="group">
					<input id="check" type="checkbox" class="check">
					<label for="check"><span class="icon"></span> Recuerdame</label>
				</div>
				<div class="group">
					<input type="submit" class="button cursorHand" value="Ingresar">
				</div>
				<?php if(isset($alerta)):?>
				<div class="alerta" style="text-align: center;">
					<?php echo $alerta;?>
				</div>
				<?php endif;?>
				<div class="hr"></div>
				<div class="foot-lnk">
					<a href="index.html">Regresar al inicio?</a>
				</div>
			</form>
			<form class="sign-up-htm spaceTop" action="" method="POST">
				<div class="group">
					<label for="cedula" class="label">Numero de identificacion</label>
					<input id="cedula" type="text" class="input" name="cedular">
				</div>
				<div class="group">
					<label for="user" class="label">Nombre Completo</label>
					<input id="user" type="text" class="input" name="nombrer">
				</div>
				<div class="group">
					<label for="pass" class="label">Contraseña</label>
					<input id="pass" type="password" class="input" data-type="password" name="contrar">
				</div>
				<div class="group">
					<label for="pass" class="label">Correo electronico</label>
					<input id="pass" type="text" class="input" name="correor">
				</div>
				<div class="group">
					<input type="submit" class="button cursorHand" value="Registarme">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk">
					<label for="tab-1" class="cursorHand">Ya tengo cuenta?</a>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- partial -->
  
</body>
</html>
