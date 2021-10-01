$(document).ready(function () {
    bsCustomFileInput.init()
  });

  $(document).ready(function() {
    expnombre = /^[A-Za-z\s]+$/im;
    exphoras= /^[0-9]{2}$/im;
    $("#errorhoras").hide();
    $("#errorfecha").hide();
    $("#errorproyect").hide();
    $("#errorencar").hide();

    $("#horasSoc").focusout(function() {
      horas=$("#horasSoc").val();
      if (horas>20) {
        $("#horasSoc").focus();
        var html ="No deben exceder de 20 horas"
        $('#errorhoras').html(html);
        $("#errorhoras").show();
        
        setTimeout(function() {
          $("#errorhoras").fadeOut(1700);
        },1700);
        
    }
     
    });
    $(".fechaFinal").focusout(function() {
      var FechaInicial = $(".fechaInicial").val();
      var Final = $(".fechaFinal").val();
      if (Date.parse(FechaInicial) > Date.parse(Final)) 
      {
        $(".fechaInicial").focus();
        var html = "La Fecha Inicial no puede ser mayor que la fecha Final"
        $('#errorfecha').html(html);
        $("#errorfecha").show();
        setTimeout(function() {
          $("#errorfecha").fadeOut(1700);
        },1700);
;
      }
    });
      $('#horasSoc')+$('#NombreProyecto')+$("#encargado").on('input change', function () {
        if ($(this).val() != '') {
            $('#submit').prop('disabled', false);
        }
        else {
            $('#submit').prop('disabled', true);
        }
    });
      
  });
