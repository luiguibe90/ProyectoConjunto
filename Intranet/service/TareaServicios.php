<?php

include 'mainService.php';

class TareaServicios extends mainService
{
    function periodo()
    {
        return $this->conex->query("SELECT * FROM periodo_lectivo WHERE ESTADO = 'ACT'");
    }
    function asignaturaParaleloNivel($cod_docente)
    {
        return $this->conex->query("SELECT asignatura.NOMBRE, asignatura.COD_NIVEL_EDUCATIVO, 
        asignatura.COD_ASIGNATURA,asignatura_periodo.COD_DOCENTE,asignatura_periodo.COD_PARALELO, paralelo.NOMBRE as NOMPARALELO 
        FROM asignatura 
        INNER JOIN asignatura_periodo ON asignatura.COD_ASIGNATURA = asignatura_periodo.COD_ASIGNATURA
        INNER JOIN paralelo ON paralelo.COD_PARALELO = asignatura_periodo.COD_PARALELO 
        WHERE asignatura_periodo.COD_DOCENTE ='".$cod_docente."'");
    }
    function ingresarTarea($cod_nivel_educativo,$cod_asignatura,$cod_periodo_lectivo,$cod_paralelo,$cod_docente,$titulo_tarea,$detalle_tarea,$fecha_entrega,$archivo)
    {
        $estado="ACT";
        $stmt = $this->conex->prepare("INSERT INTO tarea_asignatura (COD_NIVEL_EDUCATIVO,COD_ASIGNATURA,COD_PERIODO_LECTIVO 
        ,COD_PARALELO,COD_DOCENTE,TITULO_TAREA,DETALLE_TAREA,FECHA_ENTREGA,ESTADO,ARCHIVO)
        VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('ssssisssss',$cod_nivel_educativo,$cod_asignatura,$cod_periodo_lectivo,$cod_paralelo,$cod_docente,$titulo_tarea,$detalle_tarea,$fecha_entrega,$estado,$archivo);
        $stmt->execute();
        $stmt->close();
    }
    function verificarTarea($cod_alumno)
    {
        $result = $this->conex->query("SELECT tarea_asignatura.TITULO_TAREA,tarea_asignatura.DETALLE_TAREA,
                                    tarea_asignatura.FECHA_ENTREGA,asignatura.IMAGEN,asignatura.NOMBRE,tarea_asignatura.COD_TAREA,tarea_asignatura.ARCHIVO
                                          FROM tarea_asignatura
                                          INNER JOIN matricula_periodo ON tarea_asignatura.COD_NIVEL_EDUCATIVO = matricula_periodo.COD_NIVEL_EDUCATIVO
                                          INNER JOIN asignatura ON tarea_asignatura.COD_ASIGNATURA = asignatura.COD_ASIGNATURA
                                          WHERE matricula_periodo.COD_ALUMNO='".$cod_alumno."' AND tarea_asignatura.ESTADO='ACT'");
        return $result;
    }

    function verificarTareaDocente($cod_docente)
    {
        $result = $this->conex->query("SELECT tarea_asignatura.TITULO_TAREA,tarea_asignatura.DETALLE_TAREA,tarea_asignatura.FECHA_ENTREGA,
        asignatura.NOMBRE,tarea_asignatura.COD_TAREA,paralelo.NOMBRE AS PARALELO
        FROM tarea_asignatura 
        INNER JOIN asignatura ON tarea_asignatura.COD_ASIGNATURA = asignatura.COD_ASIGNATURA
        INNER JOIN paralelo ON tarea_asignatura.COD_PARALELO = paralelo.COD_PARALELO
        WHERE tarea_asignatura.COD_DOCENTE='".$cod_docente."' AND ESTADO='ACT'");
        return $result;
    }

    function tareaTerminada($cod_tarea)
    {
        $estado='FIN';
        $stmt = $this->conex->prepare("UPDATE tarea_asignatura SET ESTADO=?
                                          WHERE COD_TAREA=?");
        $stmt->bind_param('si' ,$estado,$cod_tarea);
        $stmt->execute();
        $stmt->close();
    }
    function ingresarComunicado($cod_nivel_educativo,$cod_asignatura,$cod_periodo_lectivo,$cod_paralelo,$cod_docente,$titulo_comunicado,$detalle_comunicado,$fecha_entrega,$archivo)
    {
        $stmt = $this->conex->prepare("INSERT INTO comunicado_asignatura (COD_NIVEL_EDUCATIVO,COD_ASIGNATURA,COD_PERIODO_LECTIVO 
        ,COD_PARALELO,COD_DOCENTE,DETALLE_COMUNICADO,TITULO_COMUNICADO,FECHA_COMUNICADO,ARCHIVO)
        VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('ssssissss',$cod_nivel_educativo,$cod_asignatura,$cod_periodo_lectivo,$cod_paralelo,$cod_docente,$detalle_comunicado,$titulo_comunicado,$fecha_entrega,$archivo);
        $stmt->execute();
        $stmt->close();
    }
    function verificarComunicado($cod_alumno)
    {
        echo("<script>console.log('PHP:recibido en funcion comunicado ');</script>");
        $result = $this->conex->query("SELECT comunicado_asignatura.TITULO_COMUNICADO,comunicado_asignatura.DETALLE_COMUNICADO,
                                    comunicado_asignatura.FECHA_COMUNICADO,asignatura.IMAGEN,asignatura.NOMBRE,comunicado_asignatura.COD_COMUNICADO,comunicado_asignatura.ARCHIVO
                                          FROM comunicado_asignatura
                                          INNER JOIN matricula_periodo ON comunicado_asignatura.COD_NIVEL_EDUCATIVO = matricula_periodo.COD_NIVEL_EDUCATIVO
                                          INNER JOIN asignatura ON comunicado_asignatura.COD_ASIGNATURA = asignatura.COD_ASIGNATURA
                                          WHERE matricula_periodo.COD_ALUMNO='".$cod_alumno."'");
        return $result;
    }
    //VISUALIZAR AL REPRESENTANTE
    function datosEstudiante($cod_representante)
    {
        return $this->conex->query("SELECT COD_PERSONA,APELLIDO,NOMBRE FROM persona 
        WHERE COD_PERSONA_REPRESENTANTE='".$cod_representante."'");
    }
}
