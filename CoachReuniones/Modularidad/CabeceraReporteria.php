<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
<link rel="shortcut icon" href="../img/WorkeysIcon.png" />
<!-- Bootstrap core CSS -->
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!--Iconos-->
<link rel="stylesheet" href="../icons/css/all.css">

<!--CSS principal-->
<link rel="stylesheet" href="../css/main.css">

<!--FOOTER-->
<link rel="stylesheet" href="../css/footer.css">

<!-- Custom styles for this template -->
<link href="../css/simple-sidebar.css" rel="stylesheet">

<!--Estilo css CrearCuentas-->
<link rel="stylesheet" type="text/css" href="css/EstiloCrearCuentas.css">


<!--ENLACES PARA UTILIZAR DATABLE-->
<link rel="stylesheet" type="text/css" href="DataTable/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-1.8.3.js" integrity="sha256-dW19+sSjW7V1Q/Z3KD1saC6NcE5TUIhLJzJbrdKzxKc=" crossorigin="anonymous"></script>

<script src="DataTable/js/jquery.dataTables.min.js"></script>


<!--Script para utilizar datatable-->

<!--Script para utilizar las alerta-->
<link rel="stylesheet" href="../sweetalert/sweetalert2.css">
<script src="../sweetalert/sweetalert2.js"></script>
<script type="text/javascript" src="js/ValidarPassword.js"></script>
<script type="text/javascript" src="../js/inputfile.js"></script>
<!--Script FIN para utilizar las alerta-->


<!-- <link rel="stylesheet" href="../css/reporteria.css"> -->


<!-- librerias para graficas tipo mapas -->
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/sv/sv-all.js"></script>
<!-- librerias para graficas de pastel -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- select multiple  -->

<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


