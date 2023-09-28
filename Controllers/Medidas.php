<?php
class Medidas extends Controller{
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
        $data=$this->model->getMedidas();
        for ($i=0; $i <count($data) ; $i++) {
            if($this->model->getValidacionMedidas($data[$i]['MedidaId']) == true){
                $data[$i]['acciones'] ='<div>
                <button class="btn btn-warning btn-sm text-white btn-circle" type="button" title="Editar" onclick="btnEditarMedida('.$data[$i]['MedidaId'].');"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-sm btn-circle" type="button" title="Eliminar" onclick="btnEliminarMedida('.$data[$i]['MedidaId'].');"><i class="fas fa-trash" aria-hidden="true"></i></button>
                </div>';
            }else{
                $data[$i]['acciones'] ='<div>
                <button class="btn btn-warning btn-sm text-white btn-circle" type="button" title="Editar" onclick="btnEditarMedida('.$data[$i]['MedidaId'].');"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                </div>';
            }
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
       $medidaNombre    = $_POST['inputMedidaNombre'];
       $medidaPrefijo   = $_POST['inputMedidaPrefijo'];
        if(empty($medidaNombre)||empty($medidaPrefijo)){
            $mensaje="Todos los campos son obligatorios";
        }else {
            $data = $this->model->registrarMedida($medidaNombre,$medidaPrefijo);
            if ($data == "Ok") {
                $mensaje = "Ok";
            }elseif($data =="Existe") {
                $mensaje="El prefijo de la medida  existe en el sistema";
            }else{

                $mensaje="Error al registrar la categoría";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function editarMedida(){
        $medidaNombre   = $_POST['inputMedidaNombre'];
        $medidaId       = $_POST['inputMedidaId'];
        $medidaPrefijo  = $_POST['inputMedidaPrefijo'];
        if( empty($medidaNombre)){
            $mensaje="Todos los campos son obligatorios";
        }elseif($medidaId!=""){
            $data = $this->model->editarMedida($medidaNombre,$medidaPrefijo,$medidaId);
            if ($data == "Modificado") {
                $mensaje = "Modificado";
            }else {
                $mensaje="Error al modificar la medida";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function obtener(int $medidaId)
    {
        $data = $this->model->obtenerMedida($medidaId);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function eliminarMedida(int $medidaId)
    {
        $data = $this->model->eliminarMedida($medidaId);
        if ($data=="Eliminado") {
            $mensaje="Ok";
        }else{
            $mensaje="Error eliminar la medida";
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