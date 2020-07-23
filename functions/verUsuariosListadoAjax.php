<?
$table = 'Usuarios';
$primaryKey = 'idUsuario';
$columns = array(
    array( 'db' => 'idUsuario', 'dt' => 0),
    array( 'db' => 'nombre', 'dt' => 1),
    array( 'db' => 'apellido', 'dt' => 2),
    array( 'db' => 'email', 'dt' => 3),
    array( 'db' => 'tipoUsuario',  'dt' =>4),
    array( 'db' => 'activo',  'dt' =>5),
    array( 'db' => 'fechaRegistro',  'dt' =>6)
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