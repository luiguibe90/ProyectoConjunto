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
//SEDE
if (isset($_POST['accionSede']) && ($_POST['accionSede'] == 'Añadir')) {
    $infraestructura->insertarSede(
        $_POST['codigo_sede'],
        $_POST['nombre_sede'],
        $_POST['direccion_sede'],
        $_POST['telefono_sede'],
        $_POST['cod_postal_sede']
    );
} else if (isset($_POST["accionSede"]) && ($_POST["accionSede"] == "Modificar")) {
    $infraestructura->modificarSede(
        $_POST['codigo_sede'],
        $_POST['nombre_sede'],
        $_POST['direccion_sede'],
        $_POST['telefono_sede'],
        $_POST['cod_postal_sede'],
        $_POST['codigo_sede_comparar']
    );
} else if (isset($_GET["modificarSede"])) {
    $result = $infraestructura->encontrarSede($_GET['modificarSede']);
    if ($result != null) {
        $codigoSede = $result['COD_SEDE'];
        $nombreSede = $result['NOMBRE'];
        $direccionSede = $result['DIRECCION'];
        $telefonoSede = $result['TELEFONO'];
        $codPostalSede = $result['CODIGO_POSTAL'];
        $mensajeSede = "Modificar datos de la Sede";
        $accion = "Modificar";
    }
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
                                <li class="breadcrumb-item"><a href="managCampus.php">Gestion Sede</a></li>
                                <li class="breadcrumb-item active">Modificar Sede</li>
                            </ol>
                        </div>


                    </div>


                </div><!-- /.container-fluid -->

            </section>

            <section class="content">
                <div class="container-fluid">
                    <form id="sedes" method="post" name="sedes" action="">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Direccion</th>
                                        <th>Teléfono</th>
                                        <th>Codigo Postal</th>
                                        <th>Actualizar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $result = $infraestructura->mostrarInfraestructura($sede);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row["COD_SEDE"]; ?></td>
                                                <td><?php echo $row["NOMBRE"]; ?></td>
                                                <td><?php echo $row["DIRECCION"]; ?></td>
                                                <td><?php echo $row["TELEFONO"]; ?></td>
                                                <td><?php echo $row["CODIGO_POSTAL"]; ?></td>
                                                <td>
                                                    <div>
                                                        <a href="modifyCampus.php?modificarSede=<?php echo $row["COD_SEDE"]; ?>#sedesForm" class="btn btn-success" type="button">
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
                                        <h3 class="card-title">Modificar Sede</h3>
                                    </div>
                                    <div style="margin-left: 14px;">
                                    </div>
                                    <div class="row container-flat-form">
                                        <div class="card-body">
                                            <input type="hidden" name="codigo_sede_comparar" value="<?php echo $codigoSede ?>">
                                            <div class="form-group" id="aulasForm">
                                                <label for="exampleInputEmail1">Codigo Sede</label>
                                                <input type="text" class="form-control" placeholder="Código de la sede" required="" data-toggle="tooltip" data-placement="top" title="Escriba el código de la sede" name="codigo_sede" value="<?php echo $codigoSede ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nombre Sede</label>
                                                <input type="text" class="form-control" placeholder="Nombre de la sede" required="" data-toggle="tooltip" data-placement="top" title="Escriba el nombre de la sede" name="nombre_sede" value="<?php echo $nombreSede ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Direccion Sede</label>
                                                <input type="text" class="form-control" placeholder="Dirección de la Sede" required="" data-toggle="tooltip" data-placement="top" title="Escriba la dirección de la Sede" name="direccion_sede" value="<?php echo $direccionSede ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Teléfono Sede</label>
                                                <input type="text" class="form-control" placeholder="Teléfono de la Sede" required="" data-toggle="tooltip" data-placement="top" title="Escriba el teléfono de la Sede" name="telefono_sede" value="<?php echo $telefonoSede ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Código Postal</label>
                                                <input type="text" class="form-control" placeholder="Código Postal" required="" data-toggle="tooltip" data-placement="top" title="Escriba el código postal de la sede" name="cod_postal_sede" value="<?php echo $codPostalSede ?>">
                                            </div>
                                            <p class="text-center">
                                                <input type="submit" name="accionSede" value="Modificar" class="btn btn-primary" style="margin-right: 20px;">
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
    <?php include("../../views/footer.php"); ?>
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