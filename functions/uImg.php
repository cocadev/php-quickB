<?
include('../control/configuracion.php');
if(!$idUsuario) {
    header('Location: /login'); die;
}
$up_id = md5(uniqid(rand()));
$idImagen = $_GET['idImagen'];
$idNegocio = $_GET['idNegocio'];
$seccion = $_GET['seccion'];
$directorioNegocio = $pathArchivos.$idNegocio.'/';
if(isset($_GET['bua'])) {
	$borrar = mysqli_query($FUNCIONES->conexion, "SELECT * FROM Imagenes WHERE idImagen = '$_GET[bua]'");
	while($rowBorrar = mysqli_fetch_array($borrar)){
		$imgDel = $directorioNegocio.$rowBorrar['nombreImg'];
		unlink($imgDel);
	}
	mysqli_query($FUNCIONES->conexion, "DELETE FROM Imagenes WHERE idImagen = '$_GET[bua]'");
	$redirect = 'uImg.php?idNegocio='.$idNegocio.'&seccion='.$seccion;
	header('Location: '.$redirect); die;
}
if ($_POST) {
    $idNegocio = $_POST['idNegocio'];
	$seccion = $_POST['seccion'];
	$idImagen =  $FUNCIONES->generateRandomString(10);
    if (!is_dir($directorioNegocio)) {
        if(!mkdir($directorioNegocio, 0755, true)) {
            echo "Error al crear directorio";
        }
    }
	$archivoTemporal = $_FILES['file']['tmp_name'];
	$nombreArchivoTemporal = $_FILES['file']['name'];
	$tipo = $_FILES["file"]["type"];
	$partesArchivo = pathinfo($nombreArchivoTemporal);
	$nombreArchivoFinal = $idImagen.'.'.$partesArchivo['extension'];
	if(($tipo == "image/gif") || ($tipo == "image/png") || ($tipo == "image/jpeg") || ($tipo == "image/jpg") || ($tipo == "image/bmp") || ($tipo == "image/x-png") || ($tipo == "image/pjpeg")){
		$archivoRutaCompleta = $directorioNegocio.$nombreArchivoFinal;
		if(move_uploaded_file($archivoTemporal, $archivoRutaCompleta)){
			$flag = 'SUC';
		} else {
			$flag = 'ERR';
		}
	} else {
		echo "Archivo Invalido";
	}
	$fechaCreacion = date('Y-m-d H:m:s');
	$queryInsert = "INSERT INTO Imagenes (idImagen, Referencia, nombreImg, tipo, seccion, fechaCreacion) VALUES ('$idImagen', '$idNegocio', '$nombreArchivoFinal', '$tipo', '$seccion', '$fechaCreacion')";
	mysqli_query($FUNCIONES->conexion, $queryInsert);
	$redirect = 'uImg.php?idImagen='.$idImagen.'&idNegocio='.$idNegocio.'&seccion='.$seccion;
	header('Location: '.$redirect); 
	die;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>:: Archivos ::</title>
<link href="/css/barraProgreso.css" rel="stylesheet">
<script src="/vendors/jquery/jquery.min.js"></script>
<script>
$(document).ready(function() { 
	var show_bar = 0;
	$("#file").change(function(){
		show_bar = 1;
			$('#upload_frame').show();
			function set () {
				$('#upload_frame').attr('src','upload_frame.php?up_id=<?= $up_id; ?>');
			}
			setTimeout(set);		
    });
});
</script>
</head>
<body>
<?
$qTodas = mysqli_query($FUNCIONES->conexion, "SELECT * FROM Imagenes WHERE idImagen = '$idImagen'");
$totalFotos = mysqli_num_rows($qTodas);
$datosImg = mysqli_query($FUNCIONES->conexion, "SELECT * FROM Imagenes WHERE idImagen = '$idImagen'");
while($datos = mysqli_fetch_array($datosImg)){
	echo '<img border="0" width="25" height="25" align="absmiddle" src="https://admin.quickb.mx/AppDelivery/Imagenes/'.$datos['Referencia'].'/'.$datos['nombreImg'].'" alt="'.$datos['Referencia'].'">';
?>
&nbsp;<a href="uImg.php?idNegocio=<?= $idNegocio; ?>&bua=<?= $datos['idImagen']; ?>&seccion=<?= $seccion; ?>"><img src="/imagenes/b_drop.png" width="16" height="16" border="0" align="absmiddle" title="BORRAR"/></a>
<br>
<? } ?>
<div>
  <? if($totalFotos < 1) { ?>
  <form action="<? $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <input type="hidden" name="APC_UPLOAD_PROGRESS" id="progress_key" value="<?=  $up_id; ?>"/>
    <input name="idNegocio" type="hidden" value="<?= $idNegocio; ?>" />
    <input name="seccion" type="hidden" value="<?= $seccion; ?>" />
    <input name="file" type="file" id="file" size="30" onchange="this.form.submit();"/>
    <iframe id="upload_frame" name="upload_frame" frameborder="0" border="0" src="" scrolling="no" scrollbar="no" allowtransparency="true" /></iframe>
  </form>
  <? } ?>
  </div>
</body>
</html>