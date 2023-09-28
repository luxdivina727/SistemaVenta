
const url=base_url+"Assets/js/datatable/Spanish.json";

//#region Modales Genericos  
function ModalMensajeSatisfactorio(texto){
    Swal.fire({
        icon: 'success',
        title: texto,
        showConfirmButton: false,
        timer: 3000
      })
}
function ModalMensajeError(texto){
    Swal.fire({
        icon: 'error',
        title: texto,
        showConfirmButton: false,
        timer: 3000
      })
}
function ModalMensajeInactivacion(texto){
    Swal.fire(
        '¡Mensaje!',
        texto,
        'success'
    )
}
//#endregion

//#region  Tablas 
let tableUsuarios,tableClientes,tableCajas,tableCategorias,tableMedidas,tableProveedores,
tableProductos;
document.addEventListener("DOMContentLoaded",function(){
    tableUsuarios = $('#tableUsuarios').DataTable( {
        ajax: {
            url: base_url + "Usuarios/listar",
            dataSrc: ''
        },
        "language": {
            url
        },
        columns: [ {
            'data':'UsuarioId'
            },
            {
                'data':'UsuarioNombre'
            },
            {
                'data':'UsuarioNombreCompleto'
            },
            {
                'data':'UsuarioCorreoElectronico'
            },
            {
                'data':'CajaNombre'
            },
            {
                'data':'Estado'
            },
            {
               'data':'acciones'     
            }
        ]
    },
     );
     // Fin de la tabla usuario 
     tableClientes = $('#tableClientes').DataTable( {
        ajax: {
            url: base_url + "Clientes/listar",
            dataSrc: ''
        },
        "language": {
            url
        },
        columns: [ {
            'data':'ClienteId'
            },
            {
                'data':'ClienteNumeroCedula'
            },
            {
                'data':'ClienteNombreCompleto'
            },
            {
                'data':'ClienteTelefono'
            },
            {
                'data':'CiudadNombre'
            },
            {
                'data':'ClienteDireccion'
            },
            {
                'data':'Estado'
            },
            {
               'data':'acciones'     
            }
        ]
    },
     );
     // Fin de la tabla cliente
     tableCajas = $('#tableCajas').DataTable( {
        ajax: {
            url: base_url + "Cajas/listar",
            dataSrc: ''
        },
        "language": {
            url
        },
        columns: [ {
            'data':'CajaId'
            },
            {
                'data':'CajaNombre'
            },
            {
               'data':'acciones'     
            }
        ]
    },
     );
     // Fin de la tabla Caja
     tableCategorias = $('#tableCategorias').DataTable( {
        ajax: {
            url: base_url + "Categorias/listar",
            dataSrc: ''
        },
        "language": {
            url
        },
        columns: [ {
            'data':'CategoriaId'
            },
            {
                'data':'CategoriaNombre'
            },
            {
               'data':'acciones'     
            }
        ]
    },
     );
    // Fin de la tabla Categoria
    tableMedidas = $('#tableMedidas').DataTable( {
        ajax: {
            url: base_url + "Medidas/listar",
            dataSrc: ''
        },
        "language": {
            url
        },
        columns: [ {
            'data':'MedidaId'
            },
            {
                'data':'MedidaNombre'
            },
            {
                'data':'MedidaPrefijo'
            },
            {
               'data':'acciones'     
            }
        ]
    },
     );
     //Fin de la tabla Medidas
     tableProveedores = $('#tableProveedores').DataTable( {
        ajax: {
            url: base_url + "Proveedores/listar",
            dataSrc: ''
        },
        "language": {
            url
          },
        columns: [ {
            'data':'ProveedorId'
            },
            {
                'data':'ProveedorNumeroCedula'
            },
            {
                'data':'ProveedorNombreCompleto'
            },
            {
                'data':'ProveedorTelefono'
            },
            {
                'data':'CiudadNombre'
            },
            {
                'data':'ProveedorDireccion'
            },
            {
                'data':'Estado'
            },
            {
               'data':'acciones'     
            }
        ]
    },
     );
     // Fin de la tabla proveedores
     //#region Tabla productos
     tableProductos = $('#tableProductos').DataTable( {
        ajax: {
            url: base_url + "Productos/listar",
            dataSrc: ''
        },
        "language": {
            url
        },
        columns: [ {
            'data':'ProductoId'
            },
            {
                'data':'ProductoDescripcion'
            },
            {
                'data':'ProductoCodigo'
            },
            {
                'data':'ProductoPrecioCompra',
                render: $.fn.dataTable.render.number(',', '.', 1, ''),
                targets: 4,
            },
            {
                'data':'ProductoCantidad'
            },
            {
                'data':'ProveedorNombreCompleto'
            },
            {
                'data':'Estado'
            },
            {
               'data':'acciones'     
            },
        ]
    },
     );
     //#endregion
})
//#endregion

