<?
include("../control/configuracion.php");
//$_POST['iu'] = 'YQ9XBQ'; //idUsuario
//$_POST['ib'] = '4631894'; //idNegocio
//$_POST['i'] = '0'; // Like 1 / 0

if( isset($_POST['iu']) && isset($_POST['ib']) ) {
    $idUsuarioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iu']);
    $idNegocioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['ib']);

    $query = "SELECT likeNegocio FROM NegociosLikes WHERE idNegocio = '$idNegocioL' AND idUsuario = '$idUsuarioL'";
    $result = mysqli_query($FUNCIONES->conexion, $query);
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $resultado[] = array(
                'estatus' => $row['likeNegocio']
            );
        }
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    } else {
        $resultado[] = array('mensaje' => "failure-registry:".mysqli_error($FUNCIONES->conexion));
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    }

} else {
    $resultado[] = array('mensaje' => "failure-nodata");
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}