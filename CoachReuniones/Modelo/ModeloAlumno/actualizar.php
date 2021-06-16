<?php
include_once "../../../Conexion/conexion.php";
session_start();


//extraccion de datos por metodo POST

if (isset($_POST['actualizar'])) {
    $carnet = $_POST['id'];
    $cum = $_POST['cum'];
    $carnetU = $_POST['carnet'];
    $u = $_POST['universidad'];
    $idU = $_POST['expU'];
    $avance = $_POST['avance'];
    $carrera = $_POST['carrera'];

    $nuevo = rand(15, 9999999999);

    $stmt = $dbh->prepare("SELECT COUNT(*) FROM expedienteu WHERE ID_Alumno =:id");
    $stmt->execute(['id' => $carnet]);
    $user = $stmt->fetch();

    // var_dump($carnet, $cum, $carnetU, $idU, $u, $carrera, $nuevo, $user[0]);

    if ($user[0] >= 1) {
        $sql = "UPDATE expedienteu SET cum=?, carnet=?,  avancePensum=? WHERE idExpedienteU=?";
        $stmt111 = $dbh->prepare($sql);
        header("Location: expedienteU.php");

        if ($stmt111->execute([$cum,  $carnetU, $avance, $idU])) {
            $_SESSION['message'] = 'Perfil actualizado';
            $_SESSION['message2'] = 'success';
            header("Location: ../../NotasPorAlumno.php?id=$carnet ");
        } else {
            $_SESSION['message'] = 'No se pudo actualizar el perfil ';
            $_SESSION['message2'] = 'danger';
            header("Location: ../../NotasPorAlumno.php?id=$carnet ");
        }
    } else {
        $sql45 = "INSERT INTO `expedienteu`(`idExpedienteU`, `ID_Alumno`, `cum`, `proyecEgreso`,
         `pensum`, `avancePensum`,  `Id_Carrera`, `ID_Empresa`, `estado`, `carnet`)
          VALUES (?,?,?,?,?,?,?,?,?,?)";

        if ($dbh->prepare($sql45)->execute([$nuevo, $carnet, $cum, " ", " ", $avance, "$carrera", $u, "Activo", $carnetU])) {
            $_SESSION['message'] = 'Perfil creado';
            $_SESSION['message2'] = 'success';
            header("Location: ../../NotasPorAlumno.php?id=$carnet ");
        } else {
            $_SESSION['message'] = 'No se pudo crear el perfil ';
            $_SESSION['message2'] = 'danger';
            header("Location: ../../NotasPorAlumno.php?id=$carnet ");
        }
    }
}
