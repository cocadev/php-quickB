<?
/*
 * RewriteRule ^ApisDelivery/Category/List?$    AppDelivery/verCategoryList.php    [NC]
 * Ejemplo https://admin.quickb.mx/ApisDelivery/Category/List
 */
include('../control/configuracion.php');
$query = "SELECT idCategoria, concat('https://admin.quickb.mx/AppDelivery/Imagenes/',imagen) AS imagen, nombre FROM CategoriasImagenes";
$result = mysqli_query($FUNCIONES->conexion, $query);
while($row = mysqli_fetch_assoc($result)){
    $resultado[] = array(
        'idCategoria' => $row['idCategoria'],
        'imagen' => $row['imagen'],
        'nombre' => $row['nombre']
    );
}
echo json_encode($resultado, JSON_PRETTY_PRINT);