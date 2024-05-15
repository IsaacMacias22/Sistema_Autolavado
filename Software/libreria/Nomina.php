<?php
    class Nomina
    {
        function Mostrar($fecha)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("call p_mostrar_vehiculos_lavados(?)");
            $query->bind_param('s', $fecha);
            $query->execute();
            $query->bind_result($numeroEmpleado, $nombreEmpleado, $autosLavados, $montoCobrado, $porcentaje, $montoGanado, $gananciaGenerada); //Traer variables
            $rs = ' <h4 class="text-center text-white">'.date('d-m-Y', strtotime($fecha)).'</h4>
                    <div class="table-responsive-md">
                    <table class="table table-striped table-hover">
                    <thead><tr><th class="fs-5 text-azul1">No. Empleado</th><th class="fs-5 text-azul1">Nombre Empleado</th><th class="fs-5 text-azul1">Vehículos Lavados</th>
                    <th class="fs-5 text-azul1">Monto Cobrado</th><th class="fs-5 text-azul1">Porcentaje Ganado</th><th class="fs-5 text-azul1">Monto Ganado</th></tr></thead>
                    <tbody>';
            while($query->fetch())
            {
                $rs.= '<tr>
                        <td class="text-white">'.$numeroEmpleado.'</td>
                        <td class="text-white">'.$nombreEmpleado.'</td>
                        <td class="text-white">'.$autosLavados.'</td>
                        <td class="text-white">$'.$montoCobrado.'</td>
                        <td class="text-white">'.$porcentaje.'%</td>
                        <td class="text-white fw-bold">$'.$montoGanado.'</td>
                       </tr>';
            }
            $query->close();  
            return $rs. '</tbody></table></div>';
        }
        function Obtener($fecha)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("call p_mostrar_vehiculos_lavados(?)");
            $query->bind_param('s', $fecha);
            $query->execute();
            $query->bind_result($numeroEmpleado, $nombreEmpleado, $autosLavados, $montoCobrado, $porcentaje, $montoGanado, $gananciaGenerada);

            // Arreglo para almacenar todos los datos
            $empleadosDatos = array();

            while($query->fetch()) {
                $empleado = array(
                    'nombre' => $nombreEmpleado,
                    'monto' => $montoGanado
                );
                $empleadosDatos[] = $empleado; // Agregar empleado al arreglo
            } 

            $query->close();

            // Convertir el arreglo a JSON
            $json_data = json_encode($empleadosDatos);
            return $json_data;
        }

    }
?>