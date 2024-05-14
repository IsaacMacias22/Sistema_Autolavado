<?php
    class Nomina
    {
        function Guardar($idTipo, $costo)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("call p_insertar_modificarTipos(?, ?)");
            $query->bind_param('id', $idTipo, $costo);
            $query->execute();
            $query->close();
        }
        function Mostrar($fecha)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("call p_mostrar_vehiculos_lavados(?)");
            $query->bind_param('s', $fecha);
            $query->execute();
            $query->bind_result($numeroEmpleado, $nombreEmpleado, $autosLavados, $montoCobrado, $porcentaje, $montoGanado, $gananciaGenerada); //Traer variables
            $rs = '
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
                        <td class="text-white">$'.$montoGanado.'</td>
                       </tr>';
            }
            $query->close();  
            return $rs. '</tbody></table></div>';

        }
        function GetDatos($id)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("select * from tipos where idTipo=?");
            $query->bind_param('i', $id);
            $query->execute();
            $query->bind_result($idTipo, $descripcion, $costo, $observacion); //Traer datos
            $query->fetch(); //Almacenarlos en la memoria
            $query->close();
            return array($idTipo, $descripcion, $costo, $observacion);
        }
    }
?>