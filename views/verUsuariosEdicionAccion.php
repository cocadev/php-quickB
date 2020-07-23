<?
include("../control/configuracion.php");
if(!$idUsuario) {
    header('Location: /login'); die;
}
if( ($_POST['idUsuario'] == '') ){
    header('Location: /login'); die;
}
$uIdUsuario = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['idUsuario']);
$uEmail = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['usuarioEmail']);
$uNombre = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['usuarioNombre']));
$uApellido = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['usuarioApellido']));
$uTipoUsuario = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['usuarioNivel']));
$fechaCreacion = date('Y-m-d H:i:s');

$sql = "UPDATE Usuarios SET email = '".$uEmail."', nombre = '".$uNombre."', apellido = '".$uApellido."', tipoUsuario = '".$uTipoUsuario."' WHERE idUsuario = '".$uIdUsuario."';";
mysqli_query($FUNCIONES->conexion, $sql)  or die ('Error Usuarios'. mysqli_error($FUNCIONES->conexion));

header('Location: /usuarios/listado'); die;