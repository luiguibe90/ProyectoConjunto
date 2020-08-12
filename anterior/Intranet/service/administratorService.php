<?php
include_once 'mainService.php';
class administratorService extends mainService{
 function countTypePeople($codTypePeople){
   $sql_sel = $this->conex->query("
   SELECT t.*  FROM
       schoolardb.tipo_persona_persona t
   where t.COD_TIPO_PERSONA='$codTypePeople' ");
   $nAlumns = $sql_sel->num_rows;
   return $nAlumns;
 }









}


?>