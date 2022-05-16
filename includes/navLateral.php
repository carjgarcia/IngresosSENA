<div id="sidebar" class="tm-sidebar-left uk-background-default">
    <div class="user">
        <img id="avatar" width="100" class="uk-border-circle" src="../img/usuario.png" />
        <div class="uk-margin-top"></div>
        <h3 class="uk-text-truncate"><?php echo $usuario['nombre'];?></h3>
        <div id="email" class="uk-text-truncate"><?php echo $usuario['correo'];?></div>
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