<?
include("../control/configuracion.php");
if(!$idUsuario) {
    header('Location: /login'); die;
}
$idCategoria = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['idCategoria']);
if(!$idCategoria) {
    header('Location: /login'); die;
}
$uNombre = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['categoriaNombre']));
$uSlug = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['categoriaSlug']));
$uDescripcion = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['categoriaDescripcion']));
$fechaCreacion = date('Y-m-d H:i:s');
$sql = "INSERT INTO Categorias (idCategoria, nombre, slug, descripcion, fechaCreacion) VALUES ('".$idCategoria."', '".$uNombre."', '".$uSlug."', '".$uDescripcion."', '".$fechaCreacion."')";
mysqli_query($FUNCIONES->conexion, $sql) or die ('Error '. mysqli_error($FUNCIONES->conexion));
header('Location: /categorias/listado'); die;