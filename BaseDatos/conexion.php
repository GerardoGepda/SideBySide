<?php

$pdo = new PDO('mysql:host=localhost;dbname=oportuni_despega','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->exec("SET CHARACTER SET UTF8");

?>