<?php
class ProveedoresModel extends Query{
    private $proveedorCedula,$proveedorNombreCompleto,$proveedorTelefono,$proveedorDireccion,$proveedorCiudad;

    public function __construct()
    {
        parent::__construct();
    }
    public function getCiudades()
    {
        $sql="SELECT * FROM ciudades";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function getProveedores()
    {
        $sql="SELECT cli.*,c.CiudadId,c.CiudadNombre  FROM proveedores cli INNER JOIN ciudades c where cli.CiudadId=c.CiudadId";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function registrarProveedor(int $proveedorCedula,string $proveedorNombreCompleto,int $proveedorTelefono,string $proveedorDireccion,int $proveedorCiudad)
    {
        $this->proveedorCedula=$proveedorCedula;
        $this->proveedorNombreCompleto=$proveedorNombreCompleto;
        $this->proveedorTelefono=$proveedorTelefono;
        $this->proveedorDireccion=$proveedorDireccion;
        $this->proveedorCiudad=$proveedorCiudad;
        $verificar = "SELECT * FROM proveedores WHERE ProveedorNumeroCedula = '$proveedorCedula'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO proveedores(ProveedorNumeroCedula,ProveedorNombreCompleto,ProveedorTelefono,ProveedorDireccion,Estado,CiudadId) VALUES(?,?,?,?,?,?)";
            $datos = array($this->proveedorCedula,$this->proveedorNombreCompleto,$this->proveedorTelefono,$this->proveedorDireccion,1,$this->proveedorCiudad);
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
    public function obtenerProveedor(int $proveedorId)
    {
        $sql="SELECT * FROM proveedores WHERE ProveedorId='$proveedorId'";
        $data = $this->select($sql);
        return $data;
    }
    public function obtenerProveedorPorCedula(int $proveedorNumeroCedula){
        $sql="SELECT * FROM proveedores WHERE ProveedorNumeroCedula='$proveedorNumeroCedula'";
        $data = $this->select($sql);
        return $data;
    }
    public function editarProveedor(string $proveedorNombreCompleto,int $proveedorTelefono,int $proveedorId,int $ciudadId,string $proveedorDireccion)
    {
        $this->proveedorNombreCompleto=$proveedorNombreCompleto;
        $this->proveedorTelefono=$proveedorTelefono;
        $this->proveedorDireccion=$proveedorDireccion;
        $this->proveedorId=$proveedorId;
        $this->ciudadId=$ciudadId;
        $sql = "UPDATE  proveedores SET ProveedorNombreCompleto=?,ProveedorTelefono=?,ProveedorDireccion=?,CiudadId=? WHERE ProveedorId=?";
        $datos = array($this->proveedorNombreCompleto,$this->proveedorTelefono,$this->proveedorDireccion,$this->ciudadId,$this->proveedorId);
        $data = $this->save($sql,$datos);
            if ($data == 1) {
                $res = "Modificado";
            }else {
                $res = "Error";
            }
            return $res;
    }
    public function inactivarProveedor(int $proveedorId)
    {
        $this->proveedorId=$proveedorId;
        $sql = "UPDATE  proveedores SET Estado= 0  WHERE ProveedorId = ?";
        $datos = array($this->proveedorId);
        $data = $this->save($sql,$datos);
        return $data;
    }
    public function activarProveedor(int $proveedorId)
    {
        $this->proveedorId=$proveedorId;
        $sql = "UPDATE  proveedores SET Estado= 1  WHERE ProveedorId = ?";
        $datos = array($this->proveedorId);
        $data = $this->save($sql,$datos);
        return $data;
    }
}