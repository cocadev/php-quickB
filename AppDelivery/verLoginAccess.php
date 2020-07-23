<?
include("../control/configuracion.php");

//$_POST['e'] = 'rodvelcar@hotmail.com';
//$_POST['p'] = 'pass1234';

if( isset($_POST['e']) && isset($_POST['p']) ){
    $fechaRegistro = date("Y-m-d H:i:s");
    $emailL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['e']);
    $passwordL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['p']);
    $passClean = $FUNCIONES->codePass($passwordL);
    $queryLogeo = "SELECT idUsuario, tipoUsuario FROM Usuarios WHERE email = '$emailL' AND password = '$passClean' AND activo = 1 LIMIT 1";
    $selUser = mysqli_query($FUNCIONES->conexion, $queryLogeo);
    $row = mysqli_fetch_array($selUser);
    if($row['idUsuario']){
        $resultado[] = array(
            'mensaje' => "success",
            'idUsuario' => $row['idUsuario'],
            'social' => 0

        );
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    } else {
        $resultado[] = array('mensaje' => "failure-registry");
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    }
} else {
    $resultado[] = array('mensaje' => "failure-nodata");
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}