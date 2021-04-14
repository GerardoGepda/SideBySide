<?php
include 'Modularidad/CabeceraInicio.php';
include "../BaseDatos/conexion.php"; //Realizamos la conexión con la base de datos  
include_once "Modelo/ModeloAlumno/NotasAlumno.php";
include 'Modularidad/EnlacesCabecera.php';
include 'Modularidad/MenuHorizontal.php';
?>
<title>Inicio</title>

<?php
require '../Conexion/conexion.php';
$idExpedienteU = $_GET['idAlumno'];
$id = $_GET['id'];
$expediente = $_GET['expediente'];


//extraer inscripción de alumno
$consulta2 = $pdo->prepare("SELECT * FROM inscripcionciclos WHERE Id_InscripcionC=?");
$consulta2->execute(array($id));

//extraer notas de la inscripcion del alumno
$consulta3 = $pdo->prepare("SELECT * FROM inscripcionmateria INNER JOIN materias on inscripcionmateria.idMateria = materias.idMateria 
        WHERE Id_InscripcionC =? ORDER BY nota DESC ");
$consulta3->execute(array($id));

//extraer materias disponibles para inscribir
$consulta5 = $pdo->prepare("SELECT * FROM materias WHERE idExpedienteU = ?  ");
$consulta5->execute(array($idExpedienteU));


?>
<link rel="stylesheet" href="../Alumno/CSS/modificarMateria.css">
<link rel="stylesheet" type="text/css" href="css/Menu.css">
<nav class="navbar navbar-expand-lg navbar-light" id="row">
    <a href="javascript:history.back();"><img src="../img/back.png" class="icon" style="transform:rotate(0deg);"></a>
    <a class="navbar-brand" href="#" id="T1">Modificar Inscripción</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item" id="bloque">
                <a class="nav-link" href="pensum.php?id=<?php echo $id ?>">Pensum<span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>

<div class="float-right"> <?php include 'Modularidad/Alerta.php' ?></div>
<div class="float-right"> <?php include 'Modularidad/AlertaCorreo.php' ?></div>

<div class="container-fluid text-center">
    <br>
    <!-- inicio area de trabajo -->
    <div class="row">
        <!--Primera columna-->
        <div class="col-sm" >
            <!-- incluir estilo -->
            <?php include "../Alumno/CSS/modificarInscripcion.php"; ?>
            <div class='centerTable w-75 mx-auto '>
                <table id="makeEditable">
                    <thead class="table table-striped table-bordered">
                        <tr>
                            <th style="color: red;">CODIGO</th>
                            <th style="color: red;">CICLO</th>
                            <th style="color: red;">COMPROBANTE DE INSCRIPCIÓN</th>
                            <th style="color: red;">COMPROBANTE DE NOTAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($consulta2->rowCount() >= 1) {
                            while ($fila2 = $consulta2->fetch()) {
                                $pdfCiclo = $fila2['comprobante'];
                                $pdfnotas = $fila2['pdfnotas'];
                                $idciclo =  $fila2['Id_InscripcionC'];
                                $ciclo = $fila2['cicloU'];
                                echo "<tr>
                                        <td >" . $fila2['Id_InscripcionC'] . "</td>
                                        <td class='oscuro'>" . $fila2['cicloU'] . " 
                                        <button class='btn btn-warning ' type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal2'><i class=\"fas fa-edit\"></i></button></td> 
                                        </td>
                                        <td>
                                        <a href='../pdfCicloInscripcion/$pdfCiclo' target='_blank' class='btn btn-danger '>
                                        <img src='../img/PDF.png' width='25px' height='25px '/></a> 
                                        <button class='btn btn-warning ' type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'><i class=\"fas fa-edit\"></i></button></td> 
                                        
                                        <td><a href='../pdfNotas/$pdfnotas' target='_blank' class='btn btn-danger '>
                                        <img src='../img/PDF.png' width='25px' height='25px' /></a> 
                                        <button class='btn btn-warning ' comprobante type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal3'><i class=\"fas fa-edit\"></i></button></td> 
                                        </td> 
                                    </tr>";
                            } //fin de while
                        } else {
                            echo "<tr><td colspan='6'>No ha agregado ninguna Asignatura</td></tr>";
                        } //fin de else-if

                        ?>
                    </tbody>

                    <tfoot>

                    </tfoot>
                </table>
            </div>
            <br><br>
            <h1 class="text-center" style="font-family: 'Anton', sans-serif;">Materias Inscritas</h1>
            <br>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal33">
                Agregar Materias
            </button>
            <div class='centerTable w-75 mx-auto '>
                <table id="makeEditable">
                    <thead class="table table-striped table-bordered">
                        <tr>
                            <th style="color: red;">CODIGO</th>
                            <th style="color: red;">MATERIA</th>
                            <th style="color: red;">NOTA</th>
                            <th style="color: red;">MATRICULA</th>
                            <th style="color: red;">ESTADO</th>
                            <th style="color: red;">OPCIONES</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        if ($consulta3->rowCount() >= 1) {
                            while ($fila2 = $consulta3->fetch()) {

                                $materia1 = $fila2['nombreMateria'];
                                echo "<tr>                    
                      <td class='oscuro'>" . $fila2['idMateria'] . " </td>
                      <td >" . $fila2['nombreMateria'] . "</td>
                      <td>" . $fila2['nota'] . "
                      <td>" . $fila2['matricula'] . "</td>
                      ";
                                if ($fila2['estado'] == 'Aprobada') {
                                    echo "<td class='bg-success text-white'>" . $fila2['estado'] . "</td> ";
                                } elseif ($fila2['estado'] == 'Inscrita') {
                                    echo "<td class='bg-info text-white'>" . $fila2['estado'] . "</td> ";
                                } elseif ($fila2['estado'] == 'Retirada') {
                                    echo "<td class='bg-warning text-white'>" . $fila2['estado'] . "</td> ";
                                } else {
                                    echo "<td class='bg-danger text-white'>" . $fila2['estado'] . "</td> ";
                                }
                                echo " 
                      <td>
                       <button type='button' id=" . $fila2['idMateria'] . " class='btn ' data-toggle='modal'
                        data-target='#ModalMateria' onclick='mandarId(id)' ><i class='fa fa-pen'></i>

                        <a href='Modelo/ModeloMaterias/eliminarMateria.php?idciclo=$idciclo&expediente=$expediente&alumno=$idExpedienteU&id=" . $fila2['idMateria'] . "'>
                        <button class='btn text-dark '  type='button'  data-toggle='modal' data-target='#exampleModal4'>
                        <i class=\"fas fa-trash\"></i></button></a>
                        </td> 
                      </td>
                 </tr>";
                            } //fin de while
                        } else {
                            echo "<tr><td colspan='6'>No ha agregado ninguna Asignatura</td></tr>";
                        } //fin de else-if

                        ?>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
            </div>
            <br>
            <br>
        </div>
        <!-- Fin Primera columna-->
        <br>
    </div>
    <!--Fin de row-->

    <a class="btn btn-success" href="NotasPorAlumno.php?id=<?php echo $expediente ?>" rel="noopener noreferrer">Guardar Cambios</a>
</div>
<!--Fin de container-->
</div>
</div>
</div>
<br>
<br><br><br>
</div><!-- Fin de div principal-->

<!-- /#page-content-wrapper -->


</div>

<!-- /#wrapper -->


<!-- Modal para modificar comprobante de inscripcion -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar comprobante de inscripcion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="alert alert-danger h-100" role="alert">
                    Para que su solicitud sea terminada con exito agregue su comprobante de notas.
                </div>
                <br />
                <form action="Modelo/ModeloMaterias/comprobanteInscripcion.php" method="post" enctype="multipart/form-data">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept=".pdf" id="customFileLang" name="archivo" required>
                        <label class="custom-file-label" for="customFileLang" data-browse="Buscar">Seleccionar
                            Comprobante</label>
                        <center><small>El archivo no debe pesar más de 5MB</small></center>
                    </div>
                    <br><br>
                    <div>
                        <!--idalumnos-->
                        <input type="hidden" name="alumno" value="<?php echo $expediente; ?>">
                        <!--id expedente-->
                        <input type="hidden" name="expediente" value="<?php echo $idExpedienteU; ?>">
                        <!-- ciclo -->
                        <input type="hidden" name="ciclo" value="<?php echo $ciclo; ?>">
                        <!-- comprobante cicloU -->
                        <input type="hidden" name="comprobante" value="<?php echo $pdfCiclo; ?>">
                        <!-- id ciclo -->
                        <input type="hidden" name="idInscripcionCiclo" value="<?php echo $id; ?>">

                    </div>

            </div>
            <div class="modal-footer">
                <input class="btn btn-primary btn-rounded" type="submit" name="actualizar" value="Cerrar " data-dismiss="modal">
                <input class="btn btn-primary btn-rounded" type="submit" name="actualizar" value="Guardar Cambios " id="actualizar">

            </div>

            </form>
        </div>
    </div>
</div>

<!-- Modal para modificar comprobante de notas -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Ciclo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="Modelo/ModeloMaterias/actualizarCicloInscripcion.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="idalumno" value="<?php echo $idExpedienteU; ?>">
                    <input type="hidden" name="idalumno2" value="<?php echo $expediente; ?>">
                    <div class="form-group">
                        <label class="" for="ciclo">Ciclo:</label>
                        <select name="ciclo" id="ciclo" class="ciclo form-control">
                            <!-- año 2015 -->
                            <option disabled>2015</option>
                            <option value="Ciclo 01-2015">Ciclo 01-2015</option>
                            <option value="Ciclo 02-2015">Ciclo 02-2015</option>
                            <option value="Ciclo 03-2015">Ciclo 03-2015</option>
                            <!-- año 2016 -->
                            <option disabled>2016</option>
                            <option value="Ciclo 01-2016">Ciclo 01-2016</option>
                            <option value="Ciclo 02-2016">Ciclo 02-2016</option>
                            <option value="Ciclo 03-2016" title="Interciclo">Ciclo 03-2016</option>
                            <!-- año 2017 -->
                            <option disabled>2017</option>
                            <option value="Ciclo 01-2017">Ciclo 01-2017</option>
                            <option value="Ciclo 02-2017">Ciclo 02-2017</option>
                            <option value="Ciclo 03-2017" title="Interciclo">Ciclo 03-2017</option>
                            <!-- año 2018 -->
                            <option disabled>2018</option>
                            <option value="Ciclo 01-2018">Ciclo 01-2018</option>
                            <option value="Ciclo 02-2018">Ciclo 02-2018</option>
                            <option value="Ciclo 03-2018" title="Interciclo">Ciclo 03-2018</option>
                            <!-- año 2019 -->
                            <option disabled>2019</option>
                            <option value="Ciclo 01-2019">Ciclo 01-2019</option>
                            <option value="Ciclo 02-2019">Ciclo 02-2019</option>
                            <option value="Ciclo 03-2019" title="Interciclo">Ciclo 03-2019</option>
                            <!-- año 2020 -->
                            <option disabled>2020</option>
                            <option value='Ciclo 01-2020'>Ciclo 01-2020</option>
                            <option value='Ciclo 02-2020'>Ciclo 02-2020</option>
                            <option value='Ciclo 03-2020' title="Interciclo">Ciclo 03-2020</option>
                            <!-- año 2021 -->
                            <option disabled>2021</option>
                            <option value='Ciclo 01-2021'>Ciclo 01-2021</option>
                            <option value='Ciclo 02-2021'>Ciclo 02-2021</option>
                            <option value='Ciclo 03-2021' title="Interciclo">Ciclo 03-2021</option>";

                            <!-- año 2022 -->
                            <!-- <option disabled>2022</option>
                            <option value='Ciclo 01-2022'>Ciclo 01-2022</option>
                            <option value='Ciclo 02-2022'>Ciclo 02-2022</option>
                            <option value='Ciclo 03-2022' title="Interciclo">Ciclo 03-2022</option>"; -->

                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL Materias -->
<!--**************-->
<div class="modal fade " id="ModalMateria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar nota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body " style="color: #343434;">
                <form action="Modelo/ModeloMaterias/ActualizarNota2.php" method="POST" accept-charset="utf-8">
                    <div id="alerta5"></div>
                    <div class="col">

                        <script type="text/javascript">
                            function mandarId(id) {
                                var prueba = id;
                                var prueba2 = id;

                                document.getElementById("mate").innerHTML = prueba2;
                                document.getElementById("Materia").value = prueba;

                            }
                        </script>
                        <div class="form-group">
                            <label class="" for="Materia" style="color: #343434;">Codigo de materia:</label>
                            <input type="text" name="materia" id="Materia" class="Materia form-control">
                        </div>



                        <div class="form-group">
                            <label id="mate" style="margin-left:1%" for="matricula" hidden="hidden"></label>
                        </div>

                        <div class="form-group">
                            <label class="" for="nota" style="color: #343434;">Nota:</label>
                            <input type="text" name="nota" placeholder="0.00" class="nota form-control" id="nota">
                        </div>

                        <div class="form-group ">
                            <label for="inputCity" style="color: #343434;">Estado materia:</label>
                            <select id="estado" name="estado" class="form-control"  required>
                                <option selected>Seleccione una opción...</option>
                                <option value="Aprobada">Aprobada</option>
                                <option value="Reprobada">Reprobada</option>
                                <option value="Retirada">Retirada</option>
                            </select>
                        </div>
                        <input type="hidden" name="expediente" value="<?php echo $expediente; ?>">
                        <input type="hidden" name="expedienteu" value="<?php echo $idExpedienteU; ?>">
                        <input type="hidden" name="idInscripcionCiclo" value="<?php echo $idciclo; ?>">

                    </div>

                    <input class="btn btn-primary btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="Actualizar_Notas" value="Actualizar Nota" id="Actualizar_Notas">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL MATERIA -->



<!-- Modal Pensum carrera -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comprobante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger h-100" role="alert">
                    Para que su solicitud sea terminada con exito agregue su comprobante de notas.
                </div>
                <br />
                <form action="Modelo/ModeloMaterias/subirpdfNotas.php" method="post" enctype="multipart/form-data">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" accept=".pdf" id="customFileLang" name="archivo" required>
                        <label class="custom-file-label" for="customFileLang" data-browse="Buscar">Seleccionar
                            Comprobante</label>
                        <center><small>El archivo no debe pesar más de 5MB</small></center>
                    </div>
                    <br><br>
                    <div>
                        <!--idalumnos-->
                        <input type="hidden" name="alumno" value="<?php echo $expediente; ?>">
                        <!--id expedente-->
                        <input type="hidden" name="expediente" value="<?php echo $idExpedienteU; ?>">
                        <!-- id incripcion ciclo -->
                        <input type="hidden" name="idInscripcionCiclo" value="<?php echo $idciclo; ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <input style="border-radius: 20px; border: 2px solid #9d120e; width: 100px;height: 38px; background-color: #9d120e; color:white;" type="submit" name="actualizar" value="Cerrar " data-dismiss="modal">
                <input style="border-radius: 20px; border: 2px solid #9d120e; width: 200px;height: 38px; background-color: #9d120e; color:white;" type="submit" name="pdfNotas" value="Guardar Cambios " id="pdfNotas">
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Agregar materias -->
<!-- Modal -->
<div class="modal fade" id="exampleModal33" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar materias a inscripción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="Modelo/ModeloMaterias/agregarMateria.php" method="post">
                    <!--id expedente-->
                    <input type="hidden" name="alumno" value="<?php echo $expediente; ?>">
                    <input type="hidden" name="idInscripcion" value="<?php echo $idciclo; ?>">
                    <!--idalumnos-->
                    <input type="hidden" name="idalumno" value="<?php echo $idExpedienteU; ?>">
                    <div class="searchable">
                        <input type="text" name='idMateria' placeholder="Buscar materia" onkeyup="filterFunction(this,event)">
                        <ul>
                            <?php
                            while ($row = $consulta5->fetch()) {
                                if ($row['estadoM'] != 'Aprobada') {
                                    echo "<li>" . $row['nombreMateria'] . "</li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
    <!-- fin area de trabajo -->

</div>
<script src="../Alumno/JS/selector.js"></script>
<?php require_once '../Alumno/templates/footer.php'; ?>