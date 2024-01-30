<?php
session_start();

if(isset($_POST["accion"])){
    //estamos ante una llamada a ajax
echo '  <form action="" method="post">
<label for="fname">Nombre:</label>
<input type="text" id="fname" name="nombre" value="'.$_POST['nombre'].'" readonly>

<label for="fcantidad">cantidad:</label>
<input type="text" id="lcantidad" name="cantidad" value="'.$_POST['cantidad'].'">

<label for="fdescripcion">Descripcion:</label>
<input type="text" id="fdescripcion" name="descripcion" value="'.$_POST['descripcion'].'">

<input type="submit" name="modificar" value="Modificar">
</form>
<input type="submit" id="cancelar" name="cancelar" value="Cancelar" onclick=cancelar()>
';
}

function home(){
    require_once("modelo/productos_modelo.php");
    $error = "";
    $datos = new Productos_modelo();

    if (isset($_SESSION['nombre'])) {
        if(isset($_POST['borrar'])){
            $nombre = isset($_POST['nombre'])?$_POST['nombre']: '';
            
            if($datos->borrar($nombre)) $error = "Borrado correctamente";
            else $error = "Error al borrar";
            
        } elseif(isset($_POST['insertar'])){

            $nombre = isset($_POST['nombre'])?$_POST['nombre']: '';
            $cantidad = isset($_POST['cantidad'])?$_POST['cantidad']: '';
            $descripcion = isset($_POST['descripcion'])?$_POST['descripcion']: '';

            if($datos->insertar($nombre, $cantidad, $descripcion)) $error = "Insertado correctamente.";
            else $error = "Error al insertar.";

        } elseif (isset($_POST["modificar"])) {

            $nombre=isset($_POST["nombre"])?$_POST["nombre"]:'';
            $cantidad=isset($_POST["cantidad"])?$_POST["cantidad"]:'';
            $descripcion=isset($_POST["descripcion"])?$_POST["descripcion"]:'';
            
            if ($datos->modificar($nombre, $cantidad, $descripcion)) {
                $error = "Modificado correctamente";
            } else {
                $error = "Error al modificar";
            }
                
        }
    }

    $array_datos = $datos->get_datos();
    require_once("vista/productos_vista.php");
}
?>