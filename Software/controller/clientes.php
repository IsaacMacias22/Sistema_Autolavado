<?php 
	session_start();
	require 'config.php';
	require 'libreria/IPersona.php';
	require 'libreria/Clientes.php';
	$c = new Clientes();
	$p['resultado'] = $c->Mostrar('%');

    //tomar peticion post para insertar
    if(isset($_POST['txtNombre']))
    {
    	$c->Guardar(-1, $_POST['txtNombre'], $_POST['txtTelefono'], $_POST['txtCorreo']);
    	$p['resultado'] = $c->Mostrar('%');
    }


    if(isset($_POST['_idCliente']))
    {
    	$c->Eliminar($_POST['_idCliente']);
    	$p['resultado'] = $c->Mostrar('%');
    }


    if(isset($_POST['txtNombreEdit']))
    {
    	$c->Guardar($_POST['txtIdCliente'], $_POST['txtNombreEdit'], $_POST['txtTelefonoEdit'], $_POST['txtCorreoEdit']);
    	$p['resultado'] = $c->Mostrar('%');
    }
	if (isset($_POST['inputBuscarCliente'])) {
		$searchText = $_POST['inputBuscarCliente'];
		$p['resultado'] = $c->Mostrar('%'.$searchText.'%'); // Filtrar resultados según el texto de búsqueda
		// Renderizar la vista parcial con los resultados filtrados
		// echo ViewPartial('clientes_resultado', $p); // Debes tener una vista parcial para mostrar los resultados
		// exit; // Detener la ejecución del resto del código
	}

	View('clientes',$p);
 ?>