<?php
include '../../service/AsistenciasServicios.php';
$asistencias = new AsistenciasServicios();
session_start();

$cod_alumno = $_SESSION['USU']['COD_PERSONA'];
if (!isset($_SESSION['USU'])) {
  header('Location: ../../../Seed/login.html');
}
$accion = "Aceptar";
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $_SESSION['USU']['ROL'] ?>|Seed School</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- flaticons -->
  <link rel="stylesheet" href="../../Seed/css/flaticon.css">
  <!-- w3icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <?php include("../../views/barNav.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="../../index3.html" class="brand-link">
        <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle1 ">
        <span class="brand-text font-weight-light"><?php echo $_SESSION['USU']['ROL'] ?></span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../../dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <?php $temp = explode(" ", $_SESSION['USU']['PNAME']); ?>
            <?php $temp2 = explode(" ", $_SESSION['USU']['P2NAME']); ?>
            <a href="#" class="d-block"><?php echo $temp[0]; ?></br> <?php echo $temp2[0]; ?> </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <?php include("../../views/menuEstudiante.php"); ?>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Asistencia</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Asistencia</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <section class="full-reset text-center" style="padding: 40px 0;">
        <div class="container-fluid">
          <div class="container-flat-form">
            <form action="" method="post">
              <div class="row">
                <div class="group-material col-xs-12 col-sm-8 col-sm-offset-2">
                  <span style="color: #000000;">
                    <p>Seleccione el periodo lectivo</p>
                  </span>
                  <select class="form-control" name="periodo">
                    <option value="" disabled="" selected="">Selecciona el periodo</option>
                    <?php
                    $result = $asistencias->periodo();
                    foreach ($result as $opciones) :
                    ?>
                      <option value="<?php echo $opciones['COD_PERIODO_LECTIVO'] ?>"><?php echo $opciones['COD_PERIODO_LECTIVO'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="group-material col-xs-12 col-sm-8 col-sm-offset-2">
                  <span style="color: #000000;">
                    <p>Seleccione el quimestre</p>
                  </span>
                  <select class="form-control" name="quimestre">
                    <option value="" disabled="" selected="">Selecciona el quimestre</option>
                    <option value="QUIMESTRE1">Primer quimestre</option>
                    <option value="QUIMESTRE2">Segundo quimestre</option>
                  </select>
                </div>
                <div class="group-material col-xs-12 col-sm-8 col-sm-offset-2">
                  <p class="text-center">
                    <input type="submit" name="accionCalificacionTotal" value="Aceptar" class="btn btn-primary" style="margin-right: 20px;">
                    <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid">
          <?php
          if (isset($_POST['accionCalificacionTotal']) && ($_POST['accionCalificacionTotal'] == 'Aceptar') && ($_POST['quimestre'] == 'QUIMESTRE1')) {
            $periodo = $_POST['periodo'];
          ?>
            <?php
            ?>
            <div class="table-responsive">
              <table id="tablaEstudiantesCalificaciones" class="table-striped table-bordered table-condensed" style="width: 100%;">
                <thead class="text-center">
                  <tr>
                    <th>NIVEL EDUCATIVO</th>
                    <th>FECHA</th>
                    <th>ESTADO</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result = $asistencias->asistenciasEstudiante($cod_alumno, $periodo);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <tr>
                        <!--DATOS DE LA TABLA SEDES-->
                        <td><?php echo $row["COD_NIVEL_EDUCATIVO"]; ?></td>
                        <td><?php echo $row["FECHA"]; ?></td>
                        <td><?php echo $row["ESTADO"]; ?></td>
                      </tr>
                    <?php   }
                  } else {
                    ?>
                    <tr>
                      <td colspan=3>No hay datos en la tabla</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php
          } ?>

        </div>
        <div class="container-fluid">
          <?php
          if (isset($_POST['accionCalificacionTotal']) && ($_POST['accionCalificacionTotal'] == 'Aceptar') && ($_POST['quimestre'] == 'QUIMESTRE2')) {
            $periodo = $_POST['periodo'];
          ?>
            <?php
            ?>
            <div class="table-responsive">
              <table id="tablaEstudiantesCalificaciones" class="table-striped table-bordered table-condensed" style="width: 100%;">
                <thead class="text-center">
                  <tr>
                    <th>NIVEL EDUCATIVO</th>
                    <th>FECHA</th>
                    <th>ESTADO</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $result = $asistencias->asistenciasEstudiante($cod_alumno, $periodo);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <tr>
                        <!--DATOS DE LA TABLA SEDES-->
                        <td><?php echo $row['COD_NIVEL_EDUCATIVO']; ?></td>
                        <td><?php echo $row["FECHA"]; ?></td>
                        <td><?php echo $row["ESTADO"]; ?></td>
                      </tr>
                    <?php   }
                  } else {
                    ?>
                    <tr>
                      <td colspan=3>No hay datos en la tabla</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php
          } ?>
        </div>
      </section>

      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->

  </div>

  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <p>
        Copyright &copy;
        <script>
          document.write(new Date().getFullYear());
        </script> All rights reserved | SeedSchool
      </p>
    </div>

  </footer>



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ../wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="../../plugins/chart.js/Chart.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- Sparkline -->
  <script src="../../plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="../../plugins/moment/moment.min.js"></script>
  <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
</body>

</html>