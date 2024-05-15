<div class="ColorTurnos d-flex align-items-center">
        <h5 class="text-white ms-3 mt-2">REGISTRO TURNOS</h5>
    <div class="col">
        <button class="btn btn-light ms-3 me-4 float-end" data-toggle="modal" data-target="#addturno"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
          </svg>&nbsp;NUEVO</button>
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
          <div class="modal-header modaltitulo">
            <h5 class="modal-title" id="myLargeModalLabel">Agregar Turno</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            <div class="modal-body modalcolor">
            <div class="row">
              <div class="col-6">
                  Cliente:
                  <button class="btn btn-sm cliente" type="button" data-toggle="modal" data-target="#buscarcliente" _clien=%>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>
                  </button>
                  <input type="text" name="txtcliente" id="txtcliente" class="form-control" disabled>
                  Lavador:
                  <button class="btn btn-sm lavador" type="button" data-toggle="modal" data-target="#buscarcliente" _lava=%>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>
                  </button>
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
            <div class="modal-footer modalcolor">
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

<div class="modal fade" id="buscarcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
          <div class="modal-header modaltitulo">
            <h5 class="modal-title" id="titulo"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body modalcolor">
            <div id="c">
                
            </div>
          </div>
          <div class="modal-footer modalcolor">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
            </div>
            </div>


</div>


