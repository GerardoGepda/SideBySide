<?php
include '../../../../Conexion/conexion.php';
include '../../../../BaseDatos/conexion.php';

session_start();
$year = $_POST['year'];
$class = $_POST['class'];
$ciclo = $_POST['ciclo'];
$alumnos = $_POST['alumnos'];
$estado = $_POST['estado'];
$tipo = $_POST['tipo'];
$sede = $_POST['sede'];
$dir = "Archivos/";
deleteDir($dir);

$condicional1 = "";
$condicional2 = "";
$condicional3 = "";
$condicional4 = "";
$condicional5 = "";
$condicional6 = "";
$condicional7 = "";



if (isset($year) and $year != 0) {
  $condicional1 = "year = '" . $year . "' ";
}

if (isset($class) and $class != 0) {
  $condicional2 = "class = '" . $class . "' ";
}
if (isset($ciclo) and $ciclo != 0) {
  $condicional3 = "ciclo = '" . $ciclo . "' ";
}

if (isset($alumnos) and $alumnos != 0) {
  $condicional4 = "ID_Alumno = '" . $alumnos . "' ";
}

if (isset($estado)) {
  $condicional5 = "Estado = '" . $estado . "' ";
}

if (isset($tipo)) {
  $condicional6 = "tipo = '" . $tipo . "' ";
}

if (isset($sede)) {
  $condicional7 = "sede = '" . $sede . "' ";
}

$mysql = "SELECT COUNT(*) AS 'condicion' FROM renovacion  WHERE ";
$query = "SELECT carpeta,archivo FROM renovacion WHERE Estado != 'eliminado' AND ";
$order = "ORDER BY ciclo ASC";
$AND = "AND ";



