<?
include("../control/configuracion.php");
if(!$idUsuario) {
	$redirect = "/";
	header('Location: '.$redirect); die;
}
$string = $_POST['string'];
echo $FUNCIONES->sustituye_acentos($string);