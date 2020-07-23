<?
include("../control/configuracion.php");
/*
$_POST['n'] = 'Rodrigo';
$_POST['a'] = 'Velazquez Carmona';
$_POST['e'] = 'rodvelcar@hotmail.com';
$_POST['p'] = 'pass1234';
*/
if( ($_POST['n'] != '') && ($_POST['e'] != '') && ($_POST['p'] != '')) {
    $idUsuarioLimpio = $FUNCIONES->generateRandomString(6);
    $idActivacion = $FUNCIONES->generateRandomString(16);
    $nombreLimpio = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['n']));
    $apellidoLimpio = htmlspecialchars(mysqli_real_escape_string($FUNCIONES->conexion, $_POST['a']));
    $emailLimpio = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['e']);
    $passwordLimpio = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['p']);
    $fechaRegistro = date('Y-m-d H:i:s');
    $tipoUsuario = "General";
    $sqlAgregarUsuario = "INSERT INTO Usuarios (idUsuario, nombre, apellido, email, password, tipoUsuario, activo, fechaRegistro) VALUES (
        '".$idUsuarioLimpio."',
        '".$nombreLimpio."',
        '".$apellidoLimpio."',
        '".$emailLimpio."',
        PASSWORD('".$passwordLimpio."'),
        '".$tipoUsuario."',
        '".$idActivacion."',
        '".$fechaRegistro."'
        )";
    $resultAgregarUsuario = mysqli_query($FUNCIONES->conexion, $sqlAgregarUsuario);
    if ($resultAgregarUsuario){
        /*Email Para Administradores*/
        $tituloMensaje = 'QuickB - Nuevo Registro';
        $contenidoMsg = '<span>Nombre: '.$nombreLimpio.'</span><br>';
        $contenidoMsg .= '<span>Correo: '.$emailLimpio.'</span><br>';
        $contenidoMsg .= '<span>Fecha Registro: '.$fechaRegistro.'</span><br>';
        $destinatario = $FUNCIONES->getConfiguracion('emailNotificaciones');
        $tipoEmail = "Control";
        include('../includes/mailTemplate.php');
        /*Email para el nuevo registro*/
        $tituloMensaje = 'QuickB - Bienvenido';
        $contenidoMsg = '
            &iexcl;Hola Bienvenido a la comunidad de QuickB!, agradecemos que hayas decidido unirte, ya veras como encontraras lo que necesitas mas f&aacute;cil, con QuickB tendr&aacute;s todo al alcance de tu mano.<br><br>
Ya tenemos tu cuenta en nuestro sistema, pero requerimos aun, por tu seguridad y la de nuestros usuarios, que confirmes tu correo con este E-mail, una vez hecho esto el proceso se habr&aacute; completado y podr&aacute;s disfrutar de todas las incre&iacute;bles opciones que QuickB te ofrece.<br><br>
El enlace se encuentra aqu&iacute; abajo, simplemente haz click sobre el y listo, &iquest;F&aacute;cil no?
<br>
<a href="https://www.quickb.mx/verificar/'.$idActivacion.'">Verificar email</a>
<br>
Bienvenido de nuevo, los y las integrantes de la comunidad QuickB estamos felices de tenerte.<br><br>
&iexcl;Hasta Pronto!
            ';
        $tipoEmail = "Bienvenida";
        $destinatario = $emailLimpio;
        include('../includes/mailTemplate.php');
        $resultado[] = array(
            'mensaje' => "success",
            'idUsuario' => $idUsuarioLimpio,
            'social' => 0
        );
        echo json_encode($resultado, JSON_PRETTY_PRINT);
        exit;
    } else {
        $errorSql = mysqli_error($FUNCIONES->conexion);
        $errorDuplicado = "Duplicate entry";
        //echo $errorSql;
        if( strpos($errorSql, $errorDuplicado) !== false ){
            //Error Registro Duplicado
            $resultado[] = array('mensaje' => "failure-duplicate");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
            exit;
        } else {
            //Error desconocido.
            $resultado[] = array('mensaje' => "failure-error $errorSql");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
            exit;
        }
    }
} else {
    $resultado[] = array('mensaje' => "failure-nodata");
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}