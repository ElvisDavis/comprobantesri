<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"])) {
    header("Location: login.html");

} else {
    require 'header.php';
    if ($_SESSION['Usuario'] == 0) {
        ?>
        <!--Contenido-->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h1 class="box-title">Mi perfil</h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <!-- centro -->
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li role="" class="active"><a href="#datosp" data-toggle="tab">Datos Personales</a></li>
                                    <li role=""><a href="#cuentas" data-toggle="tab">Cuentas asociadas</a></li>
                                </ul>
                                <div class="tab-content">
                                    <!--Descargar-->
                                    <div class="tab-pane active" id="datosp">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-4">
                                                    <h1>Hola</h1>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><b>Datos Personales:</b></p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p><b>Información Laboral:</b></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!---/. Desacrgas-->
                                    <!--Gastos Personales-->
                                    <div class="tab-pane" id="cuentas">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="box">
                                                    <div class="box-header">
                                                        <div class="pull-right">
                                                            <a data-toggle="modal" href="#myModal">
                                                                <button class="btn btn-primary"><span class="fa fa-plus"></span>
                                                                    Agregar</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive" id="listadoregistros">
                                                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                                            <thead>
                                                                <th>N°</th>
                                                                <th>Razón Social</th>
                                                                <th>Dirección</th>
                                                                <th>Teléfono</th>
                                                                <th>Correo Electrónico</th>
                                                                <th>RUC</th>

                                                                <th>Estado</th>
                                                                <th>Editar</th>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    <!--./Gastos Personales-->
                                </div>
                            </div>
                            <!--Fin centro -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->
        <!--Fin-Contenido-->
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 35% !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Nueva Cuenta</h4>
                    </div>
                    <div class="modal-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Razon Social(*):</label>
                                <input type="hidden" name="idcontribuyente" id="idcontribuyente">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100"
                                    placeholder="Ingrese nombres completos" required>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Dirección:</label>
                                <input type="email" class="form-control" name="direccion" id="direccion" maxlength="50"
                                    placeholder="Dirección">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Celular:</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" maxlength="10"
                                    placeholder="Teléfono">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Email:</label>
                                <input type="email" class="form-control" name="email" id="email" maxlength="50"
                                    placeholder="Email">
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>RUC(*):</label>
                                <input type="email" class="form-control" name="ruc" id="ruc" maxlength="13"
                                    placeholder="RUC">
                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Clave (*):</label>
                                <input type="password" class="form-control" name="clave" id="clave" maxlength="64"
                                    placeholder="Clave" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>
                            Registrarse</button>


                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- Fin modal -->
        <?php
    } else {
        require 'noacceso.php';

    }
    require 'footer.php';
    ?>

    <script type="text/javascript" src="scripts/contribuyente.js"></script>
    <?php
}
ob_end_flush();
?>