//#region  Usuarios 
function formUsuario() {
    document.getElementById("title").innerHTML="Crear nuevo usuario";
    $('#buttonCrear').show();
    $('#buttonEditar').hide();
    document.getElementById("rowUsuarioClaves").classList.remove("d-none");
    document.getElementById("formUsuario").reset();
    document.getElementById("inputUsuarioId").value="";
    document.getElementById("inputUsuarioNombre").disabled=false;
    $("#crearModalUsuario").modal("show");
}

function registrarUsuario(e) {
    e.preventDefault();
    if (validarCampos()==false){
        const url=base_url+"Usuarios/registrar";
        const form=document.getElementById("formUsuario");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Ok") {
                    ModalMensajeSatisfactorio('Usuario registrado con éxito');
                      form.reset();
                      document.getElementById("formUsuario").reset();
                      tableUsuarios.ajax.reload();
                      $("#crearModalUsuario").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
        }
    }
}

function validarCampos(){
    const usuarioNombre=document.getElementById("inputUsuarioNombre");
    const usuarioNombreCompleto=document.getElementById("inputUsuarioNombreCompleto");
    const usuarioCorreoElectronico=document.getElementById("inputUsuarioCorreoElectronico");
    const usuarioClave=document.getElementById("inputUsuarioClave");
    const usuarioClaveConfirmacion=document.getElementById("inputUsuarioClaveConfirmar");
    const usuarioCaja=document.getElementById("selectCaja");
    $validar=false;
    if (usuarioNombre.value==""||usuarioNombreCompleto.value==""||usuarioCorreoElectronico.value==""||usuarioClave.value==""||usuarioCaja.value=="") {
        ModalMensajeError('Todos los campos son obligatorios.');
        $validar=true;
    }else if (usuarioClave.value!=usuarioClaveConfirmacion.value) {
        ModalMensajeError('Las contraseñas no coinciden.');
        $validar=true;
    }
    return $validar;
}

function editarUsuario(e) {
    e.preventDefault();
    const usuarioCorreoElectronico=document.getElementById("inputUsuarioCorreoElectronico");
    const usuarioClave=document.getElementById("inputUsuarioClave");
    const usuarioNombreCompleto=document.getElementById("inputUsuarioNombreCompleto");
    const usuarioClaveConfirmacion=document.getElementById("inputUsuarioClaveConfirmar");
    const usuarioCaja=document.getElementById("selectCaja");
    if (usuarioNombreCompleto.value==""||usuarioCorreoElectronico.value==""||usuarioCaja.value=="") {
        ModalMensajeError('Todos los campos son obligatorios.');
    }else if (usuarioClave.value!=usuarioClaveConfirmacion.value) {
        ModalMensajeError('Las contraseñas no coinciden.');
    }else{
        const url=base_url+"Usuarios/editarUsuario";
        const form=document.getElementById("formUsuario");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Modificado") {
                      ModalMensajeSatisfactorio('Usuario modificado con éxito');
                      form.reset();
                      document.getElementById("formUsuario").reset();
                      tableUsuarios.ajax.reload();
                      $("#crearModalUsuario").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
        }
    }
}

function  btnEditarUsuario(usuarioId) {
    document.getElementById("title").innerHTML="Actualizar usuario";
    $('#buttonCrear').hide();
    $('#buttonEditar').show();
        const url=base_url+"Usuarios/obtener/"+usuarioId;
        const http=new XMLHttpRequest();
        http.open("GET", url,true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                document.getElementById("inputUsuarioNombre").value = res.UsuarioNombre;
                document.getElementById("inputUsuarioNombreCompleto").value = res.UsuarioNombreCompleto;
                document.getElementById("inputUsuarioId").value = res.UsuarioId;
                document.getElementById("inputUsuarioCorreoElectronico").value = res.UsuarioCorreoElectronico;
                document.getElementById("selectCaja").value = res.CajaId;
                document.getElementById("rowUsuarioClaves").classList.add("d-none");
                document.getElementById("inputUsuarioNombre").disabled=true;
                $("#crearModalUsuario").modal("show");
            }
        }
}

