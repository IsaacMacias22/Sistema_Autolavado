<?php 
	session_start();
	require 'config.php';
	require 'libreria/IPersona.php';
	require 'libreria/Empleados.php';
	$c = new Empleados();
	$p['resultado'] = $c->Mostrar('%');
	$p['comentarios'] = '';

    //tomar peticion post para insertar
    if(isset($_POST['txtNombre']) && isset($_FILES['imagen']))
    {
		$file_name = $_FILES['imagen']['name'];
		$file_tmp = $_FILES['imagen']['tmp_name'];

		
		// Carpeta donde se guardará la imagen
		$upload_folder = 'D:/Programas/Laragon/laragon/www/Sistema_Autolavado/Sistema_Autolavado/Software/storage/';

		// Mover la imagen a la carpeta destino
		if(move_uploaded_file($file_tmp, $upload_folder.$file_name)){
			$p['comentarios'] = "La imagen se ha subido correctamente.";
		} else{
			$p['comentarios'] = "Hubo un error al subir la imagen.";
		}
    	$c->Guardar(-1, $_POST['txtNombre'], $_POST['txtApellidos'], $_POST['txtTelefono'], $_POST['txtCorreo'], $_POST['txtPorcentaje'], $file_name);
    	$p['resultado'] = $c->Mostrar('%');
    }


    if(isset($_POST['_idEmpleado']))
    {
    	$c->Eliminar($_POST['_idEmpleado']);
    	$p['resultado'] = $c->Mostrar('%');
    }


    if(isset($_POST['txtNombreEdit']) && isset($_FILES['imagen']))
    {
		$file_name = $_FILES['imagen']['name'];
		$file_tmp = $_FILES['imagen']['tmp_name'];

		
		// Carpeta donde se guardará la imagen
		$upload_folder = 'D:/Programas/Laragon/laragon/www/Sistema_Autolavado/Sistema_Autolavado/Software/storage/';

		// Mover la imagen a la carpeta destino
		if(move_uploaded_file($file_tmp, $upload_folder.$file_name)){
			$p['comentarios'] = "La imagen se ha subido correctamente.";
		} else{
			$p['comentarios'] = "Hubo un error al subir la imagen.";
		}
    	$c->Guardar($_POST['txtIdEmpleado'], $_POST['txtNombreEdit'], $_POST['txtApellidosEdit'], $_POST['txtTelefonoEdit'], 
        $_POST['txtCorreoEdit'], $_POST['txtPorcentajeEdit'], $file_name);
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