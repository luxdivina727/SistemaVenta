<?php include "Views/Templates/header.php";?>
 <div class="card-shadow mb-3">
    <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8  mt-2">
                <h5> <i class="fas fa-shopping-bag"></i> Consulta de productos</h5>
            </div>
            <div class="col-4">
                <button class="btn btn-success btn-icon-split float-right" onclick="formProducto();" type="button">
                    Ingresar producto 
            </button>
            </div>
        </div>
    </div>
</div>
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url ?>home">Home <i class="fas fa-arrow-circle-right mr-2"></i> </a></li>
    <li class="breadcrumb-item active"  aria-current="page"> Consulta de productos</li>
  </ol>
</nav>
 <div class="card">
    <div class="card-header bg-blue text-white">
        <h6>Listado de productos</h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
 <table class="table table-light table-width" id="tableProductos">
    <thead class="thead-dark">
        <tr>
            <th>No.</th>
            <th>Descripción</th>
            <th>Código de barras</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Proveedor</th>
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
<div id="crearModalProducto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="close"  data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="formProducto" id="formProducto">
                    <div class="form-group">
                        <label for="inputProductoNombre">Producto</label>
                        <input id="inputProductoNombre" class="form-control" type="text" name="inputProductoNombre" placeholder="Nombre del producto">
                        <input id="inputProductoId" type="hidden" name="inputProductoId">
                    </div>
                    <div class="form-group">
                        <label for="inputProductoCodigo">Código de barras</label>
                        <input id="inputProductoCodigo" class="form-control" type="text" name="inputProductoCodigo" placeholder="Código de barras">
                    </div>
                    <div class="row" id="rowProductoPrecio">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputProductoPrecioCompra">Precio Compra</label>
                            <input id="inputProductoPrecioCompra" class="form-control" type="number" name="inputProductoPrecioCompra" placeholder="Precio Compra">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputProductoPrecioVenta">Precio Venta</label>
                            <input id="inputProductoPrecioVenta" class="form-control" type="number" name="inputProductoPrecioVenta" placeholder="Precio Venta">
                        </div>
                    </div>
                    </div>
                    <div class="row" id="rowProductoMedicion">
                        <div class="col-md-6">
                        <label for="selectMedida">Categorías</label>
                        <select id="selectCategoria" class="form-control" name="selectCategoria">
                            <?php foreach ($data['categorias'] as $row) {?>
                            <option value=<?php echo $row['CategoriaId']?>><?php echo $row['CategoriaNombre'];?></option>
                                
                            <?php }?>
                        </select>
                        </div>
                        <div class="col-md-6">
                        <label for="selectMedida">Medidas</label>
                        <select id="selectMedida" class="form-control" name="selectMedida">
                            <?php foreach ($data['medidas'] as $row) {?>
                            <option value=<?php echo $row['MedidaId']?>><?php echo $row['MedidaNombre'];?></option>
                                
                            <?php }?>
                        </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                    <div class="col-md-6">
                    <div class="form-group">
                            <label for="inputProductoCantidad">Cantidad</label>
                            <input id="inputProductoCantidad" class="form-control" type="number" name="inputProductoCantidad" placeholder="Cantidad">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="selectProveedor">Proveedor</label>
                        <select id="selectProveedor" class="form-control" name="selectProveedor">
                            <?php foreach ($data['proveedores'] as $row) {?>
                            <option value=<?php echo $row['ProveedorId']?>><?php echo $row['ProveedorNombreCompleto'];?></option>    
                            <?php }?>
                        </select>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                                <button class="btn btn-success" onclick="registrarProducto(event);" id="buttonCrear" type="button">Registrar</button>
                                <button class="btn btn-warning text-white" onclick="editarProducto(event);"  id="buttonEditar" type="button">Modificar</button>
                            </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>
