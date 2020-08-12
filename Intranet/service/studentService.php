<?php

include_once 'mainService.php';

  class studentService extends mainService{
    private $entityName = "PERSONA";
    
    function findAll(){
      return $this->conex->query("  ");
    }
    function insertPeopleRepresentative($cedRepresentantive,$snRrepresentative,$nameRepresenative,
    $addressRepresentative,$telfRepresentative,$dateBrhRepresentative,$genderR,$pemailRepresentative){
    $sql="INSERT INTO PERSONA(CEDULA, APELLIDO, NOMBRE, DIRECCION, TELEFONO, FECHA_NACIMIENTO, GENERO, CORREO_PERSONAL) VALUES (?,?,?,?,?,?,?,?)";
    $result = $this->conex->query("SELECT * FROM PERSONA WHERE CEDULA = '$cedRepresentantive' ");
    if($result->num_rows == 0){

      if( $stmt = $this->conex->prepare($sql)){
        $stmt->bind_param('ssssssss',$cedRepresentantive,$snRrepresentative,$nameRepresenative,
        $addressRepresentative,$telfRepresentative,$dateBrhRepresentative,$genderR,$pemailRepresentative);
        $stmt->execute();
        $stmt->close();
       }else {
         //var_dump($this->conex->error);
       }
       $sql1=" CALL typePeopeRepresentative(?) ";
       if($stmt1 = $this->conex->prepare($sql1)){
          $stmt1->bind_param('s',$cedRepresentantive);
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

  function insertPeopleAlumn($cedAlumn,$snameAlumn,$nameAlumn,$addreAlunn,$telefAlumno,
  $dateBirthAlumn,$genderA,$emailpAlumno){
   
   
  echo("<script>console.log('PHP:recibido ');</script>");

  $sql=" CALL asignedStudentRepresentative(?,?,?,?,?,?,?,?) ";
  $result = $this->conex->query("SELECT * FROM PERSONA WHERE CEDULA = '$cedAlumn'  ");
  if($result->num_rows == 0){
    if( $stmt = $this->conex->prepare($sql)){
      $stmt->bind_param('ssssssss',$cedAlumn,$snameAlumn,$nameAlumn,$addreAlunn,$telefAlumno,
      $dateBirthAlumn,$genderA,$emailpAlumno);
      $stmt->execute();
      $stmt->close();
     }
  }else{
    echo "<script>alert('Error, el numero de cédula ya existe..');</script>";
  }
  
    $this->conex->close();

  }

  function showPeople($peopeTypeCode){
    
    return  $this->conex->query("CALL showTypePerson( '$peopeTypeCode' )");

  }

function findGrades($codAlumno){
        return $this->conex->query("SELECT a.NOMBRE, c.NOTA1, c.NOTA2, c.NOTA3, 
        c.NOTA4, c.NOTA5, c.NOTA6, c.NOTA7, c.NOTA8, c.NOTA9, c.NOTA10 FROM 
        ASIGNATURA a, ALUMNO_ASIGNATURA_PERIODO c WHERE a.COD_ASIGNATURA = c.COD_ASIGNATURA 
        AND c.COD_ALUMNO =".$codAlumno);
    }
    
    function findSubjet($codAlumno){
        return $this->conex->query("SELECT n.NOMBRE_NIVEL, n.NIVEL, a.NOMBRE, a.COD_ASIGNATURA FROM ASIGNATURA a, NIVEL_EDUCATIVO n, ALUMNO_ASIGNATURA_PERIODO c
        WHERE a.COD_ASIGNATURA = c.COD_ASIGNATURA AND n.COD_NIVEL_EDUCATIVO = c.COD_NIVEL_EDUCATIVO 
        AND c.COD_ALUMNO =".$codAlumno);
    }
    
    function findLevel($codAlumno){
        return $this->conex->query("SELECT n.NOMBRE_NIVEL, n.NIVEL, a.COD_ASIGNATURA FROM NIVEL_EDUCATIVO n, ALUMNO_ASIGNATURA_PERIODO a
        WHERE n.COD_NIVEL_EDUCATIVO = a.COD_NIVEL_EDUCATIVO 
        AND a.COD_ALUMNO =".$codAlumno);
    }

    function findSubjetByCode($codAsignatura){
        return $this->conex->query("SELECT a.NOMBRE, a.COD_ASIGNATURA, n.NIVEL, n.NOMBRE_NIVEL FROM ASIGNATURA a, NIVEL_EDUCATIVO n
        WHERE a.COD_NIVEL_EDUCATIVO = n.COD_NIVEL_EDUCATIVO AND a.COD_ASIGNATURA =".$codAsignatura);
    }

    function findyAll(){
        return $this->conex->query("SELECT NOMBRE FROM ASIGNATURA");
    }

    function findRelease($codAsignatura){
        //$conex = getConection();
        return $this->conex->query("SELECT c.ASUNTO_COMUNICADO, c. DETALLE_COMUNICADO, a.NOMBRE
        FROM COMUNICADO_ASIGNATURA c, ASIGNATURA a
        WHERE c.COD_ASIGNATURA=a.COD_ASIGNATURA 
        AND c.COD_ASIGNATURA=".$codAsignatura);
    }

    function findAssistance($codAlumno){
        return $this->conex->query("SELECT FECHA, ESTADO FROM ASISTENCIA_PERIODO WHERE COD_ALUMNO =".$codAlumno);
    }

    function findHomework($codAsignatura){
        //$conex = getConection();
        return $this->conex->query("SELECT t.TEMA_TAREA, t.FECHA_ENTREGA, t.DETALLE_TAREA, t.HORA_ENTREGA, a.NOMBRE 
        FROM TAREA_ASIGNATURA t, ASIGNATURA a
        WHERE t.COD_ASIGNATURA=a.COD_ASIGNATURA 
        AND t.COD_ASIGNATURA=".$codAsignatura);
    }

    function findSchedule($codAlumno, $codAsignatura){
        return $this->conex->query("SELECT h.HORA_INICIO, h.HORA_FIN, a.DIA, p.NOMBRE 
        FROM ASIGNATURA_HORARIO a, HORARIO h, ALUMNO_ASIGNATURA_PERIODO c, PARALELO p
        WHERE a.COD_ASIG_PERIODO = c.COD_ASIG_PERIODO AND c.COD_PARALELO = p.COD_PARALELO AND h.COD_HORARIO = a.COD_HORARIO AND  
        c.COD_ALUMNO =".$codAlumno." AND c.COD_ASIGNATURA=".$codAsignatura);
    }
    function updatePassword($password, $codUsuario){
        $stmt = $this->conex->prepare("UPDATE USUARIO set CLAVE=?
        WHERE COD_USUARIO= ?");
        $stmt->bind_param("si", $password,$codUsuario);
        $stmt->execute();
        $stmt->close();
    }







}



?>