function btnEliminarUsuario(usuarioId){
    Swal.fire({
        title: '¿Estás seguro de inactivar  el usuario?',
        text: "El usuario no se eliminará de forma permanente, solo cambiará el estado inactivo",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Inactivar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Usuarios/inactivarUsuario/"+usuarioId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    ModalMensajeInactivacion('El usuario se inactivo con éxito.');
                    tableUsuarios.ajax.reload();
                }else{
                    Swal.fire(
                        '¡Mensaje!',
                         res,
                        'Error'
                    )
                }
            }
            }
        }
      })
}

function btnActivarUsuario(usuarioId) {
    Swal.fire({
        title: '¿Estás seguro de activar  el usuario?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Activar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Usuarios/activarUsuario/"+usuarioId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    Swal.fire(
                        '¡Mensaje!',
                        'El usuario se ha activado con éxito.',
                        'success'
                    )
                    tableUsuarios.ajax.reload();
                }else{
                    Swal.fire(
                        '¡Mensaje!',
                         res,
                        'Error'
                    )
                }
            }
            }
        }
      })
}

//#endregion

//#region  Clientes
function formCliente() {
    document.getElementById("title").innerHTML="Crear nuevo cliente";
    $('#buttonCrear').show();
    $('#buttonEditar').hide();
    document.getElementById("inputClienteCedula").disabled=false;
    document.getElementById("formCliente").reset();
    document.getElementById("inputClienteId").value="";
    $("#crearModalCliente").modal("show");
}

function registrarCliente(e) {
    e.preventDefault();
    if (validarCamposCliente()==false){
        const url=base_url+"Clientes/registrar";
        const form=document.getElementById("formCliente");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Ok") {
                    ModalMensajeSatisfactorio('Cliente registrado con éxito');
                      form.reset();
                      document.getElementById("formCliente").reset();
                      tableClientes.ajax.reload();
                      $("#crearModalCliente").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
        }
    }
}

function validarCamposCliente(){
    const clienteCedula=document.getElementById("inputClienteCedula");
    const clienteNombreCompleto=document.getElementById("inputClienteNombreCompleto");
    const clienteTelefono=document.getElementById("inputClienteTelefono");
    const clienteDireccion=document.getElementById("inputClienteDireccion");
    const clienteCiudad=document.getElementById("selectCiudad");
    $validar=false;
    if (clienteCedula.value==""||clienteNombreCompleto.value==""|| clienteCiudad.value==""||clienteTelefono.value==""||clienteDireccion.value=="") {
        ModalMensajeError('Todos los campos son obligatorios.');
        $validar=true;
    }
    return $validar;
}

function editarCliente(e) {
    e.preventDefault();
    if (validarCamposCliente()==false){
        const url=base_url+"Clientes/editarCliente";
        const form=document.getElementById("formCliente");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Modificado") {
                      ModalMensajeSatisfactorio('Cliente modificado con éxito');
                      form.reset();
                      document.getElementById("formCliente").reset();
                      tableClientes.ajax.reload();
                      $("#crearModalCliente").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
        }
    }
}

function  btnEditarCliente(clienteId) {
    document.getElementById("title").innerHTML="Actualizar cliente";
    $('#buttonCrear').hide();
    $('#buttonEditar').show();
        const url=base_url+"Clientes/obtener/"+clienteId;
        const http=new XMLHttpRequest();
        http.open("GET", url,true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                document.getElementById("inputClienteNombreCompleto").value = res.ClienteNombreCompleto;
                document.getElementById("inputClienteTelefono").value = res.ClienteTelefono;
                document.getElementById("inputClienteId").value = res.ClienteId;
                document.getElementById("inputClienteCedula").value = res.ClienteNumeroCedula;
                document.getElementById("inputClienteDireccion").value = res.ClienteDireccion;
                document.getElementById("selectCiudad").value = res.CiudadId;
                document.getElementById("inputClienteCedula").disabled=true;
                $("#crearModalCliente").modal("show");
            }
        }
}

