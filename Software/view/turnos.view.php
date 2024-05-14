<div class="ColorTurnos d-flex align-items-center">
        <h5 class="text-white ms-3 mt-4 mb-4">REGISTRO TURNOS</h5>
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
                <button class="btn btn-sm cliente"  data-toggle="modal" data-target="#buscarcliente" _clien=%>&#128269;</button>
                <input type="text" name="txtcliente" id="txtcliente" class="form-control" disabled>
                Lavador:
                <button class="btn btn-sm lavador"  data-toggle="modal" data-target="#buscarcliente" _lava=%>&#128269;</button>
                <input type="text" name="txtlavador" id="txtlavador" class="form-control" disabled>
            </div>
            <div class="col-6">
                Automovil:
                <input type="text" name="txtautomovil" id="txtautomovil" class="form-control mt-1 mb-2" disabled>
                Costo:
                <input type="number" name="txtNombreEdit" class="form-control mt-1">
            </div>
            </div>
          </div>
          <div class="modal-footer">
            <form action="turnos" method="post">
                <input type="hidden" name="txtidcli" id="txtidcli">
                <input type="hidden" name="txtautomoviladd" id="txtautomoviladd">
                <input type="hidden" name="txtcostoadd" id="txtcostoadd">
                <input type="hidden" name="txtidlava" id="txtidlava">
                <button type="submit" class="btn btn-primary">Agregar</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
            </div>
            </div>


</div>


