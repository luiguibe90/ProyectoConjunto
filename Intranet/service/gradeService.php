<?php

include 'mainService.php';

class gradeService extends mainService
{
    //INGRESO DOCENTE
    function periodo()
    {
        return $this->conex->query("SELECT * FROM periodo_lectivo WHERE ESTADO = 'ACT'");
    }
    function docenteCalificacion($cod_docente)
    {
        return $this->conex->query("SELECT asignatura.NOMBRE, asignatura.COD_NIVEL_EDUCATIVO, 
        asignatura.COD_ASIGNATURA,asignatura_periodo.COD_DOCENTE,asignatura_periodo.COD_PARALELO, paralelo.NOMBRE as NOMPARALELO
        FROM asignatura 
        INNER JOIN asignatura_periodo ON asignatura.COD_ASIGNATURA = asignatura_periodo.COD_ASIGNATURA
        INNER JOIN paralelo ON paralelo.COD_PARALELO = asignatura_periodo.COD_PARALELO 
        WHERE asignatura_periodo.COD_DOCENTE ='".$cod_docente."'");
    }
    function listarEstudiantes($cod_nivel_educativo,$cod_periodo_lectivo)
    {
      
        return $this->conex->query("SELECT persona.COD_PERSONA, persona.APELLIDO, persona.NOMBRE
                                       FROM persona 
                                       INNER JOIN matricula_periodo
                                       ON persona.COD_PERSONA = matricula_periodo.COD_ALUMNO
                                       WHERE matricula_periodo.COD_NIVEL_EDUCATIVO='".$cod_nivel_educativo."' AND COD_PERIODO_LECTIVO='".$cod_periodo_lectivo."' ORDER BY persona.APELLIDO");
    }
    function ingresarNotas($cod_periodo_lectivo,$cod_alumno,$cod_nivel_educativo,$cod_asignatura,$cod_paralelo,$cod_docente,$nota1,$nota2,$nota3)
    {
        $stmt = $this->conex->prepare("INSERT INTO alumno_asignatura_periodo (COD_PERIODO_LECTIVO,COD_ALUMNO,COD_NIVEL_EDUCATIVO, 
        COD_ASIGNATURA,COD_PARALELO,COD_DOCENTE,NOTA1,NOTA2,NOTA3)
        VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('sisssiddd',$cod_periodo_lectivo,$cod_alumno,$cod_nivel_educativo,$cod_asignatura,$cod_paralelo,$cod_docente,$nota1,$nota2,$nota3);
        $stmt->execute();
        $stmt->close();
    }
    function ingresarNotas2($cod_alumno,$cod_asignatura,$nota1,$nota2,$nota3)
    {
        $stmt = $this->conex->prepare("UPDATE alumno_asignatura_periodo SET NOTA4=?,NOTA5=?,NOTA6=?
                                          WHERE COD_ALUMNO=? AND COD_ASIGNATURA=?");
        $stmt->bind_param('dddis' ,$nota1,$nota2,$nota3,$cod_alumno,$cod_asignatura);
        $stmt->execute();
        $stmt->close();
    }
    function promedioQuimestral1($cod_periodo,$cod_alumno,$cod_nivel_educativo,$nota1,$nota2,$nota3)
    {
        $datos = $this->conex->query("SELECT PROMEDIOQ1 FROM matricula_periodo WHERE COD_ALUMNO='".$cod_alumno."'
                                         AND COD_PERIODO_LECTIVO='".$cod_periodo."' AND COD_NIVEL_EDUCATIVO='".$cod_nivel_educativo."'");
        $promedio = $datos->fetch_assoc();
        $promedioT = floatval($promedio['PROMEDIOQ1']);
        if($promedioT==0)
        {
            $promedioT = ($promedioT + (($nota1+$nota2+$nota3)/3));    
        }
        else
        {
            $promedioT = ($promedioT + (($nota1+$nota2+$nota3)/3))/2;
        }
        
        $stmt = $this->conex->prepare("UPDATE matricula_periodo SET PROMEDIOQ1=?
                                          WHERE COD_ALUMNO=? AND COD_PERIODO_LECTIVO=? AND COD_NIVEL_EDUCATIVO=?");
        $stmt->bind_param('diss' ,$promedioT,$cod_alumno,$cod_periodo,$cod_nivel_educativo);
        $stmt->execute();
        $stmt->close();
    }
    function promedioQuimestral2($cod_periodo,$cod_alumno,$cod_nivel_educativo,$nota1,$nota2,$nota3)
    {
        $datos = $this->conex->query("SELECT PROMEDIOQ2 FROM matricula_periodo WHERE COD_ALUMNO='".$cod_alumno."'
                                         AND COD_PERIODO_LECTIVO='".$cod_periodo."' AND COD_NIVEL_EDUCATIVO='".$cod_nivel_educativo."'");
        $promedio = $datos->fetch_assoc();
        $promedioT = floatval($promedio['PROMEDIOQ2']);
        if($promedioT==0)
        {
            $promedioT = ($promedioT + (($nota1+$nota2+$nota3)/3));    
        }
        else
        {
            $promedioT = ($promedioT + (($nota1+$nota2+$nota3)/3))/2;
        }

        $calificacionQ1 = $this->conex->query("SELECT PROMEDIOQ1 FROM matricula_periodo WHERE COD_ALUMNO='".$cod_alumno."'
                                                  AND COD_PERIODO_LECTIVO='".$cod_periodo."' AND COD_NIVEL_EDUCATIVO='".$cod_nivel_educativo."'");
        $promedioQ1 = $calificacionQ1->fetch_assoc();
        $promedioFinal = (floatval($promedioQ1['PROMEDIOQ1']) + $promedioT)/2;
        

        $stmt = $this->conex->prepare("UPDATE matricula_periodo SET PROMEDIOQ2=?, PROMEDIO_FINAL=?
                                          WHERE COD_ALUMNO=? AND COD_PERIODO_LECTIVO=? AND COD_NIVEL_EDUCATIVO=?");
        $stmt->bind_param('ddiss' ,$promedioT,$promedioFinal,$cod_alumno,$cod_periodo,$cod_nivel_educativo);
        $stmt->execute();
        $stmt->close();
    }

    //PARA VISUALIZAR DEL ESTUDIANTE
    function asignaturasEstudiante($cod_alumno,$cod_periodo_lectivo)
    {
        return $this->conex->query("SELECT asignatura_periodo.COD_ASIGNATURA,asignatura.NOMBRE
        FROM asignatura_periodo
        INNER JOIN matricula_periodo ON matricula_periodo.COD_NIVEL_EDUCATIVO = asignatura_periodo.COD_NIVEL_EDUCATIVO
        INNER JOIN asignatura ON asignatura.COD_ASIGNATURA = asignatura_periodo.COD_ASIGNATURA
        WHERE matricula_periodo.COD_ALUMNO='".$cod_alumno."' AND matricula_periodo.COD_PERIODO_LECTIVO = '".$cod_periodo_lectivo."'");
    }
    function calificacionesEstudiante($cod_alumno,$cod_asignatura)
    {
        return $this->conex->query("SELECT NOTA1,NOTA2,NOTA3 FROM alumno_asignatura_periodo WHERE COD_ALUMNO='".$cod_alumno."'
        AND COD_ASIGNATURA='".$cod_asignatura."'");
    }
    function calificacionesEstudiante2($cod_alumno,$cod_asignatura)
    {
        return $this->conex->query("SELECT NOTA4,NOTA5,NOTA6 FROM alumno_asignatura_periodo WHERE COD_ALUMNO='".$cod_alumno."'
        AND COD_ASIGNATURA='".$cod_asignatura."'");
    }
    function calificacionGeneral1($cod_alumno,$cod_periodo)
    {
        return $this->conex->query("SELECT alumno_asignatura_periodo.NOTA1, alumno_asignatura_periodo.NOTA2, alumno_asignatura_periodo.NOTA3,asignatura.NOMBRE
        FROM alumno_asignatura_periodo
        INNER JOIN asignatura ON asignatura.COD_ASIGNATURA = alumno_asignatura_periodo.COD_ASIGNATURA
        WHERE alumno_asignatura_periodo.COD_ALUMNO='".$cod_alumno."' AND alumno_asignatura_periodo.COD_PERIODO_LECTIVO='".$cod_periodo."'");
    }
    function calificacionGeneral2($cod_alumno,$cod_periodo)
    {
        return $this->conex->query("SELECT alumno_asignatura_periodo.NOTA4, alumno_asignatura_periodo.NOTA5, alumno_asignatura_periodo.NOTA6,asignatura.NOMBRE
        FROM alumno_asignatura_periodo
        INNER JOIN asignatura ON asignatura.COD_ASIGNATURA = alumno_asignatura_periodo.COD_ASIGNATURA
        WHERE alumno_asignatura_periodo.COD_ALUMNO='".$cod_alumno."' AND alumno_asignatura_periodo.COD_PERIODO_LECTIVO='".$cod_periodo."'");
    }

    //PARA VISUALiZAR EN EL REPRESENTANTE
    function datosEstudiante($cod_representante)
    {
        return $this->conex->query("SELECT COD_PERSONA,APELLIDO,NOMBRE FROM persona 
        WHERE COD_PERSONA_REPRESENTANTE='".$cod_representante."'");
    }
}
