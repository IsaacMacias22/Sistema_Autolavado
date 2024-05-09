<section class="container-xl">
  <h2 class="text-center mt-4 pb-4 border-bottom border-1">Vehículos</h2>
  <div class="row w-100 mb-4 mt-4">
    <div class="d-flex justify-content-between">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropNuevo" id="botonvehiculonuevo">
          <span class="p-2 text-light"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 20 18">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>&nbsp;<span class="ocultar">Nuevo Vehículo</span></span>
      </button>
      <form action="vehiculos" method="post">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="(Tipo/Auto/Dueño)" aria-label="Buscar" aria-describedby="botonbuscarvehiculo" id="inputBuscarVehiculo" name="inputBuscarVehiculo">
            <button type="submit" class="btn btn-warning">
              <span class="p-2 text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>&nbsp;<span class="ocultar">Buscar</span></span>
            </button>
          </div>
      </form>
    </div>
   
    <div class="modal fade" id="staticBackdropNuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Vehículo</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <form id="formularioVehiculo" action="vehiculos" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row my-2">
                        <div class="form-group col">
                            <label for="cmbTipo" class="form-label">Tipo</label>
                            <select class="form-select" aria-label="Seleccionar Tipo" name="cmbTipo" id="cmbTipo">
                                <option selected>Seleccionar</option>
                                <option value="1">Automóvil</option>
                                <option value="2">Camioneta</option>
                                <option value="3">Tracto camión</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="txtPlacas" class="form-label">Placas</label>
                            <input type="text" name="txtPlacas" class="form-control" id="txtPlacas" placeholder="Placas del vehículo">       
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="form-group col">
                            <label for="txtMarca" class="form-label">Marca</label>
                            <input type="text" name="txtMarca" class="form-control" id="txtMarca" placeholder="Marca del vehículo">       
                        </div>
                        <div class="form-group col">
                            <label for="txtModelo" class="form-label">Modelo</label>
                            <input type="text" name="txtModelo" class="form-control" id="txtModelo" placeholder="Modelo del vehículo">       
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="form-group col">
                            <label for="txtAnio" class="form-label">Año</label>
                            <input type="number" name="txtAnio" class="form-control" id="txtAnio" placeholder="Año del vehículo">       
                        </div>
                        <div class="form-group col">
                            <label for="txtColor" class="form-label">Color</label>
                            <input type="text" name="txtColor" class="form-control" id="txtColor" placeholder="Color del vehículo">       
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="form-group col">
                            <label for="nombreCliente" class="form-label">Dueño</label>
                                <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropCliente" id="btnMostrarModalCliente">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#000000" class="bi bi-search" viewBox="0 0 18 18">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                    </svg>
                                </button>
                            <input type="text" name="nombreCliente" id="nombreCliente" class="form-control" value="" placeholder="Nombre del cliente" disabled>
                            <input type="hidden" name="idCliente" id="idCliente">
                        </div>
                        <div class="form-group col d-flex flex-column">
                            <label for="txtImagen" class="form-label">Imagen</label>
                            <input type="file" name="imagen" accept="image/*">   
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="staticBackdropCliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Lista de clientes</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inputFiltro" class="form-label">Buscar cliente:</label>
                        <input type="text" class="form-control" id="inputFiltro" placeholder="Escribe el nombre del cliente">
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
                            <tbody id="tablaClientes">
                                <?php echo $clientes ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn boton2 text-light" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div>
    <?php echo $resultado; ?>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formulario = document.getElementById('formularioVehiculo');
        formulario.addEventListener('submit', function (event) {
            event.preventDefault();
            fetch(formulario.action, {
                method: formulario.method,
                body: new FormData(formulario)
            }).then(response => {
                if (response.ok) {
                    // Si la respuesta es satisfactoria, mostramos la alerta con SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Exitoso',
                        text: 'El vehículo ha sido registrado correctamente.'
                    }).then(() => {
                        setTimeout(() => {
                            location.reload();
                        }, 250); // Espera 250 milisegundos (0.25 segundos) antes de recargar
                    });
                    // Cerrar el modal después de mostrar la alerta
                    $('#staticBackdropNuevo').modal('hide');
                } else {
                    // Si la respuesta no es satisfactoria, mostramos un mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error al registrar el vehículo. Por favor, inténtalo de nuevo.'
                    });
                }
            }).catch(error => {
                console.error('Error:', error);
                // Si hay un error en la solicitud, mostramos una alerta de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ha ocurrido un error al registrar el vehículo. Por favor, inténtalo de nuevo.'
                });
            });
        });
    });
</script>
<script>
    // Espera a que el documento esté completamente cargado
    document.addEventListener('DOMContentLoaded', function () {
    // Obtén una referencia a los modales
        const modalNuevo = new bootstrap.Modal(document.getElementById('staticBackdropNuevo'));
        const modalCliente = new bootstrap.Modal(document.getElementById('staticBackdropCliente'));

        // Agrega un evento click al botón para abrir el segundo modal
        const btnMostrarModalCliente = document.getElementById('btnMostrarModalCliente');
        btnMostrarModalCliente.addEventListener('click', function () {
            // Oculta el primer modal
            modalNuevo.hide();

            // Muestra el segundo modal encima del primero
            modalCliente.show();
        });

        // Agrega un evento hide al segundo modal para mostrar nuevamente el primero al cerrarse el segundo
        modalCliente._element.addEventListener('hide.bs.modal', function () {
            // Muestra nuevamente el primer modal al cerrarse el segundo
            modalNuevo.show();
        });
    });

    $(document).ready(function () {

        $('#staticBackdropCliente tbody tr').click(function () {
            var nombreCliente = $(this).find('td:eq(1)').text();
            var idCliente = $(this).find('td:eq(0)').text();

            $('#nombreCliente').val(nombreCliente);
            $('#idCliente').val(idCliente);

            $('#staticBackdropCliente').modal('hide');
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const inputFiltro = document.getElementById('inputFiltro');
        const tablaClientes = document.getElementById('tablaClientes');

        inputFiltro.addEventListener('input', function () {
            const filtro = inputFiltro.value.toLowerCase().trim();

            // Filtrar las filas de la tabla
            Array.from(tablaClientes.rows).forEach((fila) => {
                const textoFila = fila.textContent.toLowerCase().trim();
                if (textoFila.includes(filtro)) {
                    fila.style.display = ''; // Mostrar la fila si coincide con el filtro
                } else {
                    fila.style.display = 'none'; // Ocultar la fila si no coincide con el filtro
                }
            });
        });
    });
</script>
