<?php
session_start();

if(isset($_POST["accion"])){
    //estamos ante una llamada a ajax
echo '  <form action="" method="post">
<label for="fname">Nombre:</label>
<input type="text" id="fname" name="nombre" value="'.$_POST['nombre'].'" readonly>

<label for="fedad">Edad:</label>
<input type="text" id="ledad" name="edad" value="'.$_POST['edad'].'">

<label for="fcorreo">Correo:</label>
<input type="text" id="fcorreo" name="correo" value="'.$_POST['correo'].'">

<input type="submit" name="modificar" value="Modificar">
</form>
<input type="submit" id="cancelar" name="cancelar" value="Cancelar" onclick=cancelar()>
';
}


function home(){

    require_once("modelo/datos_modelo.php");
    $error = '';
    $datos = new Datos_modelo();
    if (!isset($_SESSION['nombre'])) {
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
        $clave = isset($_POST['clave']) ? $_POST['clave'] : '';
        if ($datos->login($nombre, $clave)) {
            $_SESSION['nombre'] = $nombre;
        } else {
            if ($nombre != '') {
                $error = "Usuario o contraseña no encontrado";
            }
        }
    } else {
        if(isset($_POST['borrar'])){
            $nombre = isset($_POST['nombre'])?$_POST['nombre']: '';
            
            if($datos->borrar($nombre)) $error = "Borrado correctamente";
            else $error = "Error al borrar";
            
        } elseif(isset($_POST['insertar'])){
            $nombre = isset($_POST['nombre'])?$_POST['nombre']: '';
            $clave = isset($_POST['clave'])?$_POST['clave']: '';
            $edad = isset($_POST['edad'])?$_POST['edad']: '';
            $correo = isset($_POST['correo'])?$_POST['correo']: '';

            if($datos->insertar($nombre, $clave, $edad, $correo)) $error = "Insertado correctamente.";
            else $error = "Error al insertar.";
        }

    }

    if (isset($_POST["modificar"])) {
        /*
        if (isset($_POST["nombre"])) {
            $nombre=$_POST["nombre"]
        }else {
            $nombre='';
        }
        Esto es lo mismo que lo de abajo*/
        $nombre=isset($_POST["nombre"])?$_POST["nombre"]:'';
        $edad=isset($_POST["edad"])?$_POST["edad"]:'';
        $correo=isset($_POST["correo"])?$_POST["correo"]:'';
        if ($datos->modificar($nombre, $edad, $correo)) {
            $error = "Modificado correctamente";
        } else {
            $error = "Error al modificar";
        }
            
    }
    
    $array_datos = $datos->get_datos();
    require_once("vista/datos_vista.php");
}

function desconectar()
{
    session_destroy();
    header("Location: index.php");
}
?>