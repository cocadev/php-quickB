<?
class classQuickb {
    var $datosConexion = array();   // almacena las variables de conexion
    private $querySql;              // cadena sql de consulta
    var $respuesta;                 // resultado de la consulta
    var $resultado;
    var $conexion;

    function __construct() {
        $this->conexion = mysqli_connect('localhost', 'quickb_user', 'KqAI0]Rw%hWW', 'quickb_db');
        if (!$this->conexion) {
            die('Error de Conexion (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
    }
    /*Control*/
    function getConfiguracion($variable){
        $this->querySql = "SELECT valor FROM Configuracion WHERE variable = '$variable'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function sustituye_acentos($str) {
        $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', ' ', '\'', '.', '`', '&', '-y-', '--', ':', ';', '´', 's.a. de c.v.', 'S.A. DE C.V.', '-SA-DE-CV', ' - ', ',','(',')');
        $b = array('a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'd', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'a', 'a', 'a', 'a', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'd', 'd', 'd', 'd', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'g', 'h', 'h', 'h', 'h', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'i', 'ij', 'ij', 'j', 'j', 'k', 'k', 'l', 'l', 'l', 'l', 'l', 'l', 'L', 'l', 'l', 'l', 'n', 'n', 'n', 'n', 'n', 'n', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'oe', 'oe', 'r', 'r', 'r', 'r', 'r', 'r', 's', 's', 's', 's', 's', 's', 's', 's', 't', 't', 't', 't', 't', 't', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'w', 'w', 'y', 'y', 'y', 'z', 'z', 'z', 'z', 'z', 'z', 's', 'f', 'O', 'o', 'u', 'u', 'a', 'a', 'i', 'i', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'a', 'a', 'ae', 'ae', 'O', 'o', '-', '', '', '', '-', '-', '', '-', '-', '', '', '', '', '-','','','');
        return strtolower(str_replace($a, $b, $str));
    }
    function codePass($string){
        $this->querySql = "SELECT PASSWORD( '$string' )";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function generateRandomString($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function generateRandomStringPassword($length) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function stringToHtml($string){
        return htmlspecialchars_decode(htmlentities($string, ENT_NOQUOTES, 'ISO-8859-1'), ENT_NOQUOTES);
    }
    function getStringBetween($str,$from,$to){
        $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
        return substr($sub,0,strpos($sub,$to));
    }
    function fechaHoy(){ //formato MES XX, YYYY
        $diaHoy = date('j');
        $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
        $mesHoy = $meses[date('n')-1];
        $yearHoy = date('Y');
        $fechaActual = $mesHoy." ".$diaHoy.", ".$yearHoy;
        return $fechaActual;
    }
    function mesAMostrar($numeroMes){
        $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
        $mesShow = $meses[$numeroMes - 1];
        return $mesShow;
    }
    function returnJson($arreglo){
        //return '{ "returnData":['.json_encode($arreglo).'] }';
        return json_encode($arreglo);
    }
    function ExcelDateToPhp($EXCEL_DATE){
        $UNIX_DATE = ($EXCEL_DATE - 25569) * 86400;
        return gmdate("Y-m-d", $UNIX_DATE);
    }
    /*Control*/
    /*Usuarios*/

    function getPrimerNombre($idUsuario){
        $this->querySql = "SELECT nombre FROM Usuarios WHERE idUsuario = '$idUsuario' LIMIT 1";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        $nombreParcial = preg_split('/[\s,]+/', $this->resultado[0], 3);
        return $nombreParcial[0];
    }
    function getNombreUsuario($idUsuario){
        $this->querySql = "SELECT nombre FROM Usuarios WHERE idUsuario = '$idUsuario' LIMIT 1";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function getApellidoUsuario($idUsuario){
        $this->querySql = "SELECT apellido FROM Usuarios WHERE idUsuario = '$idUsuario' LIMIT 1";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function getEmailUsuario($idUsuario){
        $this->querySql = "SELECT email FROM Usuarios WHERE idUsuario = '$idUsuario' LIMIT 1";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function esAdministrador($idUsuario){
        $this->querySql = "SELECT count(idUsuario) FROM Usuarios WHERE idUsuario = '$idUsuario' AND nivel = 'AD' LIMIT 1";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function emailSocialExiste($email){
        $this->querySql = "SELECT count(socialEmail) FROM Usuarios WHERE socialEmail = '$email' LIMIT 1";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function GetTipoUsuario($idUsuario){
        $this->querySql = "SELECT tipoUsuario FROM Usuarios WHERE idUsuario = '$idUsuario' LIMIT 1";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    /*Usuarios*/
    /*Imagenes*/
    function getNombreImagen($Referencia) {
        $this->querySql = "SELECT concat('https://admin.quickb.mx/AppDelivery/Imagenes/$Referencia/',nombreImg) AS image FROM Imagenes WHERE Referencia = '$Referencia'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function getNegocioLogo($Referencia) {
        $this->querySql = "SELECT concat('https://admin.quickb.mx/AppDelivery/Imagenes/',$Referencia,'/',nombreImg) AS imagen FROM Imagenes WHERE Referencia = '$Referencia' AND seccion =  'logoNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    /*Imagenes*/
    /*Negocios*/
    function getSlug($idNegocio) {
        $this->querySql = "SELECT slug FROM Negocios WHERE idNegocio = '$idNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function imgNS($idNegocio, $seccion) {
        $this->querySql = "SELECT nombreImg FROM Imagenes WHERE Referencia = '$idNegocio' && seccion = '$seccion'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function id_imgNS($idNegocio, $seccion) {
        $this->querySql = "SELECT idImagen FROM Imagenes WHERE Referencia = '$idNegocio' && seccion = '$seccion'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function get_existe_idImagen($idImagen) {
        $this->querySql = "SELECT count(idImagen) FROM Imagenes WHERE idImagen = '$idImagen'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function get_existe_imagen($Referencia, $seccion) {
        $this->querySql = "SELECT count(idImagen) FROM Imagenes WHERE Referencia = '$Referencia' AND seccion = '$seccion'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function getTotalNegocios() {
        $this->querySql = "SELECT COUNT(idNegocio) FROM Negocios";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function getTotalUsuarios() {
        $this->querySql = "SELECT COUNT(idUsuario) FROM Usuarios";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function getTotalCategorias() {
        $this->querySql = "SELECT COUNT(idCategoria) FROM Categorias";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function getTotalIconos() {
        $this->querySql = "SELECT COUNT(idIcono) FROM Iconos";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function getRatingDelNegocio($idNegocio){
        $this->querySql = "SELECT AVG(rating) FROM NegociosRatings WHERE idNegocio = '$idNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql) or die(mysqli_error($this->conexion));
        $this->resultado = mysqli_fetch_array($this->respuesta);
        if($this->resultado[0]) { $resultado = $this->resultado[0]; } else {$resultado = 0;}
        return $resultado;
    }
    function getPriceRangeNegocio($idNegocio){
        $this->querySql = "SELECT AVG(price) FROM NegociosPriceRange WHERE idNegocio = '$idNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql) or die(mysqli_error($this->conexion));
        $this->resultado = mysqli_fetch_array($this->respuesta);
        if($this->resultado[0] <= 1) { $resultado = "$"; }
        elseif ($this->resultado[0] == 2) {$resultado = "$$";}
        elseif ($this->resultado[0] == 3) {$resultado = "$$$";}
        elseif ($this->resultado[0] == 4) {$resultado = "$$$$";}
        elseif ($this->resultado[0] == 5) {$resultado = "$$$$$";}
        return $resultado;
    }
    function getRatingDelNegocioXUsuario($idNegocio, $idUsuario){
        $this->querySql = "SELECT rating FROM NegociosRatings WHERE idNegocio = '$idNegocio' AND idUsuario = '$idUsuario'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql) or die(mysqli_error($this->conexion));
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function getRatingVotosDelNegocio($idNegocio){
        $this->querySql = "SELECT count(id) FROM NegociosRatings WHERE idNegocio = '$idNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql) or die(mysqli_error($this->conexion));
        $this->resultado = mysqli_fetch_array($this->respuesta);
        if($this->resultado[0]) { $resultado = $this->resultado[0]; } else {$resultado = 0;}
        return $resultado;
    }
    function getCountReviews($idNegocio){
        $this->querySql = "SELECT count(id) FROM Reviews WHERE idNegocio = '$idNegocio' and aprobado = 1";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql) or die(mysqli_error($this->conexion));
        $this->resultado = mysqli_fetch_array($this->respuesta);
        if($this->resultado[0]) { $resultado = $this->resultado[0]; } else {$resultado = 0;}
        return $resultado;
    }
    function getLatNegocio($idNegocio){
        $this->querySql = "SELECT latitud FROM Negocios WHERE idNegocio = '$idNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql) or die(mysqli_error($this->conexion));
        $this->resultado = mysqli_fetch_array($this->respuesta);
        if($this->resultado[0]) { $resultado = $this->resultado[0]; } else {$resultado = 0;}
        return $resultado;
    }
    function getLonNegocio($idNegocio){
        $this->querySql = "SELECT longitud FROM Negocios WHERE idNegocio = '$idNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql) or die(mysqli_error($this->conexion));
        $this->resultado = mysqli_fetch_array($this->respuesta);
        if($this->resultado[0]) { $resultado = $this->resultado[0]; } else {$resultado = 0;}
        return $resultado;
    }
    function getDireccionNegocio($idNegocio){
        $this->querySql = "SELECT concat(domicilio,' ',colonia) FROM Negocios WHERE idNegocio = '$idNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql) or die(mysqli_error($this->conexion));
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    function getNombreNegocio($idNegocio){
        $this->querySql = "SELECT nombre FROM Negocios WHERE idNegocio = '$idNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql) or die(mysqli_error($this->conexion));
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    /*Negocios*/
    /*Categorias*/
    function getNombreCategoria($idCategoria) {
        $this->querySql = "SELECT nombre FROM Categorias WHERE idCategoria = '$idCategoria'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    /*Categorias*/
    function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
        // Cálculo de la distancia en grados
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));

        // Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
        switch($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
                break;
            case 'mi':
                $distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
                break;
            case 'nmi':
                $distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
        }
        return round($distance, $decimals);
    }
    function distanciaANegocio($idNegocio, $latitudActual, $longitudActual){
        $this->querySql = "SELECT 
             p.distance_unit
                     * DEGREES(ACOS(COS(RADIANS(p.latpoint))
                     * COS(RADIANS(z.latitud))
                     * COS(RADIANS(p.longpoint - z.longitud))
                     + SIN(RADIANS(p.latpoint))
                     * SIN(RADIANS(z.latitud)))) AS distance
      FROM Negocios AS z
      JOIN ( SELECT '$latitudActual' AS latpoint, '$longitudActual' AS longpoint, 111.045 AS distance_unit ) AS p ON 1=1
      WHERE z.idNegocio = '$idNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    /*NegociosLikes*/
    function existeLike($idUsuario, $idNegocio) {
        $this->querySql = "SELECT count(id) FROM NegociosLikes WHERE idUsuario = '$idUsuario' AND idNegocio = '$idNegocio'";
        $this->respuesta = mysqli_query($this->conexion, $this->querySql);
        $this->resultado = mysqli_fetch_array($this->respuesta);
        return $this->resultado[0];
    }
    /*NegociosLikes*/
}