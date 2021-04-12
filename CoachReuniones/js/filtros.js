// select2
$("#ciclo").select2({
    width: 'resolve',
    tags: "true",
    placeholder: "Seleccione ciclo",
    allowClear: true,
});
$("#checkbox1").click(function(){
    if($("#checkbox1").is(':checked') ){
        $("#ciclo > option").prop("selected","selected");
        $("#ciclo").trigger("change");
    }else{
        $("#ciclo > option").removeAttr("selected");
         $("#ciclo").trigger("change");
     }
});
// 
$("#clase").select2({
    width: 'resolve',
    tags: "true",
    placeholder: "Seleccione clase",
    allowClear: true,
});
$("#checkbox2").click(function(){
    if($("#checkbox2").is(':checked') ){
        $("#clase > option").prop("selected","selected");
        $("#clase").trigger("change");
    }else{
        $("#clase > option").removeAttr("selected");
         $("#clase").trigger("change");
     }
});
// 
$("#financiamiento").select2({
    width: 'resolve',
    tags: "true",
    placeholder: "Seleccione financiamiento",
    allowClear: true,
});
$("#checkbox3").click(function(){
    if($("#checkbox3").is(':checked') ){
        $("#financiamiento > option").prop("selected","selected");
        $("#financiamiento").trigger("change");
    }else{
        $("#financiamiento > option").removeAttr("selected");
         $("#financiamiento").trigger("change");
     }
});
// 
$("#sede").select2({
    width: 'resolve',
    tags: "true",
    placeholder: "Seleccione sede",
    allowClear: true,
});
$("#checkbox4").click(function(){
    if($("#checkbox4").is(':checked') ){
        $("#sede > option").prop("selected","selected");
        $("#sede").trigger("change");
    }else{
        $("#sede > option").removeAttr("selected");
         $("#sede").trigger("change");
     }
});