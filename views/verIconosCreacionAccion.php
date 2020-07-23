<?
include("../control/configuracion.php");
if(!$idUsuario) {
    header('Location: /login'); die;
}
$idIcono = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['idIcono']);
if(!$idIcono) {
    header('Location: /login'); die;
}
$uNombre = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iconoNombre']));
$uSlug = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iconoSlug']));
$uDescripcion = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iconoDescripcion']));
$uSeccion = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iconoSeccion']));
$fechaCreacion = date('Y-m-d H:i:s');
$sql = "INSERT INTO Iconos (idIcono, nombre, slug, descripcion, seccion, fechaCreacion) VALUES ('".$idIcono."', '".$uNombre."', '".$uSlug."', '".$uDescripcion."','".$uSeccion."','".$fechaCreacion."')";
mysqli_query($FUNCIONES->conexion, $sql) or die ('Error '. mysqli_error($FUNCIONES->conexion));
header('Location: /iconos/listado'); die;