function btnInactivarCliente(clienteId){
    Swal.fire({
        title: '¿Estás seguro de inactivar  el cliente?',
        text: "El cliente no se eliminará de forma permanente, solo cambiará el estado inactivo",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Inactivar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Clientes/inactivarCliente/"+clienteId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    ModalMensajeInactivacion('El cliente se inactivo con éxito.');
                    tableClientes.ajax.reload();
                }else{
                    Swal.fire(
                        '¡Mensaje!',
                         res,
                        'Error'
                    )
                }
            }
            }
        }
      })
}

function btnActivarCliente(clienteId) {
    Swal.fire({
        title: '¿Estás seguro de activar  el cliente?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Activar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Clientes/activarCliente/"+clienteId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    Swal.fire(
                        '¡Mensaje!',
                        'El cliente se ha activado con éxito.',
                        'success'
                    )
                    tableClientes.ajax.reload();
                }else{
                    Swal.fire(
                        '¡Mensaje!',
                         res,
                        'Error'
                    )
                }
            }
            }
        }
      })
}

//#endregion

//#region  Cajas
function formCaja() {
    document.getElementById("title").innerHTML="Crear nueva caja";
    $('#buttonCrear').show();
    $('#buttonEditar').hide();
    document.getElementById("formCaja").reset();
    document.getElementById("inputCajaId").value="";
    $("#crearModalCajas").modal("show");
}

function registrarCajas(e) {
    e.preventDefault();
    if (validarCamposCaja()==false){
        const url=base_url+"Cajas/registrar";
        const form=document.getElementById("formCaja");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Ok") {
                      ModalMensajeSatisfactorio('Caja registrado con éxito');
                      form.reset();
                      document.getElementById("formCaja").reset();
                      tableCajas.ajax.reload();
                      $("#crearModalCajas").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
         }  
        }
}

function validarCamposCaja(){
    const cajaNombre =document.getElementById("inputCajaNombre");
    $validar=false;
    if (cajaNombre.value=="") {
        ModalMensajeError('Todos los campos son obligatorios.');
        $validar=true;
    }
    return $validar;
}

function editarCajas(e) {
    e.preventDefault();
    if (validarCamposCaja()==false){
        const url=base_url+"Cajas/editarCaja";
        const form=document.getElementById("formCaja");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Modificado") {
                     ModalMensajeSatisfactorio('Caja modificado con éxito');
                      form.reset();
                      document.getElementById("formCaja").reset();
                      tableCajas.ajax.reload();
                      $("#crearModalCajas").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
        }
    }
}

function  btnEditarCaja(cajaId) {
    document.getElementById("title").innerHTML="Actualizar caja";
    $('#buttonCrear').hide();
    $('#buttonEditar').show();
        const url=base_url+"Cajas/obtener/"+cajaId;
        const http=new XMLHttpRequest();
        http.open("GET", url,true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                document.getElementById("inputCajaId").value=res.CajaId;
                document.getElementById("inputCajaNombre").value = res.CajaNombre;
                $("#crearModalCajas").modal("show");
            }
        }
}

function btnEliminarCaja(cajaId){
    Swal.fire({
        title: '¿Estás seguro que desea  eliminar la caja?',
        text: "La caja  se eliminará de forma permanente",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Cajas/eliminarCaja/"+cajaId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    ModalMensajeInactivacion('La caja se eliminó con éxito.');
                    tableCajas.ajax.reload();
                }else{
                    Swal.fire(
                        '¡Mensaje!',
                         res,
                        'Error'
                    )
                }
            }
            }
        }
      })
}

//#endregion

//#region  Categorias
function formCategoria() {
    document.getElementById("title").innerHTML="Crear nueva categoría";
    $('#buttonCrear').show();
    $('#buttonEditar').hide();
    document.getElementById("formCategoria").reset();
    document.getElementById("inputCategoriaId").value="";
    $("#crearModalCategorias").modal("show");
}

function registrarCategorias(e) {
    e.preventDefault();
    if (validarCamposCategoria()==false){
        const url=base_url+"Categorias/registrar";
        const form=document.getElementById("formCategoria");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Ok") {
                      ModalMensajeSatisfactorio('Categoría registrado con éxito');
                      form.reset();
                      document.getElementById("formCategoria").reset();
                      tableCategorias.ajax.reload();
                      $("#crearModalCategorias").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
         }  
        }
}

