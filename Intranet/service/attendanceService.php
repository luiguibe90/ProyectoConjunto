<?php

include_once 'mainService.php';

class attendanceService extends mainService
{
    function periodo()
    {
        
        return $this->conex->query("SELECT
        CONCAT(P.FECHA_INICIO,'AL',P.FECHA_FIN) AS PERIODO,
        P.COD_PERIODO_LECTIVO AS COD_PERIODO_LECTIVO
     FROM
     PERIODO_LECTIVO P
     WHERE
          P.ESTADO = 'ACT'");
    }
    function docenteAsistencia($cod_docente)
    {
        echo ("<script>console.log('PHP:recibido ');</script>");
        return $this->conex->query("SELECT asignatura.NOMBRE, asignatura.COD_NIVEL_EDUCATIVO, 
        asignatura.COD_ASIGNATURA,asignatura_periodo.COD_DOCENTE,asignatura_periodo.COD_PARALELO 
        FROM asignatura INNER JOIN asignatura_periodo 
        ON asignatura.COD_ASIGNATURA = asignatura_periodo.COD_ASIGNATURA 
        WHERE asignatura_periodo.COD_DOCENTE ='" . $cod_docente . "'");
        
    }
    function listarEstudiantes($cod_nivel_educativo)
    {
        //OJO PARA DISCRIMINAR POR PARALELOS EN CASO DE QUE SEA 2 CURSOS DE LOS MISMOS
        //EL JOIN CON LA TABLA ASIGNATURA PERIODO Y MATRICULA PERIODO TE SIRVE PERO HAY QUE VER
        //LA FORMA PARA QUE TRAIGA LOS DATOS DEL ESTUDIANTE
        return $this->conex->query("SELECT persona.COD_PERSONA, persona.APELLIDO, persona.NOMBRE
                                       FROM persona 
                                       INNER JOIN matricula_periodo
                                       ON persona.COD_PERSONA = matricula_periodo.COD_ALUMNO
                                       WHERE matricula_periodo.COD_NIVEL_EDUCATIVO='" . $cod_nivel_educativo . "'");
    }
    function ingresarAsistencia($cod_periodo_lectivo, $cod_alumno, $cod_nivel_educativo, $fecha, $estado)
    {
        $stmt = $this->conex->prepare("INSERT INTO asistencia_periodo (COD_PERIODO_LECTIVO,COD_ALUMNO,COD_NIVEL_EDUCATIVO, 
        FECHA,ESTADO)
        VALUES (?,?,?,?,?)");
        $stmt->bind_param('sisss', $cod_periodo_lectivo, $cod_alumno, $cod_nivel_educativo, $fecha, $estado);
        $stmt->execute();
        $stmt->close();
    }

    //PARA VISUALIZAR DEL ESTUDIANTE
    function asignaturasEstudiante($cod_alumno, $cod_periodo_lectivo)
    {
        return $this->conex->query("SELECT asignatura_periodo.COD_ASIGNATURA,asignatura.NOMBRE
        FROM asignatura_periodo
        INNER JOIN matricula_periodo ON matricula_periodo.COD_NIVEL_EDUCATIVO = asignatura_periodo.COD_NIVEL_EDUCATIVO
        INNER JOIN asignatura ON asignatura.COD_ASIGNATURA = asignatura_periodo.COD_ASIGNATURA
        WHERE matricula_periodo.COD_ALUMNO='" . $cod_alumno . "' AND matricula_periodo.COD_PERIODO_LECTIVO = '" . $cod_periodo_lectivo . "'");
    }
    function asistenciasEstudiante($cod_alumno)
    {
        return $this->conexion->query("SELECT COD_NIVEL_EDUCATIVO,FECHA,ESTADO FROM asistencia_periodo WHERE COD_ALUMNO='" . $cod_alumno . "'");
    }

    //PARA VISUALiZAR EN EL REPRESENTANTE
    function datosEstudiante($cod_representante)
    {
        return $this->conex->query("SELECT COD_PERSONA,APELLIDO,NOMBRE FROM persona 
        WHERE COD_PERSONA_REPRESENTANTE='" . $cod_representante . "'");
    }
}
