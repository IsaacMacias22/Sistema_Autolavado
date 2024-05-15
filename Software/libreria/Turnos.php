<?php
    class Turnos
    {
        function GetDatos($fecha)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("SELECT turnos.idTurno ,clientes.nombre AS cliente , CONCAT(vehiculos.marca, ' ', vehiculos.modelo, ' ', vehiculos.anio, ' ', vehiculos.color) AS vehiculo,
            vehiculos.imagen, empleados.nombre AS empleado, turnos.costo AS costo, turnos.fecha AS fecha, turnos.estatus AS estatus 
            FROM clientes, vehiculos, empleados, turnos WHERE clientes.idCliente = turnos.fkIdCliente AND vehiculos.idVehiculo = turnos.fkIdVehiculo AND empleados.idEmpleado = turnos.fkIdEmpleado AND fecha = ?");
            $query->bind_param('s', $fecha);
            $query->execute();
            $query->bind_result($idTurno,$cliente,$vehiculo,$imagen,$empleado,$costo,$fecha,$estatus);
            $rsesta = '';
            $rspro = '';
            $rster = '';
            $modal = '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cambiar Progreso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <form action="turnos" method="post">
            <div id="x">
                
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
            </div>
            </div>
    
    
                <script>
                $(".cambiar").click(function() {
                    let _ide = $(this).attr("_ide");
                    $.post("accionesturnos",{ide:_ide},function(mensaje)
                    {
                        $("#x").html(mensaje);
                    }
                );    
                });
                </script>';



            while ($query->fetch()) {
                if ($estatus == "En Espera") {
                    $color = 'btn btn-success';
                    $rsesta.= '
                    <div class="col p-0 me-3 mb-3 mt-3">
      <div class="card">
        <div class="row p-0">
            <div class="col card-image d-flex">
                <img src="http://localhost/sistema_autolavado/Sistema_Autolavado/Software/storage/'.$imagen.'" class="img-fluid" alt="Imagen">
            </div>
            <div class="col p-0">
                <h6 class="mt-2 mb-3">'.$cliente.'</h6>
                <h6 class="mb-0">Vehiculo:</h6><p class="mb-0">'.$vehiculo.'</p>
                <h6 class="mb-0">Lavador:</h6><p class="mb-0">'.$empleado.'</p>
                <h6 class="mb-0">Precio:</h6><p class="mb-0">$'.$costo.'</p>
            </div>
            <div class="col">

                    <button class=" '.$color.' redondear text-center text-white h-100 w-100 cambiar"  data-toggle="modal" data-target="#exampleModal" _ide='.$idTurno.'>
                        <h4 class="m-0">TURNO:</h4>
                        <br><h1 class="m-0">'.$idTurno.'</h1>
                    </button>
                
            </div>
        </div>
      </div>
      </div> ';
                }


                if ($estatus == "En Progreso") 
                {
                    $color = 'btn btn-primary';
                    $rspro.= '
                    <div class="col p-0 me-3 mb-3 mt-3">
      <div class="card">
        <div class="row p-0">
            <div class="col card-image d-flex">
                <img src="http://localhost/sistema_autolavado/Sistema_Autolavado/Software/storage/'.$imagen.'" class="img-fluid" alt="Imagen">
            </div>
            <div class="col p-0">
                <h6 class="mt-2 mb-3">'.$cliente.'</h6>
                <h6 class="mb-0">Vehiculo:</h6><p class="mb-0">'.$vehiculo.'</p>
                <h6 class="mb-0">Lavador:</h6><p class="mb-0">'.$empleado.'</p>
                <h6 class="mb-0">Precio:</h6><p class="mb-0">$'.$costo.'</p>
            </div>
            <div class="col d-flex">
                    <button class=" '.$color.' redondear text-center text-white h-100 w-100 cambiar"  data-toggle="modal" data-target="#exampleModal" _ide='.$idTurno.'>
                        <h4 class="m-0">TURNO:</h4>
                        <br><h1 class="m-0">'.$idTurno.'</h1>
                    </button>
            </div>
        </div>
      </div>
      </div>

                    ';
                }


                if ($estatus == "Terminado") 
                {
                    $color = 'btn btn-danger';
                    $rster.= '
                    <div class="col p-0 me-3 mb-3 mt-3">
      <div class="card">
        <div class="row p-0">
            <div class="col card-image d-flex">
                <img src="http://localhost/sistema_autolavado/Sistema_Autolavado/Software/storage/'.$imagen.'" class="img-fluid" alt="Imagen">
            </div>
            <div class="col p-0">
                <h6 class="mt-2 mb-3">'.$cliente.'</h6>
                <h6 class="mb-0">Vehiculo:</h6><p class="mb-0">'.$vehiculo.'</p>
                <h6 class="mb-0">Lavador:</h6><p class="mb-0">'.$empleado.'</p>
                <h6 class="mb-0">Precio:</h6><p class="mb-0">$'.$costo.'</p>
            </div>
            <div class="col">
                    <button class=" '.$color.' redondear text-center text-white h-100 w-100 cambiar"  data-toggle="modal" data-target="#exampleModal" _ide='.$idTurno.'>
                        <h4 class="m-0">TURNO:</h4>
                        <br><h1 class="m-0">'.$idTurno.'</h1>
                    </button>
            </div>
        </div>
      </div>
      </div>
                   ';
                }
            }


            $rsesta.= $modal;
            $rspro.= $modal;
            $rster.= $modal;

            $query->close();
            return array($rsesta, $rspro, $rster);
        }

        public static function Consultar($id, $fecha)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("SELECT turnos.idTurno, clientes.nombre, turnos.estatus FROM clientes, turnos WHERE clientes.idCliente = turnos.fkIdCliente AND turnos.idTurno = ? AND turnos.fecha=?");
            $query->bind_param('ss', $id, $fecha);
            $query->execute();
            $query->bind_result($id, $cliente, $estatus);
            $query->fetch();
            $query->close();
            return array($id,$cliente,$estatus);
        }

        public function Editar($id,$estatus,$fecha)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("update turnos set estatus=? where idTurno=? and fecha=?");
            $query->bind_param('sss', $estatus,$id,$fecha);
            $query->execute();
            $query->close();
        }

        public static function ConsultarClientes()
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("SELECT clientes.idCliente, clientes.nombre, vehiculos.idVehiculo , CONCAT(vehiculos.marca, ' ', vehiculos.modelo, ' ', vehiculos.anio, ' ', vehiculos.color) 
            AS vehiculo, vehiculos.observacion, tipos.descripcion as tipo
            from clientes, vehiculos, tipos WHERE vehiculos.fkIdCliente = clientes.IdCliente AND vehiculos.fkIdTipo = tipos.idTipo");
            // $query->bind_param('s', $filtro);
            $query->execute();
            $query->bind_result($id, $nombre,$idve, $vehiculo, $observacion, $tipo);

            $rs = '<table class="table table-bordered table-striped">
                    <thead><tr><th>Nombre</th><th>Vehiculo</th><th>Tipo</th></tr></thead>
                    <tbody>';
            while($query->fetch())
            {
                $rs.= '<tr>
                            <td class="info" data-nombre="'.$nombre.'" data-vehiculo="'.$vehiculo.'" data-id="'.$id.'" data-idve="'.$idve.'" data-observacion="'.$observacion.'" data-tipo="'.$tipo.'" data-dismiss="modal">'.$nombre.'</td>
                            <td class="info" data-nombre="'.$nombre.'" data-vehiculo="'.$vehiculo.'" data-id="'.$id.'" data-idve="'.$idve.'" data-observacion="'.$observacion.'" data-tipo="'.$tipo.'" data-dismiss="modal">'.$vehiculo.'</td>
                            <td class="info" data-nombre="'.$nombre.'" data-vehiculo="'.$vehiculo.'" data-id="'.$id.'" data-idve="'.$idve.'" data-observacion="'.$observacion.'" data-tipo="'.$tipo.'" data-dismiss="modal">'.$tipo.'</td>
                        </tr>';
            }
            $query->close();  
            return $rs. '</tbody></table>
                <script>
                $(".info").click(function(){
                    var nombre = $(this).data("nombre"); 
                    var vehiculo = $(this).data("vehiculo");
                    var id = $(this).data("id"); 
                    var idve = $(this).data("idve");

                    $("#txtidcli").val(id);
                    $("#txtautomoviladd").val(idve);

                    $("#txtcliente").val(nombre);
                    $("#txtautomovil").val(vehiculo);

                    let _tipo = $(this).data("tipo");
                    let _observacion = $(this).data("observacion");
                    $.post("accionesturnos",{tipo:_tipo, observacion:_observacion},function(mensaje)
                      {
                        $("#txtCostoLavado").val(parseFloat(mensaje));
                        $("#txtcostoadd").val(parseFloat(mensaje));
                      }
                    );    
                    
                });
                </script>
            ';
        }

        public static function ConsultarEmpleados()
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("SELECT empleados.idEmpleado, CONCAT(empleados.nombre, ' ', empleados.apellidos) AS nombre FROM empleados");
            // $query->bind_param('s', $filtro);
            $query->execute();
            $query->bind_result($id, $nombre);

            $rs = '  
                    <table class="table table-bordered table-striped">
                    <thead><tr><th>No. Empleado</th><th>Nombre</th></tr></thead>
                    <tbody id="tablaEmpleados">';
            while($query->fetch())
            {
                $rs.= '<tr>
                            <td class="info" data-nombre="'.$nombre.'"  data-idla="'.$id.'" data-dismiss="modal">'.$id.'</td>
                            <td class="info" data-nombre="'.$nombre.'"  data-idla="'.$id.'" data-dismiss="modal">'.$nombre.'</td>
                       </tr>';
            }
            $query->close();  
            return $rs. '</tbody></table>
                <script>
                $(".info").click(function(){
                    var nombre = $(this).data("nombre"); 
                    var id = $(this).data("idla"); 

                    
                    $("#txtidlava").val(id);

                    $("#txtlavador").val(nombre);
                    $("#txtlavadoradd").val(nombre);
                });
                </script>
            ';
        }


        public function Agregar($fkidcliente,$fkidvehiculo,$fkidempleado,$costo,$fecha)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("CALL p_insertar_modificarTurnos(-1, ?, ?, 'En Espera', ?, ?, ?)");
            $query->bind_param('dsiii',$costo, $fecha, $fkidcliente, $fkidvehiculo, $fkidempleado);
            $query->execute();
            $query->close();
        }

    }

?>