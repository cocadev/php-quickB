<?
/*
 * RewriteRule ^Apis/Business/Detail?$    AppDelivery/verBusinessDetail.php   [NC]
 * Ejemplo https://admin.quickb.mx/Apis/Business/Detail
 */
//$_POST['n'] = '4630719';                    //idNegocio
$_POST['latUsuario'] = '22.772858';         //Latitud usuario
$_POST['lonUsuario'] = '-102.622551';       //Longitud usuario

include('../control/configuracion.php');
if(($_POST['n'] != '')) {
    $latUsuario= $_POST['latUsuario'];         //Latitud usuario
    $lonUsuario = $_POST['lonUsuario'];       //Longitud usuario

    $idNegocio = mysqli_real_escape_string($FUNCIONES->conexion, $_POST['n']);
    $queryImagenes = "SELECT concat('https://admin.quickb.mx/AppDelivery/Imagenes/',$idNegocio,'/',nombreImg) AS imagen FROM Imagenes WHERE Referencia = '$idNegocio' AND seccion LIKE '%galeria_%'";
    $resultImagenes = mysqli_query($FUNCIONES->conexion, $queryImagenes);
    $idImagen = 1;
    while($rowImagenes = mysqli_fetch_array($resultImagenes)){
        $arrayImagenes[] = array(
            'numImage' => $idImagen,
            'image' => $rowImagenes['imagen']
        );
        $idImagen++;
    }
    $queryReviews ="SELECT id, idUsuarioReviewer, review FROM Reviews WHERE idNegocio = '$idNegocio'  ORDER BY fechaCreacion DESC";
    $resultReviews = mysqli_query($FUNCIONES->conexion, $queryReviews);
    while($rowReviews = mysqli_fetch_array($resultReviews)){
        $arrayReviews[] = array(
            'idReview' => $rowReviews['id'],
            'usuario' => $rowReviews['idUsuarioReviewer'],
            //'imagen'=>$FUNCIONES->getNombreImagen($rowReviews['idUsuarioReviewer']),
            'imagen'=> 'https://admin.quickb.mx/AppDelivery/Imagenes/4630719/CY1OEVTAQR.png',
            'name'=>$FUNCIONES->getNombreUsuario($rowReviews['idUsuarioReviewer']),
            'lastname'=>$FUNCIONES->getApellidoUsuario($rowReviews['idUsuarioReviewer']),
            'Comentario' => $rowReviews['review'],
            'rating' => $FUNCIONES->getRatingDelNegocioXUsuario($idNegocio, $rowReviews['idUsuarioReviewer']),
        );
    }

    /*SERVICIOS*/
    $arrayServices = [];
    /*SERVICIOS*/

    $queryInformacion = "SELECT idNegocio AS businessId, nombre AS title, descripcion AS description, concat(domicilio,' ',colonia) AS direction, telefonos AS phone, horario FROM Negocios WHERE idNegocio = '$idNegocio'";
    $result = mysqli_query($FUNCIONES->conexion, $queryInformacion);
        while($row = mysqli_fetch_assoc($result)){
            $resultado[] = array(
                'carouselImages' => $arrayImagenes,
                'bussinesLogo' => $FUNCIONES->getNegocioLogo($idNegocio),
                'bussinesName' => $row['title'],
                'distance' => sprintf("%01.2f", $FUNCIONES->distanciaANegocio($idNegocio, $latUsuario, $lonUsuario)),
                'direction' => $row['direction'],
                'bussinesPhone' => $row['phone'],
                'Hour' => $row['horario'],
                'priceRange' => $FUNCIONES->getPriceRangeNegocio($row['businessId']),
                'rating' => $FUNCIONES->getRatingDelNegocio($row['businessId']),
                'ratingCount' => $FUNCIONES->getRatingVotosDelNegocio($row['businessId']),
                'description' => $row['description'],
                'services' => $arrayServices,
                'reviews' => $arrayReviews,
            );
        }
        //$jsonFinal = ltrim(rtrim(substr(json_encode($resultado, JSON_PRETTY_PRINT), 1),"]"));
        //$jsonFinal = ltrim(rtrim(substr(json_encode($resultado, JSON_PRETTY_PRINT), 1),"]"));
        //echo $jsonFinal;
        echo json_encode($resultado, JSON_PRETTY_PRINT);
} else {
    echo "ERRORbussinesdetail";
}