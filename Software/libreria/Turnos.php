<?php
    class Turnos
    {
        function GetDatos($fecha)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("SELECT turnos.ID ,cliente.nombre AS cliente ,vehiculo.nombreve AS vehiculo ,usuarios.nombre AS Empleado, turnos.costo AS Costo, turnos.fecha AS Fecha, turnos.estatus AS Estatus 
            FROM cliente, vehiculo, usuarios, turnos WHERE cliente.ID = turnos.fkidcliente AND vehiculo.ID = turnos.fkidvehiculo AND usuarios.ID = turnos.fkidempleado AND fecha = ?");
            $query->bind_param('s', $fecha);
            $query->execute();
            $query->bind_result($ID,$cliente,$vehiculo,$empleado,$costo,$fecha,$estatus);
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
            <div class="col card-image">
                <img src="./images/car.jpg" class="" alt="Imagen">
            </div>
            <div class="col p-0">
                <h6 class="mt-2 mb-3">'.$cliente.'</h6>
                <h6 class="mb-0">Vehiculo:</h6><p class="mb-0">'.$vehiculo.'</p>
                <h6 class="mb-0">Lavador:</h6><p class="mb-0">'.$empleado.'</p>
                <h6 class="mb-0">Precio:</h6><p class="mb-0">$'.$costo.'</p>
            </div>
            <div class="col">

                    <button class=" '.$color.' redondear text-center text-white h-100 w-100 cambiar"  data-toggle="modal" data-target="#exampleModal" _ide='.$ID.'>
                        <h4 class="m-0">TURNO:</h4>
                        <br><h1 class="m-0">'.$ID.'</h1>
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
            <div class="col card-image">
                <img src="./images/car.jpg" class="" alt="Imagen">
            </div>
            <div class="col p-0">
                <h6 class="mt-2 mb-3">'.$cliente.'</h6>
                <h6 class="mb-0">Vehiculo:</h6><p class="mb-0">'.$vehiculo.'</p>
                <h6 class="mb-0">Lavador:</h6><p class="mb-0">'.$empleado.'</p>
                <h6 class="mb-0">Precio:</h6><p class="mb-0">$'.$costo.'</p>
            </div>
            <div class="col">
                    <button class=" '.$color.' redondear text-center text-white h-100 w-100 cambiar"  data-toggle="modal" data-target="#exampleModal" _ide='.$ID.'>
                        <h4 class="m-0">TURNO:</h4>
                        <br><h1 class="m-0">'.$ID.'</h1>
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
            <div class="col card-image">
                <img src="./images/car.jpg" class="" alt="Imagen">
            </div>
            <div class="col p-0">
                <h6 class="mt-2 mb-3">'.$cliente.'</h6>
                <h6 class="mb-0">Vehiculo:</h6><p class="mb-0">'.$vehiculo.'</p>
                <h6 class="mb-0">Lavador:</h6><p class="mb-0">'.$empleado.'</p>
                <h6 class="mb-0">Precio:</h6><p class="mb-0">$'.$costo.'</p>
            </div>
            <div class="col">
                    <button class=" '.$color.' redondear text-center text-white h-100 w-100 cambiar"  data-toggle="modal" data-target="#exampleModal" _ide='.$ID.'>
                        <h4 class="m-0">TURNO:</h4>
                        <br><h1 class="m-0">'.$ID.'</h1>
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

        public static function Consultar($id)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("SELECT turnos.ID, cliente.nombre, turnos.estatus FROM cliente, turnos WHERE cliente.ID = turnos.fkidcliente AND turnos.ID = ?");
            $query->bind_param('s', $id);
            $query->execute();
            $query->bind_result($id, $cliente, $estatus);
            $query->fetch();
            $query->close();
            return array($id,$cliente,$estatus);
        }

        public function Editar($id,$estatus)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("update turnos set estatus=? where id=?");
            $query->bind_param('ss', $estatus,$id);
            $query->execute();
            $query->close();
        }

        public static function ConsultarClientes()
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("SELECT cliente.ID, cliente.nombre, vehiculo.id ,vehiculo.nombreve AS vehiculo from cliente, vehiculo WHERE cliente.fkidvehiculo = vehiculo.ID");
            // $query->bind_param('s', $filtro);
            $query->execute();
            $query->bind_result($id, $nombre,$idve, $vehiculo);

            $rs = '<table class="table table-bordered table-striped">
                    <thead><tr><th>Nombre</th><th>Vehiculo</th></tr></thead>
                    <tbody>';
            while($query->fetch())
            {
                $rs.= '<tr>
                            <td class="info" data-nombre="'.$nombre.'" data-vehiculo="'.$vehiculo.'" data-id="'.$id.'" data-idve="'.$idve.'" data-dismiss="modal">'.$nombre.'</td>
                            <td class="info" data-nombre="'.$nombre.'" data-vehiculo="'.$vehiculo.'" data-id="'.$id.'" data-idve="'.$idve.'" data-dismiss="modal">'.$vehiculo.'</td>
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

                    $("#txtcostoadd").val("110.50");
                    
                });
                </script>
            ';
        }

        public static function ConsultarEmpleados()
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("SELECT usuarios.ID, usuarios.nombre FROM usuarios WHERE rol = 'operador'");
            // $query->bind_param('s', $filtro);
            $query->execute();
            $query->bind_result($id, $nombre);

            $rs = '<table class="table table-bordered table-striped">
                    <thead><tr><th>Num Empleado</th><th>Nombre</th></tr></thead>
                    <tbody>';
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
            $query->prepare("INSERT INTO turnos VALUES (NULL,?,?,?,?,?,'En Espera')");
            $query->bind_param('sssss',$fkidcliente,$fkidvehiculo,$fkidempleado,$costo,$fecha);
            $query->execute();
            $query->close();
        }

    }

?>