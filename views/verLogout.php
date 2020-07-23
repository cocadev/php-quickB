<?
include("../control/configuracion.php");
//$sql = "DELETE FROM UsuariosSessions WHERE idUsuario = '".$idUsuario."'";
//$liberaSesion = mysqli_query($FUNCIONES->conexion, $sql);
session_destroy();
mysqli_close($FUNCIONES->conexion);
header("Location: /login"); die;