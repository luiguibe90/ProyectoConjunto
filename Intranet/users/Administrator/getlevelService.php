<?php
include '../../service/levelService.php';
$levelService = new levelService();
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/Bogota');


if (isset($_GET['listlevel'])) {
$levelService->listLevel();
 //echo json_encode($datos);
}

if (isset($_GET['newLevel'])) {
    $levelService->insertLevel($_POST['nameLevel'],$_POST['nLevel']);
}

?>