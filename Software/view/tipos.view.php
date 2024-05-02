<section class="container-xl">
  <h2 class="text-center mt-4 pb-4 border-bottom border-1">Tipos</h2>
  <div class="row w-100 mb-4 mt-4">
    <div class="d-flex justify-content-end">
      <form action="tipos" method="post">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Descripción" aria-label="Descripción" aria-describedby="botonbuscartipo" id="inputBuscarTipo" name="inputBuscarTipo">
            <button type="submit" class="btn btn-warning">
              <span class="p-2 text-dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/></svg>&nbsp;<span class="ocultar">Buscar</span></span>
            </button>
          </div>
      </form>
    </div>
  </div>
  <div>
    <?php echo $resultado; ?>
  </div>
</section>
