<?php
    class Tipos
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
        function Mostrar($filtro)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("select * from tipos where descripcion like ?");
            $query->bind_param('s', $filtro);
            $query->execute();
            $query->bind_result($idTipo, $descripcion, $costo, $observacion); //Traer variables
            $rs = '
                    <div class="table-responsive-md">
                    <table class="table table-striped table-hover">
                    <thead><tr><th>Descripción</th><th>Costo</th><th>Observación</th><th>Acciones</th></tr></thead>
                    <tbody>';
            while($query->fetch())
            {
                $rs.= '<tr>
                        <td>'.$descripcion.'</td>
                        <td>'.$costo.'</td>
                        <td>'.$observacion.'</td>
                        <td class="d-flex">
                            <button class="btn btn-primary btn-sm editar" data-bs-toggle="modal" data-bs-target="#staticBackdrop" _ide='.$idTipo.'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                            </button>
                        </td>
                       </tr>';
            }
            $query->close();  
            return $rs. '</tbody></table></div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edición de Tipo</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formularioTipoEdit" action="tipos" method="post">
                            <div class="modal-body">
                                <div id="x">
                                
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                $(".editar").click(function() {
                    let _ide = $(this).attr("_ide");
                    $.post("tiposacciones", {ide: _ide}, function(mensaje){
                        $("#x").html(mensaje);
                        $("#staticBackdrop").modal("show");
                    });
                });
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const formulario = document.getElementById("formularioTipoEdit");
                formulario.addEventListener("submit", function (event) {
                    event.preventDefault();
                    fetch(formulario.action, {
                        method: formulario.method,
                        body: new FormData(formulario)
                    }).then(response => {
                        if (response.ok) {
                            // Si la respuesta es satisfactoria, mostramos la alerta con SweetAlert
                            Swal.fire({
                                icon: "success",
                                title: "Actualización Exitosa",
                                text: "El tipo ha sido actualizado correctamente."
                            }).then(() => {
                                setTimeout(() => {
                                    location.reload();
                                }, 250); // Espera 250 milisegundos (0.25 segundos) antes de recargar
                            });
                            // Cerrar el modal después de mostrar la alerta
                            $("#staticBackdropNuevo").modal("hide");
                        } else {
                            // Si la respuesta no es satisfactoria, mostramos un mensaje de error
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al actualizar el tipo. Por favor, inténtalo de nuevo."
                            });
                        }
                    }).catch(error => {
                        console.error("Error:", error);
                        // Si hay un error en la solicitud, mostramos una alerta de error
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al actualizar el tipo. Por favor, inténtalo de nuevo."
                        });
                    });
                });
            });
        </script>
            ';
            //Encontrar clase editar, cuando se haga click hacer funcion
            //Tomar id desde el botón 
            //Crear petición de tipo post, enviar ide y la función será sobreescribir en el id x el mensaje que retorne el controlador
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