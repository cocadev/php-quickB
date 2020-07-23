<?
include('../control/configuracion.php');
//$_POST['c'] = 'CAT_G4S';                    //categoria
$idCategoria = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['c']);

$query = "SELECT scian, subcategoria FROM Negocios WHERE idCategoria = '$idCategoria' GROUP BY scian, subcategoria";
$result = mysqli_query($FUNCIONES->conexion, $query);
while($row = mysqli_fetch_assoc($result)){
    $resultado[] = array(
        'idSubCategoria' => $row['scian'],
        'nombre' => $row['subcategoria']
    );
}
echo json_encode($resultado, JSON_PRETTY_PRINT);