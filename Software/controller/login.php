<?php
    session_start();
    require 'config.php';
    require 'libreria/Login.php';
    $l = new Login();
    $p['resultado'] = '';

    //Tomar Peticion Post Externa
    if (isset($_POST['txtusuario'])) 
    {
        $dc = $l->GetDatos($_POST['txtusuario']);
        if ($dc[1] == $_POST['txtcontrasena']) 
        {
            $p['usuario'] = $dc[0];
            $p['rol'] = $dc[2];
            $_SESSION['username'] = $p['usuario'];
            $_SESSION['rol'] = $p['rol'];
            View('home',$p);
        }
        else 
        {
            $p['resultado'] = '<label for="validacion" class="textred">Contraseña o Usuario Incorrecto</label>';
            View('login',$p);
        }
    }
    else 
    {
        View('login',$p);
    }
    
?>