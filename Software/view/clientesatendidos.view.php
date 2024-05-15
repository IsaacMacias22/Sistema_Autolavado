<section class="container-fluid">
  <h2 class="text-center mt-4 pb-4 text-white">Clientes Atendidos</h2>
  <div class="row w-100 mb-0 mt-2">
    <div class="d-flex justify-content-end">
      <form action="clientesatendidos" method="post">
        <div class="d-flex">
            <div class="input-group">
                <label for="" class="form-label text-white fs-5">Fecha Inicio: &nbsp;</label>
                <input type="date" class="form-control bgazul3 text-white" id="fechaInicio" name="fechaInicio">
            </div>
            &nbsp;&nbsp;
            <div class="input-group">
                <label for="" class="form-label text-white fs-5">Fecha Fin: &nbsp;</label>
                <input type="date" class="form-control bgazul3 text-white" id="fechaFin" name="fechaFin">
            </div>
            &nbsp;&nbsp;
            <button class="btn btn-sm btn-primary text-white fs-5" type="submit" id="btnenviarform">
               Generar &nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                </svg>
            </button>
        </div>
      </form>
    </div>
  </div>
  <div class="row w-75 mx-auto d-flex justify-content-center">
    <canvas id="barChart" width="500px" height="500px"></canvas>
  </div>
  <div>
    <?php echo $resultado; ?>
  </div>
</section>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Obtener el campo de fecha
    const fechaInput = document.getElementById('fechaInicio');
    const fechaFin = document.getElementById('fechaFin');
    const btn = document.getElementById('btnenviarform');

    // Agregar un EventListener para detectar cambios en el valor
    btn.addEventListener('click', function() {
      // Obtener el valor seleccionado en el campo de fecha
      const fechaSeleccionada = fechaInput.value;
      const fechaFinSeleccionada = fechaFin.value;

      // Dividir la fecha en sus componentes (día, mes, año)
      const partesFecha = fechaSeleccionada.split('-');
      const partesFechaFin = fechaFinSeleccionada.split('-');

      // Reorganizar la fecha en el formato deseado (año-mes-día)
      const fechaFormateada = partesFecha[0] + '-' + partesFecha[1] + '-' + partesFecha[2];
      const fechaFinFormateada = partesFechaFin[0] + '-' + partesFechaFin[1] + '-' + partesFechaFin[2]; 

      // Asignar el valor formateado de vuelta al campo fechaPagos
      fechaInput.value = fechaFormateada;
      fechaFin.value = fechaFinFormateada;

      // Enviar el formulario automáticamente
      document.querySelector('form').submit();
    });
  });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener el contexto del canvas
        var ctx = document.getElementById('barChart').getContext('2d');

        // Recuperar los datos JSON de los empleados y montos ganados
        var jsonData = <?php echo $grafico; ?>;

        // Extraer nombres de clientes y números de servicios del JSON
        var clientes = jsonData.map(function (cliente) {
            return cliente.cliente;
        });

        var numeroservicios = jsonData.map(function (cliente) {
            return cliente.numeroservicios;
        });

        // Generar una paleta de colores para el gráfico
        var backgroundColors = [];
        for (var i = 0; i < numeroservicios.length; i++) {
            var red = Math.floor(Math.random() * 256);
            var green = Math.floor(Math.random() * 256);
            var blue = Math.floor(Math.random() * 256);
            backgroundColors.push('rgba(' + red + ',' + green + ',' + blue + ', 0.7)');
        }

        // Configurar y crear la gráfica de pastel
        var barChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: clientes,
                datasets: [{
                    label: 'Número de Servicios',
                    data: numeroservicios,
                    backgroundColor: backgroundColors,
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Desactivar la opción responsive
                plugins: {
                    legend: {
                        labels: {
                            color: 'white', // Cambiar el color del texto de la leyenda a blanco
                            font: {
                                size: 18, // Cambiar el tamaño de la fuente
                                weight: 'bold'
                            }
                        }
                    },
                    datalabels: {
                        color: 'white',
                        font: {
                            size: 18, // Cambiar el tamaño de la fuente
                            weight: 'bold'
                        },
                        formatter: (value, context) => {
                            return value;
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
</script>

