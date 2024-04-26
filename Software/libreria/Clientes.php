<?php
    class Clientes
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
            $rs = '
                    <div class="table-responsive-md">
                    <table class="table table-striped table-hover">
                    <thead><tr><th>Nombre</th><th>Teléfono</th><th>Correo</th><th>Acciones</th></tr></thead>
                    <tbody>';
            while($query->fetch())
            {
                $rs.= '<tr>
                        <td>'.$nombre.'</td>
                        <td>'.$telefono.'</td>
                        <td>'.$correo.'</td>
                        <td class="d-flex">
                            <button class="btn btn-primary btn-sm editar" data-bs-toggle="modal" data-bs-target="#staticBackdrop" _ide='.$idCliente.'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                </svg>
                            </button>
                            &nbsp;
                            <form method="post" action="clientes" class="eliminarCliente">
                            <button type="submit" class="btn btn-danger btn-sm eliminar" data-id="'.$idCliente.'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                </svg>
                            </button>
                            <input type="hidden" name="_idCliente" value="'.$idCliente.'"/>
                        </form>
                        </td>
                       </tr>';
            }
            $query->close();  
            return $rs. '</tbody></table></div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edición de Cliente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formularioClienteEdit" action="clientes" method="post">
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
                    console.log("Clic en el botón editar");
                    let _ide = $(this).attr("_ide");
                    $.post("clientesacciones", {ide: _ide}, function(mensaje){
                        $("#x").html(mensaje);
                        $("#staticBackdrop").modal("show");
                    });
                });
            </script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>

            <script>
            // Agregar evento de escucha para los botones de eliminar
            document.querySelectorAll(".eliminar").forEach(item => {
                item.addEventListener("click", function(event) {
                    event.preventDefault(); // Evitar que el formulario se envíe automáticamente
        
                    const idCliente = this.dataset.id;
        
                    Swal.fire({
                        title: "¿Estás seguro de eliminar?",
                        text: "El cliente y su información serán borrados del sistema",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Confirmar",
                        cancelButtonText: "Cancelar",
                        backdrop: true,
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Enviar formulario de eliminación
                            const form = this.closest("form");
                            form.submit();
                        }
                    });
                });
            });
        </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const formulario = document.getElementById("formularioClienteEdit");
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
                                text: "El cliente ha sido actualizado correctamente."
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
                                text: "Ha ocurrido un error al actualizar el cliente. Por favor, inténtalo de nuevo."
                            });
                        }
                    }).catch(error => {
                        console.error("Error:", error);
                        // Si hay un error en la solicitud, mostramos una alerta de error
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al actualizar el cliente. Por favor, inténtalo de nuevo."
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
        function GetDatos($idCliente)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("select * from clientes where idCliente=?");
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