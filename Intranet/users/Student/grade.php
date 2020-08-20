<?php
include '../../service/CalificacionServicios.php';
$calificacion = new CalificacionServicios();
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
                            <h1> Ver Calificaciones</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Ver Calificaciones</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Seleccione Para Ver Calificaciones</h3>
                                </div>
                                <form method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Seleccione Periodo</label>
                                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" name="periodo">

                                                <option value="" disabled="" selected="">Selecciona el periodo</option>
                                                <?php
                                                $result = $calificacion->periodo();
                                                foreach ($result as $opciones) :
                                                ?>
                                                    <option value="<?php echo $opciones['COD_PERIODO_LECTIVO'] ?>"><?php echo $opciones['COD_PERIODO_LECTIVO'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Seleccione Quimestre</label>
                                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" name="quimestre">
                                                <option value="" disabled="" selected="">Selecciona el quimestre</option>
                                                <option value="QUIMESTRE1">Primer quimestre</option>
                                                <option value="QUIMESTRE2">Segundo quimestre</option>
                                            </select>
                                        </div>
                                        <div class="card-footer">
                                            <input type="submit" name="accionCalificacionTotal" value="Aceptar" class="btn btn-primary" style="margin-right: 20px;">


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
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Listado Calificaciones</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">

                                            <table id="tablaEstudiantesCalificaciones" class="table table-hover text-nowrap" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Asignatura</th>
                                                        <th>Deberes</th>
                                                        <th>Talleres</th>
                                                        <th>Pruebas</th>
                                                        <th>Promedio</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $result = $calificacion->calificacionGeneral1($cod_alumno, $periodo);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                    ?>
                                                            <tr>
                                                                <!--DATOS DE LA TABLA SEDES-->
                                                                <td><?php echo $row["NOMBRE"]; ?></td>
                                                                <td><?php echo $row["NOTA1"]; ?></td>
                                                                <td><?php echo $row["NOTA2"]; ?></td>
                                                                <td><?php echo $row["NOTA3"]; ?></td>
                                                                <td><?php echo round(($row["NOTA1"] + $row['NOTA2'] + +$row['NOTA3']) / 3, 2); ?></td>
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
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } ?>


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
                                                    <th>ASIGNATURA</th>
                                                    <th>NOTA 1</th>
                                                    <th>NOTA 2</th>
                                                    <th>NOTA 3</th>
                                                    <th>PROMEDIO</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $result = $calificacion->calificacionGeneral2($cod_alumno, $periodo);
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                ?>
                                                        <tr>
                                                            <!--DATOS DE LA TABLA SEDES-->
                                                            <td><?php echo $row['NOMBRE']; ?></td>
                                                            <td><?php echo $row["NOTA4"]; ?></td>
                                                            <td><?php echo $row["NOTA5"]; ?></td>
                                                            <td><?php echo $row["NOTA6"]; ?></td>
                                                            <td><?php echo round(($row["NOTA4"] + $row['NOTA5'] + +$row['NOTA6']) / 3, 2); ?></td>
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
                                    </div>
                                <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </section>

    <section class="full-reset text-center" style="padding: 40px 0;">
        <div class="container-fluid">
            <div class="container-flat-form">
                <form method="post">
                    <div class="row">
                        <div class="group-material col-xs-12 col-sm-8 col-sm-offset-2">
                            <span style="color: #000000;">
                                <p>Verificar Notas Quimestrales</p>
                            </span>
                            <span style="color: #000000;">
                                <p>Seleccione el periodo lectivo</p>
                            </span>
                            <select class="form-control" name="periodo">
                                <option value="" disabled="" selected="">Selecciona el periodo</option>
                                <?php
                                $result = $calificacion->periodo();
                                foreach ($result as $opciones) :
                                ?>
                                    <option value="<?php echo $opciones['COD_PERIODO_LECTIVO'] ?>"><?php echo $opciones['COD_PERIODO_LECTIVO'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="group-material col-xs-12 col-sm-8 col-sm-offset-2">
                            <?php
                            $resultPeriodo = $calificacion->periodo();
                            $valores = $resultPeriodo->fetch_assoc();
                            $cod_periodo_lectivo = $valores['COD_PERIODO_LECTIVO'];
                            echo "VALOR" . $cod_periodo_lectivo;
                            ?>
                            <span style="color: #000000;">
                                <p>Seleccione la asignatura</p>
                            </span>
                            <select class="form-control" name="asignatura">
                                <option value="" disabled="" selected="">Selecciona la asignatura</option>
                                <?php
                                $result2 = $calificacion->asignaturasEstudiante($cod_alumno, $cod_periodo_lectivo);
                                foreach ($result2 as $opciones) :
                                ?>
                                    <option value="<?php echo $opciones['COD_ASIGNATURA'] ?>|<?php echo $opciones['NOMBRE'] ?>"><?php echo $opciones['NOMBRE'] ?></option>
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
                                <input type="submit" name="accionCalificacion" value="Aceptar" class="btn btn-primary" style="margin-right: 20px;">
                                <button type="reset" class="btn btn-info" style="margin-right: 20px;"><i class="zmdi zmdi-roller"></i> &nbsp;&nbsp; Limpiar</button>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="container-fluid">
            <?php
            if (isset($_POST['accionCalificacion']) && ($_POST['accionCalificacion'] == 'Aceptar') && ($_POST['quimestre'] == 'QUIMESTRE1')) {
                $periodo = $_POST['periodo'];
                $asignatura = $_POST['asignatura'];
                $result_explode = array_map('trim', explode('|', $asignatura));
                $cod_asignatura = $result_explode[0];
                $nombre_asignatura = $result_explode[1];
            ?>
                <?php
                ?>
                <div class="table-responsive">
                    <table id="tablaEstudiantesCalificaciones" class="table-striped table-bordered table-condensed" style="width: 100%;">
                        <thead class="text-center">
                            <tr>
                                <th>ASIGNATURA</th>
                                <th>NOTA 1</th>
                                <th>NOTA 2</th>
                                <th>NOTA 3</th>
                                <th>PROMEDIO QUIMESTRAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $calificacion->calificacionesEstudiante($cod_alumno, $cod_asignatura);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <!--DATOS DE LA TABLA SEDES-->
                                        <td><?php echo $nombre_asignatura; ?></td>
                                        <td><?php echo $row["NOTA1"]; ?></td>
                                        <td><?php echo $row["NOTA2"]; ?></td>
                                        <td><?php echo $row["NOTA3"]; ?></td>
                                        <td><?php echo round(($row["NOTA1"] + $row['NOTA2'] + +$row['NOTA3']) / 3, 2); ?></td>
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
                </div>
                <input type="submit" name="accionNotas" value="Hecho" class="btn btn-primary" style="margin-right: 20px;">
            <?php
            } ?>

        </div>
        <div class="container-fluid">
            <?php
            if (isset($_POST['accionCalificacion']) && ($_POST['accionCalificacion'] == 'Aceptar') && ($_POST['quimestre'] == 'QUIMESTRE2')) {
                $periodo = $_POST['periodo'];
                $asignatura = $_POST['asignatura'];
                $result_explode = array_map('trim', explode('|', $asignatura));
                $cod_asignatura = $result_explode[0];
                $nombre_asignatura = $result_explode[1];
            ?>
                <?php
                ?>
                <div class="table-responsive">
                    <table id="tablaEstudiantesCalificaciones" class="table-striped table-bordered table-condensed" style="width: 100%;">
                        <thead class="text-center">
                            <tr>
                                <th>ASIGNATURA</th>
                                <th>NOTA 1</th>
                                <th>NOTA 2</th>
                                <th>NOTA 3</th>
                                <th>PROMEDIO QUIMESTRAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $calificacion->calificacionesEstudiante2($cod_alumno, $cod_asignatura);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <!--DATOS DE LA TABLA SEDES-->
                                        <td><?php echo $nombre_asignatura; ?></td>
                                        <td><?php echo $row["NOTA4"]; ?></td>
                                        <td><?php echo $row["NOTA5"]; ?></td>
                                        <td><?php echo $row["NOTA6"]; ?></td>
                                        <td><?php echo round(($row["NOTA4"] + $row['NOTA5'] + +$row['NOTA6']) / 3, 2); ?></td>
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
                </div>
                <input type="submit" name="accionNotas" value="Hecho" class="btn btn-primary" style="margin-right: 20px;">
            <?php
            } ?>

        </div>
    </section>

    </div>
    </div>


    <!-- /.content-wrapper -->

    <?php include("../../views/footer.php"); ?>



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