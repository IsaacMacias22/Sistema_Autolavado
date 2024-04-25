<?php
    session_start():
    require 'config.php';
    require 'libreria/Login.php';
    $l = new Login();
    $p['resultado'] = '';

    //Tomar Peticion Post Externa
    if (isset($_POST['user'])) 
    {
        $dc = Login::GetDatos($_POST['user']);
        //Validar
        $p['resultado'] = $l->Validar($dc[0],$dc[1]);
    }

?>