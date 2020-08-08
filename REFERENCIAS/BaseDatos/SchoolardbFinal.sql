create table aspirante
(
    COD_ASPIRANTE    int auto_increment
        primary key,
    CEDULA           varchar(10)  not null,
    APELLIDO         varchar(50)  not null,
    NOMBRE           varchar(50)  not null,
    DIRECCION        varchar(100) null,
    TELEFONO         varchar(15)  null,
    FECHA_NACIMIENTO date         null,
    GENERO           varchar(3)   null,
    CORREO_PERSONAL  varchar(128) not null
);

create table nivel_educativo
(
    COD_NIVEL_EDUCATIVO int auto_increment
        primary key,
    NOMBRE              varchar(100) null,
    NIVEL               varchar(3)   null
);

create table asignatura
(
    COD_ASIGNATURA      int auto_increment,
    COD_NIVEL_EDUCATIVO int          not null,
    NOMBRE              varchar(100) not null,
    CREDITOS            decimal(2)   not null,
    TIPO                varchar(3)   not null,
    primary key (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO),
    constraint FK_ASIGNATURA_A_NIVELEDUCATIVO
        foreign key (COD_NIVEL_EDUCATIVO) references nivel_educativo (COD_NIVEL_EDUCATIVO)
);

create table calificacion_prueba_aspirante
(
    COD_ASPIRANTE       int           not null,
    COD_NIVEL_EDUCATIVO int           not null,
    CALIFICACION        decimal(4, 2) null,
    ESTADO              varchar(3)    null,
    constraint FK_CAL_PRU_ASPIRANTE_A_ASPIRANTE
        foreign key (COD_ASPIRANTE) references aspirante (COD_ASPIRANTE),
    constraint FK_CAL_PRU_ASPIRANTE_A_NIVELEDUCATIVO
        foreign key (COD_NIVEL_EDUCATIVO) references nivel_educativo (COD_NIVEL_EDUCATIVO)
);

create table paralelo
(
    COD_PARALELO        int auto_increment
        primary key,
    COD_NIVEL_EDUCATIVO int          null,
    NOMBRE              varchar(100) not null,
    constraint FK_PARALELO_A_NIVELEDUCATIVO
        foreign key (COD_NIVEL_EDUCATIVO) references nivel_educativo (COD_NIVEL_EDUCATIVO)
);

create table periodo_lectivo
(
    COD_PERIODO_LECTIVO int auto_increment
        primary key,
    ESTADO              varchar(3) not null,
    FECHA_INICIO        date       not null,
    FECHA_FIN           date       null
);

create table cronograma_periodo
(
    COD_CRONOGRAMA_PERIODO int auto_increment
        primary key,
    COD_PERIODO_LECTIVO    int           not null,
    FECHA                  date          not null,
    TIPO                   varchar(3)    null,
    DESCRIPCION            varchar(1000) null,
    constraint FK_CRONOGRAMA_A_PERIODO
        foreign key (COD_PERIODO_LECTIVO) references periodo_lectivo (COD_PERIODO_LECTIVO)
);

create table persona
(
    COD_PERSONA               int auto_increment
        primary key,
    COD_PERSONA_REPRESENTANTE int          null,
    CEDULA                    varchar(10)  not null,
    APELLIDO                  varchar(50)  not null,
    NOMBRE                    varchar(50)  not null,
    DIRECCION                 varchar(200) not null,
    TELEFONO                  varchar(15)  null,
    FECHA_NACIMIENTO          date         not null,
    GENERO                    varchar(3)   not null,
    CORREO                    varchar(128) null,
    CORREO_PERSONAL           varchar(128) not null,
    constraint IDXU_PERSONA_CEDULA
        unique (CEDULA),
    constraint FK_PERSONA_A_PERSONA
        foreign key (COD_PERSONA_REPRESENTANTE) references persona (COD_PERSONA)
);

create table matricula_periodo
(
    COD_ALUMNO          int           not null,
    COD_PERIODO_LECTIVO int           not null,
    COD_NIVEL_EDUCATIVO int           not null,
    PROMEDIOQ1          decimal(4, 2) null,
    PROMEDIOQ2          decimal(4, 2) null,
    PROMEDIO_FINAL      decimal(4, 2) null,
    primary key (COD_ALUMNO, COD_PERIODO_LECTIVO, COD_NIVEL_EDUCATIVO),
    constraint FK_MATPERIODO_A_NIVELEDUCATIVO
        foreign key (COD_NIVEL_EDUCATIVO) references nivel_educativo (COD_NIVEL_EDUCATIVO),
    constraint FK_MATPERIODO_A_PERIODOLECTIVO
        foreign key (COD_PERIODO_LECTIVO) references periodo_lectivo (COD_PERIODO_LECTIVO),
    constraint FK_MATPERIODO_A_PERSONA
        foreign key (COD_ALUMNO) references persona (COD_PERSONA)
);

