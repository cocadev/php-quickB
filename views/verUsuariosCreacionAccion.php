<?
include("../control/configuracion.php");
if(!$idUsuario) {
    header('Location: /login'); die;
}
$uIdUsuario = $FUNCIONES->generateRandomString(6);
$uEmail = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['usuarioEmail']);
$uNombre = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['usuarioNombre']));
$uTelefono = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['usuarioTelefono']));
$uNivel = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['usuarioNivel']));
if($uNivel == 'BA') {$uNivelMensaje = 'BA - B&aacute;sico'; }
elseif ($uNivel == 'PR') {$uNivelMensaje = 'PR - Premium'; }
elseif ($uNivel == 'PU') {$uNivelMensaje = 'PU - Publicidad'; }
elseif ($uNivel == 'AD') {$uNivelMensaje = 'AD - Administrador'; }
elseif ($uNivel == 'EQ') {$uNivelMensaje = 'EQ - Equipo TuZacatecas'; }
$fechaCreacion = date('Y-m-d H:i:s');
$uPassword = $FUNCIONES->generateRandomStringPassword(8);
$sql = "INSERT INTO Usuarios (idUsuario, email, password, nombre, telefono, nivel, fechaCreacion) VALUES ('".$uIdUsuario."', '".$uEmail."', PASSWORD('".$uPassword."'), '".$uNombre."', '".$uTelefono."', '".$uNivel."', '".$fechaCreacion."')";
mysqli_query($FUNCIONES->conexion, $sql) or die ('Error '. mysqli_error($FUNCIONES->conexion));
$tituloMensaje = 'Cuenta de Ingreso';
$contenidoMsg = 'Tu cuenta de ingreso sido creada exitosamente.<br><br>';
$contenidoMsg .= 'Tu usuario es: <strong>'.$uEmail.'</strong><br>';
$contenidoMsg .= 'Tu Contrase&ntilde;a: <strong>'.$uPassword.'</strong><br>';
$contenidoMsg .= 'El tipo de tu cuenta es: <strong>'.$uNivelMensaje.'</strong><br><br>';
$contenidoMsg .= 'Te recomendamos recordar tus datos de ingreso a la plataforma.<br><br>';
$contenidoMsg .= 'Para ingresar a TuZacatecas.com, favor de visitar, <a href="https://verwaltung.tuzacatecas.com"><strong>verwaltung.tuzacatecas.com</strong></a><br><br>';
$contenidoMsg .= 'Gracias por utilizar nuestra plataforma.<br>';
$emailDestinatario = $uEmail;
//$emailDestinatario = $uEmail.',web-0n8nx@mail-tester.com';
$tipoEmail = 'Informativo';
include("../templates/mailParaUsuarioNuevo.php");
header('Location: /usuarios/listado'); die;