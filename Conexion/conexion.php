<?php
try {
    $dbname="oportuni_despega";
    $user="root";
    $password="";
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->exec("SET CHARACTER SET UTF8");
} catch (PDOException $e){
    echo $e->getMessage();
}
?>
