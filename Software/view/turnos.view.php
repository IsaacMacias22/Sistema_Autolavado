<div class="ColorTurnos d-flex align-items-center">
        <img src="./images/LOGO.png" class="imgbarra" alt="Imagen">
        <h5 class="text-white ms-3">REGISTRO TURNOS</h5>
    <div class="col">
        <button class="btn btn-light ms-3 me-4 float-end" data-toggle="modal" data-target="#addturno">NUEVO</button>
    </div>
</div>
    


<div class="row bg-transparent">
<div class="col-4 mt-2 bg-transparent">

    <div class="text-center bg-success card mb-4">
        <h4 class="">En Espera</h4>
    </div>

    <!-- Turnos BD -->
    <?php echo $resultado[0]; ?>
</div>

<div class="col-4 mt-2 ">

    <div class="text-center bg-primary card mb-4">
        <h4>En Proceso</h4>
    </div>

    <!-- Turnos BD -->
    <?php echo $resultado[1]; ?>

</div>
<div class="col-4 mt-2 ">

    <div class="text-center bg-danger card mb-4">
        <h4>Terminado</h4>
    </div>

    <!-- Turnos BD -->
    <?php echo $resultado[2]; ?>

</div>


<div class="modal fade bd-example-modal-lg" id="addturno" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myLargeModalLabel">Agregar Turno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body">
            <div class="row">
              <div class="col-6">
                  Cliente:
                  <button class="btn btn-sm cliente" type="button" data-toggle="modal" data-target="#buscarcliente" _clien=%>&#128269;</button>
                  <input type="text" name="txtcliente" id="txtcliente" class="form-control" disabled>
                  Lavador:
                  <button class="btn btn-sm lavador" type="button" data-toggle="modal" data-target="#buscarcliente" _lava=%>&#128269;</button>
                  <input type="text" name="txtlavador" id="txtlavador" class="form-control" disabled>
              </div>
              <div class="col-6">
                  Automovil:
                  <input type="text" name="txtautomovil" id="txtautomovil" class="form-control mt-1 mb-2" disabled>
                  Costo:
                  <div id="costo">
                    <input type="number" name="txtCostoLavado" id="txtCostoLavado" class="form-control mt-1" disabled>
                  </div>
              </div>
              </div>
            </div>
            <div class="modal-footer">
              <form action="turnos" method="post">
                  <input type="hidden" name="txtidcli" id="txtidcli">
                  <input type="hidden" name="txtautomoviladd" id="txtautomoviladd">
                  <input type="hidden" name="txtcostoadd" id="txtcostoadd">
                  <input type="hidden" name="txtidlava" id="txtidlava">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary">Agregar</button>
              </form>
            </div>
        </div>
            </div>
</div>

<script>
                $(".cliente").click(function() {
                    let _clien = $(this).attr("_clien");
                    $.post("accionesturnos",{clien:_clien},function(mensaje)
                    {
                        $("#titulo").text("Seleccionar Cliente");
                        $("#c").html(mensaje);
                    }
                );    
                });
</script>

<script>
                $(".lavador").click(function() {
                    let _lava = $(this).attr("_lava");
                    $.post("accionesturnos",{lava:_lava},function(mensaje)
                      {
                        $("#titulo").text("Seleccionar Lavador");
                        $("#c").html(mensaje);
                      }
                    );    
                });
</script>

<!-- <script>
  document.addEventListener('DOMContentLoaded', function() {
    // Selecciona el formulario por su ID
    const form = document.querySelector('form');

    // Adjunta un evento al evento 'submit' del formulario
    form.addEventListener('submit', function(event) {
      // Obtiene el valor actual del campo txtCostoLavado
      const costoLavado = document.getElementById('txtCostoLavado').value;

      // Asigna este valor al campo txtcostoadd
      document.getElementById('txtcostoadd').value = costoLavado;

      // Asegura que el valor se haya asignado correctamente antes de enviar el formulario
      // Puedes agregar una pequeña demora (por ejemplo, 100 milisegundos) para asegurarte de que la asignación se complete
      setTimeout(function() {
        // Envía el formulario después de asignar el valor
        form.submit();
      }, 100);
      
      // Evita el envío del formulario por defecto
      event.preventDefault();
    });

    // Adjunta un evento al botón de envío del formulario
    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.addEventListener('click', function() {
      // Simula el clic en el botón de envío para activar el evento 'submit' del formulario
      form.dispatchEvent(new Event('submit'));
    });
  });
</script> -->



<div class="modal fade" id="buscarcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="titulo"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="c">
                
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
            </div>
            </div>


</div>


