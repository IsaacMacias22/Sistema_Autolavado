<section class="container-xl">
  <h2 class="text-center mt-4 pb-4 text-white">Pagos del día</h2>
  <div class="row w-100 mb-0 mt-2">
    <div class="d-flex">
      <form action="nomina" method="post">
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
  <div class="row w-75 mx-auto">
    <canvas id="barChart" width="400px" height="200px"></canvas>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener el contexto del canvas
        var ctx = document.getElementById('barChart').getContext('2d');

        // Recuperar los datos JSON de los empleados y montos ganados
        var jsonData = <?php echo $grafico; ?>;

        // Extraer nombres de empleados y montos ganados del JSON
        var nombresEmpleados = jsonData.map(function (empleado) {
            return empleado.nombre;
        });

        var montosGanados = jsonData.map(function (empleado) {
            return empleado.monto;
        });

        // Configurar y crear la gráfica de barras
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nombresEmpleados,
                datasets: [{
                    label: 'Monto Ganado por Empleado',
                    data: montosGanados,
                    backgroundColor: 'rgba(28, 92, 121, 0.5)', // Color de las barras
                    borderColor: 'rgba(255, 255, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Monto Ganado',
                            color: 'rgba(255,255,255,1)'
                        },
                        ticks: {
                            color: 'white' // Color de las etiquetas en el eje x (nombres de empleados)
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Nombre del Empleado',
                            color: 'rgba(255,255,255,1)'
                        },
                        ticks: {
                            color: 'white' // Color de las etiquetas en el eje x (nombres de empleados)
                        }
                    }
                },
                plugins: {
                  legend: {
                      labels: {
                          color: 'white' // Cambiar el color del texto de la leyenda a blanco
                      }
                  }
                }
            }
        });
    });
</script>



