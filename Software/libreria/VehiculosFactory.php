<?php
    class VehiculosFactory
    {
        public function CrearVehiculo($tipo)
        {
            switch($tipo)
            {
                case 'Automóvil': return new Automovil(); break;
                case 'Camioneta': return new Camioneta(); break;
                case 'Tracto camión': return new Tractocamion(); break;
            }
        }
    }
?>