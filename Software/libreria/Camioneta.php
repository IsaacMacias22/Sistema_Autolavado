<?php
    class Camioneta implements IVehiculos
    {
        function CalcularCosto($observacion)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("select costo from tipos where descripcion='Camioneta'");
            $query->execute();
            $query->bind_result($costo); //Traer datos
            $query->fetch(); //Almacenarlos en la memoria
            $query->close();

            //Calculo por Numero de Puertas
            $puertas = $observacion;

            return ($costo*$puertas);
        }
    }
?>   