create table asistencia_periodo
(
    FECHA               date       not null,
    COD_ALUMNO          int        not null,
    COD_PERIODO_LECTIVO int        not null,
    COD_NIVEL_EDUCATIVO int        not null,
    ESTADO              varchar(3) null,
    primary key (FECHA, COD_ALUMNO, COD_PERIODO_LECTIVO, COD_NIVEL_EDUCATIVO),
    constraint FK_ASISTENCIA_PERIODO_A_MATPERIODO
        foreign key (COD_ALUMNO, COD_PERIODO_LECTIVO, COD_NIVEL_EDUCATIVO) references matricula_periodo (COD_ALUMNO, COD_PERIODO_LECTIVO, COD_NIVEL_EDUCATIVO)
);

create table regla_periodo
(
    COD_REGLA_PERIODO   int auto_increment
        primary key,
    COD_PERIODO_LECTIVO int          not null,
    TIPO                varchar(3)   null,
    NOMBRE_REGLA        varchar(100) null,
    VALOR               varchar(100) null,
    constraint FK_REGLAPER_A_PERLECTIVO
        foreign key (COD_PERIODO_LECTIVO) references periodo_lectivo (COD_PERIODO_LECTIVO)
);

create table rol
(
    COD_ROL varchar(8)   not null
        primary key,
    NOMBRE  varchar(100) not null
);

create table sede
(
    COD_SEDE      int auto_increment
        primary key,
    NOMBRE        varchar(100) null,
    DIRECCION     varchar(200) null,
    TELEFONO      varchar(15)  null,
    CODIGO_POSTAL varchar(6)   null
);

create table edificio
(
    COD_EDIFICIO   int auto_increment
        primary key,
    COD_SEDE       int          not null,
    NOMBRE         varchar(100) not null,
    CANTIDAD_PISOS decimal(2)   not null,
    constraint FK_EDIFICIO_A_SEDE
        foreign key (COD_SEDE) references sede (COD_SEDE)
);

create table aula
(
    COD_AULA     int auto_increment
        primary key,
    COD_EDIFICIO int                      not null,
    NOMBRE       varchar(100)             not null,
    CAPACIDAD    decimal(3)               not null,
    TIPO         varchar(3) default 'GEN' not null,
    PISO         decimal(2)               not null,
    constraint FK_AULA_A_EDIFICIO
        foreign key (COD_EDIFICIO) references edificio (COD_EDIFICIO)
);

create table asignatura_periodo
(
    COD_ASIGNATURA      int not null,
    COD_NIVEL_EDUCATIVO int not null,
    COD_PERIODO_LECTIVO int not null,
    COD_DOCENTE         int not null,
    COD_PARALELO        int not null,
    COD_AULA            int not null,
    primary key (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO, COD_PERIODO_LECTIVO, COD_DOCENTE, COD_PARALELO),
    constraint FK_ASIGNATURA_PERIODO_A_ASIGNATURA
        foreign key (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO) references asignatura (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO),
    constraint FK_ASIGNATURA_PERIODO_A_PARALELO
        foreign key (COD_PARALELO) references paralelo (COD_PARALELO),
    constraint FK_ASIGNATURA_PERIODO_A_PERLECTIVO
        foreign key (COD_PERIODO_LECTIVO) references periodo_lectivo (COD_PERIODO_LECTIVO),
    constraint FK_ASIGNATURA_PERIODO_A_PERSONA
        foreign key (COD_DOCENTE) references persona (COD_PERSONA),
    constraint FK_ASIGPERIODO_A_AULA
        foreign key (COD_AULA) references aula (COD_AULA)
);

