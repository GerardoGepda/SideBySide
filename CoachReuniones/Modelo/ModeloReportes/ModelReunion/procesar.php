<?php
include_once "../../../../Conexion/conexion.php";
session_start();
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$data = array();


if (isset($input['ciclo']) && isset($input['idreunion']) && isset($input['tipo'])) {
    // asignación de variables
    $ciclo = $input['ciclo'];
    $idreu = $input['idreunion'];
    $tipo = $input['tipo'];

    // creación de consulta
    $sql1 = "SELECT DISTINCT * FROM reuniones WHERE ID_Reunion = ?";
    $query1 = $dbh->prepare($sql1);
    $query1->execute([$idreu]);
    
    //guardamos toda la info de la reunión en el array data
    array_push($data, $query1->fetchAll(PDO::FETCH_ASSOC)[0]);

    //Creamos consulata para extraer las universidades de la reunión
    $sqlUni = "SELECT ID_Empresa FROM `universidadreunion` WHERE ID_Reunion = ?";
    $queryUni = $dbh->prepare($sqlUni);
    $queryUni->execute([$idreu]);
    $unis = $queryUni->fetchAll(PDO::FETCH_NUM);

    //recorreomos para extraer alumnos que asistieron, inasistieron y no se inscribieron
    foreach ($unis as $key => $value) {
        $sqlAsis = "SELECT al.id_alumno as id, al.Nombre as nombre, al.correo as correo, u.imagen, al.ID_Empresa as U, asistencia, al.ID_Sede as sede, al.StatusActual as estatus, al.Class as Class 
        FROM inscripcionreunion inreu INNER JOIN alumnos al
        ON inreu.id_alumno = al.id_alumno INNER JOIN usuarios u on u.correo = al.correo  WHERE inreu.asistencia = 'Asistio' AND al.ID_Empresa = ? AND inreu.id_reunion = ?";
        $queryAsis = $dbh->prepare($sqlAsis);    
        $queryAsis->execute([$value[0], $idreu]);
        
        $sqlInas = "SELECT al.id_alumno as id, al.Nombre as nombre, al.correo as correo, u.imagen, al.ID_Empresa as U, asistencia, al.ID_Sede as sede, al.StatusActual as estatus, al.Class as Class 
        FROM inscripcionreunion inreu INNER JOIN alumnos al
        ON inreu.id_alumno = al.id_alumno INNER JOIN usuarios u on u.correo = al.correo WHERE inreu.asistencia = 'Inasistencia' AND al.ID_Empresa = ? AND inreu.id_reunion = ?";
        $queryInas = $dbh->prepare($sqlInas);    
        $queryInas->execute([$value[0], $idreu]);

        $sqlNoins = "SELECT al.id_alumno as id, al.Nombre as nombre, al.correo as correo, u.imagen, 
        al.ID_Empresa as U, al.ID_Sede as sede, al.StatusActual as estatus, al.Class as Class 
        FROM alumnos al INNER JOIN usuarios u
        ON al.correo = u.correo
        WHERE NOT EXISTS (SELECT ins.id_alumno FROM inscripcionreunion ins 
                            WHERE al.ID_Alumno = ins.id_alumno AND ins.id_reunion = ?) 
        AND al.ID_Empresa = ? AND al.StatusActual = 'Becado' GROUP BY al.ID_Alumno  ORDER BY `al`.`Nombre` ASC";
        $queryNoins = $dbh->prepare($sqlNoins);
        $queryNoins->execute([ $idreu, $value[0]]);

        array_push($data, array(
            "universidad" => $value[0], 
            "Asistieron" => $queryAsis->fetchAll(PDO::FETCH_ASSOC),
            "Inasistieron" => $queryInas->fetchAll(PDO::FETCH_ASSOC),
            "No_inscritos" => $queryNoins->fetchAll(PDO::FETCH_ASSOC)
        ));
    }

    // llenado de información
    try {
        // enviar info
        echo json_encode($data);
    } catch (\Throwable $th) {
        echo ($th);
    }
    //echo json_encode(array($ciclo, $titulo, $tipo));
}
