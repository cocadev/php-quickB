<?
include("../control/configuracion.php");
if(!$idUsuario) {
    header('Location: /login'); die;
}
if( ($_POST['idNegocio'] == '') ){
    header('Location: /login'); die;
}
$idNegocio = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['idNegocio']);
$uidCategoria = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioIdCategoria']);
$uNombre = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioNombre']));
$uSlug = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioSlug']);
$uRazonSocial = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioRazonSocial']));
$uRfc = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioRfc']));
$uScian = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioScian']));
$uSubcategoria = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioSubcategoria']));
$uDomicilio = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioDomicilio']));
$uColonia = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioColonia']));
$uCodigoPostal = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioCodigoPostal']));
$uMunicipio = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioMunicipio']));
$uEstado = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioEstado']));
$uTelefonos = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioTelefonos']));
$uPaginaWeb = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioPaginaWeb']));
$uEmail = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioEmail']));
$uDescripcion = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioDescripcion']);
$uHorario = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioHorario']));
$uLatitud = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioLatitud']);
$uLongitud = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioLongitud']);
$uFechaTermino = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['negocioFechaTermino']);
$sql = "UPDATE Negocios SET 
idCategoria = '".$uidCategoria."',
nombre = '".$uNombre."',
slug = '".$uSlug."',
razonSocial = '".$uRazonSocial."',
rfc = '".$uRfc."',
scian = '".$uScian."',
subcategoria = '".$uSubcategoria."',
domicilio = '".$uDomicilio."',
colonia = '".$uColonia."',
codigoPostal = '".$uCodigoPostal."',
municipio = '".$uMunicipio."',
estado = '".$uEstado."',
telefonos = '".$uTelefonos."',
paginaWeb = '".$uPaginaWeb."',
email = '".$uEmail."',
descripcion = '".$uDescripcion."',
horario = '".$uHorario."',
latitud = '".$uLatitud."',
longitud = '".$uLongitud."',
fechaTermino = '".$uFechaTermino."'
WHERE idNegocio = '".$idNegocio."';";
mysqli_query($FUNCIONES->conexion, $sql) or die ('Error '. mysqli_error($FUNCIONES->conexion));
$redir = "Location: /negocios/detalle/".$idNegocio;
header($redir); die;