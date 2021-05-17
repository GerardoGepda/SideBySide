<?php

error_reporting(0);
require_once "../../../BaseDatos/conexion.php";
session_start();


header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
$id = $input['id'];

$sql = "UPDATE inscripcionreunion SET  	is_typing =? WHERE id=? ";
$pdo->prepare($sql)->execute(['yes', $id]);



echo json_encode(true);
