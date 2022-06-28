<?php
    include("../includes/conexion.php");
    session_start();


    $cedula=$_POST["documento"];
    $nombres=$_POST["nombres"];
    $correo=$_POST["correo"];
    $sede=$_POST["sede"];
    $motivo=$_POST["motivo"];
    $dispositivos=$_POST["dispositivos"];
    $fechaIngreso=$_POST["fecha"];
    $horaIngreso=$_POST["hora"];

    function combinacionNumerica($ndigitos){
        $codigo="";
        for ($i=0; $i < $ndigitos; $i++) {
            $numero=rand(0,9);
            $codigo=$codigo."$numero";
        }
        return $codigo;
    };

    /* Consultar id de dispositivo */

    /* Registrar Dispositivo */
    foreach ($dispositivos as $value) {
        $serial=$value["Serial"];
        $sql="SELECT * FROM dispositivos WHERE serial='$serial';";
        $result=mysqli_query($con,$sql);
        if(!$result) die("ERROR AL CONSULTAR DISPOSITIVOS". mysqli_error($con));
        if (mysqli_num_rows($result)==0) {
            $sql2="INSERT INTO dispositivos(dispositivo,serial,placa,marca,propiedad,cantidad) 
                   VALUES ('".$value["Producto"]."','".$value["Serial"]."',
                           '".$value["Placa"]."','".$value["Marca"]."',
                           '".$value["Propietario"]."',
                           ".$value["Cantidad"].")";
            $result2= mysqli_query($con,$sql2);
            if(!$result) die("ERROR AL REGISTRAR DISPOSITIVOS". mysqli_error($con));
        }
    }

    /* Actualizar Datos de Usuario */

    $sql="UPDATE usuarios SET nombres='$nombres',correo='$correo',sede='$sede' WHERE cedula='$cedula'";
    $result=mysqli_query($con,$sql);
    if(!$result) die("ERROR AL ACTUALIZAR USUARIOS". mysqli_error($con));
    
    
    $codigoingreso=combinacionNumerica(4);
    
    /* Registrar INGRESO */
    $sql="INSERT INTO ingreso VALUES($codigoingreso,NOW(),'$horaIngreso','INGRESO','$motivo','$cedula')";
    $result=mysqli_query($con,$sql);
    if(!$result) die("ERROR AL REGISTRAR INGRESO". mysqli_error($con));
    
    /* Registrar dispositivos */
    foreach ($dispositivos as $value) {
        $sql="SELECT * FROM dispositivos WHERE serial='".$value['Serial']."';";
        $result=mysqli_query($con,$sql);
        if(!$result) die("ERROR AL CONSULTAR DISPOSITIVOS 2pt". mysqli_error($con));
        if (mysqli_num_rows($result)>0) {
            $iddispositivo=mysqli_fetch_array($result)["id_dispositivos"];
            $sql2="INSERT INTO ingresodispositivo(id_dispositivos,codigo_ingreso) values($iddispositivo,$codigoingreso)";
            $result2=mysqli_query($con,$sql2);
            if(!$result) die("ERROR AL REGISTRAR INGRESO DISPOSITIVO". mysqli_error($con));
        }
    }


    $_SESSION["cedula"]=$cedula;
    $_SESSION["fecha"]=$fechaIngreso;
    $_SESSION["hora"]=$horaIngreso;

    echo true;


?>