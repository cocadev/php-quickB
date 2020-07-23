<?
//$_POST['iu'] = 'YQ9XBQ'; //idUsuario
//$_POST['ib'] = '4631894'; //idNegocio
//$_POST['p'] = '1';//#pagina
include('../control/configuracion.php');
if( ($_POST['iu'] != '') && ($_POST['ib'] != '') ) {
    $cantidadAmostrar = 10;
    $inicioInferior = 0;
    $idUsuarioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['iu']);
    $idNegocioL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['ib']);
    $pagina = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['p']);
    $inicioInferior = ($pagina-1) * $cantidadAmostrar;
    $query = "SELECT idMensaje, emisor, mensaje FROM Mensajes WHERE idUsuario = '$idUsuarioL' AND idNegocio = '$idNegocioL' ORDER BY fechaCreacion DESC LIMIT $inicioInferior, $cantidadAmostrar";
    $result = mysqli_query($FUNCIONES->conexion, $query);
        while($row = mysqli_fetch_assoc($result)){
            $resultado[] = array(
                'idMensaje' => $row['idMensaje'],
                'emisor' => $row['emisor'],
                'mensaje' => $row['mensaje']
            );
        }
        echo json_encode($resultado, JSON_PRETTY_PRINT);

} else {
    $resultado[] = array('mensaje' => "failure-nodata");
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}