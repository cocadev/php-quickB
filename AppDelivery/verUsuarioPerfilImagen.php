<?
/*
 * RewriteRule ^apis/usuario/perfil/imagen?$    AppDelivery/verUsuarioPerfilImagen.php   [NC]
 * Ejemplo https://admin.quickb.mx/apis/usuario/perfil/imagen
 */
include("../control/configuracion.php");
//$_POST['i'] = 'FSMUMG';
if( isset($_POST['i']) ){
    $idUsuarioSel = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['i']);
    $queryCuantos = "SELECT concat('https://admin.quickb.mx/AppDelivery/Imagenes/',Referencia,'/',nombreImg) AS imagen FROM Imagenes WHERE Referencia = '$idUsuarioSel' LIMIT 1";
    $resultCuantos = mysqli_query($FUNCIONES->conexion, $queryCuantos);
    $cuantosNegocios = mysqli_num_rows($resultCuantos);
    if($cuantosNegocios > 0){
        $query = "SELECT concat('https://admin.quickb.mx/AppDelivery/Imagenes/',Referencia,'/',nombreImg) AS imagen FROM Imagenes WHERE Referencia = '$idUsuarioSel' LIMIT 1";
        $selUser = mysqli_query($FUNCIONES->conexion, $query);
        $row = mysqli_fetch_array($selUser);
        if($row['imagen']){
            $resultado[] = array(
                'url' => $row['imagen']
            );
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        } else {
            $resultado[] = array('mensaje' => "ERROR Generating information");
            echo json_encode($resultado, JSON_PRETTY_PRINT);
        }
    } else {
        $resultado[] = array(
            'url' => 'https://admin.quickb.mx/apis/usuario/perfil/imagen/default'
        );
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    }
} else {
    $resultado[] = array('mensaje' => "failure-nodata");
    echo json_encode($resultado, JSON_PRETTY_PRINT);
}