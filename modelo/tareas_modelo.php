<?php

class tareas_modelo{
    private $db; //conexion con la bbdd
    private $tareas; //registros recuperados de la bbdd

    public function __construct() {
        require_once("modelo/conectar.php");
        $this->db = Conectar::conexion();
        $this->tareas = array();
    }

    public function get_tareas() {
        $sql = "SELECT * FROM tareas";
        $consulta = $this->db->query($sql);
        while($registro = $consulta->fetch_assoc()) {
            $this->tareas[] = $registro;
        }
        return $this->tareas;
    }
    public function get_usuarios2() {
        $sql = "SELECT * FROM usuarios";
        $consulta = $this->db->query($sql);
        while($registro = $consulta->fetch_assoc()) {
            $this->tareas[] = $registro;
        }
        return $this->tareas;
    }

    public function borrar($nombre)
    {
        $sql = "DELETE FROM tareas WHERE nombre='$nombre'";
        return $this->db->query($sql);
    }
    
    public function insertar($nombre, $descripcion, $estado, $fecha_creacion, $autor){
        $sql = "INSERT INTO tareas (nombre, descripcion, estado, fecha_creacion, autor) VALUES ('$nombre', '$descripcion', '$estado', '$fecha_creacion', '$autor')";
        return $this->db->query($sql);
    }

    function modificarTarea($nombre, $descripcion, $estado, $fecha_creacion, $autor){
        $sql = "UPDATE tareas SET nombre='$nombre', descripcion='$descripcion', estado='$estado', fecha_creacion='$fecha_creacion', autor='$autor' WHERE nombre='$nombre'";
        return $this->db->query($sql);
    }
}

?>