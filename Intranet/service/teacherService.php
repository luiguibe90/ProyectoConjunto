<?php

include_once 'mainService.php';

  class teacherService extends mainService{

    private $entityName = "PERSONA";
    function insertPeopleTeacher($cedDocente,$snDocente,$nameDocente,
    $addressDocente,$telfDocente,$dateBrhDocente,$genderD,$pemailDocente){
      echo("<script>console.log('PHP:recibido ');</script>");
    $sql="INSERT INTO PERSONA(CEDULA, APELLIDO, NOMBRE, DIRECCION, TELEFONO, FECHA_NACIMIENTO, GENERO, 
    CORREO_PERSONAL) VALUES (?,?,?,?,?,?,?,?)";
    $result = $this->conex->query("SELECT * FROM PERSONA WHERE CEDULA = '$cedDocente' ");
    if($result->num_rows == 0){
      if( $stmt = $this->conex->prepare($sql)){
        echo("<script>console.log('PHP:sentencia preparada ');</script>");
        $stmt->bind_param('ssssssss',$cedDocente,$snDocente,$nameDocente,
        $addressDocente,$telfDocente,$dateBrhDocente,$genderD,$pemailDocente);
        $stmt->execute();
        $stmt->close();
       }else {
         var_dump($this->conex->error);
       }
       $sql1=" CALL typePeopleTeacher(?) ";
       if($stmt1 = $this->conex->prepare($sql1)){
        $stmt1->bind_param('s',$cedDocente);
        $stmt1->execute();
        $stmt1->close();
        }else {
         echo "<script>alert('Representante  insertado exitosamente');</script>";
          var_dump($this->conex->error);
        }
        
    }else{
      echo "<script>alert('Error, el numero de cédula ya existe..);</script>";

    }
    
    
    $this->conex->close();
    }
}
