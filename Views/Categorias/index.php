<?php include "Views/Templates/header.php";?>
 <div class="card-shadow mb-3">
    <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8  mt-2">
                <h5> <i class="fas fa-sitemap"></i> Consulta de categorías</h5>
            </div>
            <div class="col-4">
                <button class="btn btn-success btn-icon-split float-right" onclick="formCategoria();" type="button">
                    Crear categorías 
            </button>
            </div>
        </div>
    </div>
</div>
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url ?>home">Home <i class="fas fa-arrow-circle-right mr-2"></i> </a></li>
    <li class="breadcrumb-item active"  aria-current="page"> Consulta de categorías</li>
  </ol>
</nav>
 <div class="card">
    <div class="card-header bg-blue text-white">
        <h6>Listado de categorías</h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
 <table class="table table-light table-width" id="tableCategorias">
    <thead class="thead-dark">
        <tr>
            <th>No.</th>
            <th>Nombre</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
 </table>
</div>
</div>
</div>
<div id="crearModalCategorias" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="close"  data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="formCategoria" id="formCategoria">
                    <div class="form-group">
                        <label for="inputCategoriaNombre">Nombre</label>
                        <input id="inputCategoriaNombre" class="form-control" type="text" name="inputCategoriaNombre" placeholder="Nombre de la categoría">
                        <input id="inputCategoriaId" type="hidden" name="inputCategoriaId">
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                                <button class="btn btn-success" onclick="registrarCategorias(event);" id="buttonCrear" type="button">Registrar</button>
                                <button class="btn btn-warning text-white" onclick="editarCategorias(event);"  id="buttonEditar" type="button">Modificar</button>
                            </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>
