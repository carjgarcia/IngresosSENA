<?php
    include("../includes/conexion.php");
    session_start();
    if (!isset($_SESSION['idUser'])) {
        header("Location: ../index.html");
    }
    $cedula=$_SESSION['idUser'];
    include("../includes/rellenar_datos_usuario.php");
    $time= mysqli_query($con,"SELECT CURRENT_TIME();");

    if (!$time) {
        die("ERROR AL CONSULTAR HORA");
    }
    $horaActual= mysqli_fetch_array($time)['CURRENT_TIME()'];

    
    $alerta=null;

    $nombres=null;
    $correo=null;
    $sede=$usuario['sede'];
    
    $motivo=null;

    $vehiculo=null;
    $dispositivosIngresados=null;
    if (isset($_POST['btnadd'])){

    }else if(isset($_POST['btncancel'])){
       
    }else if(isset($_POST['ingresar'])){

    }

    $result=mysqli_query($con,"SELECT codigo_ingreso FROM ingreso WHERE cedula='$cedula'");
    if(!$result)die("ERROR".mysqli_error($con));
    $codigoIngreso=null;
    while($row = mysqli_fetch_array($result)){
        $codigoIngreso=$row['codigo_ingreso'];
    }

    $sql = "SELECT dp.codigo_ingreso, d.dispositivo, d.serial, d.placa, d.marca, d.cantidad, d.propiedad, d.autoriza 
    FROM ingresodispositivo as dp INNER JOIN dispositivos as d on dp.id_dispositivos=d.id_dispositivos WHERE dp.codigo_ingreso=$codigoIngreso;";
    $result=mysqli_query($con, $sql);

    $ingresosSalidas=array();
    while($row = mysqli_fetch_array($result)){
        $ingresosSalidas[]=array($row["codigo_ingreso"],$row["dispositivo"],$row["serial"],$row["placa"],$row["marca"],$row["cantidad"],$row["propiedad"],$row["autoriza"],
        );
    }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Salida Sena</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/css/uikit.min.css'>
  <link rel="stylesheet" href="../css/home.css">
</head>
<body>
<!-- partial:index.partial.html -->
<?php include("../includes/navTop.php");?>
<?php include("../includes/navLateral.php");?>
<!-- <div id="sidebar" class="tm-sidebar-left uk-background-default">
    <div class="user">
        <img id="avatar" width="100" class="uk-border-circle" src="../img/usuario.png" />
        <div class="uk-margin-top"></div>
        <h3 class="uk-text-truncate">Carlos Garcia</h3>
        <div id="email" class="uk-text-truncate">carlitosG@gmail.com</div>
        <span id="status" class="uk-margin-top uk-label uk-label-success">Conectado</span>
    </div>
    <br />
    
    <ul class="uk-nav uk-nav-default">

        <li class="uk-nav-header">
            Instructor
        </li>
        <li><a href="../home.html"><button class="btn btn-light">Inicio</button></a></li>
        <li><a href="ingreso.html"><button class="btn btn-success">Ingreso</button></a></li>
        <li><a href="salida.html"><button class="btn btn-warning">Salida</button></a></li>  
        <li><a href=""><button class="btn btn-danger">Cerrar Sesión</button></a></li>

    </ul>
</div>
 -->

