<?
include("../control/configuracion.php");
//$_POST['n'] = '4630719';
//$_POST['c'] = 'Este es el mejor negocio del planeta';
//$_POST['r'] = '3.2';
//$_POST['u'] = 'TWJL1M3PWI';
if( ($_POST['n'] != '') && ($_POST['c'] != '') && ($_POST['r'] != '') && ($_POST['u'] != '')) {
    $Fecha = date('Y-m-d H:i:s');
    $idNegocio = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['n']);
    $comentario = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['c']));
    $rating = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['r']);
    $Usuario = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['u']);
    $q = "INSERT INTO Reviews (idNegocio, idUsuarioReviewer, review, fechaCreacion) VALUES ('$idNegocio', '$Usuario', '$comentario', '$Fecha')";
    $result = mysqli_query($FUNCIONES->conexion, $q);
    $qA = "INSERT INTO NegociosRatings (idNegocio, idUsuario, rating) VALUES ('$idNegocio', '$Usuario', '$rating')";
    $resultA = mysqli_query($FUNCIONES->conexion, $qA);
    $resultadoArray = array('status' => "B", 'men' => "Comentario y rating hecho.");
    echo $FUNCIONES->returnJson($resultadoArray);
} else {
    $resultadoArray = array('status' => "E", 'men' => "Parametros Incorrectos.");
    echo $FUNCIONES->returnJson($resultadoArray);
}