if (isset($_POST['descargar'])) {


  //Filtros Individuales

  //Inicio Filtro Año

  if (!(empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$order;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }//Final de filtro year

  //Inicio de filtro Class

  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$order;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }//Final de filtro  class

  //Inicio de filtro ciclo

  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional3;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional3.$order;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }//Final de fltro  ciclo

  //Inicio de filtro alumnos

  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional4;;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional4;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }//final de filtro alumnos
  //inicio de filtro  estado

  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional5.$order;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }//FInal de filtro estado

  //Inicio de filtro tipo
  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional6.$order;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }//final de filtro tipo

  //inicio de filtro sede

  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional7.$order;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }//Final de filtro sede

  //Inicio de filtro por parejas
  elseif (!(empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and (empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional3;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional3;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif (!(empty($year)) and (empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional4;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional4;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif (!(empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif (!(empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif (!(empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  //condicional 2

  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional4;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional4;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  
  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
//condicion 3
  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional4;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional3.$AND.$condicional4;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional3.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional3.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional3.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  //condicional4
  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional4.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional4.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional4.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional4.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional4.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional4.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  //condicional 5

  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional5.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional5.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional5.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional5.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  //condicional 6
  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  //Final de filtro en parejas

  //Inicio de filtro en trios

  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and !(empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional4;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional4;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif (!(empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  //condicional 2


  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condicional4;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional4;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }


  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
   //condicional 3
  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional4.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional4.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional4.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  //condicional 4

  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional4.$AND.$condicional5.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional4.$AND.$condicional5.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional4.$AND.$condicional5.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional4.$AND.$condicional5.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional5.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  
   //Final de filtro de tres

   //Inicio de filtro de cuatro
  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  
  //condicional 2


  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  //Final de filtro de cuatro

  //Inicio de filtro de cinco
  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }
  
  
  
  
  //Final de filtro de cinco

  //Inicio de filtro de seis

  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  //Final de filtro de seis

  //Filtro total 
  elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional2.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and (empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional3.$AND.$condicional4;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional3.$AND.$condicional4;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }




  elseif (!(empty($year)) and (empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional4.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional4.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }




  elseif (!(empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional5.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional5.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional4.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional4.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional5.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional5.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }


  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }




  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional5.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional3.$AND.$condicional5.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional3.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and (empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and (empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }



  elseif (!(empty($year)) and (empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and (empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional1.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  

  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional4.$AND.$condicional5.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif ((empty($year)) and !(empty($class)) and (empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional2.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }


  elseif ((empty($year)) and (empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional3.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query . $condicional3.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and (empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and (empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query .  $condicional1.$AND.$condicional3.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }

  elseif (!(empty($year)) and (empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional1.$AND.$condicional4.$AND.$condiciona5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query .  $condicional1.$AND.$condicional4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  }


  elseif ((empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
    $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condiciona4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($mysql) as $C) {
      $condicion = $C['condicion'];
    }
    if ($condicion < 1) {
      $_SESSION['noti'] = "<script>swal({
        title: 'Error!',
        text: 'No hay Renovaciones!',
        icon: 'error',
        button: 'Cerrar',
      });</script>";
      header("Location:../../../descargas.php");
    } else {
      $query = $query .  $condicional2.$AND.$condicional3.$AND.$condiciona4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
      foreach ($dbh->query($query) as $carpeta) {
        $source = $carpeta['carpeta'];
        $destination = "Archivos/" . $source;
        if (!is_dir($destination)) {
          mkdir("Archivos/" . $source, 0777, true);
          full_copy("../../../" . $source, $destination);
        }
        header("Location:Zip.php");
      }
    }
  
}

elseif (!(empty($year)) and (empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
  $mysql = $mysql . $condicional2.$AND.$condicional3.$AND.$condiciona4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
  foreach ($dbh->query($mysql) as $C) {
    $condicion = $C['condicion'];
  }
  if ($condicion < 1) {
    $_SESSION['noti'] = "<script>swal({
      title: 'Error!',
      text: 'No hay Renovaciones!',
      icon: 'error',
      button: 'Cerrar',
    });</script>";
    header("Location:../../../descargas.php");
  } else {
    $query = $query .  $condicional2.$AND.$condicional3.$AND.$condiciona4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($query) as $carpeta) {
      $source = $carpeta['carpeta'];
      $destination = "Archivos/" . $source;
      if (!is_dir($destination)) {
        mkdir("Archivos/" . $source, 0777, true);
        full_copy("../../../" . $source, $destination);
      }
      header("Location:Zip.php");
    }
  }

}

elseif (!(empty($year)) and !(empty($class)) and (empty($ciclo)) and !(empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
  $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condiciona4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
  foreach ($dbh->query($mysql) as $C) {
    $condicion = $C['condicion'];
  }
  if ($condicion < 1) {
    $_SESSION['noti'] = "<script>swal({
      title: 'Error!',
      text: 'No hay Renovaciones!',
      icon: 'error',
      button: 'Cerrar',
    });</script>";
    header("Location:../../../descargas.php");
  } else {
    $query = $query .  $condicional1.$AND.$condicional2.$AND.$condiciona4.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($query) as $carpeta) {
      $source = $carpeta['carpeta'];
      $destination = "Archivos/" . $source;
      if (!is_dir($destination)) {
        mkdir("Archivos/" . $source, 0777, true);
        full_copy("../../../" . $source, $destination);
      }
      header("Location:Zip.php");
    }
  }

}



elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and (empty($alumnos)) and !(empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
  $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condiciona3.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
  foreach ($dbh->query($mysql) as $C) {
    $condicion = $C['condicion'];
  }
  if ($condicion < 1) {
    $_SESSION['noti'] = "<script>swal({
      title: 'Error!',
      text: 'No hay Renovaciones!',
      icon: 'error',
      button: 'Cerrar',
    });</script>";
    header("Location:../../../descargas.php");
  } else {
    $query = $query .  $condicional1.$AND.$condicional2.$AND.$condiciona3.$AND.$condicional5.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($query) as $carpeta) {
      $source = $carpeta['carpeta'];
      $destination = "Archivos/" . $source;
      if (!is_dir($destination)) {
        mkdir("Archivos/" . $source, 0777, true);
        full_copy("../../../" . $source, $destination);
      }
      header("Location:Zip.php");
    }
  }

}

elseif (!(empty($year)) and !(empty($class)) and !(empty($ciclo)) and !(empty($alumnos)) and (empty($estado)) and !(empty($tipo)) and !(empty($sede))) {
  $mysql = $mysql . $condicional1.$AND.$condicional2.$AND.$condiciona3.$AND.$condicional4.$AND.$condicional6.$AND.$condicional7;
  foreach ($dbh->query($mysql) as $C) {
    $condicion = $C['condicion'];
  }
  if ($condicion < 1) {
    $_SESSION['noti'] = "<script>swal({
      title: 'Error!',
      text: 'No hay Renovaciones!',
      icon: 'error',
      button: 'Cerrar',
    });</script>";
    header("Location:../../../descargas.php");
  } else {
    $query = $query .  $condicional1.$AND.$condicional2.$AND.$condiciona3.$AND.$condicional4.$AND.$condicional6.$AND.$condicional7;
    foreach ($dbh->query($query) as $carpeta) {
      $source = $carpeta['carpeta'];
      $destination = "Archivos/" . $source;
      if (!is_dir($destination)) {
        mkdir("Archivos/" . $source, 0777, true);
        full_copy("../../../" . $source, $destination);
      }
      header("Location:Zip.php");
    }
  }

}


//final de filtro total
}






if (isset($_POST['todo'])) {
session_start();
$dir = "Archivos/";
deleteDir($dir);
foreach ($dbh->query("SELECT COUNT(*) AS 'condicion' FROM renovacion ") as $C) {
  $condicion = $C['condicion'];
}
if ($condicion < 1) {
  $_SESSION['noti'] = "<script>swal({
    title: 'Error!',
    text: 'No hay Renovaciones!',
    icon: 'error',
    button: 'Cerrar',
  });</script>";
  header("Location:../../../descargas.php");
} else {
  foreach ($dbh->query("SELECT carpeta,archivo FROM renovacion") as $carpeta) {
    $source = $carpeta['carpeta'];
    if (!is_dir('carpeta_copia')) {
      mkdir("Archivos/" . $source, 0777, true);
      $destination = "Archivos/" . $source;
      full_copy("../../../" . $source, $destination);
    }
    header("Location:Zip.php");
  }
}
}


if(isset($_POST['descargar2'])){
  include_once "archiver2.php";
}


/*Funciones*/
function full_copy($source, $target)
{
  if (is_dir($source)) {
    @mkdir($target);
    $d = dir($source);
    while (FALSE !== ($entry = $d->read())) {
      if ($entry == '.' || $entry == '..') {
        continue;
      }
      $Entry = $source . '/' . $entry;
      if (is_dir($Entry)) {
        full_copy($Entry, $target . '/' . $entry);
        continue;
      }
      copy($Entry, $target . '/' . $entry);
    }

    $d->close();
  } else {
    copy($source, $target);
  }
}
function deleteDir($path)
{
  if (empty($path)) {
    return false;
  }
  return is_file($path) ?
    @unlink($path) :
    array_map(__FUNCTION__, glob($path . '/*')) == @rmdir($path);
}

function copiar($from,$archivo){
    
  $to = 'Archivos/';
  copy($from,$to.$archivo);

}
