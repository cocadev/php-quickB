<?

$_POST['c'] = 'CAT_G4S';                    //categoria
$_POST['p'] = '1';                          //numero pagina
$_POST['latUsuario'] = '22.772858';         //Latitud usuario
$_POST['lonUsuario'] = '-102.622551';       //Longitud usuario
$_POST['f'] = '';                           //Raiting o Distancia o Views o null-vacio
$_POST['r'] = '5';                          //distancia en kilometros 5 es el default
//22.772858, -102.622551

include('../control/configuracion.php');
if( ($_POST['c'] != '') && ($_POST['p'] != '') ) {
    $latitudActual = $_POST['latUsuario'];
    $longitudActual = $_POST['lonUsuario'];
    $radio = $_POST['r'];
    $stringBusqueda = $_POST['s'];
    $cantidadAmostrar = 6;
    $inicioInferior = 0;
    $resultado = array();
    $idCategoria = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['c']);
    $pagina = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['p']);
    $queryCuantos = "SELECT a.idNegocio FROM Negocios a INNER JOIN Imagenes b ON a.idNegocio=b.Referencia WHERE a.idCategoria = '$idCategoria' AND b.seccion = 'logoNegocio'";
    $resultCuantos = mysqli_query($FUNCIONES->conexion, $queryCuantos);
    $cuantosNegocios = mysqli_num_rows($resultCuantos);
    $inicioInferior = ($pagina-1) * $cantidadAmostrar;
    $query = "
    SELECT idNegocio, nombre, domicilio, latitud, longitud, distance
    FROM (
      SELECT z.idNegocio,
             z.latitud, 
             z.longitud,
             p.radius,
             p.distance_unit
                     * DEGREES(ACOS(COS(RADIANS(p.latpoint))
                     * COS(RADIANS(z.latitud))
                     * COS(RADIANS(p.longpoint - z.longitud))
                     + SIN(RADIANS(p.latpoint))
                     * SIN(RADIANS(z.latitud)))) AS distance,
             z.nombre as nombre,
             z.domicilio as domicilio
      FROM Negocios AS z
      JOIN ( SELECT $latitudActual AS latpoint, $longitudActual AS longpoint, $radio AS radius, 111.045 AS distance_unit ) AS p ON 1=1
      INNER JOIN Imagenes b ON z.idNegocio=b.Referencia
      WHERE z.idCategoria = '$idCategoria'
      AND b.seccion = 'logoNegocio'
        AND z.latitud
         BETWEEN p.latpoint  - (p.radius / p.distance_unit)
             AND p.latpoint  + (p.radius / p.distance_unit)
        AND z.longitud
         BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
             AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
    ) AS d
    WHERE distance <= radius
    ORDER BY nombre, distance
    LIMIT $inicioInferior, $cantidadAmostrar";
    $result = mysqli_query($FUNCIONES->conexion, $query);
    if($cuantosNegocios > 0){
        while($row = mysqli_fetch_assoc($result)){
            $latitudNegocio = $FUNCIONES->getLatNegocio($row['idNegocio']);
            $longitudNegocio = $FUNCIONES->getLonNegocio($row['idNegocio']);
            $resultado[] = array(
                'idNegocio' => $row['idNegocio'],
                'coordinate' => array('latitude' => $row['latitud'], 'longitude' => $row['latitud']),
                'title' => $row['nombre'],
                'domicilio' => $row['nombre']

            );
        }
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    } else {
        echo "ERROR Generating information map";
    }
} else {
    echo "ERROR empty map";
}