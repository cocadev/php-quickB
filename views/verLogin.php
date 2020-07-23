<?
include("../control/configuracion.php");
$error = isset($_GET['error']) ? $_GET['error'] : false;
?>
<!doctype html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/favicon.ico">
    <title>QUICKB</title>
    <link href="/vendors/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="/vendors/font-awesome/font-awesome.min.css" rel="stylesheet">
    <link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="/vendors/animate/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="/css/custom.min.css" rel="stylesheet">
</head>
<body class="login">
<div>
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form class="form-signin" action="/login/action" method="post">
                    <h1>ADMIN QUICKB</h1>
                    <div>
                        <input name="email" type="text" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input name="password" type="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <?
                    $mensaje = '';
                    if($error) {
                        switch ($error){
                            case "usuario":
                                $mensaje = "El usuario ya tiene una sesión activa.";
                                break;
                            case "acceso":
                                $mensaje = "User ID y/o contraseña incorrecto.";
                                break;
                        }
                        ?>
                        <div>
                            <label class="error-box red" style="color: #ff0000;font-size: 11px;">ERROR: <?= $mensaje ?></label>
                        </div>
                    <? } ?>
                    <div>
                        <button class="btn btn-primary submit" type="submit">Entrar</button>
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        <div>
                            <p><?= date('Y') ?></p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
</body>
</html>