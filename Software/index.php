<?php 
require 'helpers.php';
$pagina = 'login';
global $nav;
$nav = '';
if(isset($_GET['pagina']))
{
	$pagina = $_GET['pagina'];
}

Controller($pagina);