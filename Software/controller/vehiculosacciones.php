<?php 
	session_start();
	require 'config.php';
	require 'libreria/Vehiculos.php';
	$c = new Vehiculos();

    if(isset($_POST['ide']))
    {
        $dc = $c->GetDatos($_POST['ide']);
        echo $mensaje = '
            <!-- Modal -->
            <div class="row my-2">
                <div class="form-group col">
                    <label for="cmbTipoEditar" class="form-label">Tipo</label>
                    <select class="form-select" aria-label="Seleccionar Tipo" name="cmbTipoEditar" id="cmbTipoEditar" value="'.$dc[9].'">
                        <option selected>Seleccionar</option>
                        <option value="1">Automóvil</option>
                        <option value="2">Camioneta</option>
                        <option value="3">Tracto camión</option>
                    </select>
                </div>
                <div class="form-group col">
                    <label for="txtPlacasEditar" class="form-label">Placas</label>
                    <input type="text" name="txtPlacasEditar" class="form-control" id="txtPlacasEditar" placeholder="Placas del vehículo" value="'.$dc[5].'">       
                </div>
            </div>
            <div class="row my-2">
                <div class="form-group col">
                    <label for="txtMarcaEditar" class="form-label">Marca</label>
                    <input type="text" name="txtMarcaEditar" class="form-control" id="txtMarcaEditar" placeholder="Marca del vehículo" value="'.$dc[1].'">       
                </div>
                <div class="form-group col">
                    <label for="txtModeloEditar" class="form-label">Modelo</label>
                    <input type="text" name="txtModeloEditar" class="form-control" id="txtModeloEditar" placeholder="Modelo del vehículo" value="'.$dc[2].'">       
                </div>
            </div>
            <div class="row my-2">
                <div class="form-group col">
                    <label for="txtAnioEditar" class="form-label">Año</label>
                    <input type="number" name="txtAnioEditar" class="form-control" id="txtAnioEditar" placeholder="Año del vehículo" value="'.$dc[3].'">       
                </div>
                <div class="form-group col">
                    <label for="txtColorEditar" class="form-label">Color</label>
                    <input type="text" name="txtColorEditar" class="form-control" id="txtColorEditar" placeholder="Color del vehículo" value="'.$dc[4].'">       
                </div>
            </div>
            <div class="row my-2">
                <div class="form-group col">
                    <label for="nombreClienteEditar" class="form-label">Dueño</label>
                    <input type="text" name="nombreClienteEditar" id="nombreClienteEditar" class="form-control" value="'.$dc[11].'" placeholder="Nombre del cliente" disabled>
                    <input type="hidden" name="idClienteEditar" id="idClienteEditar" value="'.$dc[10].'">
                </div>
                <div class="form-group col d-flex flex-column">
                    <label for="txtImagen" class="form-label">Imagen</label>
                    <input type="file" name="imagen" accept="image/*">
                    <input type="hidden" name="valorImagen" value="'.$dc[6].'">   
                </div>
            </div>
                <input type="hidden" name="txtIdVehiculo" value="'.$dc[0].'">
                <input type="hidden" name="txtObservacionEditar" value="'.$dc[7].'">
                ';
                
    }
    if(isset($_POST['clientes']))
    {
        echo $mensaje = $c->GetClientes('%');
    }
    if(isset($_POST['imagen']))
    {
        echo $mensaje = '
        <img src="http://localhost/sistema_autolavado/Sistema_Autolavado/Software/storage/'.$_POST['imagen'].'" alt="Imagen por defecto" width="300" height="300">';
    }
 ?>
