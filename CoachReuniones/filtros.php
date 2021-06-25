<?php
include "../BaseDatos/conexion.php";
// consulta para obtener los ciclos

//INICIO DE  CONSULTAS PARA FILTROS
$stmt = $pdo->query("SELECT DISTINCT cicloU FROM inscripcionciclos ORDER BY cicloU ASC");
$stmt->execute();

// consulta para obtener las clases
$stmt2 = $pdo->query("SELECT DISTINCT Class FROM alumnos ORDER BY Class ASC");
$stmt2->execute();

// consulta para obtener las sede
$stmt3 = $pdo->query("SELECT DISTINCT ID_Sede FROM alumnos ORDER BY Class ASC");
$stmt3->execute();


// consulta para obtener los status de beca
$stmt4 = $pdo->query("SELECT DISTINCT StatusActual FROM alumnos ORDER BY StatusActual ASC");
$stmt4->execute();
?>

<!-- inicio de filtros -->
<div id="filtros">
    <form>
        <div class="row tex-center">
            <div class="col" id="filtro1">
                <fieldset>
                    <div class="mb-1">
                        <label class="form-label">Ciclo</label>
                        <div class="pl-3 tex-center">
                            <select class="js-example-basic-single form-control" id="ciclo" multiple="multiple" onchange=" main(), GraphBarraU()">
                                <?php
                                while ($row = $stmt->fetch()) {
                                    echo "<option >" . $row['cicloU'] . "</option>";
                                }
                                ?>
                            </select>
                            <input class="form-check-input" type="checkbox" id="checkbox1">Select All</input>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col" id="filtro2">
                <fieldset>
                    <div class="mb-1">
                        <label class="form-label">Class</label>
                        <div class="tex-center">
                            <select class="js-example-basic-single form-control" id="clase" multiple="multiple" onchange=" main(), GraphBarraU()">
                                <?php
                                while ($row2 = $stmt2->fetch()) {
                                    echo "<option>" . $row2['Class'] . "</option>";
                                }
                                ?>
                            </select>
                            <input class="form-check-input" type="checkbox" id="checkbox2">Select All</input>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="col" id="filtro3">
                <fieldset>
                    <div class="mb-1 tex-center">
                        <label class="form-label">Financiamiento</label>
                        <select class="form-select form-control" id="financiamiento" multiple="" onchange=" main(), GraphBarraU()">
                            <option value="FGK" class="dropdown-item">FGK</option>
                            <option value="BORJA" class="dropdown-item">BORJA</option>
                            <option value="FOM" class="dropdown-item">FOM</option>
                            <option value="Financiamiento Propio" class="dropdown-item">Financiamiento propio</option>
                        </select>
                        <input class="form-check-input" type="checkbox" id="checkbox3">Select All</input>
                    </div>
                </fieldset>
            </div>
            <div class="col" id="filtro3">
                <fieldset>
                    <div class="mb-1 w-75 pl-3">
                        <label class="form-label">Sede</label>
                        <select class="form-select form-control" id="sede" multiple="" onchange=" main(), GraphBarraU()">
                            <?php
                            while ($row3 = $stmt3->fetch()) {
                                echo "<option>" . $row3['ID_Sede'] . "</option>";
                            }
                            ?>
                        </select>
                        <input class="form-check-input" type="checkbox" id="checkbox4">Select All</input>
                    </div>
                </fieldset>
            </div>
            <div class="col" id="filtro4">
                <fieldset>
                    <div class="mb-1 w-75 pl-3">
                        <label class="form-label">Status</label>
                        <select class="form-select form-control" id="status" multiple="" onchange=" main(), GraphBarraU()">
                            <?php
                            while ($row2 = $stmt4->fetch()) {
                                echo "<option>" . $row2['StatusActual'] . "</option>";
                            }
                            ?>
                        </select>
                        <input class="form-check-input" type="checkbox" id="checkbox5">Select All</input>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>
</div>

<!-- fin de filtros -->