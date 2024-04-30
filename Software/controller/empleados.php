<?php 
	session_start();
	require 'config.php';
	require 'libreria/IPersona.php';
	require 'libreria/Empleados.php';
	$c = new Empleados();
	$p['resultado'] = $c->Mostrar('%');

    //tomar peticion post para insertar
    if(isset($_POST['txtNombre']))
    {
    	$c->Guardar(-1, $_POST['txtNombre'], $_POST['txtApellidos'], $_POST['txtTelefono'], $_POST['txtCorreo'], $_POST['txtPorcentaje'], $_POST['txtImagen']);
    	$p['resultado'] = $c->Mostrar('%');
    }


    if(isset($_POST['_idEmpleado']))
    {
    	$c->Eliminar($_POST['_idEmpleado']);
    	$p['resultado'] = $c->Mostrar('%');
    }


    if(isset($_POST['txtNombreEdit']))
    {
    	$c->Guardar($_POST['txtIdEmpleado'], $_POST['txtNombreEdit'], $_POST['txtApellidosEdit'], $_POST['txtTelefonoEdit'], 
        $_POST['txtCorreoEdit'], $_POST['txtPorcentajeEdit'], $_POST['txtImagenEdit']);
    	$p['resultado'] = $c->Mostrar('%');
    }
	if (isset($_POST['inputBuscarEmpleado'])) {
		$searchText = $_POST['inputBuscarEmpleado'];
		$p['resultado'] = $c->Mostrar('%'.$searchText.'%'); // Filtrar resultados según el texto de búsqueda
		// Renderizar la vista parcial con los resultados filtrados
		// echo ViewPartial('clientes_resultado', $p); // Debes tener una vista parcial para mostrar los resultados
		// exit; // Detener la ejecución del resto del código
	}

	View('empleados',$p);
 ?>