<section class="container-xl">
  <h2 class="text-center mt-4 pb-4 border-bottom border-1 text-white">Empleados</h2>
  <div class="row w-100 mb-4 mt-4">
    <div class="d-flex justify-content-between">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdropNuevo" id="botonclientenuevo">
          <span class="p-2 text-light"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 20 18">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
            </svg>&nbsp;<span class="ocultar">Nuevo Empleado</span></span>
      </button>
      <form action="empleados" method="post">
        <div class="input-group">
            <input type="text" class="form-control bgblanco1" placeholder="Empleado" aria-label="Empleado" aria-describedby="botonbuscarempleado" id="inputBuscarEmpleado" name="inputBuscarEmpleado">
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
            <div class="modal-header modaltitulo">
              <h5 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Empleado</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
              <form id="formularioEmpleado" action="empleados" method="post" enctype="multipart/form-data">
                <div class="modal-body modalcolor">
                    <div class="form-group my-2">
                        <label for="txtNombre" class="form-label">Nombre</label>
                        <input type="text" name="txtNombre" class="form-control" id="txtNombre" placeholder="Nombre(s) del Empleado">       
                    </div>
                    <div class="form-group my-2">
                        <label for="txtApellidos" class="form-label">Apellidos</label>
                        <input type="text" name="txtApellidos" class="form-control" id="txtApellidos" placeholder="Apellido(s) del Empleado">       
                    </div>
                    <div class="form-group my-2">
                        <label for="txtTelefono" class="form-label">Teléfono</label>
                        <input type="text" name="txtTelefono" class="form-control" id="txtTelefono" placeholder="Teléfono del Empleado">       
                    </div>
                    <div class="form-group my-2">
                        <label for="txtCorreo" class="form-label">Correo Electrónico</label>
                        <input type="email" name="txtCorreo" class="form-control" id="txtCorreo" placeholder="Correo del Empleado">       
                    </div>
                    <div class="form-group my-2">
                        <label for="txtPorcentaje" class="form-label">Porcentaje</label>
                        <input type="number" name="txtPorcentaje" class="form-control" id="txtPorcentaje" placeholder="Porcentaje a ganar">       
                    </div>
                    <div class="form-group my-2 d-flex flex-column">
                        <label for="txtImagen" class="form-label">Imagen</label>
                        <input type="file" name="imagen" accept="image/*">   
                    </div>
                </div>
                <div class="modal-footer modalcolor">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
        </div>
      </div>
    </div>
  </div>
  <div>
    <?php echo $resultado; ?>
    <?php echo $comentarios; ?>
  </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const formulario = document.getElementById('formularioEmpleado');
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
                        text: 'El empleado ha sido registrado correctamente.'
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
                        text: 'Ha ocurrido un error al registrar el empleado. Por favor, inténtalo de nuevo.'
                    });
                }
            }).catch(error => {
                console.error('Error:', error);
                // Si hay un error en la solicitud, mostramos una alerta de error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ha ocurrido un error al registrar el empleado. Por favor, inténtalo de nuevo.'
                });
            });
        });
    });
</script>
<script>
    // Función para formatear el número de teléfono
    function formatearTelefono(numero) {
        // Eliminar cualquier carácter que no sea un dígito
        var digits = numero.replace(/\D/g, '');
        // Aplicar el formato (999) 999-9999
        var formateado = digits.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
        return formateado;
    }

    // Obtener el elemento de entrada
    var inputTelefono = document.getElementById('txtTelefono');

    // Escuchar el evento de cambio en el campo de entrada
    inputTelefono.addEventListener('input', function() {
        // Obtener el valor del campo de entrada
        var valor = this.value;
        // Formatear el número de teléfono y establecerlo como valor del campo de entrada
        this.value = formatearTelefono(valor);
    });
</script>
