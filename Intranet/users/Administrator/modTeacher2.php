<?php
	$mysql=new mysqli("sschoodb.mysql.database.azure.com", "adminschoolar@sschoodb", "Admin+123", "schoolardb");
	if ($mysql->connect_error)
	  die("Problemas con la conexión a la base de datos");
  
    $mysql->query("update persona set 
                            CEDULA = '$_REQUEST[cedula]',
                            APELLIDO = '$_REQUEST[apellido]',
                            NOMBRE = '$_REQUEST[nombre]',
                            DIRECCION = '$_REQUEST[direccion]',
                            TELEFONO = '$_REQUEST[telefono]',
                            FECHA_NACIMIENTO = '$_REQUEST[date]',
                            GENERO = '$_REQUEST[genero]',
                            CORREO = '$_REQUEST[mail]',
                            CORREO_PERSONAL = '$_REQUEST[email]',
              where COD_PERSONA=$_REQUEST[codigo]") or
      die($mysql->error());
	 
    $mysql->close();

    header('Location:./viewTeacher.php');
  ?>