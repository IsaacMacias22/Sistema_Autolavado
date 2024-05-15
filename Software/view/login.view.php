<!DOCTYPE html>
<html>
<head>
  <title>Bimbuñuelo Autolavado</title>
  <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="./css/StylesGio.css"> -->
  <script src="dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    html, body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(to bottom, #4CA1AF, #C4E0E5);
    }
    .margen
  {
    padding: 0px 0px !important;
  }
  .card{
    background: white;
    /* Para la sombra */
    box-shadow: 5px 5px 10px rgb(85, 84, 84) !important;
    /* Para el redondeado */
    border-radius: 5px;
    margin: 0% !important;
  }
  .card-image img{
    width: 100% !important;
    height: auto !important;
    border-radius: 5px;
  }
  .textred
  {
    color: red;
  }
  </style>
</head>
<body>
  <div class="container card">
    <div class="row justify-content-center">
      <div class="col-auto margen mr-2">
        <div class="text-center card-image">
          <img src="./images/LOGO.png" class="img-fluid" alt="Imagen">
        </div>
      </div>
      <div class="col-auto">
        <form method="post" action="login"  style="width: 420px; margin: 0 auto;">
          <h2 class="text-center mb-4 mt-4">Bienvenido<br><h4 class="text-center">Inicio de Sesión</h4></br></h2>
          <div class="form-group mt-4">
            <label for="username">Usuario:</label>
            <input type="text" class="form-control" name="txtusuario" id="txtusuario" placeholder="Ingresa Usuario">
          </div>
          <div class="form-group mt-4 mb-4">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control"  name="txtcontrasena" id="txtcontrasena" placeholder="Ingresa Contraseña">
          </div>
          <div class="text-center">
            <!-- <label for="validacion" class="textred">Contraseña o Usuario Incorrecto</label> -->
            <?php echo $resultado; ?>
          </div>
          <button type="submit" class="btn btn-primary btn-block mt-4">Iniciar Sesión</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>