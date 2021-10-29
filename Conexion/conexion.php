<?php
try {
    $dbname="oportuni_despega";
    $user="oportuni_Admin";
    $password="UDB123456@";
    $dsn = "mysql:host=localhost;dbname=$dbname";
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("SET CHARACTER SET UTF8");
} catch (PDOException $e){
    echo $e->getMessage();
}
?>
