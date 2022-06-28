<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Código QR con Javascript</title>
		<link rel="preconnect" href="https://fonts.googleapis.com" />
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
		<link rel="stylesheet" href="estilos.css" />
		<script defer src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<script defer src="app.js"></script>
	</head>
	<body>
		<div class="contenedor">
			<!-- <form action="" id="formulario" class="formulario">
				<button class="btn">Generar QR</button>
			</form> -->

			<h1 style="text-align: center;">Generar codigo QR</h1>

			<div id="contenedorQR" class="contenedorQR"></div>
		</div>
	</body>
</html>
