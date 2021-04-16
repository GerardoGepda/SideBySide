<?php
date_default_timezone_set("America/El_Salvador"); 
if (!empty($_COOKIE['InscrpCiclo'])) {
    setcookie("InscrpCiclo[idInscrip]", '', time() - 129600, "/");
	setcookie("InscrpCiclo[idExpdt]", '', time() - 129600, "/");
	setcookie("InscrpCiclo[ciclo]", '', time() - 129600, "/");
	setcookie("InscrpCiclo[alumnoCarnet]", '', time() - 129600, "/");
}else {
    setcookie("InscrpCiclo[idInscrip]", '', time() - 129600, "/");
	setcookie("InscrpCiclo[idExpdt]", '', time() - 129600, "/");
	setcookie("InscrpCiclo[ciclo]", '', time() - 129600, "/");
	setcookie("InscrpCiclo[alumnoCarnet]", '', time() - 129600, "/");
}
header('location: expedienteU.php');