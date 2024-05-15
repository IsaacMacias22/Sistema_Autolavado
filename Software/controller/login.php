<?php
    session_start();
    require 'config.php';
    require 'libreria/Login.php';
    $l = new Login();

    $p['navbar'] = '';

    //Tomar Peticion Post Externa
    if (isset($_POST['txtusuario'])) 
    {
        //Cifrado
        $contrasenaFormulario = hash('sha256', $_POST['txtcontrasena']);

        $dc = $l->GetDatos($_POST['txtusuario']);
        if ($dc[1] == strtoupper(hash('sha256',$_POST['txtcontrasena'])))
        {
            $p['usuario'] = $dc[0];
            $p['rol'] = $dc[2];
            $_SESSION['username'] = $p['usuario'];
            $_SESSION['rol'] = $p['rol'];


            if ($dc[2] == "Operador")
            {
                $_SESSION['navbar'] = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="home"><img src="./images/LOGO.png" class="imgbarra" alt="Imagen"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="clientes">CLIENTES</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    AUTOS
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="vehiculos">VEHICULOS</a>
                                    <a class="dropdown-item" href="tipos">TIPOS DE VEHICULOS</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="turnos">TURNOS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled text-primary" href="#" tabindex="-1" aria-disabled="true">Usuario:'.$dc[0].'</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-secondary" href="logout">Cerrar Sesión</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>';
            }

            if ($dc[2] == "Administrador")
            {
                $_SESSION['navbar'] = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="home"><img src="./images/LOGO.png" class="imgbarra" alt="Imagen"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="empleados">EMPLEADOS</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    AUTOS
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="vehiculos">VEHICULOS</a>
                                    <a class="dropdown-item" href="tipos">TIPOS DE VEHICULOS</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    REPORTES
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="nomina">PAGOS DIARIOS</a>
                                    <a class="dropdown-item" href="empleadodia">EMPLEADO DEL DÍA</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled text-primary" href="#" tabindex="-1" aria-disabled="true">Usuario:'.$dc[0].'</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn btn-secondary" href="logout">Cerrar Sesión</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>';
            }
           

            View('home',$p);
        }
        else 
        {
            $resultado = '<label for="validacion" class="textred">Contraseña o Usuario Incorrecto</label>';
            if ($controller === 'login') {
                require 'view/login.view.php';
            } 
            else {
            View($controller, $p);
            }
        }
    }
    else 
    {
        $resultado = '';
        if ($controller === 'login') {
            require 'view/login.view.php';
        } 
        else {
        View($controller, $p);
    }
}
?>