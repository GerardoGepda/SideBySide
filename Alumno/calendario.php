<?php require_once 'templates/head.php'; ?>
<title>Calendario</title>
<?php
  require_once 'templates/header.php';
  require_once 'templates/MenuHorizontal.php';
  require '../Conexion/conexion.php';
?>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.0.0/main.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.0.0/main.min.css">
<div class="container-fluid text-center p-4">
  <style>
    #calendar, #lista {
      position: relative;
      max-width: 1100px;
      margin: 40px auto;
      font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
      font-size: 14px;
    }
  .row{
      margin-left: 205px;
    }
  </style>
  <div>
    <?php include "config/Alerta.php"; ?>
  </div>

  <div class="row">
  <div class="col">
      <div id="lista"></div>
    </div>
    <div class="col">
      <!-- inicio de trabajo -->
      <div id="calendar"></div>
      <!-- fin de trabajo -->
    </div>
    
  </div>
</div>
</div>
</div>

<script async src="./JS/calendar.js"></script>
<script async src="./JS/listadoreuniones.js"></script>
<?php require_once 'templates/footer.php'; ?>