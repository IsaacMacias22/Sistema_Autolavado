<?php 
	session_start();
    $p['navbar'] = '';
	
	if (!isset($_SESSION['username'])) 
	{
		header("Location: login");
		exit();
	}

	$p['usuario'] = $_SESSION['username'];
	$p['rol'] = $_SESSION['rol'];


	View('home',$p);
 ?>