<?php
  include './service/clienteService.php';
  session_start();
  if (!isset($_SESSION['user'])) {
    header('Location: login.php');
  }
?>
<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>INSPINIA | Main view</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">

            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="block m-t-xs font-bold"><?php echo $_SESSION['user']['NAME'] ?></span>
                                    <span class="text-muted text-xs block">menu <b class="caret"></b></span>
                                </a>
                                <?php
                                 if ($_SESSION['user']['ROL'] == 'ADM') {

                                 
                                ?>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a class="dropdown-item" href="logout.php">Admin</a></li>
                                </ul>
                                <?php } else { ?>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a class="dropdown-item" href="logout.php">User</a></li>
                                </ul>
                                <?php }?>    
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                IN+
                            </div>
                        </li>
                        <li class="active">
                            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Main view</span></a>
                        </li>
                        <li>
                            <a href="minor.html"><i class="fa fa-th-large"></i> <span class="nav-label">Minor view</span> </a>
                        </li>
                    </ul>

                </div>
            </nav>

            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                            <form role="search" class="navbar-form-custom" method="post" action="#">
                                <div class="form-group">
                                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                                </div>
                            </form>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <a href="logout.php">
                                    <i class="fa fa-sign-out"></i> Log out
                                </a>
                            </li>
                        </ul>

                    </nav>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center m-t-lg">
                            <form id="forma" name="forma" method="post" action="index.php">
                                <h1>Conexion a BD Mysql</h1>
                                <small>
                                
                                </small>
                                <h1>Ejemplo mas cercano a la realidad</h1>
                                <table border=0>
                                  <tr>
                                    <td colspan=3 style="width: 500px;">&nbsp;</td>
                                    <td><input type="button" name="eliminar" value="Eliminar" onclick="eliminarCliente();"></td>
                                  </tr>
                                </table>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td>CEDULA</td>
                                        <td>NOMBRE</td>
                                        <td>FECHA NACIMIENTO</td>
                                        <td>ELIM.</td>
                                    </tr>
                                    </thead>
                                <tbody>
                                   <?php
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td><a href="index.php?update=<?php echo $row["cod_cliente"]; ?>" ><?php echo $row["cod_cliente"]; ?></a></td>
                                                <td><?php echo $row["cedula"]; ?></td>
                                                <td><?php echo $row["nombre"]; ?></td>
                                                <td><?php echo $row["fecha_nacimiento"]; ?></td>
                                                <td><input type="radio" name="eliCodigo" value="<?php echo $row["cod_cliente"]; ?>"></td>
                                            </tr>
                                        <?php }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="4">No hay datos</td>
                                        </tr>
<?php } ?>
                                </tbody>
                                </table>
                                <br/>
                               
                                <input type="hidden" name="codCliente" value="<?php echo $codCliente; ?>" />
                                        <table border="0" >
                                            <tr><td colspan=2 ><strong>Nuevo Cliente</strong></td></tr>
                                            <tr>
                                              <td><label id="lblCedula" for="cedula">Cedula:</label></td>
                                              <td><input type="text" name="cedula" value="<?php echo $cedula; ?>" maxlength="10" size="11" requiered/></td>
                                            </tr>
                                            <tr>
                                              <td><label id="lblNombre" for="nombre">Nombre:</label></td>
                                              <td><input type="text" name="nombre" value="<?php echo $nombre; ?>" maxlength="100" size="25" required/></td>
                                            </tr>
                                            <tr>
                                              <td><label id="lblFechaNacimiento" for="fechaNacimiento">Fecha Nacimieto:</label></td>
                                              <td><input type="text" name="fechaNacimiento" value="<?php echo $fechaNacimiento; ?>" maxlength="10" size="11" /></td>
                                            </tr>
                                            <tr><td colspan=2><input type="submit" name="accion" value="<?php echo $accion; ?>"/></td></tr>
                                        </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="pull-right">
                        10GB of <strong>250GB</strong> Free.
                    </div>
                    <div>
                        <strong>Copyright</strong> Example Company &copy; 2014-2019
                    </div>
                </div>

            </div>
        </div>

        <!-- Mainly scripts -->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="js/inspinia.js"></script>
        <script src="js/plugins/pace/pace.min.js"></script>


    </body>
    <script>
      function eliminarCliente() {
        document.getElementById('forma').submit();
      }
    </script>
</html>