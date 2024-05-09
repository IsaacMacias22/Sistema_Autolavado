<?php
    class VehiculosFactory
    {
        public function CrearVehiculo($tipo)
        {
            switch($tipo)
            {
                case 'Auto': return new Automovil(); break;
                case 'Camioneta': return new Camioneta(); break;
                case 'Tractocamion': return new Tractocamion(); break;
            }
        }
    }
?>