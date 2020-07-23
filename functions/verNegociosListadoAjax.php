<?
ini_set('memory_limit', '-1');
$table = 'NegociosConCategorias';
$primaryKey = 'idNegocio';
$columns = array(
    array( 'db' => 'idNegocio', 'dt' => 0),
    array( 'db' => 'nombre', 'dt' => 1),
    array( 'db' => 'Categoria', 'dt' => 2),
    array( 'db' => 'subcategoria', 'dt' => 3)
);
$sql_details = array(
    'user' => 'quickb_user',
    'pass' => 'KqAI0]Rw%hWW',
    'db'   => 'quickb_db',
    'host' => 'localhost'
);
require('../functions/datatables/ssp.class.php');
echo json_encode( SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns ));