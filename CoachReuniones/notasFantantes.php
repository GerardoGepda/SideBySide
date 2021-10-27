<?php include 'Modularidad/CabeceraInicio.php'; ?>
<title>Notas || Notas Faltantes</title>
<?php
include 'Modularidad/EnlacesCabecera.php';
include 'Modularidad/MenuHorizontal.php';
require_once '../Conexion/conexion.php';
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link rel="stylesheet" type="text/css" href="css/modulos-moodle.css">

<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- style para select multiple -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
<link rel="stylesheet" type="text/css" href="css/notasfaltantes.css">

<div class="title  mb-2">
    <a href="javascript:history.back();" title=""><img src="../img/back.png" class="icon"></a>
    <h2 class="main-title">Notas faltantes</h2>
    <div class="title2">
        <button type="button" class="btn btn-primary p-1" data-toggle="modal" data-target=".bd-example-modal-lg">Editar Mensaje</button>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cambiar Mensaje
                            <br>
                            <small><code>*Los cambios son actualizados automáticamente.</code></small>
                            <br>
                            <small><code>*El última día para subir las notas ya esta delimitado.</code></small>
                            <br>
                            <small><code>*El ciclo es generado aútomaticamente</code></small>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $file = "./docs/notasFaltantes.txt";
                        $documento  = file_get_contents($file);
                        $pretty = trim(($documento));
                        ?>
                        <textarea name="editor" id="editor" cols="60" rows="10">
                            <?php echo $pretty; ?>
                        </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="float-right"> <?php include 'Modularidad/Alerta.php' ?></div>
<div class="card p-2 ">
    <div class='row'>
        <div class="col-sm m-1">
            <select id="class" class="browser-default bg-light custom-select choices-multiple-remove-button" name="class" onchange="main();"  placeholder="Seleccionar class" multiple>
                <!-- <option class='dropdown-item' disabled selected>Class</option> -->
                <?php
                $consult1 = $dbh->query("SELECT DISTINCT(Class) FROM alumnos ORDER BY Class DESC");
                foreach ($consult1 as $alumnos) {
                    $clase = $alumnos['Class'];
                    echo '<option  value="' . $clase . '">' . $clase . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-sm m-1">
            <select id="ciclo" class="browser-default bg-light custom-select choices-multiple-remove-button" name="ciclo" onchange="main();" placeholder="Seleccionar ciclo" multiple>
                <!-- <option class='dropdown-item' disabled selected>Ciclo</option> -->
                <?php
                // $consult2 = $dbh->query("SELECT DISTINCT cicloU FROM inscripcionciclos WHERE cicloU != '' ORDER BY cicloU ASC");
                $consult2 = $dbh->query("SELECT DISTINCT cicloU FROM inscripcionciclos ORDER BY cicloU ASC");
                foreach ( $consult2 as $alumnos) {
                    $ciclo = $alumnos['cicloU'];
                    echo '<option value="' . $ciclo . '">' . $ciclo . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-sm m-1">
            <select id="status" class="browser-default bg-light custom-select choices-multiple-remove-button" name="status" onchange="main();" placeholder="Seleccionar status" multiple>
                <!-- <option class='dropdown-item' disabled selected>Status</option> -->
                <?php
                $consult3 = $dbh->query("SELECT DISTINCT StatusActual FROM alumnos ORDER BY StatusActual ASC");
                foreach ($consult3 as $alumnos) {
                    $status = $alumnos['StatusActual'] ;
                    echo '<option value="' .$status . '">' . $status . '</option>';
                }
                ?>
            </select>
        </div>
    </div>
</div>
<div>
    <div id="grafica">
    <div id="donutchart" class="h-50 d-inline bg-light mx-auto"></div>
    </div>
    
    <div id="lista" class="d-inline h-50 w-75 mx-auto p-1" style="background-color:#ADADB2"></div>
</div>

<div style="height:300px; " id="canal">

</div>
<script async src="js/notasFantantes.js"></script>
<script async src="js/editor.js"></script>

<!-- script para select multiple -->
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

<!-- script para select multiple -->
<script>
    $(document).ready(function(){

    var multipleCancelButton = new Choices('.choices-multiple-remove-button', {
    removeItemButton: true,
    maxItemCount:5,
    searchResultLimit:5,
    renderChoiceLimit:50
    });
    
    });
</script>

<?php include 'Modularidad/PiePagina.php'; ?>