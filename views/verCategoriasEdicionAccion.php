<?
include("../control/configuracion.php");
if(!$idUsuario) {
    header('Location: /login'); die;
}
if( ($_POST['categoriaIdCategoria'] == '') ){
    header('Location: /login'); die;
}
$uIdCategoria = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['categoriaIdCategoria']);
$uNombre = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['categoriaNombre']));
$uSlug = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['categoriaSlug']));
$uDescripcion = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['categoriaDescripcion']));
$sql = "UPDATE Categorias SET nombre = '".$uNombre."', slug = '".$uSlug."', descripcion = '".$uDescripcion."' WHERE idCategoria = '".$uIdCategoria."';";
mysqli_query($FUNCIONES->conexion, $sql)  or die ('Error Usuarios'. mysqli_error($FUNCIONES->conexion));
$redir= 'Location: /categorias/detalle/'.$uIdCategoria;
header($redir); die;