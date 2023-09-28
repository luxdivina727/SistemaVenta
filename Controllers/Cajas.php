<?php
class Cajas extends Controller{
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
         $this->views->getView($this,"index");
    }
    public function listar()
    {
        $data=$this->model->getCajas();
        for ($i=0; $i <count($data) ; $i++) {
            if($this->model->getValidacionUsuarios($data[$i]['CajaId']) == false){
                $data[$i]['acciones'] ='<div>
                <button class="btn btn-warning btn-sm text-white btn-circle" type="button" title="Editar" onclick="btnEditarCaja('.$data[$i]['CajaId'].');"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                </div>';
            }else{
                $data[$i]['acciones'] ='<div>
                <button class="btn btn-warning btn-sm text-white btn-circle" type="button" title="Editar" onclick="btnEditarCaja('.$data[$i]['CajaId'].');"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-sm btn-circle" type="button" title="Eliminar" onclick="btnEliminarCaja('.$data[$i]['CajaId'].');"><i class="fas fa-trash" aria-hidden="true"></i></button>
                </div>';
            }
           
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
       $cajaNombre = $_POST['inputCajaNombre'];
        if(empty($cajaNombre)){
            $mensaje="Todos los campos son obligatorios";
        }else {
            $data = $this->model->registrarCaja($cajaNombre);
            if ($data == "Ok") {
                $mensaje = "Ok";
            }elseif($data =="Existe") {
                $mensaje="El nombre de la caja  existe en el sistema";
            }else{

                $mensaje="Error al registrar la caja";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function editarCaja(){
        $cajaNombre     = $_POST['inputCajaNombre'];
        $cajaId         = $_POST['inputCajaId'];
        if( empty($cajaNombre)){
            $mensaje="Todos los campos son obligatorios";
        }elseif($cajaId!=""){
            $data = $this->model->editarCaja($cajaNombre,$cajaId);
            if ($data == "Modificado") {
                $mensaje = "Modificado";
            }else {
                $mensaje="Error al modificar el usuario";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function obtener(int $cajaId)
    {
        $data = $this->model->obtenerCaja($cajaId);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function obtenerCajaPorNombre(string $cajaNombre){
        $data = $this->model->obtenerCajaPorNombre($cajaNombre);
        if ($data==0) {
            $mensaje="0";
        }else{
            $mensaje="1";
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function eliminarCaja(int $cajaId)
    {
        $data = $this->model->eliminarCaja($cajaId);
        if ($data=="Eliminado") {
            $mensaje="Ok";
        }else{
            $mensaje="Error eliminar la caja";
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
