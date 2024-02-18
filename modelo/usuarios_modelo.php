<?php

class usuarios_modelo
{
    private $db; //conexion con la bbdd
    private $usuarios; //registros recuperados de la bbdd

    public function __construct()
    {
        require_once("modelo/conectar.php");
        $this->db = Conectar::conexion();
        $this->usuarios = array();
    }

    public function get_usuarios()
    {
        $sql = "SELECT * FROM usuarios";
        $consulta = $this->db->query($sql);
        while ($registro = $consulta->fetch_assoc()) {
            $this->usuarios[] = $registro;
        }
        return $this->usuarios;
    }

    public function login($email, $password)
    {
        $login = false;
        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND clave = '$password'";
        if ($consulta = $this->db->query($sql)) {
            if ($consulta->num_rows > 0) {
                $login = true;
            }
        }
        return $login;
    }

    public function borrar($email)
    {
        $sql = "DELETE FROM usuarios WHERE nombre='$email'";
        if ($this->db->query($sql)) {
            $sql1 = "DELETE FROM usuarios WHERE nombre='$email'";
            return $this->db->query($sql1);
        }
        return false;
    }

    public function insertar($email, $nombre, $apellidos, $clave){

        $sql = "INSERT INTO usuarios (email, clave) VALUES ('$nombre', '$clave')";
        //No entiendo para que se ha creado la tabla "usuarios" teniendo la de "usuarios"
        if($this->db->query($sql)){
            $sql1 = "INSERT INTO usuarios (email, nombre, apellidos) VALUES ('$email', '$nombre', $apellidos)";
            return $this->db->query($sql1);

            }
            return false;
    }   

    function modificarUsuario($email, $nombre, $apellidos){
        $sql = "UPDATE usuarios SET apellidos=$apellidos, email='$email' WHERE nombre='$nombre'";
        return $this->db->query($sql);
    }
}
?>