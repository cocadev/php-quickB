<?
include('../control/configuracion.php');
if(!$idUsuario) {
    header('Location: /login'); die;
}
if( ($_GET['idNegocio'] == '') ){
    header('Location: /login'); die;
}
$idNegocioL = mysqli_real_escape_string($FUNCIONES->conexion, $_GET['idNegocio']);
$queryListado = "SELECT * FROM Negocios WHERE idNegocio = '$idNegocioL' LIMIT 1";
$qTodos = mysqli_query($FUNCIONES->conexion, $queryListado);
while($negocioInfo = mysqli_fetch_array($qTodos)){
    $idCategoria = $negocioInfo['idCategoria'];
    $nombre = $negocioInfo['nombre'];
    $slug = $negocioInfo['slug'];
    $razonSocial = $negocioInfo['razonSocial'];
    $rfc = $negocioInfo['rfc'];
    $scian = $negocioInfo['scian'];
    $subcategoria = $negocioInfo['subcategoria'];
    $domicilio = $negocioInfo['domicilio'];
    $colonia = $negocioInfo['colonia'];
    $codigoPostal = $negocioInfo['codigoPostal'];
    $municipio = $negocioInfo['municipio'];
    $estado = $negocioInfo['estado'];
    $telefonos = $negocioInfo['telefonos'];
    $paginaWeb = $negocioInfo['paginaWeb'];
    $email = $negocioInfo['email'];
    $descripcion = $negocioInfo['descripcion'];
    $horario = $negocioInfo['horario'];
    $latitud = $negocioInfo['latitud'];
    $longitud = $negocioInfo['longitud'];
    $fechaContratacion = $negocioInfo['fechaContratacion'];
    $fechaInicio = $negocioInfo['fechaInicio'];
    $fechaTermino = $negocioInfo['fechaTermino'];
}
if($FUNCIONES->imgNS($idNegocioL,'marcadorGoogleMap')){
    $marcadorUser = "https://admin.quickb.mx/AppDelivery/$idNegocioL/".$FUNCIONES->imgNS($idNegocioL,'marcadorGoogleMap');
} else {
    $marcadorUser = "/images/defaultMarker.png";
}
$id_imagen_logoFacebook = $FUNCIONES->id_imgNS($idNegocioL,'facebook');
$id_imagen_logoNegocio = $FUNCIONES->id_imgNS($idNegocioL,'logoNegocio');
$id_imagen_logoNegocioVertical = $FUNCIONES->id_imgNS($idNegocioL,'logoNegocioVertical');
$id_imagen_MarcadorGoogleMap = $FUNCIONES->id_imgNS($idNegocioL,'marcadorGoogleMap');
$id_imagen_galeria_a = $FUNCIONES->id_imgNS($idNegocioL,'galeria_a');
$id_imagen_galeria_b = $FUNCIONES->id_imgNS($idNegocioL,'galeria_b');
$id_imagen_galeria_c = $FUNCIONES->id_imgNS($idNegocioL,'galeria_c');
$id_imagen_galeria_d = $FUNCIONES->id_imgNS($idNegocioL,'galeria_d');
$id_imagen_galeria_e = $FUNCIONES->id_imgNS($idNegocioL,'galeria_e');
$id_imagen_galeria_f = $FUNCIONES->id_imgNS($idNegocioL,'galeria_f');
$id_imagen_galeria_g = $FUNCIONES->id_imgNS($idNegocioL,'galeria_g');
$id_imagen_galeria_h = $FUNCIONES->id_imgNS($idNegocioL,'galeria_h');
?>
<!doctype html>
<html lang="es">
<head>
    <? include('../includes/htmlHead.php'); ?>
    <link href="/vendors/google-code-prettify/prettify.min.css" rel="stylesheet">
    <link href="/vendors/select2/select2.min.css" rel="stylesheet">
    <link href="/vendors/switchery/switchery.min.css" rel="stylesheet">
    <link href="/vendors/starrr/starrr.css" rel="stylesheet">
    <link href="/css/custom.min.css?id=<?= date('U')?>" rel="stylesheet">
    <link href="/css/main.css?id=<?= date('U')?>" rel="stylesheet">