create table alumno_asignatura_periodo
(
    COD_ALUMNO          int           not null,
    COD_ASIGNATURA      int           not null,
    COD_NIVEL_EDUCATIVO int           not null,
    COD_PERIODO_LECTIVO int           not null,
    COD_DOCENTE         int           not null,
    COD_PARALELO        int           not null,
    NOTA1               decimal(4, 2) null,
    NOTA2               decimal(4, 2) null,
    NOTA3               decimal(4, 2) null,
    NOTA4               decimal(4, 2) null,
    NOTA5               decimal(4, 2) null,
    NOTA6               decimal(4, 2) null,
    NOTA7               decimal(4, 2) null,
    NOTA8               decimal(4, 2) null,
    NOTA9               decimal(4, 2) null,
    NOTA10              decimal(4, 2) null,
    NOTA11              decimal(4, 2) null,
    NOTA12              decimal(4, 2) null,
    NOTA13              decimal(4, 2) null,
    NOTA14              decimal(4, 2) null,
    NOTA15              decimal(4, 2) null,
    primary key (COD_ALUMNO, COD_ASIGNATURA, COD_NIVEL_EDUCATIVO, COD_PERIODO_LECTIVO, COD_DOCENTE, COD_PARALELO),
    constraint FK_ALU_ASIG_PER_A_ASIG_PER
        foreign key (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO, COD_PERIODO_LECTIVO, COD_DOCENTE,
                     COD_PARALELO) references asignatura_periodo (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO,
                                                                  COD_PERIODO_LECTIVO, COD_DOCENTE, COD_PARALELO),
    constraint FK_ASIG_PER_A_MATRICULA_PER
        foreign key (COD_ALUMNO, COD_PERIODO_LECTIVO, COD_NIVEL_EDUCATIVO) references matricula_periodo (COD_ALUMNO, COD_PERIODO_LECTIVO, COD_NIVEL_EDUCATIVO)
);

create table comunicado_asignatura
(
    COD_ASIGNATURA      int          not null,
    COD_NIVEL_EDUCATIVO int          not null,
    COD_PERIODO_LECTIVO int          not null,
    COD_DOCENTE         int          not null,
    COD_PARALELO        int          not null,
    DETALLE_COMUNICADO  varchar(200) null,
    primary key (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO, COD_PERIODO_LECTIVO, COD_DOCENTE, COD_PARALELO),
    constraint FK_COMASIGNATURA_A_ASIGNATURAPER
        foreign key (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO, COD_PERIODO_LECTIVO, COD_DOCENTE,
                     COD_PARALELO) references asignatura_periodo (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO,
                                                                  COD_PERIODO_LECTIVO, COD_DOCENTE, COD_PARALELO)
);

create table tarea_asignatura
(
    COD_ASIGNATURA      int          not null,
    COD_NIVEL_EDUCATIVO int          not null,
    COD_PERIODO_LECTIVO int          not null,
    COD_DOCENTE         int          not null,
    COD_PARALELO        int          not null,
    DETALLE_TAREA       varchar(200) null,
    primary key (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO, COD_PERIODO_LECTIVO, COD_DOCENTE, COD_PARALELO),
    constraint FK_TAR_ASIGNATURA_A_ASIGPERIODO
        foreign key (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO, COD_PERIODO_LECTIVO, COD_DOCENTE,
                     COD_PARALELO) references asignatura_periodo (COD_ASIGNATURA, COD_NIVEL_EDUCATIVO,
                                                                  COD_PERIODO_LECTIVO, COD_DOCENTE, COD_PARALELO)
);

create table tipo_persona
(
    COD_TIPO_PERSONA int auto_increment
        primary key,
    DESCRIPCION      varchar(100) not null
);

create table tipo_persona_persona
(
    COD_TIPO_PERSONA int                      not null,
    COD_PERSONA      int                      not null,
    ESTADO           varchar(3) default 'ACT' not null,
    FECHA_INICIO     date                     not null,
    FECH_FIN         date                     null,
    primary key (COD_TIPO_PERSONA, COD_PERSONA),
    constraint FK_TIPOPERPER_A_TIPOPER
        foreign key (COD_TIPO_PERSONA) references tipo_persona (COD_TIPO_PERSONA),
    constraint FK_TIPOPER_A_PERSONA
        foreign key (COD_PERSONA) references persona (COD_PERSONA)
);

create table usuario
(
    COD_USUARIO       int auto_increment
        primary key,
    COD_PERSONA       int                      not null,
    NOMBRE_USUARIO    varchar(32)              not null,
    CLAVE             varchar(64)              not null,
    ESTADO            varchar(3) default 'ACT' not null,
    ULT_FECHA_INGRESO datetime                 null,
    INTENTOS_FALLIDOS decimal(2) default 0     not null,
    constraint FK_USUARIO_A_PERSONA
        foreign key (COD_PERSONA) references persona (COD_PERSONA)
);

create table rol_usuario
(
    COD_ROL     varchar(8) not null,
    COD_USUARIO int        not null,
    ESTADO      varchar(3) not null,
    primary key (COD_ROL, COD_USUARIO),
    constraint FK_ROLUSU_A_ROL
        foreign key (COD_ROL) references rol (COD_ROL),
    constraint FK_ROLUSU_A_USUARIO
        foreign key (COD_USUARIO) references usuario (COD_USUARIO)
);

create index IDXU_USUARIO_NOMBREUSUARIO
    on usuario (NOMBRE_USUARIO);

