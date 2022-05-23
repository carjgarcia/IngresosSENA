<?php
    include("./includes/conexion.php");
    session_start();
    if (!isset($_SESSION['idUser'])) {
        header("Location: index.html");
    }

    $cedula=$_SESSION['idUser'];
    $sql= "SELECT * FROM usuarios WHERE cedula='$cedula'";
    $result= mysqli_query($con,$sql);
	if (!$result) {
		die("Error al consultar usuarios".mysqli_error($con));
	}

    $usuario=array();
    while ($row = mysqli_fetch_array($result)) {
        $usuario=array(
            "nombre"=>$row["nombres"],
            "correo"=>$row["correo"]
        );
    }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Ingreso Sena</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/css/uikit.min.css'>
  <link rel="stylesheet" href="./css/home.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div uk-sticky class="uk-navbar-container tm-navbar-container uk-active uk-light">
    <div class="uk-container uk-container-expand">
        <nav uk-navbar>
            <div class="uk-navbar-left">
                <a id="sidebar_toggle" class="uk-navbar-toggle" uk-navbar-toggle-icon></a>
                <a href="#" class="uk-navbar-item uk-logo">
                    Ingresos Sena
                </a>
            </div>
            <div class="uk-navbar-right uk-light">
                <ul class="uk-navbar-nav">
                    <li class="uk-active">
                        <a href="#"><?php echo $usuario["nombre"];?> &nbsp;<span uk-icon="chevron-down"></span></a>
                        <div uk-dropdown="pos: bottom-right; mode: click; offset: -17;">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header">Opciones</li>
                                <li><a href="#">Editar Perfil</a></li>
                                <li class="uk-nav-header">Acciones</li>
                                <li><a href="includes/logout.php">Cerrar sesión</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
<div id="sidebar" class="tm-sidebar-left uk-background-default">
    <div class="user">
        <img id="avatar" width="100" class="uk-border-circle" src="img/usuario.png" />
        <div class="uk-margin-top"></div>
        <h3 class="uk-text-truncate"><?php echo $usuario["nombre"];?></h3>
        <div id="email" class="uk-text-truncate"><?php echo $usuario["correo"];?></div>
        <span id="status" class="uk-margin-top uk-label uk-label-success">Conectado</span>
    </div>
    <br />
    
    <ul class="uk-nav uk-nav-default">

        <li class="uk-nav-header">
            Instructor
        </li>
        <li><a href="home.php"><button class="btn btn-light">Inicio</button></a></li>
        <li><a href="pages/ingreso.php"><button class="btn btn-success">Ingreso</button></a></li>
        <li><a href="./pages/salida.html"><button class="btn btn-warning">Salida</button></a></li>  
        <li><a href=""><button class="btn btn-danger">Cerrar Sesión</button></a></li>
        
    </ul>
</div>
<div class="content-padder content-background">
    <div class="uk-section-small uk-section-default header">
        <div class="uk-container uk-container-large">
            <h1></span>Inicio</h1>
            <p style="font-weight: bold; font-size: 25px; ">
                Bienvenido, <?php echo $usuario["nombre"];?>
            </p>
            <ul class="uk-breadcrumb">
                <li><a href="home.php" class="bold">Inicio</a></li>
                <a href="./pages/ingreso.php"><li><span>Ingreso</span></li></a>
            </ul>
        </div>
    </div>
    </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit-icons.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.12/jquery.transit.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js'></script><script  src="./js/home.js"></script>

</body>
</html>
