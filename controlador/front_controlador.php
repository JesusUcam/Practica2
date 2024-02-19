<?php
//TODO EL EJERCICIO ESTÁ AÚN SIN ARREGLAR
function console_log( $data ){
echo '<script>';
echo 'console.log('. json_encode( $data ) .')';
echo '</script>';
}

define ('CONTROLLERS_FOLDER', "controlador/");
define ('DEFAULT_CONTROLLER', "usuarios"); 
define ('DEFAULT_ACTION', "home");

$controller = DEFAULT_CONTROLLER;
// Si el usuario lo indica, seleccionamos el controlador indicado.
if ( !empty ( $_GET[ 'controlador' ] ) ) $controller = $_GET [ 'controlador' ];
// Obtenemos la acción por defecto.
$action = DEFAULT_ACTION;
// Si el usuario la indica, seleccionamos la indicada.
if ( !empty ( $_GET [ 'action' ] ) ) $action = $_GET [ 'action' ];
//Ya tenemos el controlador y la accion
//Formamos el nombre del fichero que contiene nuestro controlador
$controller = CONTROLLERS_FOLDER . $controller . '_controlador.php'; // ********* esto se cambia
//_controlador.php
console_log($controller);
console_log($action);
try
{
if ( is_file ( $controller ) ) require_once ($controller);
else
throw new Exception ('El controlador no existe - 404 not found');
//Si la variable $action es una funcion la ejecutamos o detenemos el script
if ( is_callable ($action) ) $action();
else
throw new Exception ('La accion no existe - 404 not found');
}catch (Exception $e) {
console_log($e->getMessage());
}
?>