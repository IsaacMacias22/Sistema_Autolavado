<?php
    class ClientesAtendidos
    {
        function Mostrar($fechaInicio, $fechaFin)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("CALL p_mostrar_clientes_atendidos_desglose(?, ?)");
            $query->bind_param('ss', $fechaInicio, $fechaFin);
            $query->execute();
            $query->bind_result($cliente, $vehiculo, $imagen, $numeroservicios);
            $rs = ' <h4 class="text-center text-azul1 fw-bold mt-4">'.date('d/m/Y', strtotime($fechaInicio)).' - '.date('d/m/Y', strtotime($fechaFin)).'</h4>
                    <h4 class="text-center text-azul1 fw-bold mt-4">Desglose</h4>
                    <div class="row w-75 mx-auto">
                    <div class="table-responsive-md">
                    <table class="table table-striped table-hover">
                    <thead><tr><th class="fs-5 text-azul1">Cliente</th><th class="fs-5 text-azul1">Vehículo</th><th class="fs-5 text-azul1">Imagen</th><th class="fs-5 text-azul1">No. Servicios</th></tr></thead>
                    <tbody>';
            while($query->fetch())
            {
                $rs.= '<tr>
                            <td class="text-white" style="vertical-align:middle;">'.$cliente.'</td>
                            <td class="text-white" style="vertical-align:middle;">'.$vehiculo.'</td>
                            <td><img src="http://localhost/sistema_autolavado/Sistema_Autolavado/Software/storage/'.$imagen.'" alt="Imagen por defecto" width="50" height="50"></td>
                            <td class="text-white" style="vertical-align:middle;">'.$numeroservicios.'</td>
                        </tr>';
            }

            return $rs. '</tbody></table></div></div>';
        }
        function Obtener($fechaInicio, $fechaFin)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("CALL p_mostrar_clientes_atendidos(?, ?)");
            $query->bind_param('ss', $fechaInicio, $fechaFin);
            $query->execute();
            $query->bind_result($cliente, $numeroservicios);

            // Arreglo para almacenar todos los datos
            $clientesDatos = array();

            while($query->fetch()) {
                $cliente = array(
                    'cliente' => $cliente,
                    'numeroservicios' => $numeroservicios
                );
                $clientesDatos[] = $cliente; // Agregar empleado al arreglo
            } 

            $query->close();

            // Convertir el arreglo a JSON
            $json_data = json_encode($clientesDatos);
            return $json_data;
        }

    }
?>