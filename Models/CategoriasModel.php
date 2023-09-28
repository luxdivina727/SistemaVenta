<?php
class CategoriasModel extends Query{
    private $categoriaNombre,$categoriaId;
    public function __construct()
    {
        parent::__construct();
    }
    public function getCategorias()
    {
        $sql="SELECT * FROM categorias";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function registrarCategoria(string $categoriaNombre)
    {
        $this->categoriaNombre=$categoriaNombre;
        $verificar = "SELECT * FROM categorias WHERE CategoriaNombre = '$categoriaNombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO categorias(CategoriaNombre,Estado) VALUES(?,?)";
            $datos = array($this->categoriaNombre,1);
            $data = $this->save($sql,$datos);
                if ($data == 1) {
                    $res = "Ok";
                }else {
                    $res = "Error";
                }
            }else{
                $res = "Existe";
            }
        return $res;
    }
    public function obtenerCategoria(int $categoriaId)
    {
        $sql="SELECT * FROM categorias WHERE CategoriaId='$categoriaId'";
        $data = $this->select($sql);
        return $data;
    }
    public function editarCategoria(string $categoriaNombre,int $categoriaId)
    {
        $this->categoriaNombre=$categoriaNombre;
        $this->categoriaId=$categoriaId;
        $sql = "UPDATE  categorias SET CategoriaNombre=?  WHERE CategoriaId=?";
        $datos = array($this->categoriaNombre,$this->categoriaId);
        $data = $this->save($sql,$datos);
        if ($data == 1) {
            $res = "Modificado";
        }else {
            $res = "Error";
        }
        return $res;
    }
    public function eliminarCategoria(int $categoriaId)
    {
        $this->categoriaId=$categoriaId;
        $sql = "DELETE  FROM categorias  WHERE CategoriaId=?";
        $datos = array($this->categoriaId);
        $data = $this->save($sql,$datos);
        if ($data == 1) {
            $res = "Eliminado";
        }else {
            $res = "Error";
        }
        return $res;
    }
    public function getValidacionCategorias(int $categoriaId)
    {
        $validacion=false;
        $sql="SELECT u.*,c.CategoriaId  FROM productos u INNER JOIN categorias c where u.CategoriaId=$categoriaId";
        $dataUsuario=$this->selectAll($sql);
        if(empty($dataUsuario)){
            $validacion=true;
        }
        return $validacion;
    }
}