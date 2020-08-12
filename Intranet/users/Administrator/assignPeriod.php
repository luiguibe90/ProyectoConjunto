<?php
session_start();
if (!isset($_SESSION['USU'])) {
    header('Location: ../../../Seed/login.html');
}
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/Bogota');
include '../../service/administratorService.php';
include '../../service/aspirantService.php';

$aspirantService = new aspirantService();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $_SESSION['USU']['ROL'] ?>|Seed School</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
</head>

<body id="all" class="hold-transition sidebar-mini layout-fixed">

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
                <?php include("../../views/menuAdmin.php"); ?>
            </div>
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>PERIODO ACADÉMICO</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item"><a href="managAspirant">Periodo académico</a></li>
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
                                <b>Periodos Lectivos</b>
                            </div>
                            <div class="card-body">
                                <center><button type="button" class="btn btn-success" data-toggle='modal' data-target='#newPeriod'>Nuevo Periodo</button></center>
                                <br><br>
                                <table class="display responsive nowrap" style="width:100%; cursor: pointer;" id="tablePeriods">
                                    <thead>
                                        <tr>
                                            <th>Codigo Periodo</th>
                                            <th>Estado</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Final</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="newPeriod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Periodo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Estado</span>
                                        </div>
                                        <select class="custom-select" id="statePeriod">
                                            <option value="ACT" selected>ACTIVO</option>
                                            <option value="INA">INACTIVO</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Fecha Inicio Periodo</span>
                                        </div>
                                        <input type="date" class="form-control" placeholder="Nombre" aria-label="Username" aria-describedby="basic-addon1" id="dateStartPeriod">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Fecha Final Periodo</span>
                                        </div>
                                        <input type="date" class="form-control" placeholder="Nombre" aria-label="Username" aria-describedby="basic-addon1" id="dateEndPeriod">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" onclick="crearNuevo()">Guardar</button>
                                    <button id="cerrar" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Modal Change Period-->
                    <div class="modal fade" id="changePeriod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar Periodo Lectivo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Estado del
                                                Periodo</label>
                                        </div>
                                        <select class="custom-select" id="modstatePeriod">
                                            <option value="ACT" selected>ACTIVO</option>
                                            <option value="INA">INACTIVO</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Fecha Inicio</span>
                                        </div>
                                        <input type="date" class="form-control" placeholder="Nombre" aria-label="Username" aria-describedby="basic-addon1" id="moddateStartPeriod">
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Fecha Final</span>
                                        </div>
                                        <input type="date" class="form-control" placeholder="Nombre" aria-label="Username" aria-describedby="basic-addon1" id="moddateEndPeriod">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" onclick="guardarCambios()">Guardar
                                        Cambios</button>
                                    <button id="cerrarModal" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br><br>

                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <b>Cronograma por Periodo</b>
                            </div>
                            <div class="card-body">
                                <center><button type="button" class="btn btn-success" data-toggle='modal' data-target='#newSchedule'>Nuevo Cronograma</button></center>
                                <br><br>
                                <center>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">Periodo</label>
                                        </div>
                                        <select class="custom-select" id="selectPeriods">

                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button" onclick="tablaFunciones()">Buscar</button>
                                        </div>
                                    </div>
                                </center>
                                <br><br>
                                <table class="display responsive nowrap" style="width:100%; cursor: pointer;" id="tblfunc">
                                    <thead>
                                        <tr>
                                            <th>Codigo Cronograma</th>
                                            <th>Tipo</th>
                                            <th>Descripcion</th>
                                            <th>Fecha</th>
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


                <!-- Modal  Menu Select Funcionalidad-->
                <div class="modal fade" id="newSchedule" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevo Cronograma</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <label>Seleccionar el Periodo: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Periodo</label>
                                    </div>
                                    <select class="custom-select" id="selectPeriodShedule">
                                    </select>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Tipo</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Tipo" id="typeShedule">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Descripción</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Descripción" id="descripShedule">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Fecha</span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="Fecha" id="dateShedule">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" onclick="guardarFuncionNuevo()">Guardar Cambios</button>
                                <button id="cerrarNue" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>



            </section>



            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

            <script>
                var id
                var tblfunc
                var roles
                var idRol
                var idModulo

                $(document).ready(function() {

                    var tablePeriods = $('#tablePeriods').DataTable({
                        "ajax": "./periodGetService.php?listPeriod=true",
                        "columns": [{
                                "data": "COD_PERIODO_LECTIVO"
                            },
                            {
                                "data": "ESTADO"
                            },
                            {
                                "data": "FECHA_INICIO"
                            },
                            {
                                "data": "FECHA_FIN"
                            },
                            {
                                "data": null,
                                "defaultContent": "<button type='button' class='btn btn-sm rounded btn-warning' data-toggle='modal' data-target='#changePeriod'>Editar</button>&nbsp<button class='btn btn-sm rounded btn-danger' onclick='eliminarModulo()'>Desactivar</button>",
                                orderData: false
                            },
                        ],
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
                    $('#tablePeriods tbody').on('click', 'td', function() {
                        var data = tablePeriods.row($(this).parents('tr')).data();
                        id = data['COD_PERIODO_LECTIVO'];
                        document.getElementById('modstatePeriod').value = data['ESTADO']
                        document.getElementById('moddateStartPeriod').value = data['FECHA_INICIO']
                        document.getElementById('moddateEndPeriod').value = data['FECHA_FIN']

                    });

                    $.fn.dataTable.ext.errMode = 'none'

                    fillSelectPeriods()

                });


                function eliminarModulo() {
                    $.ajax({
                        url: "./consultas/modulos.php?eliminarModulo=true&id=" + id,
                        data: {},
                        type: "POST",
                        success: function(data) {
                            if (data == "exito") {
                                alert("El módulo ha sido eliminado exitosamente")
                                $('#tablePeriods').DataTable().ajax.reload()
                            }
                        },
                    });
                }

                function guardarCambios() {

                    var estate = document.getElementById('modstatePeriod').value
                    var dateInitial = document.getElementById('moddateStartPeriod').value
                    var dateFinal = document.getElementById('moddateEndPeriod').value
                    $.ajax({
                        url: "periodGetService.php?editarModulo=true&id=" + id,
                        data: {
                            estate: estate,
                            dateInitial: dateInitial,
                            dateFinal: dateFinal
                        },
                        type: "POST",
                        success: function(data) {
                            if (data == "exito") {
                                alert("El módulo ha sido editado exitosamente")
                                $('#cerrarModal').click()
                                $('#tablePeriods').DataTable().ajax.reload()
                            }
                        },
                    });
                }

                function crearNuevo() {
                    var stateP = document.getElementById('statePeriod').value
                    var dateI = document.getElementById('dateStartPeriod').value
                    var dateF = document.getElementById('dateEndPeriod').value
                    $.ajax({
                        url: "./periodGetService.php?newPeriod=true",
                        data: {
                            stateP: stateP,
                            dateI: dateI,
                            dateF: dateF
                        },
                        type: "POST",
                        success: function(data) {
                            if (data == "exito") {
                                alert("El módulo ha sido registrado exitosamente")
                                $('#cerrar').click()
                                $('#tablePeriods').DataTable().ajax.reload()
                            }
                        },
                    });
                }

                function fillSelectPeriods() {
                    $.ajax({
                        url: "periodGetService.php?selectPeriods=true",
                        data: {},
                        type: "POST",
                        success: function(data) {
                            if (data != "mal") {
                                var selectPeriods = document.getElementById("selectPeriods");
                                selectPeriods.innerHTML = data;
                                var selectPeriodShedule = document.getElementById("selectPeriodShedule");
                                selectPeriodShedule.innerHTML = data;
                            }
                        }
                    });
                }

                function guardarFuncionNuevo() {
                    var type = document.getElementById('typeShedule').value
                    var descrip = document.getElementById('descripShedule').value
                    var dateS = document.getElementById('dateShedule').value
                    var selectNewPeriod = document.getElementById('selectPeriodShedule').value
                    $.ajax({
                        url: "./periodGetService.php?newShedule=true",
                        data: {
                            type: type,
                            descrip: descrip,
                            dateS: dateS,
                            modulo: selectNewPeriod
                        },
                        type: "POST",
                        success: function(data) {
                            if (data == "exito") {
                                alert("El nuevo cronograma ha sido guardado exitosamente")
                                $('#cerrarNue').click()
                                $('#tblfunc').DataTable().ajax.reload()
                            }
                        },
                    });
                }

                function tablaFunciones() {
                    var modulo = document.getElementById('selectPeriods').value
                    tblfunc = $('#tblfunc').DataTable({
                        "ajax": "periodGetService.php?listShedules=true&modulo=" + modulo,
                        "columns": [{
                                "data": "COD_REGLA_PERIODO",
                                visible: false
                            },
                            {
                                "data": "TIPO"
                            },
                            {
                                "data": "NOMBRE_REGLA"
                            },
                            {
                                "data": "VALOR"
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
                    $('#tblfunc tbody').on('click', 'td', function() {
                        var data = tblfunc.row($(this).parents('tr')).data();
                        idFunc = data['COD_FUNCIONALIDAD'];
                        document.getElementById('urlPrincipal').value = data['URL_PRINCIPAL']
                        document.getElementById('nombreFuncion').value = data['NOMBRE']
                        document.getElementById('descriFuncion').value = data['DESCRIPCION']
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
        <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
        <!-- Summernote -->
        <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../dist/js/demo.js"></script>

</body>
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

</html>