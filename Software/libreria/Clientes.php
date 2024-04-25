<?php
    class Conexion
    {
        function Guardar($idCliente, $nombre, $telefono, $correo)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("call p_insertar_modificarClientes(?, ?, ?, ?)");
            $query->bind_param('isss', $idCliente, $nombre, $telefono, $correo);
            $query->execute();
            $query->close();
        }
        function Mostrar($filtro)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("select * from clientes where nombre like ?");
            $query->bind_param('s', $filtro);
            $query->execute();
            $query->bind_result($idCliente, $nombre, $telefono, $correo); //Traer variables
            $rs = '<table class="table table-bordered table-striped">
                    <thead><tr><th>Nombre</th><th>Teléfono</th><th>Correo</th></tr></thead>
                    <tbody>';
            while($query->fetch())
            {
                $rs.= '<tr>
                        <td>'.$nombre.'</td>
                        <td>'.$telefono.'</td>
                        <td>'.$correo.'</td>
                        <td>
                            <button class="btn btn-primary editar" _ideCliente='.$idCliente.'>Editar</button>
                        </td>
                        <td>
                            <form method="post" action="clientes">
                                <button class="btn btn-danger">Eliminar</button>
                                <input type="hidden" name="_idCliente" value ="'.$idCliente.'"/>
                            </form>
                        </td>
                       </tr>';
            }
            $query->close();  
            return $rs. '</tbody></table>
            
            <script>
                $(".editar").click(function() {
                    let _ide = $(this).attr("_ideCliente");
                    $.post("accionesdatos", {ide: _ide}, function(mensaje){
                        $("#x").html(mensaje);
                    });
                    alert(_ide);
                });
            </script>
            ';
            //Encontrar clase editar, cuando se haga click hacer funcion
            //Tomar id desde el botón 
            //Crear petición de tipo post, enviar ide y la función será sobreescribir en el id x el mensaje que retorne el controlador
        }
        function GetDatos($idCliente)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("select * from clientes where id=?");
            $query->bind_param('i', $idCliente);
            $query->execute();
            $query->bind_result($idCliente, $nombre, $telefono, $correo); //Traer datos
            $query->fetch(); //Almacenarlos en la memoria
            $query->close();
            return array($idCliente, $nombre, $telefono, $correo);
        }
        function Eliminar($idCliente)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("delete from clientes where idCliente = ?");
            $query->bind_param('i', $idCliente);
            $query->execute();
            $query->close();
        }
    }
?>