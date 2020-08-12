<?php
include_once 'mainService.php';
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/Bogota');

class enrollementService extends mainService{


    function showShedule($modulo){
        $consult = $this->conex->query("
        SELECT
	    P.COD_PERSONA AS CODALUMN,
	    concat(P.APELLIDO,',',P.NOMBRE) AS NAMEPEOPLE,
	    N.COD_NIVEL_EDUCATIVO AS LEVEL
        FROM 
	    MATRICULA_PERIODO M,
	    PERSONA P,
	    NIVEL_EDUCATIVO N
        WHERE  
	    P.COD_PERSONA=M.COD_ALUMNO
	    AND N.COD_NIVEL_EDUCATIVO=M.COD_NIVEL_EDUCATIVO
	    AND M.COD_PERIODO_LECTIVO=$modulo
        ");
        while ($row = $consult->fetch_assoc()) {    
          $datos['data'][] = $row;
        }
        echo json_encode($datos);
     }
     

     function selectLevel(){
      $consult = $this->conex->query("SELECT *FROM NIVEL_EDUCATIVO ");
      $cont=0;
      $datos=null;      
      while ($row = $consult->fetch_assoc()){
          $cont=1;
          $datos = $datos."<option value=" . $row['COD_NIVEL_EDUCATIVO'] . ">" ."Nivel:".$row['NIVEL'] ." ".$row['NOMBRE']. "</option>";
      }
      if($cont==0){
          echo ("mal");
      }else{
          echo ($datos); 
      }    
    }

    function searchAlumn($alumn){

        $consult = $this->conex->query("SELECT
        concat(P.APELLIDO,',',P.NOMBRE) AS NAMEALUMN,
        T.ESTADO AS ESTADO
        FROM
        PERSONA P,
        TIPO_PERSONA_PERSONA T
        WHERE
          P.COD_PERSONA=T.COD_PERSONA
          AND P.CEDULA = '$alumn'
          AND T.COD_TIPO_PERSONA = 1 ");
        while ($row = $consult->fetch_assoc()) {    
            $datos['data'][] = $row;
          }
          echo json_encode($datos);

    }
        










}
















?>