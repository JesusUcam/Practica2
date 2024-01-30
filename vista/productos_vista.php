<?php

if (isset($_SESSION['nombre'])) {
    require_once("menu.php");

    ?>
    <h3>Nuevo Producto</h3>

    <div class="container">
        <div id="nuevo">
            <form action="" method="post">
                <label for="fname">Nombre:</label>
                <input type="text" id="fname" name="nombre" placeholder="Nombre del producto...">

                <label for="fcantidad">Cantidad:</label>
                <input type="text" id="fcantidad" name="cantidad" placeholder="Cantidad de stock...">

                <label for="fdescripcion">Descripcion:</label>
                <input type="text" id="fdescripcion" name="descripcion" placeholder="descripcion..">

                <input type="submit" name="insertar" value="Insertar">
            </form>
        </div>

        <div id="contenido"></div>

        <?php

        if (isset($array_datos)) {
            echo "<table border><tr><th>Nombre</th><th>Cantidad</th><th>Descripcion</th></tr>";
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
                  <input type='hidden' id='cantidad".$value['nombre']."' value='" . $value['cantidad'] . "'>
                  <input type='hidden' id='descripcion".$value['nombre']."' value='" . $value['descripcion'] . "'>
                  <input type='submit' name='modificar' value='Modificar' onclick=modificarProducto(`".$value['nombre']."`)></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
} else {
    ?>
        <div class="container">
            <h3>Inicio de sesión</h3>
            <form action="" method="post">
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