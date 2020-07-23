<?
include('../control/configuracion.php');
if(!$idUsuario) {
    header('Location: /login'); die;
}
if( ($_GET['idCategoria'] == '') ){
    header('Location: /login'); die;
}
$idCategoriaL = mysqli_real_escape_string($FUNCIONES->conexion, $_GET['idCategoria']);
$queryListado = "SELECT * FROM Categorias WHERE idCategoria = '$idCategoriaL' LIMIT 1";
$qTodos = mysqli_query($FUNCIONES->conexion, $queryListado);
while($categoriaInfo = mysqli_fetch_array($qTodos)){
    $nombre = $categoriaInfo['nombre'];
    $slug = $categoriaInfo['slug'];
    $descripcion = $categoriaInfo['descripcion'];
    $fechaCreacion = $categoriaInfo['fechaCreacion'];
}
$id_imagen_categoria = $FUNCIONES->id_imgNS($idCategoriaL,'categoria');
?>
<!doctype html>
<html lang="es">
<head>
    <? include('../includes/htmlHead.php'); ?>
    <link href="/vendors/google-code-prettify/prettify.min.css" rel="stylesheet">
    <link href="/vendors/select2/select2.min.css" rel="stylesheet">
    <link href="/vendors/switchery/switchery.min.css" rel="stylesheet">
    <link href="/vendors/starrr/starrr.css" rel="stylesheet">
    <link href="/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="/css/custom.min.css?id=<?= date('U')?>" rel="stylesheet">
    <link href="/css/tuzacatecas.css?id=<?= date('U')?>" rel="stylesheet">
</head>
<body class="nav-md">
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
                                <h2>Edici&oacute;n de categor&iacute;a <?= $idCategoriaL ?></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" action="/categorias/edicion/accion" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Nombre</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <input type="text" class="form-control" name="categoriaNombre" id="categoriaNombre" placeholder="Nombre" autocomplete="no" value="<?= $nombre ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Slug <img id="imgRefreshSlug" style="display: none;" src="/images/cargando.gif"></label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <input type="text" class="form-control" name="categoriaSlug" id="categoriaSlug" placeholder="Slug" autocomplete="no" value="<?= $slug; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Descripci&oacute;n</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <input type="text" class="form-control" name="categoriaDescripcion" placeholder="Descripci&oacute;n" autocomplete="no" value="<?= $descripcion ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Imagen</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_categoria ?>&idNegocio=<?= $idCategoriaL; ?>&seccion=categoria" allowtransparency="true" ></iframe>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="hidden" name="categoriaIdCategoria" value="<?= $idCategoriaL ?>">
                                            <button type="submit" class="btn btn-success">Editar Categor&iacute;a</button>
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
<script src="/js/custom.js"></script>
<script>
    $(function() {
        $("#categoriaNombre").keyup(function() {
            $("#imgRefreshSlug").show();
            $.post( "/crea/slug", { string: $(this).val() })
                .done(function( data ) {
                    $("#categoriaSlug").val( data );
                    $("#imgRefreshSlug").hide();
                });
        });

    });
</script>
</body>
</html>
