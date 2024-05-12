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

	$p['resultado'] = $c->GetDatos(date('2024-05-05'));

	if (isset($_POST['ide'])) 
	{
		$c->Editar($_POST['ide'],$_POST['estatus']);
		$p['resultado'] = $c->GetDatos(date('2024-05-05'));
	}

	if (isset($_POST['txtidcli'])) 
	{
		$c->Agregar($_POST['txtidcli'],$_POST['txtautomoviladd'],$_POST['txtidlava'],$_POST['txtcostoadd'],'2024-05-05');
		$p['resultado'] = $c->GetDatos(date('2024-05-05'));
	}

	View('turnos',$p);
 ?>