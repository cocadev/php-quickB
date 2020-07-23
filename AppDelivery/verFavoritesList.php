<?
/*
 * RewriteRule ^Apis/Favorites/List?$    AppDelivery/verFavoritesList.php   [NC]
 * Ejemplo https://admin.quickb.mx/Apis/favorites/List
 */

$_POST['i'] = 'FSMUMG';                    //categoria
$_POST['p'] = '1';                          //numero pagina
$_POST['latUsuario'] = '22.772858';         //Latitud usuario
$_POST['lonUsuario'] = '-102.622551';       //Longitud usuario
$_POST['s'] = '';                       //String de busqueda
$_POST['fs'] = '';                           //Filtro subcategoria
$_POST['fd'] = '4';                           //filtro de distancia
//22.772858, -102.622551

include('../control/configuracion.php');
if( ($_POST['i'] != '') && ($_POST['p'] != '') ) {

    if($_POST['fd'] == '1'){ $radio = 2;}
    elseif ($_POST['fd'] == '2') { $radio = 5;}
    elseif ($_POST['fd'] == '3') { $radio = 10;}
    elseif ($_POST['fd'] == '4') { $radio = 100;}
    else { $radio = 2; }
    $idUsuarioSel = $_POST['i'];
    $latitudActual = $_POST['latUsuario'];
    $longitudActual = $_POST['lonUsuario'];
    $stringBusqueda = $_POST['s'];
    $cantidadAmostrar = 6;
    $inicioInferior = 0;
    $resultado = array();
    $idCategoria = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['c']);
    $pagina = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['p']);
    $inicioInferior = ($pagina-1) * $cantidadAmostrar;
    $query = "
    SELECT idNegocio, direccion, telefonos, logo, nombre, latitud, longitud, distance
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
             concat(z.domicilio,' ',z.colonia) AS direccion,
             z.nombre as nombre,
             z.telefonos as telefonos,
             concat('https://admin.quickb.mx/AppDelivery/Imagenes/',b.Referencia,'/',b.nombreImg) AS logo
      FROM Negocios AS z
      JOIN ( SELECT $latitudActual AS latpoint, $longitudActual AS longpoint, $radio AS radius, 111.045 AS distance_unit ) AS p ON 1=1
      INNER JOIN Imagenes b ON z.idNegocio=b.Referencia
      INNER JOIN Favoritos f ON z.idNegocio=f.idNegocio
      WHERE b.seccion = 'logoNegocio'
        AND f.idUsuario = '$idUsuarioSel'
        AND z.latitud
         BETWEEN p.latpoint  - (p.radius / p.distance_unit)
             AND p.latpoint  + (p.radius / p.distance_unit)
        AND z.longitud
         BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
             AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
    ) AS d
    WHERE distance <= radius
    AND nombre LIKE '%$stringBusqueda%'
    ORDER BY nombre, distance
    LIMIT $inicioInferior, $cantidadAmostrar";
    $result = mysqli_query($FUNCIONES->conexion, $query);

    $queryCuantos = $query;
    $resultCuantos = mysqli_query($FUNCIONES->conexion, $queryCuantos);
    $cuantosNegocios = mysqli_num_rows($resultCuantos);

    if($cuantosNegocios > 0){
        while($row = mysqli_fetch_assoc($result)){
            $latitudNegocio = $FUNCIONES->getLatNegocio($row['idNegocio']);
            $longitudNegocio = $FUNCIONES->getLonNegocio($row['idNegocio']);
            $resultado[] = array(
                'idNegocio' => $row['idNegocio'],
                'nombreNegocio' => $row['nombre'],
                'distancia' => sprintf("%01.2f", $row['distance']),
                'direccion' => $row['direccion'],
                'telefonos' => $row['telefonos'],
                'logo' => $row['logo'],
                'rating' => $FUNCIONES->getRatingDelNegocio($row['idNegocio']),
                'reviews' => $FUNCIONES->getCountReviews($row['idNegocio']),
            );
        }
        echo json_encode($resultado, JSON_PRETTY_PRINT);
    } else {
        echo "ERROR Generating information ";
        //echo "<br>";
        //echo $query;

    }
} else {
    echo "ERROR favorite list";
}