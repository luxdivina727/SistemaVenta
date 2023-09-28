<?php
class Productos extends Controller{
    public function __construct()
    {
        session_start();

        parent::__construct();
    }
    public function index()
    {
        $data['proveedores']    = $this->model->getProveedores();
        $data['categorias']     = $this->model->getCategorias();
        $data['medidas']        = $this->model->getMedidas();
        $this->views->getView($this,"index",$data);
    }
    public function listar()
    {
        $data=$this->model->getProductos();
        for ($i=0; $i <count($data) ; $i++) {
            if ($data[$i]['Estado']== 1) {
                $data[$i]['Estado']= '<span class="badge badge-success">Activo</span>';
                $data[$i]['acciones'] ='<div>
                                        <button class="btn btn-warning btn-sm text-white btn-circle" type="button" title="Editar" onclick="btnEditarProducto('.$data[$i]['ProductoId'].');"><i class="fas fa-pencil-alt" aria-hidden="true"></i></button>
                                        <button class="btn btn-danger btn-sm btn-circle" type="button" title="Eliminar" onclick="btnInactivarProducto('.$data[$i]['ProductoId'].');"><i class="fas fa-trash" aria-hidden="true"></i></button>
                                        </div>';
            }else{
                $data[$i]['Estado']= '<span class="badge badge-danger">Inactivo</span>';
                $data[$i]['acciones'] ='<div>
                <button class="btn btn-success btn-sm btn-circle" type="button" title="Activar" onclick="btnActivarProducto('.$data[$i]['ProductoId'].');"><i class="fas fa-check-circle" aria-hidden="true"></i></button>
                </div>';
            }

        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function inactivarProducto(int $productoId)
    {
        $data = $this->model->inactivarProducto($productoId);
        if ($data==1) {
            $mensaje="Ok";
        }else{
            $mensaje="Error al inactiva el producto";
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();
    }
    public function activarProducto(int $productoId)
    {
        $data = $this->model->activarProducto($productoId);
        if ($data==1) {
            $mensaje="Ok";
        }else{
            $mensaje="Error al activar el producto";
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();
    }
    
    public function editarProducto(){
        $productoNombre             = $_POST['inputProductoNombre'];
        $productoCodigo             = $_POST['inputProductoCodigo'];
        $productoPrecioCompra       = $_POST['inputProductoPrecioCompra'];
        $productoPrecioVenta        = $_POST['inputProductoPrecioVenta'];
        $productoCantidad           = $_POST['inputProductoCantidad'];
        $categoriaId                = $_POST['selectCategoria'];
        $medidaId                   = $_POST['selectMedida'];
        $productoId                 = $_POST['inputProductoId'];
        $proveedorId                = $_POST['selectProveedor'];
        if( empty($productoId) || empty($productoNombre) || empty($productoCodigo) || empty($productoPrecioCompra)|| empty($productoPrecioVenta) || empty($productoCantidad)|| empty($categoriaId) || empty($medidaId)| empty($proveedorId)){
            $mensaje="Todos los campos son obligatorios";
        }elseif($productoId!=""){
            $data = $this->model->editarProducto($productoId,$productoNombre,$productoCodigo,$productoPrecioCompra,$productoPrecioVenta,$productoCantidad,$categoriaId,$medidaId,$proveedorId);
            if ($data == "Modificado") {
                $mensaje = "Modificado";
            }else {
                $mensaje="Error al modificar el producto";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
    public function obtener(int $productoId)
    {
        $data = $this->model->obtenerProducto($productoId);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
        die(); 
    }
    public function registrar()
    {
       $productoNombre              = $_POST['inputProductoNombre'];
       $productoCodigo              = $_POST['inputProductoCodigo'];
       $productoPrecioCompra        = $_POST['inputProductoPrecioCompra'];
       $productoPrecioVenta         = $_POST['inputProductoPrecioVenta'];
       $productoCantidad            = $_POST['inputProductoCantidad'];
       $categoriaId                 = $_POST['selectCategoria'];
       $medidaId                    = $_POST['selectMedida'];
       $proveedorId                 = $_POST['selectProveedor'];

        if(empty($productoNombre) || empty($productoCantidad)|| empty($productoCodigo)|| empty($productoPrecioCompra) || empty($productoPrecioVenta) || empty($categoriaId) || empty($medidaId)|| empty($proveedorId)){
            $mensaje="Todos los campos son obligatorios";
        }else {
            $data = $this->model->registrarProductos($productoNombre,$productoCodigo,$productoCantidad,$productoPrecioCompra,$productoPrecioVenta,$categoriaId,$medidaId,$proveedorId);
            if ($data == "Ok") {
                $mensaje = "Ok";
            }else if($data == "Existe"){
                $mensaje = "El nombre de producto existe en el sistema";
            }else {
                $mensaje="Error al registrar el producto";
            }
        }
        echo json_encode($mensaje,JSON_UNESCAPED_UNICODE);
        die();  
    }
}
?>