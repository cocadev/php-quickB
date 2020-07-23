<?
/*
 * RewriteRule ^Apis/Business/Detail?$    AppDelivery/verBusinessDetail.php   [NC]
 * Ejemplo https://admin.quickb.mx/Apis/User
 */
//$_POST['u'] = 'TWJL1M3PWI';
include('../control/configuracion.php');
if(($_POST['u'] != '')) {
    $Usuario = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['u']);
    $query = "SELECT nombre AS name, email FROM Usuarios WHERE idUsuario = '$Usuario'";

    $result = mysqli_query($FUNCIONES->conexion, $query);
    while($row = mysqli_fetch_assoc($result)){
        $resultado[] = array(
            'userId' => $Usuario,
            'name' => $row['name'],
            'email' => $row['email'],
            'image' => $FUNCIONES->getNombreImagen($Usuario),
        );
    }
    echo json_encode($resultado, JSON_PRETTY_PRINT);
} else {
    echo "ERROR user detail";
}