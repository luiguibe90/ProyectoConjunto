<?php

include_once 'mainService.php';
class infraestructuraService extends mainService
{
    function mostrarInfraestructura($nombreEntidad)
    {
        return $this->conex->query("SELECT * FROM ".$nombreEntidad);
    }
    //SEDE
    function insertarSede($nameCampus,$addressCampus,$telefCampus,$postCampus)
    {
  
        $stmt = $this->conex->prepare("INSERT INTO sede(NOMBRE,DIRECCION,TELEFONO,CODIGO_POSTAL) 
                                          VALUES (?,?,?,?)");
        $stmt->bind_param('ssss',$nameCampus,$addressCampus,$telefCampus,$postCampus);
        $stmt->execute();
        $stmt->close();


    }
    function encontrarSede($codigo_sede)
    {
        $result = $this->conex->query("SELECT * FROM sede WHERE COD_SEDE='".$codigo_sede."'");
        if($result->num_rows>0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
    function modificarSede($cod_sede,$nombre,$direccion,$telefono,$codigo_postal, $cod_comparar)
    {
        $stmt = $this->conex->prepare("UPDATE sede SET COD_SEDE=?,NOMBRE=?,DIRECCION=?,TELEFONO=?,CODIGO_POSTAL=?
                                          WHERE COD_SEDE=?");
        $stmt->bind_param('ssssss' ,$cod_sede,$nombre,$direccion,$telefono,$codigo_postal, $cod_comparar);
        $stmt->execute();
        $stmt->close();
    }

    //EDIFICIOS
    function insertarEdificio($cod_sede,$nombre,$cantidad_pisos)
    {
        $stmt = $this->conex->prepare("INSERT INTO edificio(COD_SEDE,NOMBRE,CANTIDAD_PISOS) 
                                          VALUES (?,?,?)");
        $stmt->bind_param('ssi',$cod_sede,$nombre,$cantidad_pisos);
        $stmt->execute();
        $stmt->close();
    }
    function encontrarEdificio($codigo_edificio)
    {
        $result = $this->conex->query("SELECT * FROM edificio WHERE COD_EDIFICIO='".$codigo_edificio."'");
        if($result->num_rows>0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
    function modificarEdicio($cod_edificio, $cod_sede, $nombre, $cantidad_pisos, $cod_comparar)
    {
        $stmt = $this->conex->prepare("UPDATE edificio SET COD_EDIFICIO=?,COD_SEDE=?,NOMBRE=?,CANTIDAD_PISOS=?
                                          WHERE COD_EDIFICIO=?");
        $stmt->bind_param('sssis' ,$cod_edificio,$cod_sede, $nombre, $cantidad_pisos, $cod_comparar);
        $stmt->execute();
        $stmt->close();
    }
    function eliminarEdificio($codigo_edificio)
    {
        $stmt = $this->conex->prepare("DELETE FROM edificio WHERE COD_EDIFICIO=?");
        $stmt->bind_param('s',$codigo_edificio);
        $stmt->execute();
        $stmt->close();
    }
    //AULAS
    function insertarAula( $codEdificio, $nameClass, $capClass, $typClass, $floClass)
    {
        $stmt = $this->conex->prepare("INSERT INTO aula(COD_EDIFICIO,NOMBRE,CAPACIDAD,TIPO,PISO) 
                                          VALUES (?,?,?,?,?)");
        $stmt->bind_param('isisi', $codEdificio, $nameClass, $capClass, $typClass, $floClass);
        $stmt->execute();
        $stmt->close();
    }
   
    function encontrarAula($codigo_aula)
    {
        $result = $this->conex->query("SELECT * FROM aula WHERE COD_AULA='".$codigo_aula."'");
        if($result->num_rows>0)
        {
            return $result->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
    function modificarAula($cod_aula, $cod_edificio, $nombre, $capacidad, $tipo, $piso,$cod_aula_comparar)
    {
        $stmt = $this->conex->prepare("UPDATE aula SET COD_AULA=?,COD_EDIFICIO=?,NOMBRE=?,CAPACIDAD=?,TIPO=?,PISO=?
                                          WHERE COD_AULA=?");
        $stmt->bind_param('sssisis',$cod_aula,$cod_edificio, $nombre, $capacidad, $tipo, $piso,$cod_aula_comparar);
        $stmt->execute();
        $stmt->close();
    }
    function eliminarAula($codigo_aula)
    {
        $stmt = $this->conex->prepare("DELETE FROM aula WHERE COD_AULA=?");
        $stmt->bind_param('s',$codigo_aula);
        $stmt->execute();
        $stmt->close();
    }
}

?>