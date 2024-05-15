<?php 
	session_start();
	require 'config.php';
	require 'libreria/ClientesAtendidos.php';

	$c = new ClientesAtendidos();
	$p['resultado'] = '';
	$p['grafico'] = '';

    if (!isset($_SESSION['username'])) 
	{
		header("Location: login");
		exit();
	}
    //tomar peticion post para insertar
	if (isset($_POST['fechaInicio'])) {
		$p['resultado'] = $c->Mostrar($_POST['fechaInicio'], $_POST['fechaFin']);
		$p['grafico'] = $c->Obtener($_POST['fechaInicio'], $_POST['fechaFin']);
	}

	View('clientesatendidos',$p);
 ?>