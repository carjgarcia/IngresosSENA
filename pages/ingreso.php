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

    /* Datos Personales */
    $nombre=null;
    $correo=null;
    $sede=null;
    /* Informacion de Ingreso */
    $motivo=null;
    $vehículo=null;
    /*  Dispositivos */
    if (isset($_POST['btnadd'])) {
        $dispositivos=$_POST['dispositivo'];
        $marca=$_POST['marca'];
        $serial=$_POST['serial'];
        $placa=$_POST['placa'];
        $uso=$_POST['uso'];
        $cantidad=$_POST['cantidad'];

        if (!isset($_SESSION['dispositivos'])) {
            $_SESSION['dispositivos']=array();
        }

        $_SESSION['dispositivos'][]=array(
            "dispositivo"=>$dispositivos,
            "marca"=>$marca,
            "serial"=>$serial,
            "placa"=>$placa,
            "uso"=>$uso,
            "cantidad"=>$cantidad
        );
    }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingreso Sena</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/css/uikit.min.css'>
  <link rel="stylesheet" href="../css/home.css">
  <script src="../assets/sweet/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="../assets/sweet/sweetalert2.css">
</head>
<body>

<?php include("../includes/navTop.php");?>
<?php include("../includes/navLateral.php");?>

<div class="content-padder content-background">
    <div class="uk-section-small uk-section-default header">
        <div class="uk-container uk-container-large">
            <h1 id="tituloIngreso"><span uk-icon="server"></span>&nbsp;Ingreso al nodo</h1>
            <p>
            </p>
            <ul class="uk-breadcrumb">
                <li><a href="../home.php">Inicio</a></li>
                <li><span href="" class="bold">Ingresos</span></li>
            </ul>
        </div>
    </div>
    <div class="uk-section-small">
        <form id="">
            <?php if(isset($alerta)):?>
            <div class="alert alert-danger" role="alert" style="font-size: 20px;">
                <?php echo $alerta;?>
            </div>
            <?php endif;?>
            <h2>Datos Personales</h2>
            <div class="mb-3">
                <label for="idDocumento" class="form-label">No. de documento</label>
                <input type="text" class="form-control" id="idDocumento" value="<?php echo $cedula;?>" name="documento" readonly required>
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres Completos</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $usuario['nombre'];?>" required>
            </div>

            <div class="mb-3">
                <label for="Correo" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $usuario['correo'];?>" required>
            </div>

            <div class="mb-3">
                <label for="sede" class="form-label">Sede o nodo al que pertenece</label>
                <select class="form-select" aria-label="Default select example" id="sede" name="sede">
                    <option selected value="Sede TIC" <?php if(isset($sede)) if($sede=="Sede TIC") echo 'selected'?>>Sede TIC</option>
                    <option value="Nodo Electricidad Y Electronica" <?php if(isset($sede)) if($sede=="Nodo Electricidad Y Electronica") echo 'selected'?>>Nodo Electricidad Y Electronica</option>
                    <option value="Centro De Comercio Y Servicios" <?php if(isset($sede)) if($sede=="Centro De Comercio Y Servicios") echo 'selected'?>>Centro De Comercio Y Servicios</option>
                    <option value="Sede Energía" <?php if(isset($sede)) if($sede=="Sede Energía") echo 'selected'?>>SENA Sede Energía</option>    
                    <option value="Sede Logística y Transporte" <?php if(isset($sede)) if($sede=="Sede Logística y Transporte") echo 'selected'?>>Sede Logística y Transporte</option>
                </select>
            </div>


            <h2>Información de Ingreso</h2>

            <div class="mb-3 <?php if(isset($sede)) if($sede=="Sede TIC" || $sede=="") echo 'hiddenInput';?>" id="motivoView">
                <label for="floatingTextarea" class="form-label">Motivo Ingreso</label>
                <textarea class="form-control" id="motivo" name="motivo" placeholder="Digite el motivo de Ingreso "></textarea>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">¿Trajo vehículo?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>

                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="vehiculo" value="Si" id="btnradio1" autocomplete="off">
                    <label class="btn btn-outline-danger" for="btnradio1">SI</label>
                  
                    <input type="radio" class="btn-check" name="vehiculo" value="No" id="btnradio2" autocomplete="off" checked>
                    <label class="btn btn-outline-danger" for="btnradio2">NO</label>
                  </div>
            </div>

            <h4>Tus Ingresos Sena</h4>
            <div class="tabla">
            <table class="table" id="tablaDispositivos">
                <thead class="thead-ingreso">
                    <tr>
                        <th>Producto</th>
                        <th>Marca</th>
                        <th>Serial</th>
                        <th>Placa</th>
                        <th>Propietario</th>
                        <th>Cantidad</th>    
                        <th>Accion</th>    
                    </tr>
                </thead>
                <tbody id="cuerpotabla">
                </tbody>
            </table>
            </div>
            
            <!-- <div class="tabla">
                <table class="table" id="tablaDispositivos">
                    <thead class="thead-ingreso">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Placa o Serial</th>
                        <th scope="col">Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Telefono</td>
                        <td>16262545</td>
                        <td class="text-center"><button type="button" class="btn">Ingresar</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div> -->

            
            <div class="mb-3">
                <label for="dispositivos" class="form-label">¿Trae algun dispositivo?</label>
                <select class="form-select" aria-label="Default select example" id="dispositivos" name="dispositivos">
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
                    <input type="text" class="form-control" id="marca" name="marca" placeholder="Digite la marca del artículo">
                </div>

                <div class="mb-3">
                    <label for="serial" class="form-label">Serial</label>
                    <input type="text" class="form-control" id="serial" name="serial" placeholder="Digite el serial del equipo">
                </div>

                <div class="mb-3">
                    <label for="Placa" class="form-label">Placa</label>
                    <input type="text" class="form-control" id="placa" name="placa" placeholder="Digite placa de equipo">
                </div>

                <div class="mb-3">
                    <label for="propietario" class="form-label">Propietario</label>
                    <select class="form-select" aria-label="Default select example" id="propietario" name="propietario">
                        <option selected value="propietario">Propietario</option>
                        <option value="sena">SENA</option>
                        <option value="personal">Personal</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad">
                </div>
                    
                <div class="d-grid gap-2 d-md-block text-center">
                    <button class="btn btn-success" id="agregar" name="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        AGREGAR
                    </button>
                    <button class="btn btn-danger" id="editar" name="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        EDITAR
                    </button>
                    <button id="limpiar">LIMPIAR CAMPOS</button>
                </div>
            
            </div>
            <br>
                    <?php if(isset($_SESSION['dispositivos'])):?>
                        <div class="tabla">
                        <table class="table">
                            <thead class="thead-ingreso">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Dispositivo</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Serial</th>
                                <th scope="col">Propietario</th>
                                <th scope="col">Accion</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($_SESSION['dispositivos'] as $key => $value):?>
                                    <tr pos="<?php echo $key;?>">
                                        <th scope="row"><?php echo $key+1;?></th>
                                        <td><?php echo $value['dispositivo'];?></td>
                                        <td><?php echo $value['marca'];?></td>
                                        <td><?php echo $value['serial'];?></td>
                                        <td><?php echo $value['uso'];?></td>
                                        <td class="text-center"><button type="button" class="btn" id="btnQuitarDis">Quitar</button>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                        </div>
                    <?php endif;?>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha Actual</label>
                <input type="text" class="form-control" id="fecha" value="<?php echo date('Y-d-m');?>" name="fechaActual" readonly>
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label">Hora Actual</label>
                <input type="text" class="form-control" id="hora" value="<?php echo $horaActual;?>" name="horaActual" readonly>
            </div>

            <div class="mb-3 buttons">
                <button class="btn btn-primary button" id="ingresar" name="ingresar">Ingresar</button>
            </div>

            <!-- <form id="formulario">
                <input type="text" name="nombre" id="nombresss" placeholder="Ingresa el nombre">
                <button id="btnTest">Ingresar</button>
            </form> -->
            <div>
                <button id="imprimir">IMPRIMIR DATOS</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="../js/ingreso.js"></script>
</body>
</html>
