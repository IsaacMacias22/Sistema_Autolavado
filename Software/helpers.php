<?php 
//Loades view module NCHR
function View($view,$param = array(), $masterpage = '')
{
	extract($param);	

	// Asigna el valor de $_SESSION['navbar'] a $nav si está disponible
    if (isset($_SESSION['navbar'])) {
        $nav = $_SESSION['navbar'];
    }
	else {
		$nav = '';
	}

	$NAVBAR = $nav;

    ob_start();

	$file = "view/$view.view.php";
	require $file;
	$view_content = ob_get_clean();

	if($masterpage=='')
	{
		require 'view/masterpage/masterpage.default.view.php';	
	}	
	else 
	{
		require "view/masterpage/masterpage.$masterpage.view.php";
	}

} 

//Controler load NCHR
function Controller($controller)
{
	if(empty($controller))
	{
		$controller = 'login';
	}
		
	$file = "controller/$controller.php";

	if(file_exists($file))
	{
		require $file;	
	}
	else
	{
		require 'controller/error404.php';
	}
	
}











