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
            <div class="row tile_count">
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-university"></i> Total Negocios</span>
                    <div class="count"><?= number_format($FUNCIONES->getTotalNegocios()); ?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-child"></i> Total Usuarios</span>
                    <div class="count"><?= number_format($FUNCIONES->getTotalUsuarios()); ?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-suitcase"></i> Total Categorias</span>
                    <div class="count"><?= number_format($FUNCIONES->getTotalCategorias()); ?></div>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-calendar-o"></i> Total Iconos</span>
                    <div class="count"><?= number_format($FUNCIONES->getTotalIconos()); ?></div>
                </div>
            </div>
        </div>
        <? include('../includes/footer.php');?>
    </div>
</div>
<? include('../includes/js.php'); ?>
<script src="/vendors/moment/moment.min.js"></script>
<script src="/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/js/custom.js"></script>
</body>
</html>
