<?php 
	session_start();
	require 'config.php';
	require 'libreria/Clientes.php';
	$c = new Conexion();
	$p['resultado'] = $c->Mostrar('%');

    //tomar peticion post para insertar
    if(isset($_POST['txtNombre']))
    {
    	$c->Insertar($_POST['txtNombre'], $_POST['txtTelefono'], $_POST['txtCorreo']);
    	$p['resultado'] = $c->Mostrar('%');
    }


    if(isset($_POST['_idCliente']))
    {
    	$c->Eliminar($_POST['_idCliente']);
    	$p['resultado'] = $c->Mostrar('%');
    }

    if(isset($_POST['txtIdCliente']))
    {
    	$c->Actualizar($_POST['txtIdCliente'], $_POST['txtNombreEdit'], $_POST['txtTelefonoEdit'], $_POST['txtCorreoEdit']);
    	$p['resultado'] = $c->Mostrar('%');
    }

	View('clientes',$p);
 ?>