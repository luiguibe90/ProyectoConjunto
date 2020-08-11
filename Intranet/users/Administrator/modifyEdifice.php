<?php
session_start();
if (!isset($_SESSION['USU'])) {
    header('Location: ../../../Seed/login.html');
}

include '../../service/infraestructuraService.php';

$infraestructura = new infraestructuraService();
$sede = "sede";
$edificio = "edificio";
$aula = "aula";
$codigoSede = "";
$nombreSede = "";
$direccionSede = "";
$telefonoSede = "";
$codPostalSede = "";
$codigoAula = "";
$nombreAula = "";
$capacidadAula = "";
$pisoAula = "";
$codigoEdificio = "";
$nombreEdificio = "";
$cantidadPisos = "";
$accion = "Añadir";
$mensajeSede = "Registrar Nueva Sede";
$mensaje = "Registro de Nueva Aula";
$mensajeEdificios = "Registro de nuevo Edificio";


if (isset($_POST['accionEdificios']) && ($_POST['accionEdificios'] == 'Añadir')) {
    $infraestructura->insertarEdificio($_POST['codigo_edificio'], $_POST['sede'], $_POST['nombre_edificio'], $_POST['pisos']);
} else if (isset($_POST["accionEdificios"]) && ($_POST["accionEdificios"] == "Modificar")) {
    $infraestructura->modificarEdicio(
        $_POST['codigo_edificio'],
        $_POST['sede'],
        $_POST['nombre_edificio'],
        $_POST['pisos'],
        $_POST['codigo_edificio_comparar']
    );
} else if (isset($_GET["modificarEdificio"])) {
    $result = $infraestructura->encontrarEdificio($_GET['modificarEdificio']);
    if ($result != null) {
        $codigoEdificio = $result['COD_EDIFICIO'];
        $nombreEdificio = $result['NOMBRE'];
        $cantidadPisos = $result['CANTIDAD_PISOS'];
        $mensajeEdificios = "ModificarEdificio";
        $accion = "Modificar";
    }
} else if (isset($_GET['eliminarEdificio'])) {
    $infraestructura->eliminarEdificio($_GET['eliminarEdificio']);
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
                    <form action="" name="aulas" id="aulas" method="post">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Código Sede</th>
                                        <th>Nombre</th>
                                        <th>Cantidad de Pisos</th>
                                        <th>Actualizar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result = $infraestructura->mostrarInfraestructura($edificio);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row["COD_EDIFICIO"]; ?></td>
                                                <td><?php echo $row["COD_SEDE"]; ?></td>
                                                <td><?php echo $row["NOMBRE"]; ?></td>
                                                <td><?php echo $row["CANTIDAD_PISOS"]; ?></td>
                                                <td>
                                                    <div>
                                                        <a href="modifyEdifice.php?modificarEdificio=<?php echo $row["COD_EDIFICIO"]; ?>#edificiosForm" class="btn btn-success" type="button">
                                                            <i class="zmdi zmdi-refresh"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php   }
                                    } else {
                                        ?>
                                        <tr>
                                            <td>No hay datos en la tabla</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Modificar Edificio</h3>
                                    </div>
                                    <div style="margin-left: 14px;">
                                    </div>
                                    <div class="row container-flat-form">
                                        <div class="card-body">
                                            <input type="hidden" name="codigo_edificio_comparar" value="<?php echo $codigoEdificio ?>">
                                            <div class="form-group" id="aulasForm">
                                                <label for="exampleInputEmail1">Codigo Edificio</label>
                                                <input type="text" class="form-control" placeholder="Código de Edificio" required="" data-toggle="tooltip" data-placement="top" title="Escriba el código del edificio" name="codigo_edificio" value="<?php echo $codigoEdificio ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Codigo Sede</label>
                                                <select name="sede" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                    <?php
                                                    $result3 = $infraestructura->mostrarInfraestructura($sede);
                                                    foreach ($result3 as $opciones) :
                                                    ?>
                                                        <option value="<?php echo $opciones['COD_SEDE'] ?>"><?php echo $opciones['COD_SEDE'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nombre Edificio</label>
                                                <input type="text" class="form-control" placeholder="Nombre del edificio" required="" data-toggle="tooltip" data-placement="top" title="Nombre del Edificio" name="nombre_edificio" value="<?php echo $nombreEdificio ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Cantidad Pisos</label>
                                                <input type="text" class="form-control" placeholder="Cantidad de Pisos" required="" data-toggle="tooltip" data-placement="top" title="Escriba la cantidad de pisos" name="pisos" value="<?php echo $cantidadPisos ?>">

                                            </div>
                                            <p class="text-center">
                                                <input type="submit" name="accionEdificios" value="Modificar" class="btn btn-primary" style="margin-right: 20px;">
                                            </p>
                                        </div>
                                    </div>
                    </form>
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