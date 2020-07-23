<?
include("../control/configuracion.php");
//$_POST['n'] = '6416735';
//$_POST['s'] = 'N';
//$_POST['u'] = 'TWJL1M3PWI';
if( ($_POST['n'] != '') && ($_POST['s'] != '') && ($_POST['u'] != '')) {
    $Fecha = date('Y-m-d H:i:s');
    $idNegocio = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['n']);
    $favorito = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['s']);
    $Usuario = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['u']);
    if($favorito === 1){
        $q = "INSERT INTO UsuariosNegociosFavoritos (idNegocio, idUsuario, Fecha) VALUES ('$idNegocio', '$Usuario', '$Fecha')";
        $result = mysqli_query($FUNCIONES->conexion, $q);
        $resultadoArray = array('status' => "B", 'men' => "Favorito Insertado.");
        echo $FUNCIONES->returnJson($resultadoArray);
    } elseif($favorito === 0) {
        $q = "DELETE FROM UsuariosNegociosFavoritos WHERE idNegocio = '$idNegocio' AND idUsuario = '$Usuario'";
        $result = mysqli_query($FUNCIONES->conexion, $q);
        $resultadoArray = array('status' => "B", 'men' => "Favorito Eliminado.");
        echo $FUNCIONES->returnJson($resultadoArray);
    }
} else {
    $resultadoArray = array('status' => "E", 'men' => "Parametros Incorrectos.");
    echo $FUNCIONES->returnJson($resultadoArray);
}