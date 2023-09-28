<?php include "Views/Templates/header.php";?>

 <div class="card-shadow mb-3">
    <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8  mt-2">
                <h5> <i class="fas fa-users"></i> Consulta de proveedores</h5>
            </div>
            <div class="col-4">
                <button class="btn btn-success btn-icon-split float-right" onclick="formProveedor();" type="button">
                    Crear proveedores 
            </button>
            </div>
        </div>
    </div>
</div>
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url ?>home">Home <i class="fas fa-arrow-circle-right mr-2"></i> </a></li>
    <li class="breadcrumb-item active"  aria-current="page"> Consulta de proveedores</li>
  </ol>
</nav>
 <div class="card">
    <div class="card-header bg-blue text-white">
        <h6>Listado de proveedores</h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
 <table class="table table-light table-width" id="tableProveedores">
    <thead class="thead-dark">
        <tr>
            <th>No.</th>
            <th>NIT</th>
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
<div id="crearModalProveedor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="close"  data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="formProveedor" id="formProveedor">
                    <div class="form-group">
                        <label for="inputCedula">NIT</label>
                        <input id="inputProveedorCedula" class="form-control"  type="number" name="inputProveedorCedula" placeholder="NIT">
                        <input id="inputProveedorId" type="hidden" name="inputProveedorId">
                    </div>
                    <div class="form-group">
                        <label for="inputProveedorNombreCompleto">Nombre completo</label>
                        <input id="inputProveedorNombreCompleto" class="form-control" type="text" name="inputProveedorNombreCompleto" placeholder="Nombre del proveedor">
                    </div>
                    <div class="form-group">
                                <label for="inputProveedorTelefono">Télefono</label>
                                <input id="inputProveedorTelefono" class="form-control"  type="number" name="inputProveedorTelefono" placeholder="Teléfono">
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
                                <label for="inputProveedorDireccion">Dirección</label>
                                <input id="inputProveedorDireccion" class="form-control"  type="text" name="inputProveedorDireccion" placeholder="Dirección">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 text-center">
                                <button class="btn btn-success" onclick="registrarProveedor(event);" id="buttonCrear" type="button">Registrar</button>
                                <button class="btn btn-warning text-white" onclick="editarProveedor(event);"  id="buttonEditar" type="button">Modificar</button>
                            </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>
