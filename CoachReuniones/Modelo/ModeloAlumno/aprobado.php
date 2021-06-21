 <?php

    include_once "../../../Conexion/conexion.php";
    session_start();

    $FotoAlumno = '';
    header("Content-type: application/json; charset=utf-8");
    $input = json_decode(file_get_contents("php://input"), true);
    $data = array();
    $id = $input['id'];

    $sql = "SELECT COUNT(im.Id_InscripcionM) AS 'Aprobado' FROM inscripcionmateria
    IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC
    INNER JOIN expedienteu a on a.idExpedienteU   = IC.idExpedienteU WHERE a.ID_Alumno = ?
     AND IM.estado = 'Aprobada' ";

    $sql2 = " SELECT COUNT(im.Id_InscripcionM) AS 'Reprobada' FROM inscripcionmateria
   IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC
   INNER JOIN expedienteu a on a.idExpedienteU   = IC.idExpedienteU WHERE a.ID_Alumno = ?
    AND IM.estado = 'Reprobada' ";


    $sql3 = " SELECT COUNT(im.Id_InscripcionM) AS 'Retirada' FROM inscripcionmateria
    IM INNER JOIN inscripcionciclos IC ON IM.Id_InscripcionC = IC.Id_InscripcionC
    INNER JOIN expedienteu a on a.idExpedienteU   = IC.idExpedienteU WHERE a.ID_Alumno = ?
    AND IM.estado = 'Retirada' ";

    $sql4 = "SELECT COUNT(materias.idMateria) AS 'Inscrita' FROM materias INNER JOIN expedienteu
    on expedienteu.idExpedienteU = materias.idExpedienteU WHERE expedienteu.ID_Alumno = ? ";

    //consulta para extraer las materias inscritas de los alumnos
    $stmt9945246 = $dbh->prepare("SELECT m.nombreMateria FROM materias m INNER JOIN expedienteu e
    on e.idExpedienteU = m.idExpedienteU  WHERE e.ID_Alumno = :id AND m.Estado = 'Activo' ");
    $stmt9945246->bindParam(":id", $id);
    $stmt9945246->execute();
    // fin de consulta para extraer las materias inscritas de los alumnos



    // preparar consulta
    $stmt4 = $dbh->prepare($sql);
    // Ejecutamos
    $stmt4->execute(array($id));
    $fila4 = $stmt4->fetch(PDO::FETCH_ASSOC);


    $stmt5 = $dbh->prepare($sql2);
    // Ejecutamos
    $stmt5->execute(array($id));
    $fila5 = $stmt5->fetch(PDO::FETCH_ASSOC);


    $stmt6 = $dbh->prepare($sql3);
    // Ejecutamos
    $stmt6->execute(array($id));
    $fila6 = $stmt6->fetch(PDO::FETCH_ASSOC);

    $stmt7 = $dbh->prepare($sql4);
    // Ejecutamos
    $stmt7->execute(array($id));
    $fila7 = $stmt7->fetch(PDO::FETCH_ASSOC);

    $fila8 = $stmt9945246->fetchAll(PDO::FETCH_ASSOC);

    try {
        // enviar info
        echo json_encode(array($fila4, $fila5, $fila6, $fila7, $fila8));
    } catch (\Throwable $th) {
        echo ($th);
    }
