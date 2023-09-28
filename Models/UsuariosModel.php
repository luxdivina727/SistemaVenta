<?php
class UsuariosModel extends Query{
    private $usuario,$usuarioCorreoElectronico,$clave,$cajaId,$rolId;
    public function __construct()
    {
        parent::__construct();
    }
    public function getUsuario(string $usuario,string $clave)
    {
        $sql="SELECT * FROM usuarios WHERE UsuarioNombre = '$usuario' AND UsuarioClave = '$clave'";
        $data=$this->select($sql);
        return $data;
    }
    public function getCajas()
    {
        $sql="SELECT * FROM cajas WHERE Estado = 1";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function getUsuarios()
    {
        $sql="SELECT u.*,c.CajaId,c.CajaNombre  FROM usuarios u INNER JOIN cajas c where u.CajaId=c.CajaId";
        $data=$this->selectAll($sql);
        return $data;
    }
    public function registrarUsuario(string $usuario,string $usuarioNombreCompleto,string $usuarioCorreoElectronico,string $clave,int $cajaId)
    {
        $this->usuario=$usuario;
        $this->usuarioCorreoElectronico=$usuarioCorreoElectronico;
        $this->usuarioNombreCompleto=$usuarioNombreCompleto;
        $this->clave=$clave;
        $this->cajaId=$cajaId;
        $verificar = "SELECT * FROM usuarios WHERE UsuarioNombre = '$usuario'";
        $existe = $this->select($verificar);
        if (empty($existe)) {
            $sql = "INSERT INTO usuarios(UsuarioNombre,usuarioNombreCompleto,UsuarioClave,CajaId,Estado,UsuarioCorreoElectronico) VALUES(?,?,?,?,?,?)";
            $datos = array($this->usuario,$this->usuarioNombreCompleto,$this->clave,$this->cajaId,1,$this->usuarioCorreoElectronico);
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
    public function obtenerUsuario(int $usuarioId)
    {
        $sql="SELECT * FROM usuarios WHERE UsuarioId='$usuarioId'";
        $data = $this->select($sql);
        return $data;
    }
    public function obtenerUsuarioPorNombre(string $usuarioNombre){
        $sql="SELECT * FROM usuarios WHERE UsuarioNombre='$usuarioNombre'";
        $data = $this->select($sql);
        return $data;
    }
     public function editarUsuario(string $usuarioCorreoElectronico,string $usuarioNombreCompleto,int $usuarioId,int $cajaId)
    {
        $this->usuarioCorreoElectronico=$usuarioCorreoElectronico;
        $this->usuarioNombreCompleto=$usuarioNombreCompleto;
        $this->usuarioId=$usuarioId;
        $this->cajaId=$cajaId;
        $sql = "UPDATE  usuarios SET CajaId=?,UsuarioCorreoElectronico=?,UsuarioNombreCompleto=?  WHERE UsuarioId=?";
        $datos = array($this->cajaId,$this->usuarioCorreoElectronico,$this->usuarioNombreCompleto,$this->usuarioId);
        $data = $this->save($sql,$datos);
            if ($data == 1) {
                $res = "Modificado";
            }else {
                $res = "Error";
            }
            return $res;
    }
     public function inactivarUsuario(int $usuarioId)
    {
        $this->usuarioId=$usuarioId;
        $sql = "UPDATE  usuarios SET Estado= 0  WHERE UsuarioId = ?";
        $datos = array($this->usuarioId);
        $data = $this->save($sql,$datos);
        return $data;
    }
    public function activarUsuario(int $usuarioId)
    {
        $this->usuarioId=$usuarioId;
        $sql = "UPDATE  usuarios SET Estado= 1  WHERE UsuarioId = ?";
        $datos = array($this->usuarioId);
        $data = $this->save($sql,$datos);
        return $data;
    }
}
?>