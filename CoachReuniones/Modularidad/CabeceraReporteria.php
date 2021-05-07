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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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

    #content3 {
        padding: 1%;
        margin-bottom: -130px;
        margin-right: 0.4%;
        margin-left: 0.4%;
        margin-top: 0.4%;
        display: block;
        max-width: 100%;
        min-width: 100%;
    }

    /*Estilo del CUM*/
    #cum1 {
        position: relative;
        bottom: 130px;
        left: 46%;
        margin: 0 5%;
        max-height: 130px;
        min-height: 130px;
        min-width: 48%;
        max-width: 48%;
        background: #343A40;
        border-left: solid 15px #B01D33;
        border-radius: 3px;
    }

    #cum1 #cum2 {
        position: relative;
        left: 280px;
        bottom: 35px;
        padding: 5px;
        max-height: 80px;
        min-height: 80px;
        max-width: 40%;
        min-width: 40%;
    }

    #cum2 h5 {
        font-size: 65px;
        color: white;
        text-align: center;
    }

    #cum1 span {
        position: relative;
        bottom: 7px;
        background: #B01D33;
        color: white;
        padding: 7px 17px;
        border-radius: 30px;
        font-size: 35px;
    }

    #cum1 h4 {
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
    #content-middle-pie {
        max-height: 130px;
        min-height: 130px;
        margin: 0 0;
        min-width: 48%;
        max-width: 48%;
        background: #343A40;
        border-left: solid 15px #B01D33;
        border-radius: 3px;
    }

    .highcharts-container {
        margin: 0%;
        padding: 0%;
        background-color: #343A40;
    }

    #middle-pie {
        position: relative;
        left: 264px;
        bottom: 50px;
        max-height: 150px;
        min-height: 130px;
        max-width: 55%;
        min-width: 55%;
        padding: 0%;
        margin: 0%;
        background-color: #343A40;
        color:#d9d2d2
    }

    #content-middle-pie span {
        position: relative;
        bottom: 7px;
        background: #54E38A;
        color: white;
        padding: 7px 17px;
        border-radius: 30px;
        font-size: 35px;
    }

    #content-middle-pie h4 {
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
    /*contenedor de mapas y grafica de universidades*/
    .content-content{
        margin: 0% 0;
    }
    /*Estilo de las del contendor de los mapas y graficas de genero*/
    #maps {
        clear: both;
        float: right;
        border: solid 1px #343A40;
        border-left: solid 15px #B01D33;
        border-radius: 3px;
        max-width: 47%;
        min-width: 47%;
        margin: 0.5% 1.7%;
        max-height: 265px;
        min-height: 265px;
    }

    /*Fin estilo contendor mapas y graficas de genero*/
    /*Estilo del contededor de los mapas sedes*/
    #content {
        display: block;
    }

    #map1 {
        display: inline-block;
        max-height: 234px;
        min-height: 234px;
        max-width: 40%;
        min-width: 40%;
        margin-right: 5%;
    }

    #map2 {
        display: inline-block;
        max-height: 234px;
        min-height: 234px;
        max-width: 35%;
        min-width: 35%;
        margin-right: 3%;
    }

    /*Fin estilo contededor de los mapas sedes*/
    /*Estilo del contededor de graficas de genero*/
    #content2 {
        display: block;
    }

    #content2 h3 {
        color: #be0032;
        margin-bottom: 1%;
        font-size: 20px;
    }
    /*
    #content2 span {
        background: #FF665A;
        color: white;
        padding: 1px 7px;
        border-radius: 30px;
        font-size: 20px;
    }
    */
    .highcharts-figure {
        padding: 2px;
        margin: -1.7% 2%;
        display: inline-block;
        max-width: 40%;
        min-width: 40%;
        border-radius: 30px;
    }

    #gen {
        max-width: 100%;
        min-width: 100%;
        max-height: 250px;
        min-height: 250px;
    }

    #gen2 {
        max-width: 100%;
        min-width: 100%;
        max-height: 250px;
        min-height: 250px;
    }

    /*Fin estilo contededor de graficas de genero*/
    /*Estilo grafica de universidades*/
    #content-grafic {
        clear: both;
        float: left;
        margin-top: -41.5%;
        margin-left: 1.5%;
        max-width: 47.5%;
        min-width: 47.5%;
        max-height: 538px;
        min-height: 538px;
        border-radius: 3px;
        border: solid 1px #343A40;
        border-left: solid 15px #B01D33;
    }

    #content-grafic h3 {
        text-align: center;
        color: #be0032;
    }
    #content-grafic span {
        position: relative;
        background: #FF665A;
        color: white;
        padding: 1px 8px;
        border-radius: 30px;
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
    .title {
        clear: both;
        position: relative;
        width: 100%;
    }

    /*inicio del primer responsive*/
    @media only screen and (max-width: 1024px) {

        #filtro1,
        #filtro2,
        #filtro3,
        #filtro4 {
            display: inline-block;
            margin: 0;
            padding: 0 2%;
        }

        #content3 {
            padding: 1%;
            margin: 0;
            display: block;
            max-width: 100%;
            min-width: 100%;
        }

        #cum1 {
            position: initial;
            display: block;
            margin: 0 auto;
            min-width: 100%;
            max-width: 100%;
        }


        #content-middle-pie {
            display: block;
            margin: 2% auto;
            min-width: 100%;
            max-width: 100%;
        }

        #maps {
            position: initial;
            margin: 2% auto;
            max-width: 100%;
            min-width: 100%;
            max-height: 350px;
            min-height: 350px;
        }

    .highcharts-figure {
        max-width: 45%;
        min-width: 45%;
    }

    #gen {
        
        max-width: 87%;
        min-width: 87%;
        max-height: 280px;
        min-height: 280px;
    }

    #gen2 {
        max-width: 87%;
        min-width: 87%;
        max-height: 280px;
        min-height: 280px;
    }
    #map2,
    #map1 {
        max-height: 274px;
        min-height: 274px;
    }

        #content-grafic {
            position: initial;
            margin-top: 2%;
            margin-left: -0.5%;
            margin-bottom: 2%;
            max-width: 101%;
            min-width: 101%;
        }

        .title {
            position: initial;
            margin-top: 1%;
        }

        .uni-content {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            min-width: 100%;
        }
    }

    /*Fin del primer responsive*/
    /* Segundo responsive*/
    @media only screen and (max-width: 600px) {

        #filtro1,
        #filtro2,
        #filtro3,
        #filtro4 {
            display: inline-block;
            margin: 0%;
            padding: 0%;
        }

        #content3 {
            padding: 1%;
            margin: 0;
            display: block;
            max-width: 102%;
            min-width: 102%;
        }

        #cum1 {
            position: initial;
            display: block;
            margin: 0 auto;
            min-width: 100%;
            max-width: 100%;
        }

        #cum1 #cum2 {
            left: 130px;
            bottom: 15px;
            padding: 5px;
            max-height: 60px;
            min-height: 60px;
        }

        #cum2 h5 {
            font-size: 45px;
        }

        #cum1 span {
            padding: 7px 13px;
            font-size: 25px;
        }

        #cum1 h4 {
            font-size: 20px;
            max-width: 40%;
            min-width: 40%;
        }

        #content-middle-pie {
            display: block;
            margin: 2% auto;
            min-width: 100%;
            max-width: 100%;
        }

        #middle-pie {
            left: 150px;
            bottom: 60px;
            max-height: 120px;
            min-height: 120px;
            max-width: 52%;
            min-width: 52%;
            padding: 0%;
            margin: 0%;
        }

        #content-middle-pie span {
            padding: 7px 13px;
            font-size: 25px;
        }

        #content-middle-pie h4 {
            font-size: 20px;
            max-width: 47%;
            min-width: 47%;
        }

        #maps {
            position: initial;
            margin: 1% auto;
            max-width: 102%;
            min-width: 102%;
        }

        .highcharts-figure {
            position: relative;
            left: 20%;
        margin: 0;
        max-width: 200%;
        min-width: 200%;
        
    }

    #gen {
        max-width: 28%;
        min-width: 28%;
        max-height: 135px;
        min-height: 135px;
    }

    #gen2 {
        max-width: 28%;
        min-width: 28%;
        max-height: 135px;
        min-height: 135px;
    }
        #content-grafic {
            margin-top: 2%;
            margin-left: -1.4%;
            margin-bottom: 2%;
            max-width: 102%;
            min-width: 102%;
        }
    }
    /*Fin del segundo responsive*/
    @media only screen and (max-width: 300px){
        #middle-pie {
            right: 150px;
            bottom: 65px;
            max-width: 30%;
            min-width: 30%;
            max-height: 130px;
            min-height: 130px;
            padding: 0%;
            margin: 0%;
        }

    }
    /*Fin del nuevo diseño */
</style>
</head>