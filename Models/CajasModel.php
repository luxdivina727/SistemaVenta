<?php
class CajasModel extends Query{
    private $cajaNombre,$cajaId;
    public function __construct()
    {
        parent::__construct();
    }
    public function getCajas()
    {
        $sql="SELECT * FROM cajas";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function getValidacionUsuarios(int $cajaId)
    {
        $validacion=false;
        $sql="SELECT u.*,c.CajaId,c.CajaNombre  FROM usuarios u INNER JOIN cajas c where u.CajaId=$cajaId";
        $dataUsuario=$this->selectAll($sql);
        if(empty($dataUsuario)){
            $validacion=true;
        }
        return $validacion;
    }
    public function registrarCaja(string $cajaNombre)
    {
        $this->cajaNombre=$cajaNombre;
        $verificar = "SELECT * FROM cajas WHERE CajaNombre = '$cajaNombre'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO cajas(CajaNombre,Estado) VALUES(?,?)";
            $datos = array($this->cajaNombre,1);
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
    public function obtenerCaja(int $cajaId)
    {
        $sql="SELECT * FROM cajas WHERE CajaId='$cajaId'";
        $data = $this->select($sql);
        return $data;
    }
    public function obtenerCajaPorNombre(string $cajaNombre){
        $sql="SELECT * FROM cajas WHERE CajaNombre='$cajaNombre'";
        $data = $this->select($sql);
        return $data;
    }
    public function editarCaja(string $cajaNombre,int $cajaId)
    {
        $this->cajaNombre=$cajaNombre;
        $this->cajaId=$cajaId;
        $sql = "UPDATE  cajas SET CajaNombre=?  WHERE CajaId=?";
        $datos = array($this->cajaNombre,$this->cajaId);
        $data = $this->save($sql,$datos);
        if ($data == 1) {
            $res = "Modificado";
        }else {
            $res = "Error";
        }
        return $res;
    }
    public function eliminarCaja(int $cajaId)
    {
        $this->cajaId=$cajaId;
        $sql = "DELETE  FROM cajas   WHERE CajaId=?";
        $datos = array($this->cajaId);
        $data = $this->save($sql,$datos);
        if ($data == 1) {
            $res = "Eliminado";
        }else {
            $res = "Error";
        }
        return $res;
    }
}