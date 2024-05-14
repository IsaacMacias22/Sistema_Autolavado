<?php 
	session_start();
	require 'config.php';
	require 'libreria/Turnos.php';
	$c = new Turnos();

	if (!isset($_SESSION['username'])) 
	{
		header("Location: login");
		exit();
	}

	$p['resultado'] = $c->GetDatos(date('Y-m-d'));

	if (isset($_POST['ide'])) 
	{
		$c->Editar($_POST['ide'],$_POST['estatus']);
		$p['resultado'] = $c->GetDatos(date('Y-m-d'));
	}

	if (isset($_POST['txtidcli'])) 
	{
		$c->Agregar($_POST['txtidcli'],$_POST['txtautomoviladd'],$_POST['txtidlava'], $_POST['txtcostoadd'], date('Y-m-d'));
		$p['resultado'] = $c->GetDatos(date('Y-m-d'));
	}

	View('turnos',$p);
 ?>