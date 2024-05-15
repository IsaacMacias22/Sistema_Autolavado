<?php
    class Vehiculos
    {
        function Guardar($idVehiculo, $marca, $modelo, $anio, $color, $placas, $imagen, $observacion, $fkIdCliente, $fkIdTipo)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("call p_insertar_modificarVehiculos(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $query->bind_param('issssssdii', $idVehiculo, $marca, $modelo, $anio, $color, $placas, $imagen, $observacion, $fkIdCliente, $fkIdTipo);
            $query->execute();
            $query->close();
        }
        function Mostrar($filtro)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("call p_mostrarVehiculos(?)");
            $query->bind_param('s', $filtro);
            $query->execute();
            $query->bind_result($idVehiculo, $descripcion, $marca, $modelo, $anio, $color, $placas, $imagen, $cliente); //Traer variables
            $rs = '
                    <div class="table-responsive-md">
                    <table class="table table-striped table-hover">
                    <thead><tr><th class="fs-5 text-azul1">Tipo</th><th class="fs-5 text-azul1">Marca</th><th class="fs-5 text-azul1">Modelo</th><th class="fs-5 text-azul1">Año</th><th class="fs-5 text-azul1">Color</th><th class="fs-5 text-azul1">Placas</th><th class="fs-5 text-azul1">Dueño</th><th class="fs-5 text-azul1">Imagen</th><th class="fs-5 text-azul1">Acciones</th></tr></thead>
                    <tbody>';
            while($query->fetch())
            {
                $rs.= '<tr>
                        <td class="text-white">'.$descripcion.'</td>
                        <td class="text-white">'.$marca.'</td>
                        <td class="text-white">'.$modelo.'</td>
                        <td class="text-white">'.$anio.'</td>
                        <td class="text-white">'.$color.'</td>
                        <td class="text-white">'.$placas.'</td>
                        <td class="text-white">'.$cliente.'
                        &nbsp;
                            <button type="button" class="btn btn-sm editarCliente" data-bs-toggle="modal" data-bs-target="#staticBackdropClienteEditar" _idv="'.$idVehiculo.'" _clientes="clientes">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                            <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>
                            <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>
                          </svg>
                            </button>
                        </td>
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
                                <button class="btn btn-primary btn-sm editar" data-bs-toggle="modal" data-bs-target="#staticBackdropEditar" _ide='.$idVehiculo.'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </button>
                                &nbsp;
                                <form method="post" action="vehiculos" class="eliminarVehiculo">
                                    <button type="submit" class="btn btn-danger btn-sm eliminar" data-id="'.$idVehiculo.'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                        </svg>
                                    </button>
                                    <input type="hidden" name="_idVehiculo" value="'.$idVehiculo.'"/>
                                </form>
                            </div>
                        </td>
                       </tr>';
            }
            $query->close();  
            return $rs. '</tbody></table></div>
            <div class="modal fade" id="staticBackdropEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header modaltitulo">
                            <h5 class="modal-title fs-5" id="staticBackdropLabel">Edición de Vehículo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formularioVehiculoEdit" action="vehiculos" method="post" enctype="multipart/form-data">
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

            <div class="modal fade" id="staticBackdropClienteEditar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropClienteEditarLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header modaltitulo">
                        <h5 class="modal-title fs-5" id="staticBackdropClienteEditarLabel">Lista de clientes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modalcolor">
                            <div class="mb-3">
                                <label for="inputFiltroEditar" class="form-label">Buscar cliente:</label>
                                <input type="text" class="form-control" id="inputFiltroEditar" placeholder="Escribe el nombre del cliente">
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Correo</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tablaClientesEditar">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <form id="formularioVehiculosClienteEdit" action="vehiculos" method="post" class="d-flex justify-content-end">
                        <div class="modal-footer">
                            <input type="hidden" id="clienteIdVehiculo" name="clienteIdVehiculo">
                            <input type="hidden" id="clienteSeleccionadoId" name="clienteSeleccionadoId">
                            <p id="clienteSeleccionado" class="text-danger fw-bold"></p>
                            <p id="clienteSeleccionadoTelefono" class="text-danger fw-bold"></p>
                            <button type="submit" class="btn btn-primary text-light" id="btnActualizarCliente" disabled>Actualizar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="staticBackdropEditarCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header modaltitulo">
                            <h5 class="modal-title fs-5" id="staticBackdropLabel">Cambio de dueño del vehículo</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formularioVehiculoClienteEdit" action="vehiculos" method="post" enctype="multipart/form-data">
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
                        <h1 class="modal-title fs-5" id="modalImagenLabel">Imagen del Vehículo</h1>
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
                    $.post("vehiculosacciones", {ide: _ide}, function(mensaje){
                        $("#x").html(mensaje);
                        $("#staticBackdropEditar").modal("show");
                    });
                });
            </script>

            <script>
                $(".editarCliente").click(function() {
                    let _idv = $(this).attr("_idv");
                    let dataClientes = $(this).attr("_clientes"); // Obtiene el valor del atributo _clientes

                    $.post("vehiculosacciones", {clientes: dataClientes}, function (mensaje){
                        $("#tablaClientesEditar").html(mensaje);
                        $("staticBackdropClienteEditar").modal("show"); 
                        let idVehiculo = document.getElementById("clienteIdVehiculo");
                        idVehiculo.value = _idv;
                    });
                });
            </script>

            <script>
                $(".verImagen").click(function() {
                    let _imagen = $(this).attr("_imagen");
                    $.post("vehiculosacciones", {imagen: _imagen}, function(mensaje){
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
                        text: "El vehículo y su información serán borrados del sistema",
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
                    const formulario = document.getElementById("formularioVehiculoEdit");
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
                                    text: "El vehículo ha sido actualizado correctamente."
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
                                    text: "Ha ocurrido un error al actualizar el vehículo. Por favor, inténtalo de nuevo."
                                });
                            }
                        }).catch(error => {
                            console.error("Error:", error);
                            // Si hay un error en la solicitud, mostramos una alerta de error
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "Ha ocurrido un error al actualizar el vehículo. Por favor, inténtalo de nuevo."
                            });
                        });
                    });
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const formularioVehiculosClienteEdit = document.getElementById("formularioVehiculosClienteEdit");
                
                    formularioVehiculosClienteEdit.addEventListener("submit", function(event) {
                    event.preventDefault(); // Evitar que el formulario se envíe automáticamente
                
                    // Mostrar SweetAlert para confirmar el envío del formulario
                    Swal.fire({
                        title: "¿Estás seguro?",
                        text: "¿Deseas actualizar el dueño de este vehículo?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Actualizar",
                        cancelButtonText: "Cancelar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                        // Si el usuario confirma, enviar el formulario
                        formularioVehiculosClienteEdit.submit();
                        }
                    });
                    });
                });
            </script>
            <script>
    document.addEventListener("DOMContentLoaded", function() {
        const tablaClientesEditar = document.getElementById("tablaClientesEditar");
        const inputFiltroEditar = document.getElementById("inputFiltroEditar");

        // 1. Mostrar una alerta con el nombre del cliente al hacer clic en una fila
        tablaClientesEditar.addEventListener("click", function(event) {
            const target = event.target;
            if (target.tagName.toLowerCase() === "td") {
                const fila = target.parentElement;
                const idCliente = fila.children[0].textContent.trim();
                const nombreCliente = fila.children[1].textContent.trim(); // Obtener el nombre del cliente (segunda columna)
                const telefonoCliente = fila.children[2].textContent.trim(); 
                // Mostrar alerta con el nombre del cliente seleccionado
                //alert("Cliente seleccionado: " + nombreCliente);
                const modalIdCliente = document.getElementById("clienteSeleccionadoId");
                const modalNombreCliente = document.getElementById("clienteSeleccionado");
                const modalTelefonoCliente = document.getElementById("clienteSeleccionadoTelefono");
                modalIdCliente.value = idCliente;
                modalNombreCliente.textContent = "Cliente seleccionado: " + nombreCliente;
                modalTelefonoCliente.textContent = "Teléfono: " + telefonoCliente;

                const btnActualizar = document.getElementById("btnActualizarCliente");
                btnActualizar.disabled = false;
            }
        });

        // 2. Filtrar y actualizar los registros de la tabla cuando cambie el texto del input
        inputFiltroEditar.addEventListener("input", function(event) {
            const filtro = inputFiltroEditar.value.trim().toLowerCase();

            // Filtrar las filas de la tabla según el texto ingresado en el input
            const filas = tablaClientesEditar.getElementsByTagName("tr");
            Array.from(filas).forEach(fila => {
                const nombreCliente = fila.children[1].textContent.trim().toLowerCase(); // Obtener el nombre del cliente (segunda columna)
                if (nombreCliente.includes(filtro)) {
                    fila.style.display = ""; // Mostrar la fila si coincide con el filtro
                } else {
                    fila.style.display = "none"; // Ocultar la fila si no coincide con el filtro
                }
            });
        });
    });
