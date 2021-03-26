<?php
$stmt = $pdo->query("SELECT DISTINCT cicloU FROM inscripcionciclos ORDER BY cicloU ASC");
$stmt->execute();

// consulta para obtener las clases
$stmt2 = $pdo->query("SELECT DISTINCT Class FROM alumnos ORDER BY Class ASC");
$stmt2->execute();

// consulta para obtener las sede
$stmt3 = $pdo->query("SELECT DISTINCT ID_Sede FROM alumnos ORDER BY Class ASC");
$stmt3->execute();

$sql = "SELECT * FROM empresas WHERE Tipo = 'Universidad' ";

// ejecucion de consultas
$query = $pdo->prepare($sql);
$query->execute();
$cantidad = $query->rowCount();
