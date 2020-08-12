<?php
session_start();
if (!isset($_SESSION['USU'])) {
    header('Location: ../../../Seed/login.html');
}

include '../../service/administratorService.php';
include '../../service/aspirantService.php';
$aspirantService = new aspirantService();


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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">

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

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fa fa-users red-bg"></i>
                                <p>
                                    Periodo
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./assignPeriod.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Gestión de Periodo</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./assignTeacher.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Asignación Docente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./assignRegistration.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Matrícula</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./managLevel.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Niveles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./assignSubject.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Asignaturas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                </nav>
            </div>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>MATRÍCULAS</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="managAspirant">Matrícula</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <section>

                <br><br>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <b>GESTIÓN MATRICULAS</b>
                            </div>
                            <div class="card-body">
                                <center><button type="button" class="btn btn-success" data-toggle='modal'
                                        data-target='#newRoll'>Matricular Estudiantes</button></center>
                                <br><br>
                                <center>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Perido</label>
                                        </div>
                                        <select class="custom-select" id="selectPeriods">

                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button"
                                                onclick="tableEnroll()">Buscar</button>
                                        </div>
                                    </div>
                                </center>
                                <br><br>
                                <table class="display responsive nowrap" style="width:100%; cursor: pointer;"
                                    id="tblenroll">
                                    <thead>
                                        <tr>
                                            <th>COD Alumno</th>
                                            <th>Alumno</th>
                                            <th>Nivel</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br><br>


                <div class="modal fade" id="newRoll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Matricular Alumno</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">DNI </span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="DNI" aria-label="Username"
                                        aria-describedby="basic-addon1" id="dniAlumn">
                                    <button type="button" class="btn btn-success" data-toggle='modal'
                                        data-target='#AlumnSearch' onclick="searchAlumn()">Buscar</button>

                                </div>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Periodo</label>
                                    </div>
                                    <select name="Periods" class="custom-select" id="SelectPeriodModal">
                                    </select>

                                </form>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Nivel</label>
                                    </div>
                                    <select name="Periods" class="custom-select" id="SelectLevelModal">
                                    </select>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onclick="enrrollNewAlumn()">Matricular</button>
                                <button id="cerrar" type="button" class="btn btn-danger"
                                    data-dismiss="modal">Cerrar</button>
                            </div>


                        </div>
                    </div>
                </div>


                <!-- Modal Alumn Search -->
                <div class="modal fade" id="AlumnSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Datos del Alumno</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Nombres del
                                            Alumno</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nombre Nivel"
                                        aria-label="Username" aria-describedby="basic-addon1" id="nameAlumn">

                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Estado</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Estado" aria-label="Username"
                                        aria-describedby="basic-addon1" id="stateAlumn">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onclick="regresar()">Guardar</button>
                                <button id="cerrar" type="button" class="btn btn-danger"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>






            </section>
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
                integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
                crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

            <script>
            var id
            var tblenroll
            var roles
            var idRol
            var idModulo
            var namealumn
            var estatealumn

            $(document).ready(function() {

                fillSelectEnrollements()
                fillSelectLevels()
                

            });


            function fillSelectEnrollements() {
                $.ajax({
                    url: "periodGetService.php?selectPeriods=true",
                    data: {},
                    type: "POST",
                    success: function(data) {
                        if (data != "mal") {
                            var selectPeriods = document.getElementById("selectPeriods");
                            selectPeriods.innerHTML = data;
                            var SelectPeriodModal = document.getElementById("SelectPeriodModal");
                            SelectPeriodModal.innerHTML = data;
                        }
                    }
                });
            }

            function fillSelectLevels() {
                $.ajax({
                    url: "../../service/getEnrollementService.php?selectLevels=true",
                    data: {},
                    type: "POST",
                    success: function(data) {
                        if (data != "mal") {
                            var SelectLevelModal = document.getElementById("SelectLevelModal");
                            SelectLevelModal.innerHTML = data;
                        }
                    }
                });
            }

            function searchAlumn() {
                var idAlumnSearch = document.getElementById('dniAlumn').value
                $.ajax({
                    url: "../../service/getEnrollementService.php?searchAlumn=&idAlumnSearch=" + idAlumnSearch,
                    data: {},
                    type: "POST",
                    success: function(data) {
                        if (data != "mal") {
                            document.getElementById('nameAlumn').value = 
                            document.getElementById('stateAlumn').value = data
                        }
                    }
                });
            }
            


            function tableEnroll() {
                var modulo = document.getElementById('selectPeriods').value
                tblenroll = $('#tblenroll').DataTable({
                    "ajax": "../../service/getEnrollementService.php?listEnroll=true&modulo=" + modulo,
                    "columns": [{
                            "data": "CODALUMN",
                        },
                        {
                            "data": "NAMEPEOPLE"
                        },
                        {
                            "data": "LEVEL"
                        },
                        {
                            "data": null,
                            "defaultContent": "<button type='button' class='btn btn-sm rounded btn-warning' data-toggle='modal' data-target='#modalFuncion'>Editar</button>&nbsp<button class='btn btn-sm rounded btn-danger' onclick='eliminarFuncion()'>Eliminar</button>",
                            orderData: false
                        },
                    ],
                    "destroy": true,
                    "language": {
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    }
                });
                $('#tblenroll tbody').on('click', 'td', function() {
                    var data = tblenroll.row($(this).parents('tr')).data();
                    id = data['CODALUMN'];
                    document.getElementById('urlPrincipal').value = data['URL_PRINCIPAL']
                    document.getElementById('nombreFuncion').value = data['NOMBRE']
                    document.getElementById('descriFuncion').value = data['DESCRIPCION']
                });
            }
            function enrrollNewAlumn(){
                var cedAlumn = document.getElementById('dniAlumn').value
                var codPeriod = document.getElementById('SelectPeriodModal').value
                var codLevel = document.getElementById('SelectLevelModal').value
                $.ajax({
                url: "../../service/getEnrollementService.php?newEnrollAlumn=true",
                data: { cedAlumn: cedAlumn, codPeriod: codPeriod, codLevel: codLevel},
                type: "POST",
                success: function (data) {
                    if (data == "exito") {
                        alert("El alumno ha sido matriculado exitosamente")
                        $('#cerrarNue').click()
                        $('#tblfunc').DataTable().ajax.reload()
                    }
                },
            });
            }





            </script>




            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->

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
        <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
        </script>
        <!-- Summernote -->
        <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../dist/js/demo.js"></script>



</body>
<?php include("../../views/footer.php"); ?>

</html>