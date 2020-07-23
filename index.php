<?
include('control/configuracion.php');
if($idUsuario) {
    header('Location: /dashboard'); die;
} else {
    header('Location: /login'); die;
}