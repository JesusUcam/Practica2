<?php

class Datos_modelo
{
    private $db; //conexion con la bbdd
    private $datos; //registros recuperados de la bbdd

    public function __construct()
    {
        require_once("modelo/conectar.php");
        $this->db = Conectar::conexion();
        $this->datos = array();
    }

    public function get_datos()
    {
        $sql = "SELECT * FROM datos";
        $consulta = $this->db->query($sql);
        while ($registro = $consulta->fetch_assoc()) {
            $this->datos[] = $registro;
        }
        return $this->datos;
    }

    public function login($user, $password)
    {
        $login = false;
        $sql = "SELECT * FROM usuarios WHERE nombre = '$user' AND clave = '$password'";
        if ($consulta = $this->db->query($sql)) {
            if ($consulta->num_rows > 0) {
                $login = true;
            }
        }
        return $login;
    }

    public function borrar($nombre)
    {
        $sql = "DELETE FROM datos WHERE nombre='$nombre'";
        if ($this->db->query($sql)) {
            $sql1 = "DELETE FROM usuarios WHERE nombre='$nombre'";
            return $this->db->query($sql1);
        }
        return false;
    }

    public function insertar($nombre, $clave, $edad, $correo){

        $sql = "INSERT INTO usuarios (nombre, clave) VALUES ('$nombre', '$clave')";
        //No entiendo para que se ha creado la tabla "datos" teniendo la de "usuarios"
        if($this->db->query($sql)){
            $sql1 = "INSERT INTO datos (nombre, edad, correo) VALUES ('$nombre', $edad, '$correo')";
            return $this->db->query($sql1);

            }
            return false;
    }   

    function modificar($nombre, $edad, $correo){
        $sql = "UPDATE datos SET edad=$edad, correo='$correo' WHERE nombre='$nombre'";
        return $this->db->query($sql);
    }
}
?>