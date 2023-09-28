<?php include "Views/Templates/header.php";?>
 <div class="card-shadow mb-3">
    <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-8  mt-2">
                <h5> <i class="fas fa-users"></i> Consulta de usuarios</h5>
            </div>
            <div class="col-4">
                <button class="btn btn-success btn-icon-split float-right" onclick="formUsuario();" type="button">
                    Crear usuario 
            </button>
            </div>
        </div>
    </div>
</div>
</div>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url ?>home">Home <i class="fas fa-arrow-circle-right mr-2"></i> </a></li>
    <li class="breadcrumb-item active"  aria-current="page"> Consulta de usuarios</li>
  </ol>
</nav>
 <div class="card">
    <div class="card-header bg-blue text-white">
        <h6>Listado de usuarios</h6>
    </div>
  <div class="card-body">
    <div class="table-responsive">
 <table class="table table-light table-width" id="tableUsuarios">
    <thead class="thead-dark">
        <tr>
            <th>No.</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Correo electrónico</th>
            <th>Caja</th>
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
<div id="crearModalUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="close"  data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="formUsuario" id="formUsuario">
                    <div class="form-group">
                        <label for="inputUsuarioNombre">Usuario</label>
                        <input id="inputUsuarioNombre" class="form-control" maxlength="10" type="text" name="inputUsuarioNombre" placeholder="Usuario">
                        <input id="inputUsuarioId" type="hidden" name="inputUsuarioId">
                    </div>
                    <div class="form-group">
                        <label for="inputUsuarioNombreCompleto">Nombre Completo</label>
                        <input id="inputUsuarioNombreCompleto" class="form-control" type="text" name="inputUsuarioNombreCompleto" placeholder="Nombre completo del usuario">
                    </div>
                    <div class="form-group">
                        <label for="inputUsuarioCorreoElectronico">Correo electrónico</label>
                        <input id="inputUsuarioCorreoElectronico" class="form-control" require pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" type="email" name="inputUsuarioCorreoElectronico" placeholder="Correo electrónico">
                    </div>
                    <div class="row" id="rowUsuarioClaves">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputUsuarioClave">Contraseña</label>
                            <input id="inputUsuarioClave" class="form-control" type="password" name="inputUsuarioClave" placeholder="Contraseña">
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputUsuarioClaveConfirmar">Confirmar contraseña</label>
                                <input id="inputUsuarioClaveConfirmar" class="form-control" type="password" name="inputUsuarioClaveConfirmar" placeholder="Confirmar contraseña">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="selectCaja">Caja</label>
                        <select id="selectCaja" class="form-control" name="selectCaja">
                            <?php foreach ($data['cajas'] as $row) {?>
                            <option value=<?php echo $row['CajaId']?>><?php echo $row['CajaNombre'];?></option>
                                
                            <?php }?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                                <button class="btn btn-success" onclick="registrarUsuario(event);" id="buttonCrear" type="button">Registrar</button>
                                <button class="btn btn-warning text-white" onclick="editarUsuario(event);"  id="buttonEditar" type="button">Modificar</button>
                            </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>