</script>

            
            ';
        }
        function GetDatos($id)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("CALL p_mostrarVehiculosYClientes(?)");
            $query->bind_param('i', $id);
            $query->execute();
            $query->bind_result($idVehiculo, $marca, $modelo, $anio, $color, $placas, $imagen, $observacion, $fkIdCliente, $fkIdTipo, $idCliente, $nombre, $telefono, $correo); //Traer datos
            $query->fetch(); //Almacenarlos en la memoria
            $query->close();
            return array($idVehiculo, $marca, $modelo, $anio, $color, $placas, $imagen, $observacion, $fkIdCliente, $fkIdTipo, $idCliente, $nombre, $telefono, $correo);
        }
        function GetClientes($filtro)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("select * from clientes where nombre like ? or telefono like ? or correo like ?");
            $query->bind_param('sss', $filtro, $filtro, $filtro);
            $query->execute();
            $query->bind_result($idCliente, $nombre, $telefono, $correo); //Traer variables
            $rs = '';
            while($query->fetch())
            {
                $rs.= '<tr>
                        <td>'.$idCliente.'</td>
                        <td>'.$nombre.'</td>
                        <td>'.$telefono.'</td>
                        <td>'.$correo.'</td>
                       </tr>';
            }
            $query->close();  
            return $rs;
        }
        function GetTipo($descripcion)
        {

        }
        function ActualizarCliente($idVehiculo, $fkIdCliente)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("update vehiculos set fkIdCliente = ? where idVehiculo = ?");
            $query->bind_param('ii', $fkIdCliente, $idVehiculo);
            $query->execute();
            $query->close();
        }
        function Eliminar($id)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("delete from vehiculos where idVehiculo = ?");
            $query->bind_param('i', $id);
            $query->execute();
            $query->close();
        }
    }
?>