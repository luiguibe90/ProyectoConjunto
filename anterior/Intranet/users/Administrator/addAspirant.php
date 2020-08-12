<?php
session_start();
if (!isset($_SESSION['USU'])) {
    header('Location: ../../../Seed/login.html');
}

include '../../service/administratorService.php';
include '../../service/aspirantService.php';
$aspirantService = new aspirantService();
if (isset($_POST["btn_subR"])) {
    $aspirantService->insertPeopleTeacher(
        $_POST["cedRepresentantive"],
        $_POST["snRepresentative"],
        $_POST["nameRepresentative"],
        $_POST["addressRepresentative"],
        $_POST["telfRepresentative"],
        $_POST["dateBrhRepresentative"],
        $_POST["genderR"],
        $_POST["pemailRepresentative"]
    );
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
                        <?php $temp = explode(" ", $_SESSION['USU']['PNAME']); ?>
                        <?php $temp2 = explode(" ", $_SESSION['USU']['P2NAME']); ?>
                        <a href="#" class="d-block"><?php echo $temp[0]; ?></br> <?php echo $temp2[0]; ?> </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <?php include("../../views/menuAdmin.php");?>
            </div>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Gestión Aspirante</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="managAspirant">Gestión Aspirante</a></li>
                                <li class="breadcrumb-item active">Agregar Aspirante</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Formulario Aspirante:</h3>
                                </div>
                                <form role="form" data-toggle="validator" method="post">
                                    <div class="card-body">
                                        <div class="card-header">
                                            <h3 class="card-title">Datos del Aspirante:</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Numero de Cédula</label>
                                            <input type="text" class="form-control" id="exampleText" name="cedAspirant" placeholder="Ingrese Numero de Cédula" maxlength="10">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombres</label>
                                            <input type="text" class="form-control" id="exampleText" name="nameAspirant" placeholder="Ingrese Nombres">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Apellidos</label>
                                            <input type="text" class="form-control" id="exampleText" name="snAspirant" placeholder="Ingrese Apellidos">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha nacimiento</label>
                                            <input type="date" class="form-control" id="exampleText" name="dateBrhAspirant" placeholder="Seleccione Fecha de Nacimiento">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Correo Personal</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" name="pemailAspirant" placeholder="Ingrese email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Teléfono</label>
                                            <input type="text" class="form-control" id="exampleText" name="telfAspirant" placeholder="Ingrese numero de Teléfono">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección</label>
                                            <input type="text" class="form-control" id="exampleText" name="addressAspirant" placeholder="Ingrese dirección Domiciliaria">
                                        </div>
                                        <label for="exampleInputText">Genero:</label></br>
                                        <input type="radio" id="male" name="genderA" value="MAS">
                                        <label for="male">Masculino</label><br>
                                        <input type="radio" id="female" name="genderA" value="FEM">
                                        <label for="female">Femenino</label><br>
                                    </div>
                                    <div class="card-footer">
                                        <button name="btn_subR" type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Formulario Representante De Aspirante:</h3>
                                </div>
                                <!-- /.card-header -->
                                <form role="form1" data-toggle="validator" method="post">
                                    <div class="card-body">
                                        <div class="card-header">
                                            <h3 class="card-title">Datos del Representante:</h3>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Numero de Cédula</label>
                                            <input type="text" class="form-control" id="exampleText" placeholder="Ingrese Numero de Cédula" maxlength="10">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombres</label>
                                            <input type="text" class="form-control" id="exampleText" placeholder="Ingrese Nombres">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Apellidos</label>
                                            <input type="text" class="form-control" id="exampleText" placeholder="Ingrese Apellidos">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Fecha nacimiento</label>
                                            <input type="date" class="form-control" id="exampleText" placeholder="Ingrese Fecha de Nacimiento">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Correo Personal</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Ingrese email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Teléfono</label>
                                            <input type="text" class="form-control" id="exampleText" placeholder="Ingrese numero de  Teléfono">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dirección</label>
                                            <input type="text" class="form-control" id="exampleText" name="addreA" placeholder="Ingrese dirección domiciliaria">
                                        </div>
                                        <label for="exampleInputText">Genero:</label></br>
                                        <input type="radio" id="male" name="genderA" value="MAS">
                                        <label for="male">Masculino</label><br>
                                        <input type="radio" id="female" name="genderA" value="FEM">
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
    </div>
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