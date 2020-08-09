<?php
session_start();
if (!isset($_SESSION['USU'])) {
  header('Location: ../../../Seed/login.html');
}

include '../../service/administratorService.php';
include '../../service/studentService.php';
$studentService = new studentService();

if (isset($_POST["btn_subR"])) {

    $studentService->insertPeopleRepresentative($_POST["cedRepresentantive"], $_POST["snRepresentative"],
    $_POST["nameRepresentative"],$_POST["addressRepresentative"],$_POST["telfRepresentative"],
    $_POST["dateBrhRepresentative"],$_POST["genderR"],$_POST["pemailRepresentative"]);
    

} elseif (isset($_POST["btn_subA"])){
    echo("<script>console.log('PHP: pass btnA');</script>");
    $studentService->insertPeopleAlumn($_POST["cedAlumn"],$_POST["snameAlumn"],
    $_POST["nameAlumn"],$_POST["addreAlumn"],$_POST["telefAlumn"],$_POST["dateBirthAlumn"],
    $_POST["genderA"],$_POST["emailpAlumn"]);
    
}

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
                <a href="../../login/logout.php" class="nav-link">salir</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
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
                        <img src="../../dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <?php $temp = explode(" ", $_SESSION['USU']['PNAME'] ); ?>
                        <?php $temp2 = explode(" ", $_SESSION['USU']['P2NAME'] ); ?>
                        <a href="#" class="d-block"><?php echo $temp[0];?></br> <?php echo $temp2[0];?> </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
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
                        <li class="nav-header">Gestionar</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-users red-bg"></i>
                                <p>
                                    Personas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./managTeacher.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Profesores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./managStudent.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Alumnos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../../index3.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Representantes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./managAspirant.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Aspirantes</p>
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
                            <h1>Gestion Alumno</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="managStudent">Gestion Alumno</a></li>
                                <li class="breadcrumb-item active">Agregar Alumno</li>
                            </ol>
                        </div>


                    </div>


                </div><!-- /.container-fluid -->












            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Formulario Representante:</h3>
                                </div>
                                <!-- /.card-header -->
                                <form id="formRepresentative" role="form" action=""  data-toggle="validator" method="post"  >
                                    <div class="card-body">
                                        <div class="card-header">
                                            <h3 class="card-title">Datos del Representante:</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Numero de Cédula</label>
                                            <input type="text" class="form-control" id="exampleText"
                                                name="cedRepresentantive" placeholder="Ingrese Numero de Cédula" maxlength="10" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombres</label>
                                            <input type="text" class="form-control" id="exampleText"
                                            name="nameRepresentative"   placeholder="Ingrese sus Nombres" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Apellidos</label>
                                            <input type="text" class="form-control" id="exampleText"
                                            name="snRepresentative"    placeholder="Ingrese sus pellidos" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha nacimiento</label>
                                            <input type="date" class="form-control" id="exampleText"
                                            name="dateBrhRepresentative"    placeholder="Ingrese su Fecha de Nacimiento" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Correo Personal</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                            name = "pemailRepresentative"    placeholder="Ingrese su email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Teléfono</label>
                                            <input type="text" class="form-control" id="exampleText"
                                            name="telfRepresentative"    placeholder="Ingrese su numero de  Teléfono">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección</label>
                                            <input type="text" class="form-control" id="exampleText"
                                            name="addressRepresentative"    placeholder="Ingrese su dirección" required>
                                        </div>
                                        <label for="exampleInputText">Genero:</label></br>
                                            <input type="radio" id="male" name="genderR" value="MAS" required>
                                            <label for="male">Masculino</label><br>
                                            <input type="radio" id="female" name="genderR" value="FEM" required>
                                            <label for="female">Femenino</label><br>


                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button name="btn_subR" type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Formulario Alumno:</h3>
                                </div>
                                <!-- /.card-header -->
                                <form role="form" id="formAlumn"  action="" data-toggle="validator" method="post" >
                                    <div class="card-body">
                                        <div class="card-header">
                                            <h3 class="card-title">Datos del Alumno:</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Numero de Cédula</label>
                                            <input type="text" class="form-control" id="exampleText"
                                            name="cedAlumn"    placeholder="Ingrese Numero de Cédula" maxlength="10" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombres</label>
                                            <input type="text" class="form-control" id="exampleText"
                                            name ="nameAlumn"    placeholder="Ingrese sus Nombres" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Apellidos</label>
                                            <input type="text" class="form-control" id="exampleText"
                                            name="snameAlumn"    placeholder="Ingrese sus pellidos" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha nacimiento</label>
                                            <input type="date" class="form-control" id="exampleText"
                                            name="dateBirthAlumn"   placeholder="Ingrese su Fecha de Nacimiento" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Correo Personal</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                           name="emailpAlumn"      placeholder="Ingrese su email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Teléfono</label>
                                            <input type="text" class="form-control" id="exampleText"
                                             name="telefAlumn"   placeholder="Ingrese su numero de  Teléfono" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección</label>
                                            <input type="text" class="form-control" id="exampleText"
                                            name="addreAlumn"    placeholder="Ingrese su dirección" required>
                                        </div>
                                        <label for="exampleInputText">Genero:</label></br>
                                            <input type="radio" id="male" name="genderA" value="MAS" required>
                                            <label for="male">Masculino</label><br>
                                            <input type="radio" id="female" name="genderA" value="FEM" required>
                                            <label for="female">Femenino</label><br>
                                        
                                        


                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button name="btn_subA" type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>

                    </div>

                </div>


            </section>


        </div>







        <!-- Main content -->
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
    <!-- ./wrapper -->

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