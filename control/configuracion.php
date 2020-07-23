<?
session_start();
include("funciones.php");
$FUNCIONES = new classQuickb();
//Variables de Configuracion
$ds = DIRECTORY_SEPARATOR;
$dirArchivos = '/home/quickb/admin.quickb.mx/AppDelivery/Imagenes';
$pathArchivos = $dirArchivos.$ds;
$idUsuario = isset($_SESSION["IDUSUARIOQUICKB"]) ? $_SESSION["IDUSUARIOQUICKB"] : false;
$apiKeyGoogle = 'AIzaSyAKvtJ22Z548DS3m_Fbm9ERyKIT0vyMJE0';
$envPaypal = 'PROD'; // Entorno de Paypal PROD o LAB
mysqli_query($FUNCIONES->conexion, "SET NAMES 'utf8'");