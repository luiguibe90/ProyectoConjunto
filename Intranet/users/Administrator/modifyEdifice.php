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
        <?php include("../../views/barNav.php");?>
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
                <?php include("../../views/menuAdmin.php");?>
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
                            <h1>Gestion Edificio</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="managEdifice.php">Gestion Edificio</a></li>
                                <li class="breadcrumb-item active">Modificar Edificio</li>
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
                                    <h3 class="card-title">Formulario Edificio a Modificar:</h3>
                                </div>
                                <!-- /.card-header -->
                                <form id="formRepresentative" role="form" action=""  data-toggle="validator" method="post"  >
                                    <div class="card-body">
                                        
                                        <label for="Granados"> Seleccione La Sede: </label><!--debe selecionar la sede a la que pertenece el edificio-->
                                            <select name="campus" class="form-control">
                                            
                                            </select>
                                            
                                            <label for="Granados"> Seleccione el Edificio: </label><!--debe selecionar el edificio al que pertenece el aula y desplegarse los edificios que en la sede seleccionada anteriormente-->
                                            <select name="campus" class="form-control">
                                            
                                            </select>

                                           
                                            
                                            <!--Se deben llenar los datos al selecionar el edificio-->

                                            

                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre Edificio</label>
                                            <input type="text" class="form-control" id="exampleText" name="nameEdificio" placeholder="Ingrese Nombre del Edificio" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Cantidad Pisos</label>
                                            <input type="text" class="form-control" id="exampleText"
                                            name="canPisos"    placeholder="Ingrese la cantidad de pisos del edificio">
                                        </div>


                                        

                                    </div>
                                    <!-- /.card-body -->
                                    
                                </form>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Formulario Datos Nuevos Edificio:</h3>
                                </div>
                                <!-- /.card-header -->
                                
                                <form role="form" id="formAlumn"  action="" data-toggle="validator" method="post" >
                                    <div class="card-body">
                                        <div class="card-header">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombre edificio</label>
                                            <input type="text" class="form-control" id="exampleText" name="nameEdificio" placeholder="Ingrese Nombre del Edificio" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Cantidad Pisos</label>
                                            <input type="text" class="form-control" id="exampleText"
                                            name="canPisos"    placeholder="Ingrese la cantidad de pisos del edificio">
                                        </div>

                                        <div class="card-footer">
                                        <button name="btn_subR" type="submit" class="btn btn-primary">Modificar</button>
                                    </div>

                            </div>
                            
                        </div>

                    </div>

                </div>

            </section>


        </div>


        <!-- Main content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("../../views/footer.php");?>
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