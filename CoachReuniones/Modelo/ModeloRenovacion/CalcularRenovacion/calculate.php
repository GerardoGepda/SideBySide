<?php
//https://localhost/SideBySide/CoachReuniones/Modelo/ModeloRenovacion/CalcularRenovacion/calculate.php

    //incluimos la conexión a la BD
    include "../../../../Conexion/conexion.php";

    //inluimos el codigo que nos extraera el calulo de asistencia
    include "./getAttendance.php";

    //Declaración de variables
    $unis = array();
    $Classes = array();
    $Sedes = array();
    $alumnosBecados = array();
    $alumnosHS = array();
    $alumnosAttendance = array();
    $alumnosCicloNotas = array();

    function addPorcent($element)
    {
        $element["procentaje"] = 0;
        return $element;
    }

    //--- EXTRAEMOS LAS UNIVERSIDADES, CLASES Y SEDES A TRABAJAR ---//
    $cicloActual = "02-2021";

    $sqlUnis = "SELECT DISTINCT ID_Empresa FROM alumnos WHERE StatusActual = 'Becado'";
    $sqlClasses = "SELECT DISTINCT Class FROM alumnos WHERE StatusActual = 'Becado'";
    $sqlSedes = "SELECT DISTINCT ID_Sede FROM alumnos WHERE StatusActual = 'Becado'";

    $query1 = $dbh->prepare($sqlUnis);
    $query1->execute();
    foreach ($query1->fetchAll(PDO::FETCH_NUM) as $key => $value) {
        array_push($unis, $value[0]);
    }

    $query2 = $dbh->prepare($sqlClasses);
    $query2->execute();
    foreach ($query2->fetchAll(PDO::FETCH_NUM) as $key => $value) {
        array_push($Classes, $value[0]);
    }

    $query3 = $dbh->prepare($sqlSedes);
    $query3->execute();
    foreach ($query3->fetchAll(PDO::FETCH_NUM) as $key => $value) {
        array_push($Sedes, $value[0]);
    }
    //--- //EXTRAEMOS LAS UNIVERSIDADES, CLASES Y SEDES A TRABAJAR ---//


    //--- EXTRAEMOS TODOS LOS ALUMNOS BECADOS ---//
    $sqlBecados = "SELECT ID_Alumno as IdAlumno, Nombre, Class, correo, SedeAsistencia 
    FROM alumnos WHERE StatusActual = 'Becado'";
    $queryBecados = $dbh->prepare($sqlBecados);
    $queryBecados->execute();
    foreach ($queryBecados->fetchAll(PDO::FETCH_ASSOC) as $value) {
        $alumnosBecados[$value["IdAlumno"]] = $value;
    }
    //--- //EXTRAEMOS TODOS LOS ALUMNOS BECADOS ---//


    //--- EXTRAEMOS LOS ALUMNOS A LOS QUE SE LAS HA APROBADO LAS H. DE VINCULACIÓN ---//
    $sqlHS = "SELECT a.ID_Alumno as IdAlumno, a.Nombre as nombre, a.ID_Empresa as ID_Empresa FROM hsociales hs INNER JOIN alumnos a
    ON hs.ID_Alumno = a.ID_Alumno 
    WHERE hs.ID_Ciclo = :ciclo AND hs.estado = 'Aprobado'";

    $queryHS = $dbh->prepare($sqlHS);
    $queryHS->execute([":ciclo" => $cicloActual]);
    foreach ($queryHS->fetchAll(PDO::FETCH_ASSOC) as $value) {
        //colocamos el id del alumno como key de cada elemento.
        $alumnosHS[$value["IdAlumno"]] = $value;
    }
    //--- //EXTRAEMOS LOS ALUMNOS A LOS QUE SE LAS HA APROBADO LAS H. DE VINCULACIÓN ---//
    

    //--- EXTRAEMOS LOS ALUMNOS A LOS QUE SE HAN ASISTIDO A LAS REUNIONES REQUERIDAS ---//
    $alumnosAttendance = extractCantReu($unis, $cicloActual, $Classes, $Sedes, $dbh);
    //--- //EXTRAEMOS LOS ALUMNOS A LOS QUE SE HAN ASISTIDO A LAS REUNIONES REQUERIDAS ---//


    //--- EXTRAEMOS LOS ALUMNOS QUEN HAN INSCRITO SU CICLO Y SUBIDO SUS NOTAS ---//
    $sqlCicloNotas = "SELECT a.ID_Alumno as IdAlumno, a.Nombre as nombre, cicloU, comprobante, pdfnotas 
    FROM inscripcionciclos ic 
    INNER JOIN expedienteu eu
    ON ic.idExpedienteU = eu.idExpedienteU
    INNER JOIN alumnos a
    ON a.ID_Alumno = eu.ID_Alumno
    WHERE cicloU = :ciclo AND pdfnotas IS NOT NULL";

    $queryCicloNotas = $dbh->prepare($sqlCicloNotas);
    $queryCicloNotas->execute([":ciclo" => 'Ciclo '.$cicloActual]);
    foreach ($queryCicloNotas->fetchAll(PDO::FETCH_ASSOC) as $value) {
        $alumnosCicloNotas[$value["IdAlumno"]] = $value;
    }
    //--- //EXTRAEMOS LOS ALUMNOS QUEN HAN INSCRITO SU CICLO Y SUBIDO SUS NOTAS ---//
    
    //------------------------------------------------------------------------------//

    //ASIGNAMOS UN PORCENTAJE DE APROBACIÓN DE BECA A CADA ALUMNO SEGÚN REQUISITOS
    foreach ($alumnosBecados as $key => $value) {
        $alumnosBecados[$key]["porcentaje"] = 0;
        $alumnosBecados[$key]["porcentaje"] += isset($alumnosAttendance[$key]) ? 40 : 0;
        $alumnosBecados[$key]["porcentaje"] += isset($alumnosCicloNotas[$key]) ? 50 : 0;
        $alumnosBecados[$key]["porcentaje"] += isset($alumnosHS[$key]) ? 10 : 0;
    }

    foreach ($alumnosBecados as $key => $value) {
        if ($value["porcentaje"] > 0) {
            echo $value["Nombre"]." ".$value["IdAlumno"]." -------- [".$value["porcentaje"]."]\n";
        }
    }
    
    //echo json_encode($alumnosBecados);
?>