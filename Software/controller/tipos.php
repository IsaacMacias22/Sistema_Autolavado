<?php 
	session_start();
	require 'config.php';
	require 'libreria/Tipos.php';
	$c = new Tipos();
	$p['resultado'] = $c->Mostrar('%');


	if (!isset($_SESSION['username'])) 
	{
		header("Location: login");
		exit();
	}
    if(isset($_POST['txtCostoEdit']))
    {
    	$c->Guardar($_POST['txtIdTipo'], $_POST['txtCostoEdit']);
    	$p['resultado'] = $c->Mostrar('%');
    }
	if (isset($_POST['inputBuscarTipo'])) {
		$searchText = $_POST['inputBuscarTipo'];
		$p['resultado'] = $c->Mostrar('%'.$searchText.'%'); // Filtrar resultados según el texto de búsqueda
	}

	View('tipos',$p);
 ?>