<?php 
	session_start();
	require 'config.php';
    require 'libreria/IPersona.php';
	require 'libreria/Empleados.php';
	$c = new Empleados();

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
            <label for="txtApellidosEdit" class="form-label">Nombre</label>
            <input type="text" name="txtApellidosEdit" class="form-control" id="txtApellidosEdit" value="'.$dc[2].'">       
        </div>
        <div class="form-group my-2">
            <label for="txtTelefonoEdit" class="form-label">Teléfono</label>
            <input type="text" name="txtTelefonoEdit" class="form-control" id="txtTelefonoEdit" value="'.$dc[3].'">       
        </div>
        <div class="form-group my-2">
            <label for="txtCorreoEdit" class="form-label">Correo Electrónico</label>
            <input type="email" name="txtCorreoEdit" class="form-control" id="txtCorreoEdit" value="'.$dc[4].'">       
        </div>
        <div class="form-group my-2">
            <label for="txtPorcentajeEdit" class="form-label">Correo Electrónico</label>
            <input type="number" name="txtPorcentajeEdit" class="form-control" id="txtPorcentajeEdit" value="'.$dc[5].'">       
        </div>
        <div class="form-group my-2">
            <label for="txtImagenEdit" class="form-label">Correo Electrónico</label>
            <input type="email" name="txtImagenEdit" class="form-control" id="txtImagenEdit" value="'.$dc[6].'">       
        </div>
        <input type="hidden" name="txtIdEmpleado" value ="'.$dc[0].'"/>
        ';
    }
 ?>
