<?php

//('DA','ECdCI','ECMH','ENA','ESEN','HU-W','IEPROES','INICAES','ITCA ST','ITCA-FEPAD','JBU-W','KU','UCA SS','UDB','UDJMD','UDV','UEES','UFGS','UFGSS','UGB','UNAB CHA','UNAB SM','UNASA','UNDESA','USAM')
//('2019','2015','2014','2016','2017','2018','2020')
//('AHSAT','CHSAT','SAFT','SASAT','SMSAT','SSFT','SSSAT')
//(02-2021)
$fixedData = array();

function convertir($e)
{
    return "'" . $e . "'";
}

function extractCantReu($unis, $ciclo, $clases, $sedes, PDO $dbh)
{
    $unisText = implode(',', array_map('convertir', $unis));
    $clasesText = implode(',', array_map('convertir', $clases));
    $sedesText = implode(',', array_map('convertir', $sedes));

    //SELECT DISTINCT ID_Empresa FROM alumnos WHERE StatusActual = 'Becado'
    //SELECT DISTINCT Class FROM alumnos WHERE StatusActual = 'Becado'
    //SELECT DISTINCT ID_Sede FROM alumnos WHERE StatusActual = 'Becado'

    $sqlCounReus = "
    (
        SELECT a.ID_Alumno as IdAlumno, 
            a.Nombre as nombre,
            COUNT(a.ID_Alumno) as cantidad,
            a.ID_Empresa,
            em.Nombre as univeridad,
            a.correo,
            a.ID_Sede,
            a.Class as Class
        FROM alumnos a
            INNER JOIN empresas em ON em.ID_Empresa = a.ID_Empresa
            INNER JOIN inscripcionreunion i on i.id_alumno = a.ID_Alumno
            INNER JOIN reuniones r ON r.ID_Reunion = i.id_reunion
        WHERE i.asistencia = 'Asistio'
            AND r.ID_Ciclo = :ciclo
            AND a.ID_Sede IN ($sedesText)
            AND a.ID_Empresa IN ($unisText)
            AND a.Class IN ($clasesText)
        GROUP by i.id_alumno
    )";

    $queryCantReu = $dbh->prepare($sqlCounReus);
    $queryCantReu->execute([":ciclo" => $ciclo]);
    
    foreach ($queryCantReu->fetchAll(PDO::FETCH_ASSOC) as $value) {
        //colocamos el id del alumno como key de cada elemento.
        $fixedData[$value["IdAlumno"]] = $value;
    }

    return $fixedData;
}