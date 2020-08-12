<?php
session_start();
if (!isset($_SESSION['USU'])) {
    header('Location: ../../../Seed/login.html');
}
include '../../service/studentService.php';
$studentService = new studentService();
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
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../users/student.html" class="nav-link">Inicio</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contacto</a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </nav>
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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" style="color: white">
          <div class="sidebar-brand-icon rotate-n-15">
          </div>
          <?php
          $row = $result2->fetch_assoc();
          ?>
          <div class="sidebar-brand-text mx-3"><?php echo $row['NOMBRE'] ?></div>
        </a>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="./index.php" class="nav-link ">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item active">
              <a class="nav-link collapsed" href="./Tarea.php?codigoAsignatura=<?php echo $_GET['codigoAsignatura'] ?>" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-edit"></i>
                <span>Tareas</span>
              </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
              <a class="nav-link collapsed" href="./Comunicado.php?codigoAsignatura=<?php echo $_GET['codigoAsignatura'] ?>" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-bullhorn"></i>
                <span>Comunicados</span>
              </a>
            </li>

          </ul>
          </li>
        </nav>
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
              <h1>Tareas</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item">Materia</li>
                <li class="breadcrumb-item active">Tareas</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

          <!-- Topbar -->
          <?php
          include '../views/partials/header.php';
          ?>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <!-- Content Row -->
            <div class="row ">
              <!-- Earnings (Monthly) Card Example -->
              <?php
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $i = 1;
              ?>
                  <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                      <a class="btn btn-fix ">
                        <div class="card-body">
                          <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                              <div class="col-auto">
                                <i class="fas fa-edit fa-3x text-gray-300"></i><br>
                              </div>
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">---TAREA---</div><br>
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $row['TEMA_TAREA']; ?> </div><br>
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"><?php echo $row['DETALLE_TAREA']; ?> </div><br>
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Fecha de entrega: <?php echo $row['FECHA_ENTREGA']; ?> </div><br>
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Hora de entrega: <?php echo $row['HORA_ENTREGA']; ?> </div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">::::::::::::</div>
                              <div class="row no-gutters align-items-center"></div>
                              <div class="col">
                              </div>
                            </div>
                          </div>
                        </div>

                    </div>
                  </div>
                  </a>
                  <!-- Earnings (Monthly) Card Example -->
                <?php
                }
              } else { ?>
                <div class="col-xl-3 col-md-6 mb-4">
                  <div class="card border-left-primary shadow h-100 py-2">
                    <a class="btn btn-fix ">
                      <div class="card-body">
                        <div class="row no-gutters align-items-center">
                          <div class="col mr-2">
                            <div class="col-auto">
                              <i class="fas fa-child fa-3x text-gray-300"></i><br>
                            </div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">---YUJU !!---</div><br>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">NO HAY TAREAS</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">::::::::::::</div>
                            <div class="row no-gutters align-items-center"></div>
                            <div class="col">
                            </div>
                          </div>
                        </div>
                      </div>

                  </div>
                </div>
                </a>
              <?php } ?>
              </a>
            </div>
            </a>
          </div>
        </div>



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