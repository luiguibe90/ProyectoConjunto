<?php

include_once 'mainService.php';

  class aspirantService extends mainService{
    private $entityName = "PERSONA";
    function insertPeopleTeacher($cedDocente,$snDocente,$nameDocente,
    $addressDocente,$telfDocente,$dateBrhDocente,$genderD,$pemailDocente){
    $sql="INSERT INTO PERSONA(CEDULA, APELLIDO, NOMBRE, DIRECCION, TELEFONO, FECHA_NACIMIENTO, GENERO, CORREO_PERSONAL) VALUES (?,?,?,?,?,?,?,?)";
   if( $stmt = $this->conex->prepare($sql)){
    $stmt->bind_param('ssssssss',$cedDocente,$snDocente,$nameDocente,
    $addressDocente,$telfDocente,$dateBrhDocente,$genderD,$pemailDocente);
    $stmt->execute();
   }else {
     var_dump($this->conex->error);
   }
    $stmt->close();
    $this->conex->close();
    }
}
?>