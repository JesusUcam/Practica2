<?php
session_start();

if(isset($_POST["accion"])){
    //estamos ante una llamada a ajax
echo '  <form action="" method="post">
<label for="fname">nombre:</label>
<input type="text" id="nombre" name="nombre" value="'.$_POST['nombre'].'" readonly>

<label for="fdesc">Descripcion:</label>
<input type="text" id="descripcion" name="descripcion" value="'.$_POST['descripcion'].'">

<label for="festado">Estado:</label>
<input type="text" id="estado" name="estado" value="'.$_POST['estado'].'">

<label for="festado">Fecha de la tarea:</label>
<input type="date" id="fecha_creacion" name="fecha_creacion" value="'.$_POST['fecha_creacion'].'">
<br>
<input type="submit" name="modificar" value="Modificar">
<br>
</form>
<input type="submit" id="cancelar" name="cancelar" value="Cancelar" onclick=cancelar()>
';
}

function home(){
    require_once("modelo/tareas_modelo.php");
    $error = "";
    $tareas = new tareas_modelo();
    $usuarios = new tareas_modelo();

    if (isset($_SESSION['email'])) {

        if(isset($_POST['borrar'])){
            $nombre = isset($_POST['nombre'])?$_POST['nombre']: '';
            
            if($tareas->borrar($nombre)) $error = "Borrado correctamente";
            else $error = "Error al borrar";
            
        } elseif(isset($_POST['insertar'])){

            $nombre = isset($_POST['nombre'])?$_POST['nombre']: '';
            $descripcion = isset($_POST['descripcion'])?$_POST['descripcion']: '';
            $estado = isset($_POST['estado'])?$_POST['estado']: '';
            $fecha_creacion = isset($_POST['fecha_creacion'])?$_POST['fecha_creacion']: '';
            $autor = isset($_POST['autor'])?$_POST['autor']: '';

            console_log($autor);

            if($tareas->insertar($nombre, $descripcion, $estado, $fecha_creacion, $autor)) $error = "Insertado correctamente.";
            else $error = "Error al insertar.";

        } elseif (isset($_POST["modificar"])) {

            $nombre = isset($_POST['nombre'])?$_POST['nombre']: '';
            $descripcion = isset($_POST['descripcion'])?$_POST['descripcion']: '';
            $estado = isset($_POST['estado'])?$_POST['estado']: '';
            $fecha_creacion = isset($_POST['fecha_creacion'])?$_POST['fecha_creacion']: '';
            $autor = isset($_POST['autor'])?$_POST['autor']: '';
            
            if ($tareas->modificar($nombre, $descripcion, $estado, $fecha_creacion, $autor)) {
                $error = "Modificado correctamente";
            } else {
                $error = "Error al modificar";
            }
                
        }
    }

    $array_tareas = $tareas->get_tareas();
    $array_usuarios2 = $usuarios->get_usuarios2();
    console_log($array_tareas);
    require_once("vista/tareas_vista.php");
}
?>