</head>
<body class="nav-md" onload="initializeGMEdit('<?= $latitud; ?>','<?= $longitud; ?>','<?= $marcadorUser; ?>')">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <? include('../includes/sidebar.php'); ?>
        </div>
        <? include('../includes/nav.php'); ?>
        <div class="right_col" role="main">
            <div class="">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Detalle y Edición negocio <?= $idNegocioL; ?></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" action="/negocios/edicion/accion" method="post">
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="control-label">Nombre</label>
                                            <input type="text" class="form-control" name="negocioNombre" id="negocioNombre" placeholder="Nombre" value="<?= $nombre ?>" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="control-label">Descripci&oacuten</label>
                                            <textarea name="negocioDescripcion" class="form-control" rows="15" placeholder="Descripción"><?= $descripcion ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label class="control-label">Categor&iacute;a</label>
                                            <select class="form-control" name="negocioIdCategoria">
                                                <option value="-">Selecciona una opci&oacute;n</option>
                                                <?
                                                $result = mysqli_query($FUNCIONES->conexion, "SELECT idCategoria, nombre FROM Categorias");
                                                while($row = mysqli_fetch_array($result)){ ?>
                                                    <option value="<?= $row['idCategoria']; ?>" <? if($row['idCategoria'] == $idCategoria){ echo "selected"; }?>><?= $row['nombre']; ?></option>
                                                <? } ?>
                                            </select>

                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label class="control-label">Subcategor&iacute;a</label>
                                            <input type="text" class="form-control" name="negocioSubcategoria" placeholder="Sub Categor&iacute;a" value="<?= $subcategoria ?>" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="control-label">Raz&oacute;n Social</label>
                                            <input type="text" class="form-control" name="negocioRazonSocial" placeholder="Raz&oacute;n Social" value="<?= $razonSocial ?>" autocomplete="no">
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">Slug</label><img id="imgRefreshSlug" style="display: none;" src="/images/cargando.gif">
                                            <input type="text" class="form-control" name="negocioSlug" placeholder="Slug" id="negocioSlug" value="<?= $slug; ?>" autocomplete="no">
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">RFC</label>
                                            <input type="text" class="form-control" name="negocioRfc" placeholder="RFC" value="<?= $rfc; ?>" autocomplete="no">
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <label class="control-label">SCIAN</label>
                                            <input type="text" class="form-control" name="negocioScian" placeholder="SCIAN" value="<?= $scian; ?>" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <label class="control-label">Domicilio</label>
                                            <input type="text" class="form-control" name="negocioDomicilio" placeholder="Domicilio" value="<?= $domicilio ?>" autocomplete="no">
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <label class="control-label">Horario <small>ej. L-V 9:00AM a 8:00PM</small></label>
                                            <input type="text" class="form-control" name="negocioHorario" placeholder="Horario" value="<?= $horario; ?>" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="control-label">Colonia</label>
                                            <input type="text" class="form-control" name="negocioColonia" placeholder="Raz&oacute;n Social" value="<?= $colonia ?>" autocomplete="no">
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">C&oacute;digo Postal</label>
                                            <input type="text" class="form-control" name="negocioCodigoPostal" placeholder="C&oacute;digo Postal" value="<?= $codigoPostal; ?>" autocomplete="no">
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12">
                                            <label class="control-label">Municipio</label>
                                            <input type="text" class="form-control" name="negocioMunicipio" placeholder="Municipio" value="<?= $municipio; ?>" autocomplete="no">
                                        </div>
                                        <div class="col-md-2 col-sm-2 col-xs-12">
                                            <label class="control-label">Estado</label>
                                            <input type="text" class="form-control" name="negocioEstado" placeholder="Estado" value="<?= $estado; ?>" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="control-label">Tel&eacute;fonos</label>
                                            <input type="text" class="form-control" name="negocioTelefonos" placeholder="Tel&eacute;fonos" value="<?= $telefonos ?>" autocomplete="no">
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="control-label">Pagina Web</label>
                                            <input type="text" class="form-control" name="negocioPaginaweb" placeholder="Pagina Web" value="<?= $paginaWeb; ?>" autocomplete="no">
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="control-label">Email</label>
                                            <input type="text" class="form-control" name="negocioEmail" placeholder="Email" value="<?= $email; ?>" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="control-label">Fecha Contratacion</label>
                                            <span><?= $fechaContratacion?></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="control-label">Fecha Inicio</label>
                                            <span><?= $fechaInicio?></span>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                            <label class="control-label">Fecha Termino</label>
                                            <input name="negocioFechaTermino" type="text" id="negocioFechaTermino" size="15" value="<?= $fechaTermino; ?>">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="control-label">Ubicaci&oacute;n Google Maps</label><br>
                                            <div id="googleMap" style="width: 100%; height: 400px"></div>
                                            <span class="textosGeneral">Latitud</span>
                                            <input name="negocioLatitud" type="text" id="latitud" readonly="readonly" value="<?= $latitud; ?>">
                                            <span class="textosGeneral">Longitud</span>
                                            <input name="negocioLongitud" type="text" id="longitud" readonly="readonly" value="<?= $longitud; ?>">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="control-label">Im&aacute;genes</label><br>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 fondoImagenes">
                                            <label class="control-label">Logotipo para Facebook (jpg) 200W x 200H px</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_logoFacebook ?>&idNegocio=<?= $idNegocioL; ?>&seccion=facebook" allowtransparency="true" ></iframe>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 fondoImagenes">
                                            <label class="control-label">Logotipo para listado general, minisitio, horizontal (jpg) 296W x 181H px</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_logoNegocio ?>&idNegocio=<?= $idNegocioL; ?>&seccion=logoNegocio" allowtransparency="true" ></iframe>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 fondoImagenes">
                                            <label class="control-label">Logotipo para listado general, minisitio, vertical 181W x 296H px</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_logoNegocioVertical ?>&idNegocio=<?= $idNegocioL; ?>&seccion=logoNegocioVertical" allowtransparency="true" ></iframe>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12 fondoImagenes">
                                            <label class="control-label">Marcador Google Map (png) 35W x 30H px</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_MarcadorGoogleMap ?>&idNegocio=<?= $idNegocioL; ?>&seccion=marcadorGoogleMap" allowtransparency="true" ></iframe>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 col-sm-3 col-xs-12 fondoImagenes">
                                            <label class="control-label">Galer&iacute;a a</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_galeria_a ?>&idNegocio=<?= $idNegocioL; ?>&seccion=galeria_a" allowtransparency="true" ></iframe>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12 fondoImagenes">
                                            <label class="control-label">Galer&iacute;a b</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_galeria_b ?>&idNegocio=<?= $idNegocioL; ?>&seccion=galeria_b" allowtransparency="true" ></iframe>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12 fondoImagenes">
                                            <label class="control-label">Galer&iacute;a c</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_galeria_c ?>&idNegocio=<?= $idNegocioL; ?>&seccion=galeria_c" allowtransparency="true" ></iframe>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12 fondoImagenes">
                                            <label class="control-label">Galer&iacute;a d</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_galeria_d ?>&idNegocio=<?= $idNegocioL; ?>&seccion=galeria_d" allowtransparency="true" ></iframe>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-3 col-sm-3 col-xs-12 fondoImagenes">
                                            <label class="control-label">Galer&iacute;a e</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_galeria_e ?>&idNegocio=<?= $idNegocioL; ?>&seccion=galeria_e" allowtransparency="true" ></iframe>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12 fondoImagenes">
                                            <label class="control-label">Galer&iacute;a f</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_galeria_f ?>&idNegocio=<?= $idNegocioL; ?>&seccion=galeria_f" allowtransparency="true" ></iframe>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12 fondoImagenes">
                                            <label class="control-label">Galer&iacute;a g</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_galeria_g ?>&idNegocio=<?= $idNegocioL; ?>&seccion=galeria_g" allowtransparency="true" ></iframe>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-12 fondoImagenes">
                                            <label class="control-label">Galer&iacute;a h</label><br>
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_galeria_h ?>&idNegocio=<?= $idNegocioL; ?>&seccion=galeria_h" allowtransparency="true" ></iframe>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="hidden" class="form-control" name="idNegocio" id="idNegocio" placeholder="" value="<?= $idNegocioL; ?>" >
                                            <button type="submit" class="btn btn-success">Guardar Negocio</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <? include('../includes/footer.php');?>
    </div>
