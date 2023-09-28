<?php
class ProductosModel extends Query{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function getProveedores()
    {
        $sql="SELECT * FROM proveedores";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function getCategorias()
    {
        $sql="SELECT * FROM categorias";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function getMedidas()
    {
        $sql="SELECT * FROM medidas";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function getProductos()
    {
        $sql="SELECT pro.*,p.ProveedorId,p.ProveedorNombreCompleto  FROM productos pro INNER JOIN proveedores p where pro.ProveedorId=p.ProveedorId";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function obtenerProducto(int $productoId)
    {
        $sql="SELECT * FROM productos WHERE ProductoId='$productoId'";
        $data = $this->select($sql);
        return $data;
    }
    public function inactivarProducto(int $productoId)
    {
        $this->productoId=$productoId;
        $sql = "UPDATE  productos SET Estado= 0  WHERE ProductoId = ?";
        $datos = array($this->productoId);
        $data = $this->save($sql,$datos);
        return $data;
    }
    public function activarProducto(int $productoId)
    {
        $this->productoId=$productoId;
        $sql = "UPDATE  productos SET Estado= 1  WHERE ProductoId = ?";
        $datos = array($this->productoId);
        $data = $this->save($sql,$datos);
        return $data;
    }
    public function editarProducto(int $productoId,string $productoNombre,string $productoCodigo,int $productoCantidad, float $productoPrecioCompra,float $productoPrecioVenta,int $categoriaId,int $medidaId,int $proveedorId)
    {
        $this->productoId=$productoId;
        $this->productoNombre=$productoNombre;
        $this->productoCodigo=$productoCodigo;
        $this->productoPrecioCompra=$productoPrecioCompra;
        $this->productoPrecioVenta=$productoPrecioVenta;
        $this->medidaId=$medidaId;
        $this->categoriaId=$categoriaId;
        $this->proveedorId=$proveedorId;
        $this->productoCantidad=$productoCantidad;
        $sql = "UPDATE  Productos SET ProductoDescripcion=?,ProductoCodigo=?,ProductoPrecioCompra=?,ProductoPrecioVenta=?,ProductoCantidad=?,MedidaId=?,CategoriaId=?,ProveedorId=? WHERE ProductoId=?";
        $datos = array($this->productoNombre,$this->productoCodigo,$this->productoPrecioCompra,$this->productoPrecioVenta,$this->productoCantidad,$this->medidaId,$this->categoriaId,$this->proveedorId,$this->productoId);
        $data = $this->save($sql,$datos);
            if ($data == 1) {
                $res = "Modificado";
            }else {
                $res = "Error";
            }
            return $res;
    }
    public function registrarProductos(string $productoNombre,string $productoCodigo,int $productoCantidad, float $productoPrecioCompra,float $productoPrecioVenta,int $categoriaId,int $medidaId,int $proveedorId)
    {
        $this->productoNombre=$productoNombre;
        $this->productoCodigo=$productoCodigo;
        $this->productoPrecioCompra=$productoPrecioCompra;
        $this->productoPrecioVenta=$productoPrecioVenta;
        $this->medidaId=$medidaId;
        $this->categoriaId=$categoriaId;
        $this->proveedorId=$proveedorId;
        $this->productoCantidad=$productoCantidad;
        $verificar = "SELECT * FROM Productos WHERE ProductoCodigo = '$productoCodigo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO Productos(ProductoDescripcion,ProductoCodigo,ProductoPrecioCompra,ProductoPrecioVenta,ProductoCantidad,MedidaId,CategoriaId,ProveedorId,Estado) VALUES(?,?,?,?,?,?,?,?,?)";
            $datos = array($this->productoNombre,$this->productoCodigo,$this->productoPrecioCompra,$this->productoPrecioVenta,$this->productoCantidad,$this->medidaId,$this->categoriaId,$this->proveedorId,1);
            $data = $this->save($sql,$datos);
                if ($data == 1) {
                    $res = "Ok";
                }else {
                    $res = "Error";
                }   
        }else {
            $res = "Existe";
        }
        return $res;
    }
}