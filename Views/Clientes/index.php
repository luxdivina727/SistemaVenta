<?php include "Views/Templates/header.php";?>

 <div class="card-shadow mb-3">
    <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8  mt-2">
                <h5> <i class="fas fa-users"></i> Consulta de clientes</h5>
            </div>
            <div class="col-4">
                <button class="btn btn-success btn-icon-split float-right" onclick="formCliente();" type="button">
                    Crear clientes 
            </button>
            </div>
        </div>
    </div>
</div>
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url ?>home">Home <i class="fas fa-arrow-circle-right mr-2"></i> </a></li>
    <li class="breadcrumb-item active"  aria-current="page"> Consulta de clientes</li>
  </ol>
</nav>
 <div class="card">
    <div class="card-header bg-blue text-white">
        <h6>Listado de clientes</h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
 <table class="table table-light table-width" id="tableClientes">
    <thead class="thead-dark">
        <tr>
            <th>No.</th>
            <th>Cédula</th>
            <th>Nombre completo</th>
            <th>Teléfono</th>
            <th>Ciudad</th>
            <th>Dirección</th>
            <th>Estado</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
 </table>
</div>
</div>
</div>
<div id="crearModalCliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="close"  data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="formCliente" id="formCliente">
                    <div class="form-group">
                        <label for="inputCedula">Cédula</label>
                        <input id="inputClienteCedula" class="form-control"  type="number" name="inputClienteCedula" placeholder="Documento de identidad">
                        <input id="inputClienteId" type="hidden" name="inputClienteId">
                    </div>
                    <div class="form-group">
                        <label for="inputClienteNombreCompleto">Nombre completo</label>
                        <input id="inputClienteNombreCompleto" class="form-control" type="text" name="inputClienteNombreCompleto" placeholder="Nombre del cliente">
                    </div>
                    <div class="form-group">
                                <label for="inputClienteTelefono">Télefono</label>
                                <input id="inputClienteTelefono" class="form-control"  type="number" name="inputClienteTelefono" placeholder="Teléfono">
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                         <label for="selectCiudad">Ciudad</label>
                            <select id="selectCiudad" class="form-control" name="selectCiudad">
                                <?php foreach ($data['ciudades'] as $row) {?>
                                <option value=<?php echo $row['CiudadId']?>><?php echo $row['CiudadNombre'];?></option>
                                <?php }?>
                            </select>
                    </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputClienteDireccion">Dirección</label>
                                <input id="inputClienteDireccion" class="form-control"  type="text" name="inputClienteDireccion" placeholder="Dirección">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 text-center">
                                <button class="btn btn-success" onclick="registrarCliente(event);" id="buttonCrear" type="button">Registrar</button>
                                <button class="btn btn-warning text-white" onclick="editarCliente(event);"  id="buttonEditar" type="button">Modificar</button>
                            </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>
