<?
include("../control/configuracion.php");
//$_POST['iu'] = 'YQ9XBQ'; //idUsuario
//$_POST['ib'] = '4631894'; //idNegocio
//$_POST['e'] = '1'; //  1 usuario / 2 negocio
//$_POST['m'] = 'Hola me puede informar su horario de trabajo?'; //Mensaje
if( isset($_POST['iu']) && isset($_POST['ib']) && isset($_POST['e']) && isset($_POST['m']) ) {
    $fechaCreacion = date("Y-m-d H:i:s");
    $idUsuarioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iu']);
    $idNegocioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['ib']);
    $emisorL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['e']);
    $mensajeL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['m']);

    $query = "INSERT INTO Mensajes (idUsuario, idNegocio, emisor, mensaje, fechaCreacion) VALUES ('$idUsuarioL', '$idNegocioL', '$emisorL','$mensajeL', '$fechaCreacion')";
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
    $resultado[] = array('mensaje' => "failure-nodata");
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}