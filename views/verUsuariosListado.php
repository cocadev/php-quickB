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
    <link href="/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/datatables/scroller.bootstrap.min.css" rel="stylesheet">
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
                                <h2>Listado Usuarios</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <table id="listado" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th width="20%" style="width: 20%">#</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Email</th>
                                        <th>Tipo Usuario</th>
                                        <th>Activo</th>
                                        <th>Fecha Registro</th>
                                    </tr>
                                    </thead>
                                </table>
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
<script src="/vendors/datatables/jquery.dataTables.min.js"></script>
<script src="/vendors/datatables/dataTables.bootstrap.min.js"></script>
<script src="/vendors/datatables/dataTables.buttons.min.js"></script>
<script src="/vendors/datatables/buttons.bootstrap.min.js"></script>
<script src="/vendors/datatables/buttons.flash.min.js"></script>
<script src="/vendors/datatables/buttons.html5.min.js"></script>
<script src="/vendors/datatables/buttons.print.min.js"></script>
<script src="/vendors/datatables/dataTables.fixedHeader.min.js"></script>
<script src="/vendors/datatables/dataTables.keyTable.min.js"></script>
<script src="/vendors/datatables/dataTables.responsive.min.js"></script>
<script src="/vendors/datatables/responsive.bootstrap.js"></script>
<script src="/vendors/datatables/dataTables.scroller.min.js"></script>
<script src="/vendors/jszip/jszip.min.js"></script>
<script src="/vendors/pdfmake/pdfmake.min.js"></script>
<script src="/vendors/pdfmake/vfs_fonts.js"></script>
<script src="/js/custom.js"></script>
<script>
    $(function(){
        $('#listado thead th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="'+title+'" />' );
        } );
        var table = $('#listado').DataTable({
            "autoWidth": false,
            "order": [1, 'asc'],
            "pageLength": 25,
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "/usuarios/listado/ajax",
                type: "GET"
            },
            "columnDefs": [
                {"targets": 0, "data": 0, "render": function (data) {return '<a href="/usuarios/detalle/' + data + '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> ' + data + '';}},
                {"targets": 1, "render": function (data) {return data;}},
                {"targets": 2, "render": function (data) {return data;}},
                {"targets": 3, "render": function (data) {return data;}},
                {"targets": 4, "render": function (data) {return data;}},
                {"targets": 5, "render": function (data) {return data;}},
                {"targets": 6, "render": function (data) {return data;}}
            ]
        });
        table.columns().every( function () {
            var that = this;
            $( 'input', this.header() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    });
</script>
</body>
</html>