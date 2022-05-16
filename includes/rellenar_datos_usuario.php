<?php 
    $sql= "SELECT * FROM usuarios WHERE cedula='$cedula'";
    $result= mysqli_query($con,$sql);
	if (!$result) {
		die("Error al consultar usuarios".mysqli_error($con));
	}

    $usuario=array();
    while ($row = mysqli_fetch_array($result)) {
        $usuario=array(
            "nombre"=>$row["nombres"],
            "correo"=>$row["correo"],
            "sede"=>$row["sede"]
        );
    }
?>