<?php
	$mysql=new mysqli("sschoodb.mysql.database.azure.com", "adminschoolar@sschoodb", "Admin+123", "schoolardb");
	if ($mysql->connect_error)
    die("Problemas con la conexión a la base de datos");
  else
    echo "Conexión correcta <br> <br>";
    echo $_REQUEST['codigo'];
    echo $_REQUEST['nombre'];
  
    $mysql->query("UPDATE PERSONA SET 
    CEDULA = '$_REQUEST[cedula]',
    NOMBRE = '$_REQUEST[nombre]', 
    APELLIDO = '$_REQUEST[apellido]',
    DIRECCION = '$_REQUEST[direccion]',
    TELEFONO = '$_REQUEST[telefono]',
    FECHA_NACIMIENTO = '$_REQUEST[date]',
    GENERO = '$_REQUEST[genero]', 
    CORREO_PERSONAL = '$_REQUEST[email]',
    CORREO = '$_REQUEST[mail]'
    WHERE cod_persona=$_REQUEST[codigo] ") or die($mysql->error);
	 
    $mysql->close();

    header('Location:./viewTeacher.php');
  ?>