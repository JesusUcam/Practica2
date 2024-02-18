<?php

if (isset($_SESSION['email'])) {
    require_once("menu.php");

    ?>
    <h3>Nuevo usuario</h3>

    <div class="container">
        <div id="nuevo">
            <form action="" method="post">

                <label for="femail">email:</label>
                <input type="text" id="femail" name="email" placeholder="email..">

                <label for="fname">Usuario:</label>
                <input type="text" id="fname" name="email" placeholder="email de usuario..">

                <label for="lclave">Contraseña:</label>
                <input type="password" id="lclave" name="clave" placeholder="Contraseña..">

                <label for="fapellidos">apellidos:</label>
                <input type="text" id="fapellidos" name="apellidos" placeholder="apellidos..">

                <input type="submit" name="insertar" value="Insertar">

            </form>
        </div>

        <div id="contenido"></div>

        <?php

        if (isset($array_usuarios)) {
            echo "<table border><tr><th>Nombre</th><th>Apellidos</th><th>Email</th></tr>";
            foreach ($array_usuarios as $value) {
                echo "<tr>";
                foreach ($value as $k => $value2) {
                    echo "<td>$value2</td>";
                }
                echo "<td><form action='' method='post'>
                  <input type='hidden' name='email' value='" . $value['email'] . "'>
                  <input type='submit' name='borrar' value='Borrar'>
                  </form></td>";
                  echo "<td>
                  <input type='hidden' id='nombre".$value['email']."' value='" . $value['nombre'] . "'>
                  <input type='hidden' id='apellidos".$value['email']."' value='" . $value['apellidos'] . "'>
                  <input type='hidden' id='email".$value['email']."' value='" . $value['email'] . "'>
                  <input type='submit' name='modificar' value='Modificar' onclick=modificarUsuario(`".$value['email']."`)></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
} else {
    ?>
        <div class="container">
            <h3>Inicio de sesión</h3>
            <form action="index.php" method="post">
                <label for="email">email de usuario:</label>
                <input type="text" name="email" id="email">
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