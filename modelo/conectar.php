<?php
//conectar
class Conectar
{
    public static function conexion()
    {
        try {
            $conexion = new mysqli("localhost", "root", "", "ejemplomvc");
        } catch (Exception $e) {
            die('Error' . $e->getMessage());
        }

        return $conexion;
    }

}

?>