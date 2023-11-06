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
                <h1 class="box-title">Comprobantes electrónicos</h1>
                <div class="box-tools pull-right">
                </div>
              </div>
              <!-- /.box-header -->
              <!-- centro -->
              <ul class="nav nav-tabs">
                <li role="" class="active"><a href="#descargas" data-toggle="tab">Descargas</a></li>
                <li role=""><a href="#gastos" data-toggle="tab">Gatos Personales</a></li>
              </ul>
              <div class="tab-content">
                <!--Descargar-->
                <div class="tab-pane active" id="descargas">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="col-md-4">
                          <h1>Hola</h1>
                      </div>
                      <div class="col-md-4">
                        <h2>hola</h2>
                      </div>
                      <div class="col-md-4">
                        <h3>hola</h3>
                      </div>
                    </div>
                  </div>


                </div>
                <!---/. Desacrgas-->

                <!--Gastos Personales-->
                <div class="tab-pane" id="gastos">
                  <h1>hola soy yo </h1>

                </div>
                <!--./Gastos Personales-->



              </div>

              <!--Fin centro -->
            </div><!-- /.box -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
    <!--Fin-Contenido-->
    <?php
  } else {
    require 'noacceso.php';

  }
  require 'footer.php';
  ?>

  <script type="text/javascript" src="scripts/usuario.js"></script>
  <?php
}
ob_end_flush();
?>