<?php
class Categorias extends Controller{
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
        $data=$this->model->getCategorias();
        for ($i=0; $i <count($data) ; $i++) {
            if($this->model->getValidacionCategorias($data[$i]['CategoriaId']) == true){
                $data[$i]['acciones'] ='<div>
                <button class="btn btn-warning btn-sm text-white btn-circle" type="button" title="Editar" onclick="btnEditarCategoria('.$data[$i]['CategoriaId'].');"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                <button class="btn btn-danger btn-sm btn-circle" type="button" title="Eliminar" onclick="btnEliminarCategoria('.$data[$i]['CategoriaId'].');"><i class="fas fa-trash" aria-hidden="true"></i></button>
                </div>';
            }else{
                $data[$i]['acciones'] ='<div>
                <button class="btn btn-warning btn-sm text-white btn-circle" type="button" title="Editar" onclick="btnEditarCategoria('.$data[$i]['CategoriaId'].');"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                </div>';
            }
           
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function registrar()
    {
       $categoriaNombre = $_POST['inputCategoriaNombre'];
        if(empty($categoriaNombre)){
            $mensaje="Todos los campos son obligatorios";
        }else {
            $data = $this->model->registrarCategoria($categoriaNombre);
            if ($data == "Ok") {
                $mensaje = "Ok";
            }elseif($data =="Existe") {
                $mensaje="El nombre de la categoría  existe en el sistema";
            }else{

                $mensaje="Error al registrar la categoría";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function editarCategoria(){
        $categoriaNombre = $_POST['inputCategoriaNombre'];
        $categoriaId = $_POST['inputCategoriaId'];
        if( empty($categoriaNombre)){
            $mensaje="Todos los campos son obligatorios";
        }elseif($categoriaId!=""){
            $data = $this->model->editarCategoria($categoriaNombre,$categoriaId);
            if ($data == "Modificado") {
                $mensaje = "Modificado";
            }else {
                $mensaje="Error al modificar la categoría";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function obtener(int $categoriaId)
    {
        $data = $this->model->obtenerCategoria($categoriaId);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function eliminarCategoria(int $categoriaId)
    {
        $data = $this->model->eliminarCategoria($categoriaId);
        if ($data=="Eliminado") {
            $mensaje="Ok";
        }else{
            $mensaje="Error eliminar la categoría";
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