<?php

include_once 'mainService.php';

  class studentService extends mainService{
    private $entityName = "PERSONA";
    function insertPeopleStudent($cedRepresentantive,$snRrepresentative,$nameRepresenative,
    $addressRepresentative,$telfRepresentative,$dateBrhRepresentative,$genderR,$pemailRepresentative){
    $sql="INSERT INTO PERSONA(CEDULA, APELLIDO, NOMBRE, DIRECCION, TELEFONO, FECHA_NACIMIENTO, GENERO, CORREO_PERSONAL) VALUES (?,?,?,?,?,?,?,?)";
   if( $stmt = $this->conex->prepare($sql)){
    $stmt->bind_param('ssssssss',$cedRepresentantive,$snRrepresentative,$nameRepresenative,
    $addressRepresentative,$telfRepresentative,$dateBrhRepresentative,$genderR,$pemailRepresentative);
    $stmt->execute();
   }else {
     var_dump($this->conex->error);
   }
    $stmt->close();
    $this->conex->close();
    }







}



?>