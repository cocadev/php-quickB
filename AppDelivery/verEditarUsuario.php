<?
include("../control/configuracion.php");

$_POST['i'] = 'FSMUMG';
$_POST['n'] = 'Rodrigo';
$_POST['a'] = 'Velázquez Carmona';
$_POST['e'] = 'rodvelcar@hotmail.com';
$_POST['p'] = '123456';

if( ($_POST['i'] != '') && ($_POST['n'] != '') && ($_POST['a'] != '') && ($_POST['e'] != '') && ($_POST['p'] != '') ) {

    $idUsuarioSel = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['i']);
    $nombreL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['n']);
    $apellidoL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['a']);
    $emailL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['e']);
    $passwordL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['p']);

    $query = "UPDATE Usuarios SET nombre='$nombreL', apellido='$apellidoL', email='$emailL', password = PASSWORD('".$passwordL."') WHERE idUsuario='$idUsuarioSel'";

    $result = mysqli_query($FUNCIONES->conexion, $query);
    if ($result){
        $resultado[] = array(
            'mensaje' => 'Success'
        );
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    } else {
        $resultado[] = array(
            'mensaje' => 'Failure'
        );
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    }
} else {
    $resultado[] = array('mensaje' => "failure-nodata");
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}