<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/Bogota');
include 'enrollementService.php';

$enrollement = new enrollementService();
if (isset($_GET['listEnroll'])) {
    $enrollement->showShedule($_GET['modulo']);
  }

 if (isset($_GET['selectLevels'])) {
   $enrollement->selectLevel();
 }
 if (isset($_GET['searchAlumn'])) {
  $enrollement->searchAlumn($_GET['idAlumnSearch']);
}



  

?>