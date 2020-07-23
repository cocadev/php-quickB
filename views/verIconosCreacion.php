<?
include('../control/configuracion.php');
if(!$idUsuario) {
    header('Location: /login'); die;
}
$idIcono = 'ICO_'.$FUNCIONES->generateRandomString(3);
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
                                <h2>Creación de Iconos</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" action="/iconos/creacion/accion" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Nombre</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <input type="text" class="form-control" name="iconoNombre" id="iconoNombre" placeholder="Nombre" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Slug <img id="imgRefreshSlug" style="display: none;" src="/images/cargando.gif"></label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <input type="text" class="form-control" name="iconoSlug" id="iconoSlug" placeholder="Slug" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Descripci&oacute;n</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <input type="text" class="form-control" name="iconoDescripcion" placeholder="Descripci&oacute;n" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Secci&oacute;n</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <select class="form-control" name="iconoSeccion">
                                                <option>Desbloqueado</option>
                                                <option>Bloqueado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Imagen</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idNegocio=<?= $idIcono; ?>&seccion=icono" allowtransparency="true" ></iframe>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="hidden" name="idIcono" value="<?= $idIcono ?>">
                                            <button type="submit" class="btn btn-success">Crear Icono</button>
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
        $("#iconoNombre").keyup(function() {
            $("#imgRefreshSlug").show();
            $.post( "/crea/slug", { string: $(this).val() })
                .done(function( data ) {
                    $("#iconoSlug").val( data );
                    $("#imgRefreshSlug").hide();
                });
        });

    });
</script>
</body>
</html>
