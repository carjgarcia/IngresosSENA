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
        $dispositivo=$_POST['dispositivo'];
        if ($dispositivo!="ninguno") {
            if ($dispositivo!="otro") {
                if (isset($_POST[""])) {

                }
            } else {
    
            }
    
            if (!isset($alerta)) {
    
            }
                        
        }
    }else if(isset($_POST['ingresar'])){

        if (isset($_POST['nombres']) && isset($_POST['correo'])) {
            $nombres=$_POST['nombres'];
            $correo=$_POST['correo'];
            $sede=$_POST['sede'];
            if ($sede!="ninguno") {
                if ($sede!="Sede TIC") {
                    if ($_POST["motivo"]=="") {
                        $alerta="Debe especificar el motivo de su visita al nodo!";
                    }
                }
                if (!isset($alerta)) {
                    $motivo=$_POST["motivo"];
                }
            }else{
                $alerta="Debe seleccionar sede o nodo al que pertenece!";
            }
        }

    }





?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Ingreso Sena</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.23/css/uikit.min.css'>
  <link rel="stylesheet" href="../css/home.css">

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
        <form style="margin: 0 100px;" method="POST" action="">
        <?php if(isset($alerta)):?>
            <div class="alert alert-danger" role="alert" style="font-size: 20px;">
                <?php echo $alerta;?>
            </div>
        <?php endif;?>
            <h2>Datos Personales</h2>
            <div class="mb-3">
                <label for="idDocumento" class="form-label">No. de documento</label>
                <input type="text" class="form-control" id="idDocumento" value="<?php echo $cedula;?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres Completos</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="<?php echo $usuario['nombre'];?>" required>
            </div>

            <div class="mb-3">
                <label for="Correo" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" id="Correo" name="correo" value="<?php echo $usuario['correo'];?>" required>
            </div>

            <div class="mb-3">
                <label for="sede" class="form-label">Sede o nodo a la que pertenece</label>
                <select class="form-select" aria-label="Default select example" id="sede" name="sede">
                    <option selected value="ninguno">Sede o Nodo</option>
                    <option value="Sede TIC" <?php if(isset($sede)) if($sede=="Sede TIC") echo 'selected'?>>Sede TIC</option>
                    <option value="Nodo Electricidad Y Electronica" <?php if(isset($sede)) if($sede=="Nodo Electricidad Y Electronica") echo 'selected'?>>Nodo Electricidad Y Electronica</option>
                    <option value="Centro De Comercio Y Servicios" <?php if(isset($sede)) if($sede=="Centro De Comercio Y Servicios") echo 'selected'?>>Centro De Comercio Y Servicios</option>
                    <option value="Sede Energía" <?php if(isset($sede)) if($sede=="Sede Energía") echo 'selected'?>>SENA Sede Energía</option>    
                    <option value="Sede Logística y Transporte" <?php if(isset($sede)) if($sede=="Sede Logística y Transporte") echo 'selected'?>>Sede Logística y Transporte</option>
                </select>
            </div>


            <h2>Información de Ingreso</h2>

            <div class="mb-3 <?php if(isset($sede)) if($sede=="Sede TIC" || $sede=="") echo 'hiddenInput';?>" id="motivoView">
                <label for="floatingTextarea" class="form-label">Motivo Ingreso</label>
                <textarea class="form-control" id="floatingTextarea" name="motivo" placeholder="Digite el motivo de Ingreso "></textarea>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">¿Trajo vehículo?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                <!-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio2" id="btnradio3" autocomplete="off" checked>
                    <label class="btn btn-outline-primary" for="btnradio3">SI</label>
                  
                    <input type="radio" class="btn-check" name="btnradio2" id="btnradio4" autocomplete="off">
                    <label class="btn btn-outline-primary" for="btnradio4">NO</label>
                </div> -->
                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off">
                    <label class="btn btn-outline-danger" for="btnradio1">SI</label>
                  
                    <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" checked>
                    <label class="btn btn-outline-danger" for="btnradio2">NO</label>
                  </div>
            </div>

            <h4>Tus Ingresos Sena</h4>

            <table class="table">
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

            <div class="mb-3">
                <label for="dispositivo" class="form-label">¿Trae algun dispositivo?</label>
                <select class="form-select" aria-label="Default select example" id="dispositivo" name="dispositivo">
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
                    <input type="text" class="form-control" id="marca" name="marca" placeholder="Digite el código del artículo">
                </div>

                <div class="mb-3">
                    <label for="serial" class="form-label">Serial</label>
                    <input type="text" class="form-control" id="serial" name="serial" placeholder="Digite el serial del equipo">
                </div>

                <div class="mb-3">
                    <label for="Placa" class="form-label">Placa</label>
                    <input type="text" class="form-control" id="Placa" name="placa" placeholder="Digite placa de equipo">
                </div>

                <div class="mb-3">
                    <label for="propietario" class="form-label">Propietario</label>
                    <select class="form-select" aria-label="Default select example" id="propietario" name="uso">
                        <option selected value="sena">Propietario</option>
                        <option value="sena">SENA</option>
                        <option value="personal">Personal</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="catidad" placeholder="Digite la cantidad">
                </div>
                
                <div class="d-grid gap-2 d-md-block text-center">
                    <button class="btn btn-success" type="submit" name="btnadd">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                        </svg>
                        Añadir
                    </button>
                    <button class="btn btn-danger" type="submit" name="btncancel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                        Cancelar
                    </button>
                </div>

                
                
            </div>

            <?php if(isset($_SESSION['dispositivos'])):?>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Mis dispositivos</label>
                <textarea name="" id="" class="form-control" cols="30" rows="6"></textarea>
            </div>
            <?php endif;?>
            
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
                <input type="text" class="form-control" id="fecha" value="<?php echo date('Y-d-m');?>" readonly>
            </div>

            <div class="mb-3">
                <label for="hora" class="form-label">Hora Actual</label>
                <input type="text" class="form-control" id="hora" value="<?php echo $horaActual;?>" readonly>
            </div>

            <div class="mb-3 buttons">
                <button type="submit" class="btn btn-primary button" id="btnIngresar" name="ingresar">Ingresar</button>
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
<script src="../js/ingreso.js"></script>

</body>
</html>
