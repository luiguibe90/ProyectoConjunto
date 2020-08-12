<?php
include_once 'mainService.php';
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/Bogota');

class levelService extends mainService{
function listLevel(){
    $datos = null;
    $result = $this->conex->query("SELECT *  FROM NIVEL_EDUCATIVO " );
    while ($row = $result->fetch_assoc()) {    
     $datos['data'][] = $row;
}
echo json_encode($datos);
}

function insertLevel($nameLevel,$nLevel){ 

    $sql = ("INSERT INTO nivel_educativo (NOMBRE, NIVEL) VALUES (?,?);");
    if( $stmt = $this->conex->prepare($sql)){
        $stmt->bind_param('ss',$nameLevel,$nLevel);
        $stmt->execute();
        if ($stmt->affected_rows){ 
            $respuesta = "exito";  
            $stmt->close(); 
        }
        
    }
    if($respuesta=="exito"){
        echo $respuesta;
    }else{
        echo "mal";
    }

  }


}
?>