</div>
<? include('../includes/js.php'); ?>
<script src="/vendors/moment/moment.min.js"></script>
<script src="/vendors/bootstrap-wysiwyg/bootstrap-wysiwyg.min.js"></script>
<script src="/vendors/jquery-hotkeys/jquery.hotkeys.js"></script>
<script src="/vendors/google-code-prettify/prettify.js"></script>
<script src="/vendors/jquery-tagsinput/jquery.tagsinput.js"></script>
<script src="/vendors/switchery/switchery.min.js"></script>
<script src="/vendors/select2/select2.full.min.js"></script>
<script src="/vendors/autosize/autosize.min.js"></script>
<script src="/vendors/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
<script src="/vendors/starrr/starrr.js"></script>
<script src="/vendors/jquery/jquery-ui-core.js"></script>
<script src="/js/custom.js"></script>
<script type="text/javascript" src="https://maps-api-ssl.google.com/maps/api/js?key=<?= $apiKeyGoogle ?>"></script>
<script src="/js/googleMapsEdit.js"></script>
<script>
    $(function() {
        var dates = $( "#negocioFechaInicio, #negocioFechaTermino" ).datepicker({
            showOn: "button",
            buttonImage: "/images/calendario.gif",
            buttonImageOnly: false,
            defaultDate: "+1d",
            changeMonth: true,
            numberOfMonths: 1,
            dateFormat: "yy-mm-dd",
            onSelect: function( selectedDate ) {
                var option = this.id == "fechaInicio" ? "minDate" : "maxDate",
                    instance = $( this ).data( "datepicker" ),
                    date = $.datepicker.parseDate(
                        instance.settings.dateFormat ||
                        $.datepicker._defaults.dateFormat,
                        selectedDate, instance.settings );
                dates.not( this ).datepicker( "option", option, date );
            }
        });

        $("#negocioNombre").keyup(function() {
            $("#imgRefreshSlug").show();
            $.post( "/crea/slug", { string: $(this).val() })
                .done(function( data ) {
                    $("#negocioSlug").val( data );
                    $("#imgRefreshSlug").hide();
                });
        });

    });
</script>
</body>
</html>