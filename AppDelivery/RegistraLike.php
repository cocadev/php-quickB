<?
include("../control/configuracion.php");
//$_POST['iu'] = 'YQ9XBQ'; //idUsuario
//$_POST['ib'] = '4631894'; //idNegocio
//$_POST['i'] = '0'; // Like 1 / 0

if( isset($_POST['iu']) && isset($_POST['ib']) && isset($_POST['i']) ) {
    $idUsuarioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iu']);
    $idNegocioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['ib']);
    $likeL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['i']);

    if($FUNCIONES->existeLike($idUsuarioL,$idNegocioL)){
        $query = "UPDATE NegociosLikes SET likeNegocio = '$likeL' WHERE idUsuario = '$idUsuarioL' AND idNegocio = '$idNegocioL';";
        $result = mysqli_query($FUNCIONES->conexion, $query);
        if ($result){
            $resultado[] = array(
                'mensaje' => "success"
            );
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        } else {
            $resultado[] = array('mensaje' => "failure-registry:".mysqli_error($FUNCIONES->conexion));
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
    } else {
        $query = "INSERT INTO NegociosLikes (idNegocio, idUsuario, likeNegocio) VALUES ('$idNegocioL', '$idUsuarioL', '$likeL')";
        $result = mysqli_query($FUNCIONES->conexion, $query);
        if ($result){
            $resultado[] = array(
                'mensaje' => "success"
            );
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        } else {
            $resultado[] = array('mensaje' => "failure-registry:".mysqli_error($FUNCIONES->conexion));
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
    }
} else {
    $resultado[] = array('mensaje' => "failure-nodata");
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}