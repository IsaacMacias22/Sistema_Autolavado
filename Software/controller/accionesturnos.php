<?php
    session_start();
    require 'config.php';
    require 'libreria/Turnos.php';
    require 'libreria/IVehiculos.php';
    require 'libreria/VehiculosFactory.php';
    require 'libreria/Automovil.php';
    require 'libreria/Camioneta.php';
    require 'libreria/Tractocamion.php';
    
    if (isset($_POST['ide'])) 
    {
        $dc = Turnos::Consultar($_POST['ide']);
        if ($dc[2] == "En Espera") 
        {
            echo $mensaje = '
            <span>¿Estás seguro de cambiar el turno: </span><span class="text-primary">'.$dc[0].'</span><span> del cliente: </span><span class="text-primary">'.$dc[1].'</span><span> a </span><span class="text-primary">En Progreso</span><span>?</span>  
            
            <input type="hidden" name="ide" value="'.$dc[0].'">
            <input type="hidden" name="estatus" value="En Progreso">
            ';

        }
        if ($dc[2] == "En Progreso") 
        {
            echo $mensaje = '
            <span>¿Estás seguro de cambiar el turno: </span><span class="text-primary">'.$dc[0].'</span><span> del cliente: </span><span class="text-primary">'.$dc[1].'</span><span> a </span><span class="text-danger">Terminado</span><span>?</span>
            
            <input type="hidden" name="ide" value="'.$dc[0].'">
            <input type="hidden" name="estatus" value="Terminado">
            ';
        }
        if ($dc[2] == "Terminado") 
        {
            echo $mensaje = '
            <span>¿Estás seguro de </span><span class="text-danger">Concluir </span><span>el turno: </span><span class="text-primary">'.$dc[0].'</span><span> del cliente: </span><span class="text-primary">'.$dc[1].'</span><span>
            
            <input type="hidden" name="ide" value="'.$dc[0].'">
            <input type="hidden" name="estatus" value="Concluido">';
        }
    }

    if(isset($_POST['tipo']))
    {
        $vf = new VehiculosFactory();
        $automovil = $vf->CrearVehiculo($_POST['tipo']);

        // Calcular el costo y almacenar en $mensaje (como cadena)
        $costoCalculado = $automovil->CalcularCosto($_POST['observacion']);
        $costoNumerico = trim($costoCalculado); // Eliminar espacios en blanco al inicio y al final

        // Intentar convertir la cadena a un número (doble)
        $mensaje = (double) $costoNumerico;

        echo $mensaje;

    }

    if (isset($_POST['clien'])) 
    {
        $dc = Turnos::ConsultarClientes();
        echo $mensaje = $dc;
    }

    if (isset($_POST['lava'])) 
    {
        $dc = Turnos::ConsultarEmpleados();
        echo $mensaje = $dc;
    }
?>
