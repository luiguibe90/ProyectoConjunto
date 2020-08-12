<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/Bogota');
include '../../service/periodService.php';
$periodService = new periodService();
if (isset($_GET['listPeriod'])) {
      $periodService->listPeriod();
      //echo json_encode($datos);
  }

if (isset($_GET['newPeriod'])) {
    $consulta = $periodService->insertPeriod($_POST['stateP'],$_POST['dateI'],$_POST['dateF']);
    if ($consulta){ 
        $respuesta = "exito";   
    }
    if($respuesta=="exito"){
        echo $respuesta;
    }else{
        echo "mal";
    }
}

if (isset($_GET['editarModulo'])) {
  $consulta = $periodService->updateModulo($_POST['estate'],$_POST['dateInitial'],$_POST['dateFinal'],$_GET['id']);
  if ($consulta){ 
    $respuesta = "exito";   
  }
  if($respuesta=="exito"){
    echo $respuesta;
  }else{
    echo "mal";
  }
}

if (isset($_GET['selectPeriods'])) {
 $periodService->selectPeriod();
}

if (isset($_GET['newShedule'])) {
  
  $periodService->insertNewShedule($_POST['modulo'],$_POST['type'],$_POST['descrip'],$_POST['dateS']);
  
}

if (isset($_GET['listShedules'])) {
  $periodService->showShedule($_GET['modulo']);
}


  
?>