function validarCamposCategoria(){
    const categoriaNombre =document.getElementById("inputCategoriaNombre");
    $validar=false;
    if (categoriaNombre.value=="") {
        ModalMensajeError('Todos los campos son obligatorios.');
        $validar=true;
    }
    return $validar;
}

function editarCategorias(e) {
    e.preventDefault();
    if (validarCamposCategoria()==false){
        const url=base_url+"Categorias/editarCategoria";
        const form=document.getElementById("formCategoria");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Modificado") {
                      ModalMensajeSatisfactorio('Categoría modificado con éxito');
                      form.reset();
                      document.getElementById("formCategoria").reset();
                      tableCategorias.ajax.reload();
                      $("#crearModalCategorias").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
        }
    }
}

function  btnEditarCategoria(categoriaId) {
    document.getElementById("title").innerHTML="Actualizar categoria";
    $('#buttonCrear').hide();
    $('#buttonEditar').show();
        const url=base_url+"Categorias/obtener/"+categoriaId;
        const http=new XMLHttpRequest();
        http.open("GET", url,true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                document.getElementById("inputCategoriaId").value=res.CategoriaId;
                document.getElementById("inputCategoriaNombre").value = res.CategoriaNombre;
                $("#crearModalCategorias").modal("show");
            }
        }
}

function btnEliminarCategoria(categoriaId){
    Swal.fire({
        title: '¿Estás seguro que desea  eliminar la categoría?',
        text: "La categoría  se eliminará de forma permanente",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Categorias/eliminarCategoria/"+categoriaId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    ModalMensajeInactivacion('La categoría se eliminó con éxito.');
                    tableCategorias.ajax.reload();
                }else{
                    Swal.fire(
                        '¡Mensaje!',
                         res,
                        'Error'
                    )
                }
            }
            }
        }
      })
}
//#endregion

//#region  Medidas
function formMedida() {
    document.getElementById("title").innerHTML="Crear nueva medida";
    $('#buttonCrear').show();
    $('#buttonEditar').hide();
    document.getElementById("formMedida").reset();
    document.getElementById("inputMedidaId").value="";
    $("#crearModalMedidas").modal("show");
}

function registrarMedidas(e) {
    e.preventDefault();
    if (validarCamposMedida()==false){
        const url=base_url+"Medidas/registrar";
        const form=document.getElementById("formMedida");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Ok") {
                      ModalMensajeSatisfactorio('Medida registrado con éxito');
                      form.reset();
                      document.getElementById("formMedida").reset();
                      tableMedidas.ajax.reload();
                      $("#crearModalMedidas").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
         }  
        }
}

function validarCamposMedida(){
    const medidaNombre =document.getElementById("inputMedidaNombre");
    const medidaPrefijo =document.getElementById("inputMedidaPrefijo");
    $validar=false;
    if (medidaNombre.value==""||medidaPrefijo.value=="") {
        ModalMensajeError('Todos los campos son obligatorios.');
        $validar=true;
    }
    return $validar;
}

function editarMedidas(e) {
    e.preventDefault();
    if (validarCamposMedida()==false) {{
        const url=base_url+"Medidas/editarMedida";
        const form=document.getElementById("formMedida");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Modificado") {
                      ModalMensajeSatisfactorio('Medida modificado con éxito');
                      form.reset();
                      document.getElementById("formMedida").reset();
                      tableMedidas.ajax.reload();
                      $("#crearModalMedidas").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
        }
    }
    }
}

function  btnEditarMedida(medidaId) {
    document.getElementById("title").innerHTML="Actualizar medida";
    $('#buttonCrear').hide();
    $('#buttonEditar').show();
        const url=base_url+"Medidas/obtener/"+medidaId;
        const http=new XMLHttpRequest();
        http.open("GET", url,true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                document.getElementById("inputMedidaId").value=res.MedidaId;
                document.getElementById("inputMedidaNombre").value = res.MedidaNombre;
                document.getElementById("inputMedidaPrefijo").value = res.MedidaPrefijo;
                $("#crearModalMedidas").modal("show");
            }
        }
}

function btnEliminarMedida(medidaId){
    Swal.fire({
        title: '¿Estás seguro que desea  eliminar la medida?',
        text: "La medida  se eliminará de forma permanente",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Medidas/eliminarMedida/"+medidaId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    ModalMensajeInactivacion('La medida se eliminó con éxito.');
                    tableMedidas.ajax.reload();
                }else{
                    ModalMensajeError(res);
                }
            }
            }
        }
      })
 }

