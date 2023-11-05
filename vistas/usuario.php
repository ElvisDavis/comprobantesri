<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EcuaFacturas|Descarga Comprobantes SRI</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

</head>

<body class="hold-transition skin-purple-light sidebar-mini">
    <div class="wrapper">

        <header class="main-header">

            <!-- Logo -->
            <a href="index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>Ecua</b>Facturas</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>EcuaFacturas</b></span>
            </a>

            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Navegación</span>
                </a>
                <!-- Navbar Right Menu -->


            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header"></li>
                    <li>
                        <a href="#">
                            <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                            <small class="label pull-right bg-red">PDF</small>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                            <small class="label pull-right bg-yellow">IT</small>
                        </a>
                    </li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">Ingreso de Usuario
                                </h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->

                            <div class="panel-body" id="formularioregistros">
                                <form name="formulario" id="formulario" method="POST">
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Nombres(*):</label>
                                        <input type="hidden" name="idusuario" id="idusuario">
                                        <input type="text" class="form-control" name="nombre" id="nombre"
                                            maxlength="100" placeholder="Ingrese nombres completos" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Email(*):</label>
                                        <input type="email" class="form-control" name="email" id="email" maxlength="50"
                                            placeholder="Email">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Celular:</label>
                                        <input type="text" class="form-control" name="telefono" id="telefono"
                                            maxlength="20" placeholder="Teléfono">
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Clave (*):</label>
                                        <input type="password" class="form-control" name="clave" id="clave"
                                            maxlength="64" placeholder="Clave" required>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Permisos:</label>
                                        <ul style="list-style: none;" id="permisos">

                                        </ul>
                                    </div>
                                    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <label>Imagen:</label>
                                        <input type="file" class="form-control" name="imagen" id="imagen">
                                        <input type="hidden" name="imagenactual" id="imagenactual">
                                        <img src="" width="150px" height="120px" id="imagenmuestra">
                                    </div>

                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i
                                                class="fa fa-save"></i>
                                            Registrarse</button>
                                        <button class="btn btn-danger" onclick="location.href='login.html'" type="button">
                                        <i class="fa fa-arrow-circle-left"></i>Login</button>
                                    </div>
                                </form>
                            </div>
                            <!--Fin centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
        <!--Fin-Contenido-->



        <?php
        require 'footer.php';
        ?>
        <script src="scripts/usuario.js"></script>