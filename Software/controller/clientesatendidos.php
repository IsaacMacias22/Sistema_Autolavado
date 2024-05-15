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
    if ($_SESSION['rol'] !== "Administrador") 
	{
		session_destroy();
		header("Location: login");
		exit();
	}
    //tomar peticion post para insertar
	if (isset($_POST['fechaInicio'])) {
        if(empty($_POST['fechaInicio']) || empty($_POST['fechaFin'])){
            $p['resultado'] = $c->Mostrar(date('Y-m-d'), date('Y-m-d'));
		    $p['grafico'] = $c->Obtener(date('Y-m-d'), date('Y-m-d'));
        }
        else{
            $p['resultado'] = $c->Mostrar($_POST['fechaInicio'], $_POST['fechaFin']);
            $p['grafico'] = $c->Obtener($_POST['fechaInicio'], $_POST['fechaFin']);
        }
	}

	View('clientesatendidos',$p);
 ?>