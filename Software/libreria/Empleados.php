<?php
    class Empleados implements IPersona
    {
        function Guardar($idEmpleado, $nombre, $apellidos, $telefono, $correo, $porcentaje, $imagen)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("call p_insertar_modificarEmpleados(?, ?, ?, ?, ?, ?, ?)");
            $query->bind_param('issssds', $idEmpleado, $nombre, $apellidos, $telefono, $correo, $porcentaje, $imagen);
            $query->execute();
            $query->close();
        }
        function Mostrar($filtro)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("select * from empleados where nombre like ?");
            $query->bind_param('s', $filtro);
            $query->execute();
            $query->bind_result($idEmpleado, $nombre, $apellidos, $telefono, $correo, $porcentaje, $imagen); //Traer variables
            $rs = '
                    <div class="table-responsive-md">
                    <table class="table table-striped table-hover">
                    <thead><tr><th class="fs-5 text-azul1">Nombre</th><th class="fs-5 text-azul1">Apellidos</th><th class="fs-5 text-azul1">Teléfono</th><th class="fs-5 text-azul1">Correo</th><th class="fs-5 text-azul1">Porcentaje</th><th class="fs-5 text-azul1">Imagen</th><th class="fs-5 text-azul1">Acciones</th></tr></thead>
                    <tbody>';
            while($query->fetch())
            {
                $rs.= '<tr>
                        <td class="text-white">'.$nombre.'</td>
                        <td class="text-white">'.$apellidos.'</td>
                        <td class="text-white">'.$telefono.'</td>
                        <td class="text-white">'.$correo.'</td>
                        <td class="text-white">'.$porcentaje.'</td>
                        <td>
                            <button type="button" class="btn btn-secondary btn-sm verImagen" data-bs-toggle="modal" data-bs-target="#modalImagen" _imagen='.$imagen.'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                </svg>
                            </button>
                        </td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-primary btn-sm editar" data-bs-toggle="modal" data-bs-target="#staticBackdrop" _ide='.$idEmpleado.'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </button>
                                &nbsp;
                                <form method="post" action="empleados" class="eliminarEmpleado">
                                    <button type="submit" class="btn btn-danger btn-sm eliminar" data-id="'.$idEmpleado.'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                    </button>
                                    <input type="hidden" name="_idEmpleado" value="'.$idEmpleado.'"/>
                                </form>
                            </div>
                        </td>
                       </tr>';
            }
            $query->close();  
            return $rs. '</tbody></table></div>
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header modaltitulo">
                            <h5 class="modal-title fs-5" id="staticBackdropLabel">Edición de Empleado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formularioEmpleadoEdit" action="empleados" method="post" enctype="multipart/form-data">
                            <div class="modal-body modalcolor">
                                <div id="x">
                                
                                </div>
                            </div>
                            <div class="modal-footer modalcolor">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            
            <!-- Modal -->
            <div class="modal fade" id="modalImagen" tabindex="-1" aria-labelledby="modalImagenLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalImagenLabel">Imagen de Empleado</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="espacioimagen" class="d-flex justify-content-center">
                        
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>

                    </div>
                    </div>
                </div>
            </div>

            <script>
                $(".editar").click(function() {
                    let _ide = $(this).attr("_ide");
                    $.post("empleadosacciones", {ide: _ide}, function(mensaje){
                        $("#x").html(mensaje);
                        $("#staticBackdrop").modal("show");
                    });
                });
            </script>

            <script>
                $(".verImagen").click(function() {
                    let _imagen = $(this).attr("_imagen");
                    $.post("empleadosacciones", {imagen: _imagen}, function(mensaje){
                        $("#espacioimagen").html(mensaje);
                        $("#modalImagen").modal("show");
                    });
                });
            </script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.min.js"></script>

            <script>
            // Agregar evento de escucha para los botones de eliminar
            document.querySelectorAll(".eliminar").forEach(item => {
                item.addEventListener("click", function(event) {
                    event.preventDefault(); // Evitar que el formulario se envíe automáticamente
        
                    const idEmpleado = this.dataset.id;
        
                    Swal.fire({
                        title: "¿Estás seguro de eliminar?",
                        text: "El empleado y su información serán borrados del sistema",
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
                const formulario = document.getElementById("formularioEmpleadoEdit");
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
                                text: "El empleado ha sido actualizado correctamente."
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
                                text: "Ha ocurrido un error al actualizar el empleado. Por favor, inténtalo de nuevo."
                            });
                        }
                    }).catch(error => {
                        console.error("Error:", error);
                        // Si hay un error en la solicitud, mostramos una alerta de error
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Ha ocurrido un error al actualizar el empleado. Por favor, inténtalo de nuevo."
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
            $query->prepare("select * from empleados where idEmpleado=?");
            $query->bind_param('i', $id);
            $query->execute();
            $query->bind_result($idEmpleado, $nombre, $apellidos, $telefono, $correo, $porcentaje, $imagen); //Traer datos
            $query->fetch(); //Almacenarlos en la memoria
            $query->close();
            return array($idEmpleado, $nombre, $apellidos, $telefono, $correo, $porcentaje, $imagen);
        }
        function Eliminar($id)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("delete from empleados where idEmpleado = ?");
            $query->bind_param('i', $id);
            $query->execute();
            $query->close();
        }
    }
?>