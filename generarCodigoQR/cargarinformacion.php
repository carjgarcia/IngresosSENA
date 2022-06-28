<?php
    session_start();

    echo json_encode(array(
        $_SESSION["cedula"],
        $_SESSION["fecha"],
        $_SESSION["hora"])
    )

?>