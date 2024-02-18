<?php
session_start();

if(isset($_POST["accion"])){
    //estamos ante una llamada a ajax
echo '  <form action="" method="post">
<label for="fname">email:</label>
<input type="text" id="fname" name="email" value="'.$_POST['email'].'" readonly>

<label for="fnombre">nombre:</label>
<input type="text" id="fnombre" name="nombre" value="'.$_POST['nombre'].'">

<label for="fapellidos">apellidos:</label>
<input type="text" id="lapellidos" name="apellidos" value="'.$_POST['apellidos'].'">

<input type="submit" name="modificar" value="Modificar">
</form>
<input type="submit" id="cancelar" name="cancelar" value="Cancelar" onclick=cancelar()>
';
}


function home(){

    require_once("modelo/usuarios_modelo.php");
    $error = '';
    $usuarios = new usuarios_modelo();
    if (!isset($_SESSION['email'])) {
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $clave = isset($_POST['clave']) ? $_POST['clave'] : '';
        if ($usuarios->login($email, $clave)) {
            $_SESSION['email'] = $email;
        } else {
            if ($email != '') {
                $error = "Usuario o contraseña incorrectos";
            }
        }
    } else {
        if(isset($_POST['borrar'])){
            $email = isset($_POST['email'])?$_POST['email']: '';
            
            if($usuarios->borrar($email)) $error = "Borrado correctamente";
            else $error = "Error al borrar";
            
        } elseif(isset($_POST['insertar'])){
            $email = isset($_POST['email'])?$_POST['email']: '';
            $clave = isset($_POST['clave'])?$_POST['clave']: '';
            $apellidos = isset($_POST['apellidos'])?$_POST['apellidos']: '';
            $nombre = isset($_POST['nombre'])?$_POST['nombre']: '';

            if($usuarios->insertar($email, $nombre, $clave, $apellidos)) $error = "Insertado correctamente.";
            else $error = "Error al insertar.";
        }

    }

    if (isset($_POST["modificarUsuario"])) {
        /*
        if (isset($_POST["email"])) {
            $email=$_POST["email"]
        }else {
            $email='';
        }
        Esto es lo mismo que lo de abajo*/
        $email=isset($_POST["email"])?$_POST["email"]:'';
        $nombre=isset($_POST["nombre"])?$_POST["nombre"]:'';
        $apellidos=isset($_POST["apellidos"])?$_POST["apellidos"]:'';
        if ($usuarios->modificarUsuario($email, $apellidos, $nombre)) {
            $error = "Modificado correctamente";
        } else {
            $error = "Error al modificar";
        }
            
    }
    
    $array_usuarios = $usuarios->get_usuarios();
    require_once("vista/usuarios_vista.php");
}

function desconectar()
{
    session_destroy();
    header("Location: index.php");
}
?>