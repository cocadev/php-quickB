<?
include("../control/configuracion.php");
//$json = json_decode(file_get_contents('php://input'), true);
$id = $_POST['i'];
$nombre = $_POST['n'];
$email = $_POST['e'];
$picture = $_POST['p'];

$fechaRegistro = date("Y-m-d H:i:s");

mysqli_query($FUNCIONES->conexion,"SET CHARACTER SET utf8 ");
if( isset($email)){
    if($FUNCIONES->emailSocialExiste($email)){
        $sql_acceso = "SELECT idUsuario, tipoUsuario FROM Usuarios WHERE socialEmail = '$email' LIMIT 1";
        $valUser = mysqli_query($FUNCIONES->conexion, $sql_acceso);
        while($row = mysqli_fetch_array($valUser)){
            $resultado[] = array(
                'mensaje' => "success",
                'idUsuario' => $row['idUsuario'],
                'social' => 1
            );
        }
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    } else {
        $idUsuario = $FUNCIONES->generateRandomString(6);
        $sql_registro = "INSERT INTO Usuarios (idUsuario, socialId, socialNombre, socialEmail, tipoUsuario, activo, fechaRegistro) values('$idUsuario','$id', '$nombre', '$email', 'General', 1, '$fechaRegistro')";
        $query_result = mysqli_query($FUNCIONES->conexion, $sql_registro);
        if ($query_result){
            $resultado[] = array(
                'mensaje' => "success",
                'idUsuario' => $idUsuario,
                'social' => 1
            );
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        } else {
            $errorSql = mysqli_error($FUNCIONES->conexion);
            $resultado[] = array(
                'mensaje' => "Error DBA:($errorSql)",
                'idUsuario' => $idUsuario,
                'social' => 1
            );
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
    }
} else {
    $resultado[] = array(
        'mensaje' => "Error no data",
        'idUsuario' => '-',
        'social' => 1
    );
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}