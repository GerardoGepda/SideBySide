<?php
include_once "../../../../Conexion/conexion.php";
session_start();

header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();
$ids = array();
$alumnos = array();
function convertir($e)
{
    return "'" . $e['id'] . "'";
}

if (isset($input['ciclo']) && isset($input['clase']) && isset($input['sedes'])) {
    $ciclo = trim($input['ciclo']);
    $clase = trim($input['clase']);
    $sedes = trim($input['sedes']);
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
    $sql2 = "CALL CONSULTAR_ASISTENCIA(?, ?, ?, ?, ?, ?)";

    foreach ($data as  $row) {
        $query3 = $dbh->prepare($sql2);
        $query3->execute([$row['cantidad'], $ciclo, $clase, $row['universidad'], 'Asistio', $sedes]);
        $alumnos[] = array_merge($query3->fetchAll(PDO::FETCH_ASSOC));
    }

    try {
        // enviar info
        echo json_encode(array("ids" => $ids, "data" => $data, "alumnos" => $alumnos));
    } catch (Exception $th) {
        echo ($th);
    }
}
