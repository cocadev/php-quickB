<?
include('../control/configuracion.php');
if(!$idUsuario) {
    header('Location: /login'); die;
}
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
                                <h2>Creación de usuarios</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" action="/usuarios/creacion/accion" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Email</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <input type="text" class="form-control" name="usuarioEmail" placeholder="Email" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Nombre</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <input type="text" class="form-control" name="usuarioNombre" placeholder="Nombre" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Teléfono</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <input type="text" class="form-control" name="usuarioTelefono" placeholder="Teléfono" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-1 col-sm-1 col-xs-12">Nivel</label>
                                        <div class="col-md-11 col-sm-11 col-xs-12">
                                            <select class="form-control" name="usuarioNivel">
                                                <option value="">Selecciona una opci&oacute;n</option>
                                                <option value="BA">BA - B&aacute;sico</option>
                                                <option value="PR">PR - Premium</option>
                                                <option value="PU">PU - Publicidad</option>
                                                <? if($FUNCIONES->esAdministrador($idUsuario)){ ?>
                                                    <option value="AD">AD - Administrador</option>
                                                    <option value="EQ">EQ - Equipo TuZacatecas</option>
                                                <? } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <button type="reset" class="btn btn-primary">Borrar</button>
                                            <button type="submit" class="btn btn-success">Crear Usuario</button>
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
<script src="/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/vendors/bootstrap-wysiwyg/bootstrap-wysiwyg.min.js"></script>
<script src="/vendors/jquery-hotkeys/jquery.hotkeys.js"></script>
<script src="/vendors/google-code-prettify/prettify.js"></script>
<script src="/vendors/jquery-tagsinput/jquery.tagsinput.js"></script>
<script src="/vendors/switchery/switchery.min.js"></script>
<script src="/vendors/select2/select2.full.min.js"></script>
<script src="/vendors/autosize/autosize.min.js"></script>
<script src="/vendors/devbridge-autocomplete/jquery.autocomplete.min.js"></script>
<script src="/vendors/starrr/starrr.js"></script>
<script src="/js/custom.js"></script>
<script src="/vendors/dropzone/dropzone.min.js"></script>
<script>
    $(function(){

    });
</script>
</body>
</html>