<style>
    /* inicio de diseño para mapas */

    #map1 {
        margin-top: 1%;
        margin-left: 0%;
        height: 245px;
        min-width: 300px;
        max-width: 430px;
        display: inline-block;
    }

    #map2 {
        margin-top: 1%;
        height: 245px;
        min-width: 300px;
        max-width: 430px;
        display: inline-block;
        margin-left: 30%;
    }

    .loading {
        margin-top: 10em;
        text-align: center;
        color: gray;
    }

    #maps {
        min-width: 100%;
        max-width: 50%;
        display: block;
    }
    /* fin de diseño para mapas */

    /* inicio de diseño para filtros */

    /* diseño  */
    .form-label {
        color: #be0032;
        font-weight: bold;
    }

    .form-control {
        background-color: #d9d2d2;
        border-radius: 20px;
        border-color: white;
    }


    #filtros,
    #content,
    #content2,
    #content3,
    #generals {
        border: #a29c9c 3px solid;
        border-radius: 20px;
    }

    /*
    #content{
        padding: 0.5%;
        margin: 0.4% auto;
        display: flex;
    }

    #content2{
        padding: 0.5%;
        margin-top: 2%;
        display: flex;
    }
    */
    #content,
    #content2,
    #content3 {
        padding: 1%;
        margin: 0.4%;
        display: block;
    }

    /* estilo para graficas generales */
    .highcharts-figure {
        height: 50%;
        min-width: 40%;
        max-width: 40%;
        display: inline-block;
        margin: 0 auto;
        border-radius: 10px;
        padding: 0.4%;
    }

    #content2 h3 {
        color: #be0032;
        font-style: bold;
    }

    #gen {
        margin-left: -50%;
        margin-top: 1%;
        min-height: 90%;
        max-height: 90%;
        min-width: 90%;
        max-width: 90%;
        display: inline-block;
    }

    #gen2 {
        margin-left: 25%;
        margin-top: 1%;
        min-height: 90%;
        max-height: 90%;
        min-width: 90%;
        max-width: 90%;
        display: inline-block;
    }

    /* graficas generales */

    #middle-pie {
        height: 200px;
        min-width: 280px;
        max-width: 280px;
        display: inline-block;
        border-radius: 10px;
        margin: 2px 4%;
    }

    #cumGeneral {
        position: relative;
        bottom: 20px;
        right: -40px;
        min-width: 200px;
        max-width: 200px;
        display: inline-block;
        margin: 0.5% 4%;
    }

    #tablaGeneral {
        min-width: 450px;
        max-width: 450px;
        margin: 0% 0%;
    }

    #TableBody th {
        border: solid 0.5px #111;
        border-style: groove;
    }

    #TableBody th:hover {
        background-color: #be0032;
        color: white;
    }

    #generalTable {
        position: relative;
        bottom: 30px;
        min-width: 450px;
        max-width: 450px;
        margin-left: 9%;
        margin-top: 2%;
        display: inline-block;
    }

    /* fin de graficas generales */

    /* inicio de diseño para graficas universitarias */
    #universidades {
        padding: 0.3%;
        margin: 0.5%;
        border-radius: 20px;
        display: flex;
        min-width: 100%;
        max-width: 100%;
        display: inline-block;

    }

    .uni-content {
        border: #a29c9c 3px solid;
        border-radius: 10px;
        display: inline-block;
        min-width: 650px;
        max-width: 650px;
        height: 245px;
        margin-left: 1%;
    }

    /* fin de diseño para graficas universitarias */

    @import 'https://code.highcharts.com/css/highcharts.css';

    .highcharts-pie-series .highcharts-point {
        stroke: #EDE;
        stroke-width: 2px;
    }

    .highcharts-pie-series .highcharts-data-label-connector {
        stroke: silver;
        stroke-dasharray: 2, 2;
        stroke-width: 2px;
    }

    .highcharts-data-table table {
        min-width: 320px;
        max-width: 600px;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }

    .icon {
        font-size: 30px;
    }

    /* responsive design */
    /* responsive de grafiaca de mapas y grafica de genro*/
    @media only screen and (max-width: 1024px) {
        #content3 {
            display: inline-block;
            margin: 0 auto;
            min-width: 100%;
            max-width: 100%;
            height: auto;
        }

        #map1,
        #map2 {
            min-width: 100%;
            max-width: 100%;
            margin: 0.5% auto;
        }

        #cumGeneral{
            position: relative;
            bottom: 20px;
            right:0;
            margin: 4px 45px;
            min-width: 90%;
            max-width: 90%;
            display: inline-block;
        }
        #middle-pie {
            margin: 1px 50px;
        }
        #tablaGeneral{
            min-width: 100%;
            max-width: 100%;
        }
        #tablaGeneral thead{
            min-width: 100%;
            max-width: 100%;
        }
        #tablaGeneral tbody{
            min-width: 95%;
            max-width: 95%;
        }
        #generalTable {
            bottom: 0;
            margin: 0 15%;
            display: inline-block;
        }
        
        #gen,
        #gen2 {
            background: black;
            min-width: 40%;
            max-width: 40%;
            margin: 0% auto;
        }

        #maps {
            min-width: 100%;
            max-width: 100%;
            display: inline-block;
        }

        .highcharts-figure {
            height: 50%;
            min-width: 90%;
            max-width: 90%;
            display: inline-block;
            margin: 0 auto;
            border-radius: 10px;
            padding: 0.4%;
        }
        #universidades {
            min-width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }
    }

    /*Fin del primer responsive*/
    /*Responsive tabla y filtros de selection*/
    @media only screen and (max-width: 600px) {

        #map1,
        #map2 {
            min-width: 100%;
            max-width: 100%;
            margin: 0.5% auto;
        }

        #gen,
        #gen2 {
            min-width: 40%;
            max-width: 40%;
            margin: 0% auto;
        }

        #maps {
            min-width: 100%;
            max-width: 100%;
            display: inline-block;
        }

        #universidades {
            min-width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }

        #content {
            display: inline-block;
        }

        #content2 {
            height:50%;
            display: inline-block;
        }

        #content3 {
            display: inline-block;
        }

        #filtro1,
        #filtro2,
        #filtro3,
        #filtro4 {
            display: inline-block;
            margin: 0%;
            padding: 0%;
        }
        #tablaGeneral{
            min-width: 100%;
            max-width: 100%;
        }
        #tablaGeneral thead{
            min-width: 100%;
            max-width: 100%;
        }
        #tablaGeneral tbody{
            min-width: 95%;
            max-width: 95%;
        }
        #generalTable{
            margin: 10px auto;
            min-width: 100%;
            max-width: 100%;
            display: inline-block;
        }
        #cumGeneral{
            min-width: 100%;
            max-width: 100%;
            margin: 10px auto;
            right:0;
            display: inline-block;
        }
        #middle-pie {
            min-width: 50%;
            max-width: 50%;
            margin: 5px auto;
            padding: 0%;
            display: inline-block;
        }

        #content3,
        #content2,
        #content {
            min-width: 100%;
            max-width: 100%;
        }

        .uni-content {
            display: inline-block;
            max-width: 100%;
            min-width: 100%;
        }


        .highcharts-figure {
            height: 50%;
            min-width: 90%;
            max-width: 90%;
            display: inline-block;
            margin: 0 auto;
            border-radius: 10px;
            padding: 0.4%;
        }
    }

    tr {
        font-size: 12px;
        font-family: 'Roboto Light', arial;

    }

    th {
        font-size: 12px;
        font-family: 'Roboto Light', arial;
        font-weight: normal;
    }


    /* cum style */
    .details {
        background-color: #be0032;
        color: #f1f7ff;
    }

    .numero {
        font-size: 50px;
    }
    
</style>
</head>