<?php 
	session_start();
	require 'config.php';
	require 'libreria/IVehiculos.php';
	require 'libreria/VehiculosFactory.php';
    require 'libreria/Vehiculos.php';
	$v = new Vehiculos();
	$p['resultado'] = $v->Mostrar('%');
    $p['clientes'] = $v->GetClientes('%');

    $vf = new VehiculosFactory();

    //tomar peticion post para insertar
    if(isset($_POST['cmbTipo'])  && isset($_FILES['imagen']))
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

    	$v->Guardar(-1, $_POST['txtMarca'], $_POST['txtModelo'], $_POST['txtAnio'], $_POST['txtColor'], $_POST['txtPlacas'], $file_name, 
		$_POST['txtObservacion'], $_POST['idCliente'], $_POST['cmbTipo']);
    	$p['resultado'] = $v->Mostrar('%');
    }


    if(isset($_POST['_idVehiculo']))
    {
    	$v->Eliminar($_POST['_idVehiculo']);
    	$p['resultado'] = $v->Mostrar('%');
    }


    if(isset($_POST['cmbTipoEditar']) && isset($_FILES['imagen']))
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


		if(empty($file_name))
		{
			$file_name = $_POST['valorImagen'];
		}

    	$v->Guardar($_POST['txtIdVehiculo'], $_POST['txtMarcaEditar'], $_POST['txtModeloEditar'], $_POST['txtAnioEditar'], $_POST['txtColorEditar'], 
		$_POST['txtPlacasEditar'], $file_name, $_POST['txtObservacionEditar'], $_POST['idClienteEditar'], $_POST['cmbTipoEditar']);
    	$p['resultado'] = $v->Mostrar('%');
    }

	if(isset($_POST['clienteSeleccionadoId']))
	{
		$v->ActualizarCliente($_POST['clienteIdVehiculo'], $_POST['clienteSeleccionadoId']);
		$p['resultado'] = $v->Mostrar('%');
	}

	if (isset($_POST['inputBuscarCliente'])) {
		$searchText = $_POST['inputBuscarCliente'];
		$p['clientes'] = $v->GetClientes('%'.$searchText.'%');
	}

	View('vehiculos',$p);
 ?>