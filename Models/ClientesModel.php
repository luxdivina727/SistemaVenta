<?php
class ClientesModel extends Query{
    private $clienteCedula,$clienteNombreCompleto,$clienteTelefono,$clienteDireccion,$clienteCiudad;
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
    public function getClientes()
    {
        $sql="SELECT cli.*,c.CiudadId,c.CiudadNombre  FROM clientes cli INNER JOIN ciudades c where cli.CiudadId=c.CiudadId";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function registrarCliente(int $clienteCedula,string $clienteNombreCompleto,int $clienteTelefono,string $clienteDireccion,int $clienteCiudad)
    {
        $this->clienteCedula=$clienteCedula;
        $this->clienteNombreCompleto=$clienteNombreCompleto;
        $this->clienteTelefono=$clienteTelefono;
        $this->clienteDireccion=$clienteDireccion;
        $this->clienteCiudad=$clienteCiudad;
        $verificar = "SELECT * FROM clientes WHERE ClienteNumeroCedula = '$clienteCedula'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO clientes(ClienteNumeroCedula,ClienteNombreCompleto,ClienteTelefono,ClienteDireccion,Estado,CiudadId) VALUES(?,?,?,?,?,?)";
            $datos = array($this->clienteCedula,$this->clienteNombreCompleto,$this->clienteTelefono,$this->clienteDireccion,1,$this->clienteCiudad);
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
    public function obtenerCliente(int $clienteId)
    {
        $sql="SELECT * FROM clientes WHERE ClienteId='$clienteId'";
        $data = $this->select($sql);
        return $data;
    }
    public function obtenerClientePorCedula(int $clienteNumeroCedula){
        $sql="SELECT * FROM clientes WHERE ClienteNumeroCedula='$clienteNumeroCedula'";
        $data = $this->select($sql);
        return $data;
    }
     public function editarCliente(string $clienteNombreCompleto,int $clienteTelefono,int $clienteId,int $ciudadId,string $clienteDireccion)
    {
        $this->clienteNombreCompleto=$clienteNombreCompleto;
        $this->clienteTelefono=$clienteTelefono;
        $this->clienteDireccion=$clienteDireccion;
        $this->clienteId=$clienteId;
        $this->ciudadId=$ciudadId;
        $sql = "UPDATE  clientes SET ClienteNombreCompleto=?,ClienteTelefono=?,ClienteDireccion=?,CiudadId=? WHERE ClienteId=?";
        $datos = array($this->clienteNombreCompleto,$this->clienteTelefono,$this->clienteDireccion,$this->ciudadId,$this->clienteId);
        $data = $this->save($sql,$datos);
            if ($data == 1) {
                $res = "Modificado";
            }else {
                $res = "Error";
            }
            return $res;
    }
     public function inactivarCliente(int $clienteId)
    {
        $this->clienteId=$clienteId;
        $sql = "UPDATE  clientes SET Estado= 0  WHERE ClienteId = ?";
        $datos = array($this->clienteId);
        $data = $this->save($sql,$datos);
        return $data;
    }
    public function activarCliente(int $clienteId)
    {
        $this->clienteId=$clienteId;
        $sql = "UPDATE  clientes SET Estado= 1  WHERE ClienteId = ?";
        $datos = array($this->clienteId);
        $data = $this->save($sql,$datos);
        return $data;
    }
}
?>