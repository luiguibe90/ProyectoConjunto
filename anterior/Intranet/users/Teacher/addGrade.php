<?php
session_start();
if (!isset($_SESSION['USU'])) {
    header('Location: ../../../Seed/login.html');
}
include '../../service/studentService.php';
$studentService = new studentService();
?>


<!USUTYPE html>
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
                            <img src="../../dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <?php $temp = explode(" ", $_SESSION['USU']['PNAME']); ?>
                            <?php $temp2 = explode(" ", $_SESSION['USU']['P2NAME']); ?>
                            <a href="#" class="d-block"><?php echo $temp[0]; ?></br> <?php echo $temp2[0]; ?> </a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                            <li class="nav-item">
                                <a href="index.php" class="nav-link active">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Inicio
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon ion-ios-book"></i>
                                    <p>
                                        Calificaciones Alumnos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./addGrade.php" class="nav-link">
                                            <i class="far ion-ios-book-outline av-icon"></i>
                                            <p>Ingreso Calificaciones</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./modifyGrade.php" class="nav-link">
                                            <i class="far ion-ios-book-outline av-icon"></i>
                                            <p>Modificación Calificaciones</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./reportGrade.php" class="nav-link">
                                            <i class="far ion-ios-book-outline av-icon"></i>
                                            <p>Reporte Calificaciones</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>

                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon ion-ios-book"></i>
                                    <p>
                                        Asistencia Alumnos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./attendanceStudent.php" class="nav-link">
                                            <i class="far ion-ios-book-outline av-icon"></i>
                                            <p>Registro Asistencia</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./modifyattendanceStudent.php" class="nav-link">
                                            <i class="far ion-ios-book-outline av-icon"></i>
                                            <p>Modificación Asistencia</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="./reportattendanceStudent.php" class="nav-link">
                                            <i class="far ion-ios-book-outline av-icon"></i>
                                            <p>Reporte Asistencia</p>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon ion-ios-book"></i>
                                    <p>
                                        Listado Alumnos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="./reportStudent.php" class="nav-link">
                                            <i class="far ion-ios-book-outline av-icon"></i>
                                            <p>Reporte de Alumnos</p>
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
                                <h1>Seleccione Datos Para Ingresar Calificaciones</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                    <li class="breadcrumb-item active">Ingreso Notas</li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Seleccione Periodo</label>
                                    <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 70%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>
                   
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Seleccione Asignatura</label>
                                    <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 70%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>
                      
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label>Seleccione Quimestre</label>
                                    <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 70%;">
                                        <option selected="selected">Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                </div>
                            </div>
                        </div>




                        <section class="content">
                <div class="container-fluid">
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-10">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Ingrese Notas de Alumnos</h3>

                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Cod_Alumno</th>                                               
                                                <th>Apellido</th>
                                                <th>Nombre</th>
                                                <th>Ingrese Notas</th>
                                            
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $result = $studentService->showPeople(1);
                                            while ($alumn = mysqli_fetch_array($result)) {
                                                echo "<tr>";
                                                echo "<td>" . $alumn['COD_PERSONA'] . "</td>";
                                                echo "<td>" . $alumn['APELLIDO'] . "</td>";
                                                echo "<td>" . $alumn['NOMBRE'] . "</td>";
                                                ?>
                                                <td>
                                                    <a href="modifyTeacher.php?codigo='<?php echo $alumn['COD_PERSONA']?>'"
                                                      title="Ingresar Notas" class="btn btn-primary btn-sm"><span
                                                        class="far fa-edit fa-lg" aria-hidden="true"></span></a>
                                                 </td>
                                            <?php echo "</tr>";
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
            </section>










                    </div>



                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        </section>

        </div>




        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.5
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
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