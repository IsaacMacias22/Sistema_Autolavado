<?php 
	session_start();
	require 'config.php';
	require 'libreria/Clientes.php';
	$c = new Clientes();

    if(isset($_POST['ide']))
    {
        $dc = $c->GetDatos($_POST['ide']);
        echo $mensaje = '
	
	<!-- Modal -->
        <div class="form-group my-2">
            <label for="txtNombreEdit" class="form-label">Nombre</label>
            <input type="text" name="txtNombreEdit" class="form-control" id="txtNombreEdit" value="'.$dc[1].'">       
        </div>
        <div class="form-group my-2">
            <label for="txtTelefonoEdit" class="form-label">Teléfono</label>
            <input type="text" name="txtTelefonoEdit" class="form-control" id="txtTelefonoEdit" value="'.$dc[2].'">       
        </div>
        <div class="form-group my-2">
            <label for="txtCorreoEdit" class="form-label">Correo Electrónico</label>
            <input type="email" name="txtCorreoEdit" class="form-control" id="txtCorreoEdit" value="'.$dc[3].'">       
        </div>
        <input type="hidden" name="_idCliente" value ="'.$dc[0].'"/>
        ';
    }
 ?>