//#endregion

//#region  Proveedores
function formProveedor() {
    document.getElementById("title").innerHTML="Crear nuevo proveedor";
    $('#buttonCrear').show();
    $('#buttonEditar').hide();
    document.getElementById("inputProveedorCedula").disabled=false;
    document.getElementById("formProveedor").reset();
    document.getElementById("inputProveedorId").value="";
    $("#crearModalProveedor").modal("show");
}
function registrarProveedor(e) {
    e.preventDefault();
    if (validarCamposProveedor()==false){
        const url=base_url+"Proveedores/registrar";
        const form=document.getElementById("formProveedor");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Ok") {
                      ModalMensajeSatisfactorio('Proveedor registrado con éxito');
                      form.reset();
                      document.getElementById("formProveedor").reset();
                      tableProveedores.ajax.reload();
                      $("#crearModalProveedor").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
        }
    }
}
function validarCamposProveedor(){
    const clienteCedula=document.getElementById("inputProveedorCedula");
    const clienteNombreCompleto=document.getElementById("inputProveedorNombreCompleto");
    const clienteTelefono=document.getElementById("inputProveedorTelefono");
    const clienteDireccion=document.getElementById("inputProveedorDireccion");
    const clienteCiudad=document.getElementById("selectCiudad");
    $validar=false;
    if (clienteCedula.value==""||clienteNombreCompleto.value==""|| clienteCiudad.value==""||clienteTelefono.value==""||clienteDireccion.value=="") {
        ModalMensajeError('Todos los campos son obligatorios.');
        $validar=true;
    }
    return $validar;
}
function editarProveedor(e) {
    e.preventDefault();
    if (validarCamposProveedor()==false){
        const url=base_url+"Proveedores/editarProveedor";
        const form=document.getElementById("formProveedor");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Modificado") {
                      ModalMensajeSatisfactorio('Proveedor modificado con éxito');
                      form.reset();
                      document.getElementById("formProveedor").reset();
                      tableProveedores.ajax.reload();
                      $("#crearModalProveedor").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
        }
    }
}
function  btnEditarProveedor(proveedorId) {
    document.getElementById("title").innerHTML="Actualizar proveedor";
    $('#buttonCrear').hide();
    $('#buttonEditar').show();
        const url=base_url+"Proveedores/obtener/"+proveedorId;
        const http=new XMLHttpRequest();
        http.open("GET", url,true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                document.getElementById("inputProveedorNombreCompleto").value = res.ProveedorNombreCompleto;
                document.getElementById("inputProveedorTelefono").value = res.ProveedorTelefono;
                document.getElementById("inputProveedorId").value = res.ProveedorId;
                document.getElementById("inputProveedorCedula").value = res.ProveedorNumeroCedula;
                document.getElementById("inputProveedorDireccion").value = res.ProveedorDireccion;
                document.getElementById("selectCiudad").value = res.CiudadId;
                document.getElementById("inputProveedorCedula").disabled=true;
                $("#crearModalProveedor").modal("show");
            }
        }
}
function btnInactivarProveedor(proveedorId){
    Swal.fire({
        title: '¿Estás seguro de inactivar  el proveedor?',
        text: "El proveedor no se eliminará de forma permanente, solo cambiará el estado inactivo",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Inactivar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Proveedores/inactivarProveedor/"+proveedorId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    ModalMensajeInactivacion('El proveedor se inactivo con éxito.');
                    tableProveedores.ajax.reload();
                }else{
                    Swal.fire(
                        '¡Mensaje!',
                         res,
                        'Error'
                    )
                }
            }
            }
        }
      })
}
function btnActivarProveedor(proveedorId) {
    Swal.fire({
        title: '¿Estás seguro de activar  el proveedor?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Activar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Proveedores/activarProveedor/"+proveedorId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    Swal.fire(
                        '¡Mensaje!',
                        'El proveedor se ha activado con éxito.',
                        'success'
                    )
                    tableProveedores.ajax.reload();
                }else{
                    Swal.fire(
                        '¡Mensaje!',
                         res,
                        'Error'
                    )
                }
            }
            }
        }
      })
}
//#endregion

//#region  Productos 

