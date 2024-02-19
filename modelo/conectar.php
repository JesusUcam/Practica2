<?php
//conectar
class Conectar
{
    public static function conexion()
    {
        try {
            $conexion = new mysqli("localhost", "root", "", "practica"); //Conexion con la BBDD
        } catch (Exception $e) {
            die('Error' . $e->getMessage());
        }

        return $conexion;
    }

}

?>