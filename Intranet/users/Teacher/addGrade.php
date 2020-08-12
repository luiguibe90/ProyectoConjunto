<?php
session_start();
$cod_docente = $_SESSION['USU']['COD_PERSONA'];
if (!isset($_SESSION['USU'])) {
    header('Location: ../../../Seed/login.html');
}
include '../../service/gradeService.php';
$calificacion = new gradeService();
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
                        <img src="../../dist/img/avatar2.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <?php $temp = explode(" ", $_SESSION['USU']['PNAME']); ?>
                        <?php $temp2 = explode(" ", $_SESSION['USU']['P2NAME']); ?>
                        <a href="#" class="d-block"><?php echo $temp[0]; ?></br> <?php echo $temp2[0]; ?> </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <?php include("../../views/menuDocente.php"); ?>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Ingresar Notas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>

                                <li class="breadcrumb-item active">Ingresar Notas</li>
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
                                    <h3 class="card-title">Seleccione Para Registrar Notas</h3>
                                </div>
                                <form method="post">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Seleccione Periodo</label>
                                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" name="periodo">
                                                <?php
                                                $result = $calificacion->periodo();

                                                foreach ($result as $opciones) :
                                                ?>
                                                    <option value="<?php echo $opciones['COD_PERIODO_LECTIVO'] ?>"><?php echo $opciones['COD_PERIODO_LECTIVO'] ?></option>
                                                <?php endforeach ?>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label>Seleccione Asignatura</label>
                                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" name="asignatura">

                                                <?php
                                                $result = $calificacion->docenteCalificacion($cod_docente);

                                                foreach ($result as $opciones) :
                                                ?>
                                                    <option value="<?php echo $opciones['COD_NIVEL_EDUCATIVO'] ?>|<?php echo $opciones['COD_ASIGNATURA'] ?>|<?php echo $opciones['COD_PARALELO'] ?>"><?php echo $opciones['NOMBRE'] ?>--<?php echo $opciones['NOMPARALELO'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Seleccione Quimestre</label>
                                            <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" name="quimestre">
                                                <option value="PROMEDIOQ1">Primer Quimestre</option>
                                                <option value="PROMEDIOQ2">Segundo Quimestre</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <input type="submit" name="accionCalificacion" value="<?php echo $accion ?>" class="btn btn-primary" style="margin-right: 20px;">
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <?php
                            if (isset($_POST['accionCalificacion']) && ($_POST['accionCalificacion'] == 'Aceptar')) {
                                $valores = $_POST['asignatura'];
                                $result_explode = array_map('trim', explode('|', $valores));
                                $cod_nivel_educativo = $result_explode[0];
                                $cod_asignatura = $result_explode[1];
                                $cod_paralelo = $result_explode[2];
                                $cod_periodo_lectivo = $_POST['periodo'];
                                $quimestre = $_POST['quimestre'];
                            ?>
                                <form action="" method="post" id="registroNotas" name="registroNotas">
                                    <input type="hidden" name="cod_nivel_educativo" value="<?php echo $cod_nivel_educativo ?>">
                                    <input type="hidden" name="cod_asignatura" value="<?php echo $cod_asignatura ?>">
                                    <input type="hidden" name="cod_paralelo" value="<?php echo $cod_paralelo ?>">
                                    <input type="hidden" name="cod_periodo_lectivo" value="<?php echo $cod_periodo_lectivo ?>">
                                    <input type="hidden" name="quimestre" value="<?php echo $quimestre ?>">
                                    <?php
                                    ?>

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Listado Alumnos</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body table-responsive p-0">
                                                <table class="table table-hover text-nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>Apellido</th>
                                                            <th>Nombre</th>
                                                            <th style="text-align: right;">Deberes</th>
                                                            <th style="text-align: right;">Talleres</th>
                                                            <th style="text-align: right;">Pruebas</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $contador = 0;
                                                        $result = $calificacion->listarEstudiantes($cod_nivel_educativo, $cod_periodo_lectivo);
                                                        if ($result->num_rows > 0) {
                                                            while ($row = $result->fetch_assoc()) {
                                                        ?>
                                                                <tr>
                                                                    <!--DATOS DE LA TABLA SEDES-->
                                                                    <td><?php echo $row["APELLIDO"]; ?></td>
                                                                    <td><?php echo $row["NOMBRE"]; ?></td>
                                                                    <td>
                                                                        <input type="text" style="width: 50px" class="form-control float-right" name="notas[<?php echo $contador ?>][nota1]" id="nota1" value="">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" style="width: 50px" class="form-control float-right" name="notas[<?php echo $contador ?>][nota2]" id="nota2" value="">
                                                                    </td>
                                                                    <td>
                                                                        <input type="text" style="width: 50px" class="form-control float-right" name="notas[<?php echo $contador ?>][nota3]" id="nota3" value="">
                                                                    </td>
                                                                    <input type="hidden" name="cod_alumno[]" value="<?php echo $row['COD_PERSONA'] ?>">
                                                                </tr>
                                                            <?php $contador++;
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td>No hay datos en la tabla</td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="card-footer">
                                            
                                                <input type="submit" name="accionNotas" value="Hecho" class="btn btn-primary" style="margin-right: 20px">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php
                            } ?>


                            <?php
                            if (isset($_POST['accionNotas']) && ($_POST['accionNotas'] == 'Hecho') && ($_POST['quimestre'] == 'PROMEDIOQ1')) {
                                $codigo_alumno = $_POST['cod_alumno'];
                                $notas = $_POST['notas'];
                                foreach (array_combine($codigo_alumno, $notas) as $alumno => $notas) {
                                    $calificacion->ingresarNotas(
                                        $_POST['cod_periodo_lectivo'],
                                        $alumno,
                                        $_POST['cod_nivel_educativo'],
                                        $_POST['cod_asignatura'],
                                        $_POST['cod_paralelo'],
                                        $cod_docente,
                                        $notas['nota1'],
                                        $notas['nota2'],
                                        $notas['nota3']
                                    );
                                    $calificacion->promedioQuimestral1(
                                        $_POST['cod_periodo_lectivo'],
                                        $alumno,
                                        $_POST['cod_nivel_educativo'],
                                        $notas['nota1'],
                                        $notas['nota2'],
                                        $notas['nota3']
                                    );
                                }
                            } else if (isset($_POST['accionNotas']) && ($_POST['accionNotas'] == 'Hecho') && ($_POST['quimestre'] == 'PROMEDIOQ2')) {
                                $codigo_alumno = $_POST['cod_alumno'];
                                $notas = $_POST['notas'];
                                foreach (array_combine($codigo_alumno, $notas) as $alumno => $notas) {
                                    $calificacion->ingresarNotas2(
                                        $alumno,
                                        $_POST['cod_asignatura'],
                                        $notas['nota1'],
                                        $notas['nota2'],
                                        $notas['nota3']
                                    );
                                    $calificacion->promedioQuimestral2(
                                        $_POST['cod_periodo_lectivo'],
                                        $alumno,
                                        $_POST['cod_nivel_educativo'],
                                        $notas['nota1'],
                                        $notas['nota2'],
                                        $notas['nota3']
                                    );
                                }
                            }
                            ?>

                        </div>
            </section>
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