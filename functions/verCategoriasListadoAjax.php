<?
$table = 'CategoriasImagenes';
$primaryKey = 'idCategoria';
$columns = array(
    array( 'db' => 'idCategoria', 'dt' => 0),
    array( 'db' => 'nombre', 'dt' => 1),
    array( 'db' => 'descripcion', 'dt' => 2),
    array( 'db' => 'imagen',  'dt' =>3),
);
$sql_details = array(
    'user' => 'quickb_user',
    'pass' => 'KqAI0]Rw%hWW',
    'db'   => 'quickb_db',
    'host' => 'localhost'
);
require('../functions/datatables/ssp.class.php');
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);