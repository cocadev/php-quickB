<?
/*
 * RewriteRule ^ApisDelivery/Category/List?$    AppDelivery/verIconList.php    [NC]
 * Ejemplo https://admin.quickb.mx/Apis/Icon/List
 */
include('../control/configuracion.php');
$_POST['i'] = '0RYNFA';
if( isset($_POST['i']) ) {
    $idUsuario = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['i']);
    $seccion = $FUNCIONES->GetTipoUsuario($idUsuario);
    $query = "SELECT idIcono, concat('https://admin.quickb.mx/AppDelivery/Imagenes/',imagen) AS imagen, nombre, nombreScreen FROM IconosImagenes WHERE seccion = 'Todos' OR seccion = '$seccion' ORDER BY nombreScreen DESC";
    $result = mysqli_query($FUNCIONES->conexion, $query);
    while($row = mysqli_fetch_assoc($result)){
        $resultado[] = array(
            'idIcono' => $row['idIcono'],
            'imagen' => $row['imagen'],
            'nombre' => $row['nombre'],
            'nombreScreen' => $row['nombreScreen'],
        );
    }
    echo json_encode($resultado, JSON_PRETTY_PRINT);
} else {
    $resultado[] = array(
        'idIcono' => '-',
        'imagen' => '-',
        'nombre' => '-'
    );
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}