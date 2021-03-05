<?php
try {
    $dbname="oportuni_despega";
    $user="oportuni_Admin";
    $password="UDB123456@";
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e){
    echo $e->getMessage();
}
?>
