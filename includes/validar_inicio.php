<?php
    if(isset($_POST['submit'])) {
        if(empty($cedula)){
            $alerta = "<p class='error'>* Agrega tu número de documento.</p>";
        }	
        
        if(empty($contra)){
            $alerta = "<p class='error'>* La contraseña no puede estar vacía.</p>";
        }
    }    

?>