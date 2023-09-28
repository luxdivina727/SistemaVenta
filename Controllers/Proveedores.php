<?php
class Proveedores extends Controller{
    public function __construct(){
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
        $data=$this->model->getProveedores();
        for ($i=0; $i <count($data) ; $i++) { 
            if ($data[$i]['Estado']== 1) {
                $data[$i]['Estado']= '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] ='<div>
                                        <button class="btn btn-warning btn-sm text-white btn-circle" type="button" title="Editar" onclick="btnEditarProveedor('.$data[$i]['ProveedorId'].');"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger btn-sm btn-circle" type="button" title="Inactivar" onclick="btnInactivarProveedor('.$data[$i]['ProveedorId'].');"><i class="fa fa-ban" aria-hidden="true"></i></button>
                                        </div>';
            }else{
                $data[$i]['Estado']= '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] ='<div>
                <button class="btn btn-success btn-sm btn-circle" type="button" title="Activar" onclick="btnActivarProveedor('.$data[$i]['ProveedorId'].');"><i class="fas fa-check-circle" aria-hidden="true"></i></button>
                </div>';
            }
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
       $proveedorCedula                 = $_POST['inputProveedorCedula'];
       $proveedorNombreCompleto         = $_POST['inputProveedorNombreCompleto'];
       $proveedorTelefono               = $_POST['inputProveedorTelefono'];
       $proveedorDireccion              = $_POST['inputProveedorDireccion'];
       $proveedorCiudad                 = $_POST['selectCiudad'];
        if(empty($proveedorCedula) || empty($proveedorNombreCompleto)|| empty($proveedorTelefono) || empty($proveedorDireccion)){
            $mensaje="Todos los campos son obligatorios";
        }else {
            $data = $this->model->registrarProveedor($proveedorCedula,$proveedorNombreCompleto,$proveedorTelefono,$proveedorDireccion,$proveedorCiudad);
            if ($data == "Ok") {
                $mensaje = "Ok";
            }else if($data == "Existe"){
                $mensaje = "La cédula se encuentra registrada en el sistema";
            }else {
                $mensaje="Error al registrar el proveedor";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function editarProveedor(){
        $proveedorNombreCompleto        = $_POST['inputProveedorNombreCompleto'];
        $proveedorId                    = $_POST['inputProveedorId'];
        $proveedorTelefono              = $_POST['inputProveedorTelefono'];
        $proveedorDireccion             = $_POST['inputProveedorDireccion'];
        $ciudadId                       = $_POST['selectCiudad'];
        if( empty($proveedorNombreCompleto) || empty($proveedorTelefono) || empty($proveedorDireccion)){
            $mensaje="Todos los campos son obligatorios";
        }elseif($proveedorId!=""){
            $data = $this->model->editarProveedor($proveedorNombreCompleto,$proveedorTelefono,$proveedorId,$ciudadId,$proveedorDireccion);
            if ($data == "Modificado") {
                $mensaje = "Modificado";
            }else {
                $mensaje="Error al modificar el proveedor";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function obtener(int $proveedorId)
    {
        $data = $this->model->obtenerProveedor($proveedorId);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function inactivarProveedor(int $proveedorId)
    {
        $data = $this->model->inactivarProveedor($proveedorId);
        if ($data==1) {
            $mensaje="Ok";
        }else{
            $mensaje="Error al inactiva el proveedor";
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function activarProveedor(int $proveedorId)
    {
        $data = $this->model->activarProveedor($proveedorId);
        if ($data==1) {
            $mensaje="Ok";
        }else{
            $mensaje="Error al activar el proveedor";
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