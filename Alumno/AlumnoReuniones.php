<?php require_once 'templates/head.php'; ?>
<title>Reuniones</title>
<?php
require_once 'templates/header.php';
require_once 'templates/MenuHorizontal.php';
require '../Conexion/conexion.php';
?>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<div class="container-fluid text-center" style="margin-bottom: 25%;" id="listado">
  <div class="title">
    <a href="javascript:history.back();"><img src="../img/proximo.svg" class="icon"></a>
    <h2 class="main-title">Reuniones mensuales</h2>
  </div>
  <br>
  <div class=" w-75 mx-auto">
    <table class="table table-responsive-lg">
      <thead class="thead-dark">
        <tr>
          <th scope="col" v-for="e in columns">{{ e }}</th>
        </tr>
      </thead>
      <tbody class="bg-light">
        <tr v-if="info != '' " v-for="e in info  ">
          <td> {{e.id}} </td>
          <td> {{e.Titulo}} </td>
          <td> {{e.Fecha}} </td>
          <td> {{e.encargado}} </td>
          <td> {{e.Tipo}} </td>
          <td> <a class="btn btn-info" v-bind:href="'HorariosReunion.php?id='+e.id+'&typereu='+e.Tipo "><i class="fas fa-calendar-week"> </i> Ver horarios</a></td>
        </tr>
        <tr v-else>
          <td colspan="6">No hay reuniones activas</td>
        </tr>
      </tbody>
    </table>
  </div>

</div>
<!-- /#page-content-wrapper -->
</div>
<script async src="JS/infoInicial.js"></script>
<?php require_once 'templates/footer.php'; ?>