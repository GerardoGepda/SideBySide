<?php

$pdo = new PDO('mysql:host=localhost;dbname=oportuni_despega','oportuni_Admin','UDB123456@');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("SET CHARACTER SET UTF8");

?>