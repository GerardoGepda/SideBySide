<?php include 'Modularidad/CabeceraInicio.php'; ?>
<title>Renovación || Renovaciones Faltantes</title>
<?php
//Modularaidad para extraere los enlaces en HEAD
include 'Modularidad/EnlacesCabecera.php';
//Incluir el menu horizontal
include 'Modularidad/MenuHorizontal.php';
require_once '../Conexion/conexion.php';
$year = date("Y");
$i = 0;
?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="css/modulos-moodle.css">
<div class="title  mb-2">
    <a href="javascript:history.back();" title=""><img src="../img/back.png" class="icon"></a>
    <h2 class="main-title">Renovaciones faltantes</h2>
    <div class="title2">
    </div>
</div>
<div class="float-right"> <?php include 'Modularidad/Alerta.php'?></div>
<form method="POST" action="renovaciones2.php">
    <div class="card p-2 ">
        <div class='row'>
            <div class="col-sm m-1">
                <select id="class" class="browser-default bg-light custom-select" name="class" onchange="main();">
                    <option value="0" class='dropdown-item' disabled selected>Class</option>
                    <?php
                    foreach ($dbh->query("SELECT DISTINCT(Class) FROM alumnos ORDER BY Class DESC") as $alumnos) {
                    ?>
                        <option value="<?php echo $alumnos['Class']  ?>"><?php echo $alumnos['Class']  ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm m-1">
                <select id="ciclo" class="browser-default bg-light custom-select" name="ciclo" onchange="main();">
                    <option value=" " class='dropdown-item' disabled selected>Ciclo</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>

            <div class="col-sm m-1">
                <select id="year" class="browser-default bg-light custom-select" name="year" onchange="main();">
                    <option value="0" class='dropdown-item' disabled selected>Año</option>
                    <?php
                    for ($i = $year; $i >= 2014; $i--) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <center>
        <input type="checkbox" id="todo" name="todo" value="todo">
        <label for="todo" class="text-dark m-2">Todo</label><br>
        <input type="submit" name="mostrar" class="btn btn-success mb-1" value="Mostrar">
    </center>
</form>


<?php
if (isset($_POST['mostrar'])) {

    $class;
    $ciclo;
    $year;
    $consulta;

    if (isset($_POST['class']) and isset($_POST['ciclo']) and isset($_POST['year'])) {
        $class = $_POST['class'];
        $ciclo = $_POST['ciclo'];
        $year = $_POST['year'];

        $consulta = "SELECT ID_Alumno,alumnos.Nombre as 'name',Class,correo,carrera.nombre,alumnos.ID_Sede,alumnos.ID_Empresa
            FROM alumnos 
            JOIN carrera ON carrera.Id_Carrera = alumnos.ID_Carrera 
            WHERE ID_Alumno 
            NOT IN( SELECT r.ID_alumno FROM renovacion r LEFT JOIN alumnos A ON r.ID_alumno = A.ID_Alumno 
            WHERE ciclo = " . $ciclo . " AND year = " . $year . ") 
            AND alumnos.StatusActual = 'Becado' AND alumnos.Class = $class";
    } elseif (isset($_POST['class']) and isset($_POST['ciclo']) and !(isset($_POST['year']))) {
        $class = $_POST['class'];
        $ciclo = $_POST['ciclo'];
        $consulta = "SELECT ID_Alumno,alumnos.Nombre as 'name',Class,correo,carrera.nombre,alumnos.ID_Sede,alumnos.ID_Empresa 
            FROM alumnos 
            JOIN carrera ON carrera.Id_Carrera = alumnos.ID_Carrera 
            WHERE ID_Alumno 
            NOT IN( SELECT r.ID_alumno FROM renovacion r LEFT JOIN alumnos A ON r.ID_alumno = A.ID_Alumno 
            WHERE ciclo = " . $ciclo . ") 
            AND alumnos.StatusActual = 'Becado' AND alumnos.Class = $class";
    } elseif (!(isset($_POST['class'])) and isset($_POST['ciclo']) and isset($_POST['year'])) {
        $ciclo = $_POST['ciclo'];
        $year = $_POST['year'];

        $consulta = "SELECT ID_Alumno,alumnos.Nombre as 'name',Class,correo,carrera.nombre,alumnos.ID_Sede,alumnos.ID_Empresa 
            FROM alumnos 
            JOIN carrera ON carrera.Id_Carrera = alumnos.ID_Carrera 
            WHERE ID_Alumno 
            NOT IN( SELECT r.ID_alumno FROM renovacion r LEFT JOIN alumnos A ON r.ID_alumno = A.ID_Alumno 
            WHERE ciclo = " . $ciclo . " AND year = " . $year . ") 
            AND alumnos.StatusActual = 'Becado'";
    } elseif (isset($_POST['class']) and !(isset($_POST['ciclo'])) and isset($_POST['year'])) {
        $class = $_POST['class'];
        $year = $_POST['year'];
        $consulta = "SELECT ID_Alumno,alumnos.Nombre as 'name',Class,correo,carrera.nombre,alumnos.ID_Sede,alumnos.ID_Empresa
        FROM alumnos 
        JOIN carrera ON carrera.Id_Carrera = alumnos.ID_Carrera 
        WHERE ID_Alumno 
        NOT IN( SELECT r.ID_alumno FROM renovacion r LEFT JOIN alumnos A ON r.ID_alumno = A.ID_Alumno 
        WHERE year = " . $year . ") AND alumnos.StatusActual = 'Becado' AND alumnos.Class = $class";
    } elseif (!(isset($_POST['class'])) and !(isset($_POST['ciclo'])) and isset($_POST['year'])) {
        $year = $_POST['year'];
        $consulta = "SELECT ID_Alumno,alumnos.Nombre as 'name',Class,correo,carrera.nombre,alumnos.ID_Sede,alumnos.ID_Empresa 
        FROM alumnos 
        JOIN carrera ON carrera.Id_Carrera = alumnos.ID_Carrera 
        WHERE ID_Alumno 
        NOT IN( SELECT r.ID_alumno FROM renovacion r LEFT JOIN alumnos A ON r.ID_alumno = A.ID_Alumno 
        WHERE year = " . $year . ") ";
    } elseif (isset($_POST['class']) and !(isset($_POST['ciclo'])) and !(isset($_POST['year']))) {
        $class = $_POST['class'];
        $consulta = "SELECT ID_Alumno,alumnos.Nombre as 'name',Class,correo,carrera.nombre,alumnos.ID_Sede,alumnos.ID_Empresa 
        FROM alumnos 
        JOIN carrera ON carrera.Id_Carrera = alumnos.ID_Carrera 
        WHERE ID_Alumno 
        NOT IN( SELECT r.ID_alumno FROM renovacion r LEFT JOIN alumnos A ON r.ID_alumno = A.ID_Alumno 
        ) 
        AND alumnos.StatusActual = 'Becado' AND alumnos.Class = $class";
    } elseif (!(isset($_POST['class'])) and isset($_POST['ciclo']) and !(isset($_POST['year']))) {
        $ciclo = $_POST['ciclo'];
        $consulta = "SELECT ID_Alumno,alumnos.Nombre as 'name',Class,correo,carrera.nombre,alumnos.ID_Sede,alumnos.ID_Empresa 
        FROM alumnos 
        JOIN carrera ON carrera.Id_Carrera = alumnos.ID_Carrera 
        WHERE ID_Alumno 
        NOT IN( SELECT r.ID_alumno FROM renovacion r LEFT JOIN alumnos A ON r.ID_alumno = A.ID_Alumno 
        WHERE ciclo = " . $ciclo . " ) 
        AND alumnos.StatusActual = 'Becado'";
    } elseif (!(isset($_POST['class'])) and !(isset($_POST['ciclo'])) and !(isset($_POST['year'])) and isset($_POST['todo'])) {
        $consulta = "SELECT ID_Alumno,alumnos.Nombre as 'name',Class,correo,carrera.nombre,alumnos.ID_Sede,alumnos.ID_Empresa 
        FROM alumnos 
        JOIN carrera ON carrera.Id_Carrera = alumnos.ID_Carrera 
        WHERE ID_Alumno 
        NOT IN( SELECT r.ID_alumno FROM renovacion r LEFT JOIN alumnos A ON r.ID_alumno = A.ID_Alumno ) 
        AND alumnos.StatusActual = 'Becado'";
    } elseif (!(isset($_POST['class'])) and !(isset($_POST['ciclo'])) and !(isset($_POST['year'])) and !(isset($_POST['todo']))) {
        echo "<div class='alert alert-danger' style='margin:0 auto;text-align:center;'>Operación no valida</div>";
    }
?>
    <div style="background-color:gray;color:white;width:95%;margin-left:3%; " class="mt-4" >
    <form action="Modelo/ModeloRenovacion/correo.php" method="post">
        <button type="submit" class="btn btn-primary m-2 p-1 mx-auto">Enviar Correo</button>
        <table id="example" class="display w-100">
            <thead class="table-dark">
                <tr>
                    <th><input type='checkbox' name='' class='case' value="" id="todos">Todos</th>
                    <th>Carné</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Carrera</th>
                    <th>Class</th>
                    <th>Universidad</th>
                    <th>Sede</th>

                </tr>
            </thead>
            <tbody class="table-bordered table-hover table-striped">
                <?php
                foreach ($dbh->query($consulta) as $ausentes) {
                ?>
                    <tr>
                        <td><input type='checkbox' name='ActuaAlumno[]' class='case' value="<?php echo $ausentes['correo'] ?>"></td>
                        <td><?php echo $ausentes['ID_Alumno'] ?></td>
                        <td><?php echo $ausentes['name'] ?></td>
                        <td><?php echo $ausentes['correo'] ?></td>
                        <td><?php echo $ausentes['nombre'] ?></td>
                        <td><?php echo $ausentes['Class'] ?></td>
                        <td>
                            <?php 
                                if($ausentes['ID_Empresa'] == 'ECdCI')
                                    echo "ECCI";
                                else if($ausentes['ID_Empresa'] == 'INICAES')
                                    echo "UNICAES";
                                else if($ausentes['ID_Empresa'] == 'UFGS')
                                    echo "UFG SA";
                                else if($ausentes['ID_Empresa'] == 'UFGSS')
                                    echo "UFG SS";
                                else if($ausentes['ID_Empresa'] == 'UNDESA')
                                    echo "UES SA";
                                else if($ausentes['ID_Empresa'] == 'UNDESM')
                                    echo "UES SM";
                                else if($ausentes['ID_Empresa'] == 'UNDESS')
                                    echo "UES SS";
                                else if($ausentes['ID_Empresa'] == 'UDJMD')
                                    echo "UJMD";
                                else 
                                    echo $ausentes['ID_Empresa'];
                            ?>
                        </td>
                        <td><?php echo $ausentes['ID_Sede'] ?></td>
                    </tr>
            <?php
                }
            }
            ?>
            </tbody>
        </table>
        </form>
    </div>
    <script async src="js/faltantes.js"></script>
    <br><br><br><br><br><br><br><br><br><br>
    <?php include 'Modularidad/PiePagina.php'; ?>