<?php require_once 'templates/head.php'; ?>
<title>Historial Notas</title>
<?php

//Manda  allamar plantillas
require_once 'templates/header.php';
require_once 'templates/MenuHorizontal.php';
require '../Conexion/conexion.php';

//Carnet del alumno
$stmt1 = $dbh->prepare("SELECT `ID_Alumno`  FROM `alumnos` WHERE correo='" . $_SESSION['Email'] . "'");
$stmt1->execute();
while ($fila = $stmt1->fetch()) {
  $alumno = $fila["ID_Alumno"];
} //Fin de while 



// Expediente U
$consulta = $pdo->prepare("SELECT idExpedienteU  FROM expedienteu WHERE ID_Alumno = ? AND estado = 'Activo'");

$consulta->execute(array($alumno));
$idExpedienteU;
if ($consulta->rowCount() >= 1) {
  while ($fila = $consulta->fetch()) {
    $idExpedienteU = $fila['idExpedienteU'];
  }
} //fin de condicion


//consulta que muestra las materias
$consulMaterias = $pdo->prepare("SELECT  IM.nota,IM.idMateria,IM.matricula, M.nombreMateria, IM.estado, IC.cicloU, M.idExpedienteU
from materias M
INNER JOIN inscripcionmateria IM
ON IM.idMateria= M.idMateria

INNER JOIN inscripcionciclos IC
ON IC.Id_InscripcionC=IM.Id_InscripcionC

WHERE M.idExpedienteU = ? AND (IM.estado = 'Reprobada' OR IM.estado = 'Aprobada' OR IM.estado ='Retirada' ) ");

$consulMaterias->execute(array($idExpedienteU));

?>
<!--div principal-->
<div class="container-fluid">
    <!--Navbar-->

    <div class="title">
        <a href="javascript:history.back();"><img src="../img/proximo.svg" class="icon"></a>
        <h2 class="main-title">Historial Notas</h2>
    </div>
    <!--/.Navbar-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <style>
    th {
        width: 150px;
    }
    </style>
    <div class="container">
        <br>
        <div class="card-body"  style=" width:100%; overflow-x: scroll;">
            <div>
                <table id="makeEditable" class="table table-responsive text-center">
                    <thead class="table-dark ">
                        <tr>
                            <th scope="col">Codigo</th>
                            <th scope="col">Asignatura</th>
                            <th scope="col">Ciclo</th>
                            <th scope="col">Nota</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody class=" table-bordered">
                        <?php
            if ($consulMaterias->rowCount() >= 1) {
              while ($fila2 = $consulMaterias->fetch()) {


                if ($fila2['estadoM'] != 'Inscrita') {

                  echo "<tr>
                   <td >" . $fila2['idMateria'] . "</td>
                   <td class='oscuro'>" . utf8_decode($fila2['nombreMateria']) . "</td>
                   
                    <td >" . $fila2['cicloU'] . "</td>
                      <td >" . $fila2['nota'] . "</td>
                   <td >" . $fila2['estado'] . "</td>
                 </tr>";
                } else {

                  echo "<tr>
                   <td>" . $fila2['idMateria'] . "</td>
                   <td class='oscuro'>" . utf8_decode($fila2['nombreMateria']) . "</td>
                   <td ></td>
                    <td ></td>
                     <td >" . $fila2['nota'] . "</td>
                   <td >" . $fila2['estadoM'] . "</td>
                  
                 </tr>";
                } //fin de else

              } //fin de while
            } else {
              echo "<tr><td colspan='6'>No ha agregado ninguna Asignatura</td></tr>";
            } //fin de else-if
            ?>

                    </tbody>
                    <tfoot class="table-dark ">
                        <tr>
                            <th>Codigo</th>
                            <th>Asignatura</th>
                            <th>Ciclo</th>
                            <th>Nota</th>
                            <th>Estado</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
        <!--Fin de container-->
    </div>
</div>
<br>
<br><br><br>
</div><!-- Fin de div principal-->

<script>
$(document).ready(function() {
    var table = $('#makeEditable').DataTable({

        "scrollX": true,
        "scrollY": "50vh",
        //Esto sirve que se auto ajuste la tabla al aplicar un filtro
        "scrollCollapse": true,
        initComplete: function() {
            //En el columns especificamos las columnas que queremos que tengan filtro
            this.api().columns([1, 2, 3, 4, 5, 6]).every(function() {
                var column = this;

                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.header()))
                    .on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val().trim()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();


                    });
               
                column.data().unique().sort().each(function(d, j) {
                    // select.append('<option value="' + d + '">' + d + '</option>')

                    select.append('<option value="' + d + '">' + d + '</option>')

                });
            });
        },
        "aoColumnDefs": [{
            "bSearchable": false
        }]

    });
    //****Esta bendita linea hace la magia, adjusta el header de la tabla con el body
    table.columns.adjust();
});
</script>
<script src="./JS/datatable.js"></script>
<?php

require_once 'templates/footer.php';

?>