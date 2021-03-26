<style>
    /* inicio de diseño para mapas */

    #map1 {
        margin-top:1%;
        margin-left: 0%;
        height: 245px;
        min-width: 300px;
        max-width: 430px;
        display: inline-block;
    }

    #map2 {
        margin-top:1%;
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
    #content3{
        max-height:300px;
        min-height:380px;
    }
    /* estilo para graficas generales */
    .highcharts-figure {
        height: 345px;
        min-width: 400px;
        max-width: 400px;
        display: inline-block;
        margin: 0 auto;
        border-radius: 10px;
        padding: 0.4%;
    }
    #content2 h3{
        color:#be0032;
        font-style: bold;
    }

    #gen {
        margin-left: -80%;
        margin-top:1%;
        height: 275px;
        min-width: 300px;
        max-width: 430px;
        display: inline-block;
    }

    #gen2 {
        margin-left: 45%;
        margin-top:1%;
        height: 275px;
        min-width: 300px;
        max-width: 430px;
        display: inline-block;
    }

    /* graficas generales */

    #middle-pie {
        height: 200px;
        min-width: 300px;
        max-width: 300px;
        display: inline-block;
        border-radius: 10px;
        margin-top: 0.5%;
        margin-left: 8%;
        margin-right: 8%;
        margin-bottom:-40px;
    }

    #tablaGeneral{
        min-width: 450px;
        max-width: 450px;
        margin: 0% 0%;
    }
    #TableBody th{
        border: solid 1px #111;
        border-style: groove;
    }
    #TableBody th:hover{
        background-color:#be0032;
        color: white;
    }
    #generalTable{
        min-width: 450px;
        max-width: 450px;
        margin-left: 10%;
        margin-top: 0.5%;
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
    .uni-content{
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
    @media only screen and (max-width: 1080px){
        #content3 {
            display: inline-block;
            margin:0 auto;
            min-width: 100%;
            max-width: 100%;
        }
        #map1,
        #map2{
            min-width: 100%;
            max-width: 100%;
            margin:0.5% auto;
        }
        #middle-pie,
        #generalTable{
            margin:0 auto;
        }
        #gen,
        #gen2{
            min-width: 100%;
            max-width: 100%;
            min-height: 100%;
            max-height: 100%;
            margin: 0% auto;
        }
        #maps {
            min-width: 100%;
            max-width: 100%;
            display: inline-block;
        }
    }
    /*Fin del primer responsive*/
    /*Responsive tabla y filtros de selection*/
    @media only screen and (max-width: 600px) {
        #map1,
        #map2{
            min-width: 100%;
            max-width: 100%;
            margin:0.5% auto;
        }
        
        #gen,
        #gen2{
            min-width: 100%;
            max-width: 100%;
            margin: 0% auto;
        }
        #maps {
            min-width: 100%;
            max-width: 100%;
            display: inline-block;
        }

        #universidades {
            min-width: auto;
            max-width: auto;
            margin: 0 auto;
        }

        #content {
            display: inline-block;
        }

        #content2 {
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

        #generalTable {
            margin: auto;
            min-width: 100%;
            max-width: 100%;
            display: inline-block;
        }

        #middle-pie {
            min-width: 50%;
            max-width: 50%;
            margin: auto;
            padding: 0%;
            display: block;
        }

        #content3,
        #content2,
        #content{
            min-width: 100%;
            max-width: 100%;
        }
        .uni-content{
            display: inline-block;
            max-width: 100%;
            min-width: 100%;
        }
    }
</style>
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