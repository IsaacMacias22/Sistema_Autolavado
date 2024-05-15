<section class="container-xl">
  <h2 class="text-center mt-4 pb-4 text-white">Empleado del Día</h2>
  <div class="row w-100 mb-0 mt-2">
    <div class="d-flex">
      <form action="empleadodia" method="post">
        <div class="input-group">
          <label for="" class="form-label text-white fs-4">Seleccionar Fecha: &nbsp;</label>
          <input type="date" class="form-control bgazul3 text-white" id="fechaPagos" name="fechaPagos">
        </div>
      </form>
    </div>
  </div>
  <div>
    <?php echo $resultado; ?>
  </div>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Obtener el campo de fecha
    const fechaInput = document.getElementById('fechaPagos');

    // Agregar un EventListener para detectar cambios en el valor
    fechaInput.addEventListener('change', function() {
      // Obtener el valor seleccionado en el campo de fecha
      const fechaSeleccionada = fechaInput.value;

      // Dividir la fecha en sus componentes (día, mes, año)
      const partesFecha = fechaSeleccionada.split('-');

      // Reorganizar la fecha en el formato deseado (año-mes-día)
      const fechaFormateada = partesFecha[0] + '-' + partesFecha[1] + '-' + partesFecha[2];

      // Asignar el valor formateado de vuelta al campo fechaPagos
      fechaInput.value = fechaFormateada;

      // Enviar el formulario automáticamente
      document.querySelector('form').submit();
    });
  });
</script>



