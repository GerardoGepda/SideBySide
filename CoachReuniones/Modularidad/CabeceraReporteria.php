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
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<!-- select multiple  -->

<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<!--
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
-->
<!--Estilo nuevo de reporteriaUniversidad-->
<style>
    .form-label {
        color: #be0032;
        font-weight: bold;
    }

    .form-control {
        background-color: #d9d2d2;
        border-radius: 20px;
        border-color: white;
    }

    #generals {
        border: #a29c9c 3px solid;
        border-radius: 20px;
    }
    #content3{
        padding: 1%;
        margin: 0.4%;
        display: block;
        max-width: 100%;
        min-width: 100%;
    }
    /*Estilo del CUM*/
    #cum1{
        position: relative;
        bottom: 130px;
        left: 46%;
        margin: 0 5%;
        max-height: 130px;
        min-height: 130px;
        min-width: 48.5%;
        max-width: 48.5%;
        background: #343A40;
        border-left: solid 15px #B01D33;
    }
    #cum1 #cum2{
        position: relative;
        left: 280px;
        bottom: 35px;
        padding: 5px;
        max-height: 80px;
        min-height: 80px;
        max-width: 40%;
        min-width: 40%;
    }
    #cum2 h5{
        font-size: 65px;
        color: white;
        text-align: center;
    }
    #cum1 span{
        position: relative;
        bottom: 7px;
        background:#B01D33;
        color: white;
        padding: 7px 17px;
        border-radius: 30px;
        font-size: 35px;
    }
    #cum1 h4{
        position: relative;
        top: 30px;
        left: 8px;
        color: white;
        text-align: left;
        font-size: 30px;
        max-width: 40%;
        min-width: 40%;
    }
    /* FIn del estilo del CUM*/
    /* Estilo de Grafica general*/
    #content-middle-pie{
        max-height: 130px;
        min-height: 130px;
        margin: 0 0;
        min-width: 48.5%;
        max-width: 48.5%;
        background: #343A40;
        border-left: solid 15px #B01D33;
    }
    #middle-pie{
        position: relative;
        left: 268px;
        bottom: 95px;
        max-height: 185px;
        min-height: 185px;
        max-width: 50%;
        min-width: 50%;
    }
    #content-middle-pie span{
        position: relative;
        bottom: 7px;
        background:#54E38A;
        color: white;
        padding: 7px 17px;
        border-radius: 30px;
        font-size: 35px;
    }
    #content-middle-pie h4{
        position: relative;
        top: 30px;
        left: 8px;
        color: white;
        text-align: left;
        font-size: 30px;
        max-width: 47%;
        min-width: 47%;
    }
    /* FIn del estilo de la grafica general*/
    /*Estilo de las del contendor de los mapas y graficas de genero*/
    #maps{
        position: relative;
        left: 52%;
        bottom: 170px;
        margin: 3% 0 0 0;
        border: solid 1px black;
        border-radius: 30px;
        max-width: 47%;
        min-width: 47%;
        max-height: 248px;
        min-height: 248px;
    }
    /*Fin estilo contendor mapas y graficas de genero*/
    /*Estilo del contededor de los mapas sedes*/
    #content{
        display: block;
    }
    #map1{
        display: inline-block;
        max-height: 234px;
        min-height: 234px;
        max-width: 40%;
        min-width: 40%;
        margin-right: 5%;
    }
    #map2{
        display: inline-block;
        max-height: 234px;
        min-height: 234px;
        max-width: 35%;
        min-width: 35%;
        margin-right: 3%;
    }
    /*Fin estilo contededor de los mapas sedes*/
    /*Estilo del contededor de graficas de genero*/
    #content2{
        display: block;
    }
    #content2 h3{
        color:#be0032;
        margin-bottom: 1%;
        font-size: 20px;
    }
    .highcharts-figure{
        padding: 2px;
        margin: -1.7% 2%;
        display: inline-block;
        max-width: 40%;
        min-width: 40%;
        border-radius: 30px;
    }
    #gen{
        position: relative;
        max-width: 100%;
        min-width: 100%;
        max-height: 250px;
        min-height: 250px;
    }
    #gen2{
        position: relative;
        max-width: 100%;
        min-width: 100%;
        max-height: 250px;
        min-height: 250px;
    }
    
    /*Fin estilo contededor de graficas de genero*/
    /*Estilo grafica de universidades*/
    #content-grafic{
        position: absolute;
        padding: 20px;
        top: 360px;
        left: 2%;
        max-width: 47%;
        min-width: 47%;
        max-height: 530px ;
        min-height: 530px;
        border: solid 1px black;
        border-radius: 30px;
    }
    #content-grafic h3{
        text-align: center;
        color: #be0032;
    }
    /*Diseño de grafica de universidades*/
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
    .title{
        position: absolute;
        margin-top: -150px;
        width:100%; 
    }
    /*inicio del primer responsive*/
    @media only screen and (max-width: 1024px){
        #filtro1,
        #filtro2,
        #filtro3,
        #filtro4 {
            display: inline-block;
            margin: 0;
            padding: 0 2%;
        }
        #content3{
        padding: 1%;
        margin: 0;
        display: block;
        max-width: 100%;
        min-width: 100%;
    }
    #cum1{
        position: initial;
        display: block;
        margin: 0 auto;
        min-width: 100%;
        max-width: 100%;
    }
   
   
    #content-middle-pie{
        display: block;
        margin: 2% auto;
        min-width: 100%;
        max-width: 100%;
    }
    #maps{
        position: initial;
        margin: 2% auto;
        max-width: 100%;
        min-width: 100%;
    }
    #gen{
        max-width: 88%;
        min-width: 88%;
    }
    #gen2{
        max-width: 88%;
        min-width: 88%;
    }
    #content-grafic{
        position: initial;
        max-width: 100%;
        min-width: 100%;
    }
    .title{
        position: initial;
        margin-top: 1%;
    }
    .uni-content{
        display: block;
        margin: 0 auto;
        max-width: 100%;
        min-width: 100%;
    }
    }
    /*Fin del primer responsive*/
    /* Segundo responsive*/
    @media only screen and (max-width: 600px){
        #filtro1,
        #filtro2,
        #filtro3,
        #filtro4 {
            display: inline-block;
            margin: 0%;
            padding: 0%;
        }
        #content3{
        padding: 1%;
        margin: 0;
        display: block;
        max-width: 102%;
        min-width: 102%;
    }
    #cum1{
        position: initial;
        display: block;
        margin: 0 auto;
        min-width: 100%;
        max-width: 100%;
    }
    #cum1 #cum2{
        left: 250px;
        bottom: 15px;
        padding: 5px;
        max-height: 70px;
        min-height: 70px;
    }
    #cum2 h5{
        font-size: 45px;
    }
    #cum1 span{
        padding: 7px 13px;
        font-size: 25px;
    }
    #cum1 h4{
        font-size: 20px;
        max-width: 40%;
        min-width: 40%;
    }
   
    #content-middle-pie{
        display: block;
        margin: 2% auto;
        min-width: 100%;
        max-width: 100%;
    }
    #middle-pie{
        left: 200px;
        bottom: 90px;
        max-height: 185px;
        min-height: 185px;
        max-width: 50%;
        min-width: 50%;
    }
    #content-middle-pie span{
        padding: 7px 13px;
        font-size: 25px;
    }
    #content-middle-pie h4{
        font-size: 20px;
        max-width: 47%;
        min-width: 47%;
    }
    #maps{
        position: initial;
        margin: 1% auto;
        max-width: 102%;
        min-width: 102%;
    }
    .highcharts-figure{
        padding: 0;
        max-width: 45%;
        min-width: 45%;
        max-height: 300px;
        min-height: 300px;
    }
    #content-grafic{
        max-width: 100%;
        min-width: 100%;
    }
    }
</style>
</head>