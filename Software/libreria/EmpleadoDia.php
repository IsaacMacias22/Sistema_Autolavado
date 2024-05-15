<?php
    class EmpleadoDia
    {
        function Mostrar($fecha)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("CALL p_mostrar_cantidad_vehiculos_maximo(?)");
            $query->bind_param('s', $fecha);
            $query->execute();
            $query->bind_result($numeroEmpleado, $nombreEmpleado, $autosLavados, $imagen);
            $rs = ' <h4 class="text-center text-white">'.date('d-m-Y', strtotime($fecha)).'</h4>
                    ';
            while($query->fetch())
            {
                $rs.= ' <div class="d-flex justify-content-center">
                            <div class="card bgazul3" style="width: 18rem;">
                                <img src="http://localhost/sistema_autolavado/Sistema_Autolavado/Software/storage/'.$imagen.'" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title m-0 text-center">'.$nombreEmpleado.'</h5>
                                    <p class="card-text mt-2 text-center">Vehículos Lavados: '.$autosLavados.'</p>
                                </div>
                            </div>
                        </div>';
            }
            $query->close();
            
            $rs.= ' <h4 class="text-center text-azul1 fw-bold mt-4">Vehículos y Clientes Atendidos</h4>
            <div class="table-responsive-md">
            <table class="table table-striped table-hover">
            <thead><tr><th class="fs-5 text-azul1">Vehículo</th><th class="fs-5 text-azul1">Descripción</th><th class="fs-5 text-azul1">Cliente</th><th class="fs-5 text-azul1">Cobro</th></tr></thead>
            <tbody>';

            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("CALL p_mostrar_cantidad_vehiculos_todos(?, ?)");
            $query->bind_param('is', $numeroEmpleado, $fecha);
            $query->execute();
            $query->bind_result($imagen, $vehiculo, $cliente, $cobro);
            while($query->fetch())
            {
                $rs.= '<tr>
                            <td><img src="http://localhost/sistema_autolavado/Sistema_Autolavado/Software/storage/'.$imagen.'" alt="Imagen por defecto" width="100" height="100">;</td>
                            <td class="text-white" style="vertical-align:middle;">'.$vehiculo.'</td>
                            <td class="text-white" style="vertical-align:middle;">'.$cliente.'</td>
                            <td class="text-white" style="vertical-align:middle;">$'.$cobro.'</td>
                        </tr>';
            }
            return $rs;
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