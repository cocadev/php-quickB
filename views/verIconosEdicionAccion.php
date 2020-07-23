<?
include("../control/configuracion.php");
if(!$idUsuario) {
    header('Location: /login'); die;
}
if( ($_POST['iconoIdIcono'] == '') ){
    header('Location: /login'); die;
}
$uIdIcono = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iconoIdIcono']);
$uNombre = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iconoNombre']));
$uSlug = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iconoSlug']));
$uDescripcion = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iconoDescripcion']));
$sql = "UPDATE Iconos SET nombre = '".$uNombre."', slug = '".$uSlug."', descripcion = '".$uDescripcion."' WHERE idIcono = '".$uIdIcono."';";
mysqli_query($FUNCIONES->conexion, $sql)  or die ('Error Usuarios'. mysqli_error($FUNCIONES->conexion));
$redir= 'Location: /iconos/detalle/'.$uIdIcono;
header($redir); die;