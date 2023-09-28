<?php
class MedidasModel extends Query{
    private $medidaNombre,$medidaId,$medidaPrefijo;
    public function __construct()
    {
        parent::__construct();
    }
    public function getMedidas()
    {
        $sql="SELECT * FROM medidas";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function registrarMedida(string $medidaNombre,string $medidaPrefijo)
    {
        $this->medidaNombre=$medidaNombre;
        $this->medidaPrefijo=$medidaPrefijo;
        $verificar = "SELECT * FROM medidas WHERE MedidaPrefijo = '$medidaPrefijo'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO medidas(MedidaNombre,MedidaPrefijo,Estado) VALUES(?,?,?)";
            $datos = array($this->medidaNombre,$this->medidaPrefijo,1);
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
    public function obtenerMedida(int $medidaId)
    {
        $sql="SELECT * FROM medidas WHERE MedidaId='$medidaId'";
        $data = $this->select($sql);
        return $data;
    }
    public function editarMedida(string $medidaNombre,string $medidaPrefijo,int $medidaId)
    {
        $this->medidaNombre=$medidaNombre;
        $this->medidaPrefijo=$medidaPrefijo;
        $this->medidaId=$medidaId;
        $sql = "UPDATE  medidas SET MedidaNombre=?,MedidaPrefijo=?  WHERE MedidaId=?";
        $datos = array($this->medidaNombre,$this->medidaPrefijo,$this->medidaId);
        $data = $this->save($sql,$datos);
        if ($data == 1) {
            $res = "Modificado";
        }else {
            $res = "Error";
        }
        return $res;
    }
    public function eliminarMedida(int $medidaId)
    {
        $this->medidaId=$medidaId;
        $sql = "DELETE  FROM medidas  WHERE MedidaId=?";
        $datos = array($this->medidaId);
        $data = $this->save($sql,$datos);
        if ($data == 1) {
            $res = "Eliminado";
        }else {
            $res = "Error";
        }
        return $res;
    }
    public function getValidacionMedidas(int $medidaId)
    {
        $validacion=false;
        $sql="SELECT u.*,c.MedidaId  FROM productos u INNER JOIN medidas c where u.MedidaId=$medidaId";
        $dataUsuario=$this->selectAll($sql);
        if(empty($dataUsuario)){
            $validacion=true;
        }
        return $validacion;
    }
}