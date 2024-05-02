<?php 
	session_start();
	require 'config.php';
    require 'libreria/Tipos.php';
	$c = new Tipos();

    if(isset($_POST['ide']))
    {
        $dc = $c->GetDatos($_POST['ide']);
        echo $mensaje = '
	
        <!-- Modal -->
            <div class="form-group my-2">
                <label for="txtDescripcionEdit" class="form-label">Descripción</label>
                <input type="text" name="txtDescripcionEdit" class="form-control" id="txtDescripcionEdit" value="'.$dc[1].'" disabled>       
            </div>
            <div class="form-group my-2">
                <label for="txtCostoEdit" class="form-label">Costo</label>
                <input type="number" name="txtCostoEdit" class="form-control" id="txtCostoEdit" value="'.$dc[2].'">       
            </div>
            <div class="form-group my-2">
                <label for="txtObservacionEdit" class="form-label">Observación</label>
                <input type="text" name="txtObservacionEdit" class="form-control" id="txtObservacionEdit" value="'.$dc[3].'" disabled>       
            </div>
            <input type="hidden" name="txtIdTipo" value ="'.$dc[0].'"/>
            ';
    }
 ?>
