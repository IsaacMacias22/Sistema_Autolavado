<?php 
	session_start();
	require 'config.php';
	require 'libreria/EmpleadoDia.php';

	$c = new EmpleadoDia();
	$p['resultado'] = $c->Mostrar(date('Y-m-d'));
	$p['grafico'] = $c->Obtener(date('Y-m-d'));

    if (!isset($_SESSION['username'])) 
	{
		header("Location: login");
		exit();
	}
    //tomar peticion post para insertar
	if (isset($_POST['fechaPagos'])) {
		$p['resultado'] = $c->Mostrar($_POST['fechaPagos']);
		$p['grafico'] = $c->Obtener($_POST['fechaPagos']);
	}

	View('empleadodia',$p);
 ?>