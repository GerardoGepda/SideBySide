<?php
include_once "../../../../Conexion/conexion.php";

header("Content-type: application/json; charset=utf-8");
session_start();

$input = json_decode(file_get_contents("php://input"), true);
$data = array();
$ids = array();
$alumnos = array();
function convertir($e)
{
    return "'" . $e['id'] . "'";
}

if (isset($input['ciclo']) && isset($input['clases']) && isset($input['sedes']) && isset($input['financiamientos'])) {
    $ciclo = trim($input['ciclo']);
    $clases = trim($input['clases']);
    $sedes = trim($input['sedes']);
    $financiamiento = trim($input['financiamientos']);

    $stmt = "SELECT DISTINCT u.ID_Empresa as id FROM universidadreunion u INNER JOIN reuniones 
    r ON r.ID_Reunion = u.ID_Reunion WHERE r.ID_Ciclo = ? ";

    $query2 = $dbh->prepare($stmt);
    $query2->execute([$ciclo]);

    //primer paso almacenar los id de las universidades en la variable $ids
    $ids = ($query2->fetchAll(PDO::FETCH_ASSOC));

    //segundo paso recorrer los ids de las universidades y concatenenarles comillas simples
    $ids = array_map("convertir", $ids);
    //tercer paso armar un string separado por comas    
    $id = implode(',', $ids);

    $sql = "SELECT COUNT(r.ID_Reunion) AS cantidad, u.ID_Empresa as universidad FROM reuniones r
    INNER JOIN universidadreunion u ON u.ID_Reunion = r.ID_Reunion WHERE u.ID_Empresa 
    IN ($id) AND r.ID_Ciclo = ? GROUP BY u.ID_Empresa";

    $query = $dbh->prepare($sql);
    $query->execute([$ciclo]);
    $data = $query->fetchAll(PDO::FETCH_ASSOC);

    //-------------------primer -----------------------
    $sql2 = "
    (
        SELECT a.Nombre as nombre,
            CONCAT(COUNT(a.ID_Alumno), '/', :cant) as cantidad,
            ROUND(((COUNT(a.ID_Alumno) / :cant) * 100), 2) as promedio,
            a.ID_Empresa,
            us.imagen,
            em.Nombre as univeridad,
            a.correo,
            a.StatusActual,
            a.FuenteFinacimiento,
            a.ID_Sede,
            a.Class as Class,
            GROUP_CONCAT(date_format(r.Fecha, '%d-%m-%Y') SEPARATOR ', ') as fechas
        FROM alumnos a
            INNER JOIN empresas em ON em.ID_Empresa = a.ID_Empresa
            INNER JOIN inscripcionreunion i on i.id_alumno = a.ID_Alumno
            INNER JOIN reuniones r ON r.ID_Reunion = i.id_reunion
            INNER JOIN usuarios us ON us.correo = a.correo
        WHERE i.asistencia = :asistencia
            AND r.ID_Ciclo = :ciclo
            AND a.ID_Sede IN ($sedes)
            AND a.ID_Empresa = :id
            AND a.Class IN ($clases)
            AND a.FuenteFinacimiento IN ($financiamiento)
        GROUP by i.id_alumno
    )
    UNION
    (
        SELECT a.Nombre as nombre,
            CONCAT(0, '/', :cant) as cantidad,
            ROUND(0, 2) as promedio,
            a.ID_Empresa,
            us.imagen,
            em.Nombre as univeridad,
            a.correo,
            a.StatusActual,
            a.FuenteFinacimiento,
            a.ID_Sede,
            a.Class,
            'NA' as fechas
        FROM alumnos a
            INNER JOIN empresas em ON em.ID_Empresa = a.ID_Empresa
            INNER JOIN inscripcionreunion i on i.id_alumno = a.ID_Alumno
            INNER JOIN reuniones r ON r.ID_Reunion = i.id_reunion
            INNER JOIN usuarios us ON us.correo = a.correo
        WHERE i.asistencia = 'Inasistencia'
            AND r.ID_Ciclo = :ciclo
            AND a.ID_Sede IN ($sedes)
            AND a.ID_Empresa = :id
            AND a.Class IN ($clases)
            AND a.FuenteFinacimiento IN ($financiamiento)
            AND a.ID_Alumno NOT IN (
                SELECT a.ID_Alumno
                FROM alumnos a
                    INNER JOIN inscripcionreunion i on i.id_alumno = a.ID_Alumno
                    INNER JOIN reuniones r ON r.ID_Reunion = i.id_reunion
                    INNER JOIN usuarios us ON us.correo = a.correo
                WHERE i.asistencia = :asistencia
                    AND r.ID_Ciclo = :ciclo
                    AND a.ID_Sede IN ($sedes)
                    AND a.ID_Empresa = :id
                    AND a.Class IN ($clases)
                    AND a.FuenteFinacimiento IN ($financiamiento)
                GROUP by i.id_alumno
            )
        GROUP by i.id_alumno
    )
    UNION
    (
        SELECT al.Nombre as nombre,
            CONCAT(0, '/', :cant) as cantidad,
            ROUND(0, 2) as promedio,
            al.ID_Empresa,
            u.imagen,
            em.Nombre as univeridad,
            al.correo,
            al.StatusActual,
            al.FuenteFinacimiento,
            al.ID_Sede,
            al.Class,
            'NA' as fechas
        FROM alumnos al
            INNER JOIN usuarios u ON al.correo = u.correo
            INNER JOIN empresas em ON em.ID_Empresa = al.ID_Empresa
        WHERE al.ID_Sede IN ($sedes)
            AND al.FuenteFinacimiento IN ($financiamiento)
            AND NOT EXISTS (
                SELECT ins.id_alumno
                FROM inscripcionreunion ins
                WHERE al.ID_Alumno = ins.id_alumno
                    AND ins.id_reunion IN (
                        SELECT r.ID_Reunion
                        FROM reuniones r
                        WHERE r.ID_Ciclo = :ciclo
                    )
            )
            AND al.ID_Empresa = :id
            AND al.StatusActual = 'Becado'
            and al.Class IN ($clases)
        GROUP BY al.ID_Alumno
        ORDER BY `al`.`Nombre` ASC
    )
    ";

    $query3 = $dbh->prepare($sql2);
    foreach ($data as  $row) {
        $query3->execute([":cant" => $row['cantidad'], ":ciclo" => $ciclo, ":id" => $row['universidad'], ":asistencia" => 'Asistio']);
        $alumnos[] = array_merge($query3->fetchAll(PDO::FETCH_ASSOC));
    }

    try {
        // enviar info
        echo json_encode(array("ids" => $ids, "data" => $data, "alumnos" => $alumnos));
    } catch (Exception $th) {
        echo ($th);
    }
}
