<?php



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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
      mkdir("Archivos/" . $source, 0777, true);
      foreach ($dbh->query($query) as $carpeta) {
        $source = "../../../".$carpeta['carpeta'];
        $archivo = $carpeta['archivo'];
        copiar($source,$archivo);
      }
      header("Location:Zip.php");
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
    mkdir("Archivos/" . $source, 0777, true);
    foreach ($dbh->query($query) as $carpeta) {
      $source = "../../../".$carpeta['carpeta'];
      $archivo = $carpeta['archivo'];
      copiar($source,$archivo);
    }
    header("Location:Zip.php");
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
    mkdir("Archivos/" . $source, 0777, true);
    foreach ($dbh->query($query) as $carpeta) {
      $source = "../../../".$carpeta['carpeta'];
      $archivo = $carpeta['archivo'];
      copiar($source,$archivo);
    }
    header("Location:Zip.php");
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
    mkdir("Archivos/" . $source, 0777, true);
    foreach ($dbh->query($query) as $carpeta) {
      $source = "../../../".$carpeta['carpeta'];
      $archivo = $carpeta['archivo'];
      copiar($source,$archivo);
    }
    header("Location:Zip.php");
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
    mkdir("Archivos/" . $source, 0777, true);
    foreach ($dbh->query($query) as $carpeta) {
      $source = "../../../".$carpeta['carpeta'];
      $archivo = $carpeta['archivo'];
      copiar($source,$archivo);
    }
    header("Location:Zip.php");
  }

}






?>