<div class="content-padder content-background">
    <div class="uk-section-small uk-section-default header">
        <div class="uk-container uk-container-large">
            <h1 id="tituloSalida"><span uk-icon="server"></span>&nbsp;Salida del nodo</h1>
            <p>
            </p>
            <ul class="uk-breadcrumb">
                <li><a href="../home.html">Inicio</a></li>
                <li><span href="" class="bold">Salida</span></li>
            </ul>
        </div>
    </div>
    <div class="uk-section-small">
        <form>
            <h2>Datos Personales</h2>

            <div class="mb-3">
                <label for="idDocumento" class="form-label">No. de documento</label>
                <input type="text" class="form-control" id="idDocumento" value="<?php echo $cedula?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres Completo</label>
                <input type="text" class="form-control" id="nombres" value="<?php echo $usuario['nombre'];?>" readonly>
            </div>

            <div class="mb-3">
                <label for="sede" class="form-label">Sede</label>
                <input type="email" class="form-control" id="sede" value="<?php echo $usuario["sede"]; ?>" readonly>
            </div>


            <h2>Información de Salida</h2>

            <div class="mb-3 hiddenInput" id="motivoView">
                <label for="floatingTextarea" class="form-label">Motivo Ingreso</label>
                <textarea class="form-control" id="floatingTextarea" placeholder="Digite el motivo de Ingreso "></textarea>
            </div>

            <h2>Sus Salidas</h2>

            <div class="mb-3">
                <label for="dispositivo" class="form-label">¿Trae algun dispositivo?</label>
                <select class="form-select" aria-label="Default select example" id="dispositivo">
                    <option selected value="ninguno">Ninguno</option>
                    <option value="portatil">Portátil</option>
                    <option value="celular">Celular</option>
                    <option value="tablet">Tablet</option>
                    <option value="otro">Otro dispositivo</option>
                </select>
            </div>

            <div class="mb-3 hiddenInput" id="otroDispositivo">
                <label for="otrodis" class="form-label">Otro dispositivo</label>
                <input type="text" class="form-control" id="otrodis" placeholder="Digite el tipo de dispositivo">
            </div>

            <div class="form-group hiddenInput" id="dispositivoDiv">
                <div class="mb-3">
                    <label for="marca" class="form-label">Marca del dispositivo</label>
                    <input type="text" class="form-control" id="marca" placeholder="Digite el código del artículo">
                </div>

                <div class="mb-3">
                    <label for="serial" class="form-label">Serial</label>
                    <input type="text" class="form-control" id="serial" placeholder="Digite el serial del equipo">
                </div>

                <div class="mb-3">
                    <label for="Placa" class="form-label">Placa</label>
                    <input type="text" class="form-control" id="Placa" placeholder="Digite placa de equipo">
                </div>

                <div class="mb-3">
                    <label for="propietario" class="form-label">Propietario</label>
                    <select class="form-select" aria-label="Default select example" id="propietario">
                        <option selected value="sena">Propietario</option>
                        <option value="sena">SENA</option>
                        <option value="personal">Personal</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" placeholder="Digite la cantidad">
                </div>

                <div class="d-grid gap-2 d-md-block text-center">
                    <button class="btn btn-success" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Añadir
                    </button>
                    <button class="btn btn-danger" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        Cancelar
                    </button>
                </div>

            </div>
            <br>
            <div class="tabla">
                <table class="table">
                    <thead class="thead-salida">
                        <tr>
                        <th scope="col">#</th>
                        <th>Producto</th>
                        <th>Serial</th>
                        <th>Placa</th>
                        <th>Marca</th>
                        <th>Cantidad</th>
                        <th>Propietario</th>
                        <th>Autoriza</th>    
                        <th>Accion</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ingresosSalidas as $value):?>
                            <tr>
                                <td><?php echo $value[0]?></td>
                                <td><?php echo $value[1]?></td>
                                <td><?php echo $value[2]?></td>
                                <td><?php echo $value[3]?></td>
                                <td><?php echo $value[4]?></td>
                                <td><?php echo $value[5]?></td>
                                <td><?php echo $value[6]?></td>
                                <td><?php echo $value[7]?></td>
                                <td class="text-center"><button type="button" class="btn btn-outline-dark">Quitar</button></td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            
            <!-- <div class="mb-3">
                <label for="autoriza" class="form-label">Autoriza</label>
                <select class="form-select" aria-label="Default select example" id="autoriza">
                    <option selected value="sena">Autoriza</option>
                    <option value="sena">Manuel Hormechea</option>
                    <option value="personal">Giovanni Zarco</option>
                    <option value="personal">Esther Ramirez</option>
                    <option value="personal">Jorge solano</option>
                </select>
            </div> -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha Actual</label>
                <input type="text" class="form-control" id="fecha" readonly value="<?php echo date('Y-d-m'); ?>">
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label">Hora Actual</label>
                <input type="text" class="form-control" id="hora" readonly value="<?php echo $horaActual?>">
            </div>

            <div class="mb-3 buttons">
                <button type="button" class="btn btn-primary button" id="btnSalir">Salir</button>
            </div>


          </form>
    </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/js/uikit-icons.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.12/jquery.transit.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js'></script><script  src="../js/home.js"></script>
<script src="../js/salida.js"></script>

</body>
</html>
