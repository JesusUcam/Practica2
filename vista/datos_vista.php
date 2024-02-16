<?php

if (isset($_SESSION['nombre'])) {
    require_once("menu.php");

    ?>
    <h3>Nuevo usuario</h3>

    <div class="container">
        <div id="nuevo">
            <form action="" method="post">
                <label for="fname">Usuario:</label>
                <input type="text" id="fname" name="nombre" placeholder="Nombre de usuario..">

                <label for="lclave">Contraseña:</label>
                <input type="password" id="lclave" name="clave" placeholder="Contraseña..">

                <label for="fedad">Edad:</label>
                <input type="text" id="fedad" name="edad" placeholder="Edad..">

                <label for="fcorreo">Correo:</label>
                <input type="text" id="fcorreo" name="correo" placeholder="Correo..">

                <input type="submit" name="insertar" value="Insertar">
            </form>
        </div>

        <div id="contenido"></div>

        <?php

        if (isset($array_datos)) {
            echo "<table border><tr><th>Nombre</th><th>Edad</th><th>Correo</th></tr>";
            foreach ($array_datos as $value) {
                echo "<tr>";
                foreach ($value as $k => $value2) {
                    echo "<td>$value2</td>";
                }
                echo "<td><form action='' method='post'>
                  <input type='hidden' name='nombre' value='" . $value['nombre'] . "'>
                  <input type='submit' name='borrar' value='Borrar'>
                  </form></td>";
                  echo "<td>
                  <input type='hidden' id='nombre".$value['nombre']."' value='" . $value['nombre'] . "'>
                  <input type='hidden' id='edad".$value['nombre']."' value='" . $value['edad'] . "'>
                  <input type='hidden' id='correo".$value['nombre']."' value='" . $value['correo'] . "'>
                  <input type='submit' name='modificar' value='Modificar' onclick=modificarUsuario(`".$value['nombre']."`)></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
} else {
    ?>
        <div class="container">
            <h3>Inicio de sesión</h3>
            <form action="index.php" method="post">
                <label for="nombre">Nombre de usuario:</label>
                <input type="text" name="nombre" id="nombre">
                <br><br>
                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" id="clave">
                <br><br>
                <input type="submit" id="btn-enviar" value="Enviar">
            </form>
            <?php
}
echo "<p>$error</p>";
?>