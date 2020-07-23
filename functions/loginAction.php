<?
include("../control/configuracion.php");
if( isset($_POST['email']) && isset($_POST['password']) ){
    $fechaRegistro = date("Y-m-d H:i:s");
    $emailL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['email']);
    $passwordL = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['password']);
    $passClean = $FUNCIONES->codePass($passwordL);
    $queryLogeo = "SELECT idUsuario FROM Usuarios WHERE email = '$emailL' AND password = '$passClean' AND activo = 1 AND tipoUsuario = 'Administrador' LIMIT 1";
    $selUser = mysqli_query($FUNCIONES->conexion, $queryLogeo);
    $row = mysqli_fetch_array($selUser);
    if($row['idUsuario']){
        ini_set('session.gc_maxlifetime', 3600);
        $idUsuario = $row['idUsuario'];
        session_regenerate_id(true);
        $_SESSION['CREATED'] = time();
        $_SESSION['IDUSUARIOQUICKB'] = $row['idUsuario'];
        $ipUsuario = $_SERVER['REMOTE_ADDR'];
        $fechaIngreso = date('Y-m-d H:i:s');
        header("Location: /dashboard");
        exit;
    } else {
        header("Location: /login/error/acceso");
        exit;
    }
} else {
    header("Location: /login/error/incorrecto");
    exit;
}