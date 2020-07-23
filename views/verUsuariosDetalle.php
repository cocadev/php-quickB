<?
include('../control/configuracion.php');
if(!$idUsuario) {
    header('Location: /login'); die;
}
if( ($_GET['idUsuario'] == '') ){
    header('Location: /login'); die;
}
$idUsuarioL = mysqli_real_escape_string($FUNCIONES->conexion, $_GET['idUsuario']);
$queryListado = "SELECT * FROM Usuarios WHERE idUsuario = '$idUsuarioL' LIMIT 1";
$qTodos = mysqli_query($FUNCIONES->conexion, $queryListado);
while($usuarioInfo = mysqli_fetch_array($qTodos)){
    $email = $usuarioInfo['email'];
    $nombre = $usuarioInfo['nombre'];
    $apellido = $usuarioInfo['apellido'];
    $telefono = $usuarioInfo['telefono'];
    $tipoUsuario = $usuarioInfo['tipoUsuario'];
    $fechaRegistro = $usuarioInfo['fechaRegistro'];
}
$id_imagen_perfil = $FUNCIONES->id_imgNS($idUsuarioL,'perfil');
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
                                <h2>Detalle y Edición usuario <?= $idUsuarioL; ?></h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <form class="form-horizontal form-label-left" action="/usuarios/edicion/accion" method="post">
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Usuario (email)</label>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <input type="text" class="form-control" name="usuarioEmail" placeholder="Usuario (email)" value="<?= $email; ?>" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Nombre</label>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <input type="text" class="form-control" name="usuarioNombre" placeholder="Nombre" value="<?= $nombre ?>" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Apellido</label>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <input type="text" class="form-control" name="usuarioApellido" placeholder="Apellido" value="<?= $apellido ?>" autocomplete="no">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Nivel</label>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <select class="form-control" name="tipoUsuario">
                                                <option value="">Selecciona una opci&oacute;n</option>
                                                <option value="BA" <? if($tipoUsuario == 'Administrador'){ echo 'selected';} ?>>Administrador</option>
                                                <option value="PR" <? if($tipoUsuario == 'Negocio'){ echo 'selected';} ?>>Negocio</option>
                                                <option value="PU" <? if($tipoUsuario == 'General'){ echo 'selected';} ?>>General</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Imagen</label>
                                        <div class="col-md-10 col-sm-10 col-xs-12">
                                            <iframe scrolling="no" frameborder="0" width="330" height="45" src="/functions/uImg.php?idImagen=<?= $id_imagen_perfil ?>&idNegocio=<?= $idUsuarioL; ?>&seccion=perfil" allowtransparency="true" ></iframe>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-2 col-sm-offset-2">
                                            <label class="control-label">Fecha Creación</label><br>
                                           <span class="textoEnDetalle"><?= $fechaRegistro ?></span>
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="hidden" class="form-control" name="idUsuario" id="idUsuario" placeholder="" value="<?= $idUsuarioL; ?>" >
                                            <button type="submit" class="btn btn-success">Guardar Usuario</button>
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
<script src="/js/custom.js"></script>
</body>
</html>
