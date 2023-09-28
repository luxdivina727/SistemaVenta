<?php
class Usuarios extends Controller{
    public function __construct()
    {
        session_start();

        parent::__construct();
    }
    public function index()
    {
        if (empty($_SESSION['activo'])) {
            header("location:".base_url);
        }
        $data['cajas'] = $this->model->getCajas();
         $this->views->getView($this,"index",$data);

    }
    public function listar()
    {
        $data=$this->model->getUsuarios();
        for ($i=0; $i <count($data) ; $i++) { 
            if ($data[$i]['Estado']== 1) {
                $data[$i]['Estado']= '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] ='<div>
                <button class="btn btn-warning btn-sm text-white btn-circle" type="button" title="Editar" onclick="btnEditarUsuario('.$data[$i]['UsuarioId'].');"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-sm btn-circle" type="button" title="Inactivar" onclick="btnEliminarUsuario('.$data[$i]['UsuarioId'].');"><i class="fa fa-ban" aria-hidden="true"></i></button>
                </div>';
            }else{
                $data[$i]['Estado']= '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] ='<div>
                            <button class="btn btn-success btn-sm btn-circle" type="button" title="Activar" onclick="btnActivarUsuario('.$data[$i]['UsuarioId'].');"><i class="fas fa-check-circle" aria-hidden="true"></i></button>
                    </div>';
            }
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function validar()
    {
        if (empty($_POST['inputUsuario']) || empty($_POST['inputClave'])) {
            $mensaje="Los campos están vacios";
        }else {
            $usuario = $_POST['inputUsuario'];
            $clave = $_POST['inputClave'];
            $hash = hash("SHA256",$clave);
            $data =  $this->model->getUsuario($usuario,$hash); 
            if ($data) {
                $_SESSION['usuarioId']                  =$data['UsuarioId'];
                $_SESSION['usuarioNombre']              =$data['UsuarioNombre'];
                $_SESSION['usuarioCorreoElectronico']   =$data['UsuarioCorreoElectronico'];
                $_SESSION['activo']=true;
                $mensaje="ok";
            }else {
                $mensaje="Usuario o contraseña incorrecta";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
       $usuarioNombre                   = $_POST['inputUsuarioNombre'];
       $usuarioCorreoElectronico        = $_POST['inputUsuarioCorreoElectronico'];
       $usuarioNombreCompleto           = $_POST['inputUsuarioNombreCompleto'];
       $usuarioClave                    = $_POST['inputUsuarioClave'];
       $usuarioClaveConfirmar           = $_POST['inputUsuarioClaveConfirmar'];
       $cajaId                          = $_POST['selectCaja'];
       $hash                            = hash("SHA256",$usuarioClave);
        if(empty($usuarioNombre) || empty($usuarioNombreCompleto)|| empty($usuarioCorreoElectronico) || empty($usuarioClave) || empty($cajaId)){
            $mensaje="Todos los campos son obligatorios";
        }elseif ($usuarioClave!=$usuarioClaveConfirmar) {
            $msg="Las contraseñas no coinciden";
        }else {
            $data = $this->model->registrarUsuario($usuarioNombre,$usuarioNombreCompleto,$usuarioCorreoElectronico,$hash,$cajaId);
            if ($data == "Ok") {
                $mensaje = "Ok";
            }else if($data == "Existe"){
                $mensaje = "El nombre de usuario existe en el sistema";
            }else {
                $mensaje="Error al registrar el usuario";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function editarUsuario(){
        $usuarioCorreoElectronico       = $_POST['inputUsuarioCorreoElectronico'];
        $usuarioId                      = $_POST['inputUsuarioId'];
        $usuarioNombreCompleto          = $_POST['inputUsuarioNombreCompleto'];
        $cajaId                         = $_POST['selectCaja'];
        if( empty($usuarioCorreoElectronico) || empty($cajaId)){
            $mensaje="Todos los campos son obligatorios";
        }elseif($usuarioId!=""){
            $data = $this->model->editarUsuario($usuarioCorreoElectronico,$usuarioNombreCompleto,$usuarioId,$cajaId);
            if ($data == "Modificado") {
                $mensaje = "Modificado";
            }else {
                $mensaje="Error al modificar el usuario";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function obtener(int $usuarioId)
    {
        $data = $this->model->obtenerUsuario($usuarioId);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function obtenerUsuarioPorNombre(string $usuarioNombre){
        $data = $this->model->obtenerUsuarioPorNombre($usuarioNombre);
        if ($data==0) {
            $mensaje="0";
        }else{
            $mensaje="1";
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function inactivarUsuario(int $usuarioId)
    {
        $data = $this->model->inactivarUsuario($usuarioId);
        if ($data==1) {
            $mensaje="Ok";
        }else{
            $mensaje="Error al inactiva el usuario";
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function activarUsuario(int $usuarioId)
    {
        $data = $this->model->activarUsuario($usuarioId);
        if ($data==1) {
            $mensaje="Ok";
        }else{
            $mensaje="Error al activar el usuario";
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();
    }
     public function salir()
    {
        session_destroy();
        header("location:".base_url);
    }
}
?>
