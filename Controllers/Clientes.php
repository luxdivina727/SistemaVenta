<?php
class Clientes extends Controller{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location:".base_url);
        }
        parent::__construct();
    }
    public function index()
    {
         $data['ciudades'] = $this->model->getCiudades();
         $this->views->getView($this,"index",$data);

    }
    public function listar()
    {
        $data=$this->model->getClientes();
        for ($i=0; $i <count($data) ; $i++) { 
            if ($data[$i]['Estado']== 1) {
                $data[$i]['Estado']= '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] ='<div>
                                        <button class="btn btn-warning btn-sm text-white btn-circle" type="button" title="Editar" onclick="btnEditarCliente('.$data[$i]['ClienteId'].');"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger btn-sm btn-circle" type="button" title="Inactivar" onclick="btnInactivarCliente('.$data[$i]['ClienteId'].');"><i class="fa fa-ban" aria-hidden="true"></i></button>
                                        </div>';
            }else{
                $data[$i]['Estado']= '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] ='<div>
                <button class="btn btn-success btn-sm btn-circle" type="button" title="Activar" onclick="btnActivarCliente('.$data[$i]['ClienteId'].');"><i class="fas fa-check-circle" aria-hidden="true"></i></button>
                </div>';
            }
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
       $clienteCedula           = $_POST['inputClienteCedula'];
       $clienteNombreCompleto   = $_POST['inputClienteNombreCompleto'];
       $clienteTelefono         = $_POST['inputClienteTelefono'];
       $clienteDireccion        = $_POST['inputClienteDireccion'];
       $clienteCiudad           = $_POST['selectCiudad'];
        if(empty($clienteCedula) || empty($clienteNombreCompleto)|| empty($clienteTelefono) || empty($clienteDireccion)){
            $mensaje="Todos los campos son obligatorios";
        }else {
            $data = $this->model->registrarCliente($clienteCedula,$clienteNombreCompleto,$clienteTelefono,$clienteDireccion,$clienteCiudad);
            if ($data == "Ok") {
                $mensaje = "Ok";
            }else if($data == "Existe"){
                $mensaje = "La cédula se encuentra registrada en el sistema";
            }else {
                $mensaje="Error al registrar el cliente";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function editarCliente(){
        $clienteNombreCompleto      = $_POST['inputClienteNombreCompleto'];
        $clienteId                  = $_POST['inputClienteId'];
        $clienteTelefono            = $_POST['inputClienteTelefono'];
        $clienteDireccion           = $_POST['inputClienteDireccion'];
        $ciudadId                   = $_POST['selectCiudad'];
        if( empty($clienteNombreCompleto) || empty($clienteTelefono) || empty($clienteDireccion)){
            $mensaje="Todos los campos son obligatorios";
        }elseif($clienteId!=""){
            $data = $this->model->editarCliente($clienteNombreCompleto,$clienteTelefono,$clienteId,$ciudadId,$clienteDireccion);
            if ($data == "Modificado") {
                $mensaje = "Modificado";
            }else {
                $mensaje="Error al modificar el cliente";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function obtener(int $clienteId)
    {
        $data = $this->model->obtenerCliente($clienteId);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function obtenerClientePorCedula(int $clienteCedula){
        $data = $this->model->obtenerClientePorCedula($clienteCedula);
        if ($data==0) {
            $mensaje="0";
        }else{
            $mensaje="1";
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function inactivarCliente(int $clienteId)
    {
        $data = $this->model->inactivarCliente($clienteId);
        if ($data==1) {
            $mensaje="Ok";
        }else{
            $mensaje="Error al inactiva el cliente";
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function activarCliente(int $clienteId)
    {
        $data = $this->model->activarCliente($clienteId);
        if ($data==1) {
            $mensaje="Ok";
        }else{
            $mensaje="Error al activar el cliente";
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
