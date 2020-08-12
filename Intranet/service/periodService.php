<?php
include_once 'mainService.php';
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/Bogota');

class periodService extends mainService{
  
   
 function listPeriod(){
   $datos = null;
   $result = $this->conex->query("SELECT *  FROM periodo_lectivo " );
   while ($row = $result->fetch_assoc()) {    
    $datos['data'][] = $row;
  }
  echo json_encode($datos);
   //return $datos;
 }

 function getCodPeriod(){
   return $this->conex->query("SELECT COD_PERIODO_LECTIVO AS id FROM PERIODO_LECTIVO ORDER BY COD_PERIODO_LECTIVO DESC LIMIT 1 ");
 }

 function insertPeriod($state,$dateInitial,$dateFinal){ 

  $sql = ("INSERT INTO periodo_lectivo(ESTADO, FECHA_INICIO, FECHA_FIN) 
                VALUES (?,?,?)");
  $result = $this->conex->query("select *from periodo_lectivo where FECHA_INICIO = $dateInitial");
  if($result->num_rows == 0){
    if( $stmt = $this->conex->prepare($sql)){
      $stmt->bind_param('sss',$state,$dateInitial,$dateFinal);
      $stmt->execute();
      $stmt->close();
    }
  }
  return $this->conex->affected_rows;
}

function updateModulo($state,$dateInitial,$dateFinal,$codPeriod){
$stmt = $this->conex->prepare(" UPDATE PERIODO_LECTIVO SET ESTADO = ?, FECHA_INICIO = ? , FECHA_FIN = ? where COD_PERIODO_LECTIVO = ? ");
$stmt->bind_param("sssi",$state,$dateInitial,$dateFinal,$codPeriod);
$stmt->execute();
$stmt->close();
return $this->conex->affected_rows;
}
 
function selectPeriod(){
  $consult = $this->conex->query("SELECT *FROM PERIODO_LECTIVO ");
  $cont=0;
  $datos=null;      
  while ($row = $consult->fetch_assoc()){
      $cont=1;
      $datos = $datos."<option value=" . $row['COD_PERIODO_LECTIVO'] . ">" ."DEL " . $row['FECHA_INICIO'] ." AL ".$row['FECHA_FIN']. "</option>";
  }
  if($cont==0){
      echo ("mal");
  }else{
      echo ($datos); 
  }    
}

function insertNewShedule($codPeriod,$typeShedule,$descripShedule,$dateSchedule){
  
  
  $sql = ("INSERT INTO regla_periodo(COD_PERIODO_LECTIVO, TIPO, NOMBRE_REGLA, VALOR) VALUES (?,?,?,?)");
     $stmt = $this->conex->prepare($sql);
     $stmt->bind_param('isss',$codPeriod,$typeShedule,$descripShedule,$dateSchedule);
     $stmt->execute();
  if ($stmt->affected_rows){ 
      $respuesta = "exito"; 
      $stmt->close();  
  }
  if($respuesta=="exito"){
      echo $respuesta;
  }else{
      echo "mal";
  }
}

function showShedule($modulo){
$consult = $this->conex->query("
SELECT
REGLA_PERIODO.COD_REGLA_PERIODO,
REGLA_PERIODO.TIPO,
REGLA_PERIODO.NOMBRE_REGLA,
REGLA_PERIODO.VALOR
FROM
REGLA_PERIODO
INNER JOIN PERIODO_LECTIVO ON REGLA_PERIODO.COD_PERIODO_LECTIVO = PERIODO_LECTIVO.COD_PERIODO_LECTIVO
WHERE PERIODO_LECTIVO.COD_PERIODO_LECTIVO = $modulo
");
while ($row = $consult->fetch_assoc()) {    
  $datos['data'][] = $row;
}
echo json_encode($datos);
}







}


?>