function formProducto() {
    document.getElementById("title").innerHTML="Crear nuevo producto";
    $('#buttonCrear').show();
    $('#buttonEditar').hide();
    document.getElementById("formProducto").reset();
    document.getElementById("inputProductoId").value="";
    $("#crearModalProducto").modal("show");
}
function registrarProducto(e) {
    e.preventDefault();
    if (validarCamposProducto()==false){
        const url=base_url+"Productos/registrar";
        const form=document.getElementById("formProducto");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res=JSON.parse(this.responseText); 
                if (res=="Ok") {
                      ModalMensajeSatisfactorio('Producto registrado con éxito');
                      form.reset();
                      document.getElementById("formProducto").reset();
                      tableProductos.ajax.reload();
                      $("#crearModalProducto").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
         }  
        }
}
function validarCamposProducto(){
    const productoNombre =document.getElementById("inputProductoNombre");
    const productoCodigo =document.getElementById("inputProductoCodigo");
    const productoPrecioCompra =document.getElementById("inputProductoPrecioCompra");
    const productoPrecioVenta =document.getElementById("inputProductoPrecioVenta");
    const productoCantidad =document.getElementById("inputProductoCantidad");

    $validar=false;
    if (productoNombre.value==""||productoCodigo.value==""||productoPrecioCompra.value==""||productoPrecioVenta.value==""||productoCantidad.value=="") {
        ModalMensajeError('Todos los campos son obligatorios.');
        $validar=true;
    }
    return $validar;
}
function  btnEditarProducto(productoId) {
    document.getElementById("title").innerHTML="Actualizar Producto";
    $('#buttonCrear').hide();
    $('#buttonEditar').show();
        const url=base_url+"Productos/obtener/"+productoId;
        const http=new XMLHttpRequest();
        http.open("GET", url,true);
        http.send();
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                document.getElementById("inputProductoNombre").value=res.ProductoDescripcion;
                document.getElementById("inputProductoId").value=res.ProductoId;
                document.getElementById("inputProductoCodigo").value=res.ProductoCodigo;
                document.getElementById("inputProductoPrecioCompra").value=res.ProductoPrecioCompra;
                document.getElementById("inputProductoPrecioVenta").value=res.ProductoPrecioVenta;
                document.getElementById("inputProductoCantidad").value=res.ProductoCantidad;
                document.getElementById("selectCategoria").value=res.CategoriaId;
                document.getElementById("selectMedida").value=res.MedidaId;
                document.getElementById("selectProveedor").value=res.ProveedorId;
                $("#crearModalProducto").modal("show");

            }
        }
}
function btnInactivarProducto(productoId){
    Swal.fire({
        title: '¿Estás seguro de eliminar  el producto?',
        text: "El producto no se eliminará de forma permanente, solo cambiará el estado inactivo",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Inactivar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Productos/inactivarProducto/"+productoId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    ModalMensajeInactivacion('El producto se inactivo con éxito.');
                    tableProductos.ajax.reload();
                }else{
                    Swal.fire(
                        '¡Mensaje!',
                         res,
                        'Error'
                    )
                }
            }
            }
        }
      })
}
function btnActivarProducto(productoId) {
    Swal.fire({
        title: '¿Estás seguro de restaurar  el producto?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        confirmButtonColor: '#218838',
        confirmButtonText: 'Activar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
            const url=base_url+"Productos/activarProducto/"+productoId;
            const http=new XMLHttpRequest();
            http.open("GET", url,true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const res=JSON.parse(this.responseText); 
                    if(res=="Ok"){
                    Swal.fire(
                        '¡Mensaje!',
                        'El producto se ha reingresado con éxito.',
                        'success'
                    )
                    tableProductos.ajax.reload();
                }else{
                    Swal.fire(
                        '¡Mensaje!',
                         res,
                        'Error'
                    )
                }
            }
            }
        }
      })
}
function editarProducto(e) {
    e.preventDefault();
    if (validarCamposProducto()==false){
        const url=base_url+"Productos/editarProducto";
        const form=document.getElementById("formProducto");
        const http=new XMLHttpRequest();
        http.open("POST", url,true);
        http.send(new FormData(form));
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res=JSON.parse(this.responseText); 
                if (res=="Modificado") {
                      ModalMensajeSatisfactorio('Producto modificado con éxito');
                      form.reset();
                      document.getElementById("formProducto").reset();
                      tableProductos.ajax.reload();
                      $("#crearModalProducto").modal("hide");
                 }else{
                    ModalMensajeError(res);
                 }
                 
            }
        }
    }
}
//#endregion