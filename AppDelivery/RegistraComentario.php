<?
include("../control/configuracion.php");
//$_POST['iu'] = 'YQ9XBQ'; //idUsuario
//$_POST['ib'] = '4631894'; //idNegocio
//$_POST['r'] = '3.2'; //calificacion de estrellas
//$_POST['t'] = 'Comentario'; //titulo del comentario
//$_POST['o'] = 'Este es el mejor negocio del planeta, lo recomiendo al 100%'; //comentario
if( isset($_POST['iu']) && isset($_POST['ib']) && isset($_POST['r']) && isset($_POST['t']) && isset($_POST['t']) && isset($_POST['o'])) {
    $fechaRegistro = date('Y-m-d H:i:s');
    $idUsuarioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iu']);
    $idNegocioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['ib']);
    $ratingL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['r']);
    $tituloL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['t']);
    $comentarioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['o']);
    $query = "INSERT INTO ComentariosReviews (idUsuario, idNegocio, rating, titulo, comentario, fechaCreacion) VALUES ('$idUsuarioL', '$idNegocioL', '$ratingL', '$tituloL', '$comentarioL','$fechaRegistro')";
    $result = mysqli_query($FUNCIONES->conexion, $query);
    if (!$result){
        $resultado[] = array('mensaje' => "failure-registry1:".mysqli_error($FUNCIONES->conexion));
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    }
    $queryA = "INSERT INTO NegociosRatings (idNegocio, idUsuario, rating) VALUES ('$idNegocioL', '$idUsuarioL', '$ratingL')";
    $resultA = mysqli_query($FUNCIONES->conexion, $queryA);
    if ($resultA){
        $resultado[] = array(
            'mensaje' => "success"
        );
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    } else {
        $resultado[] = array('mensaje' => "failure-registry2:".mysqli_error($FUNCIONES->conexion));
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    }
} else {
    $resultado[] = array('mensaje' => "failure-nodata");
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}

