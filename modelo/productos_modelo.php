<?php

class Productos_modelo{
    private $db; //conexion con la bbdd
    private $datos; //registros recuperados de la bbdd

    public function __construct() {
        require_once("modelo/conectar.php");
        $this->db = Conectar::conexion();
        $this->datos = array();
    }

    public function get_datos() {
        $sql = "SELECT * FROM productos";
        $consulta = $this->db->query($sql);
        while($registro = $consulta->fetch_assoc()) {
            $this->datos[] = $registro;
        }
        return $this->datos;
    }

    public function borrar($nombre)
    {
        $sql = "DELETE FROM productos WHERE nombre='$nombre'";
        return $this->db->query($sql);
    }

    public function insertar($nombre, $cantidad, $descripcion){

        $sql = "INSERT INTO productos (nombre, cantidad, descripcion) VALUES ('$nombre', '$cantidad', '$descripcion')";
        return $this->db->query($sql);
        
    }

    function modificar($nombre, $cantidad, $descripcion){
        $sql = "UPDATE productos SET cantidad=$cantidad, descripcion='$descripcion' WHERE nombre='$nombre'";
        return $this->db->query($sql);
    }
}

?>