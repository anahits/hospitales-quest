$( "#genero_null" ).dialog({
    autoOpen: false
}); 
var optGeneroVacio = {
    autoOpen: false,
    modal: true,
    title: 'Selecciona un genero'
};

$( "#residencia_null" ).dialog({
    autoOpen: false
});                         
var optResidenciaVacia = {
    autoOpen: false,
    modal: true,
    title: 'Selecciona un lugar de residencia'
};

$( "#iniciales_null" ).dialog({
    autoOpen: false
});                     
var optInicialesVacio = {
    autoOpen: false,
    modal: true,
    title: 'Iniciales incompletas'
}; 
$('#form').submit(function (e){
    if ($("input[name='iniciales_paciente']").val().length < 3) {
        $( "#iniciales_null" ).dialog(optInicialesVacio).dialog("open");
        return false;
    }else if ($('#generos').val() == '0'){
        $( "#genero_null" ).dialog(optGeneroVacio).dialog("open");
        return false;
    }else if (!$("input[name='residencia']:checked").val()) {
        $( "#residencia_null" ).dialog(optResidenciaVacia).dialog("open");
        return false;
    }else{
        return true;
    }     
    e.preventDefault();                       
});                 

function setInicioPeriodLimit() {
    var startDate = document.getElementById("inicio_consultas").value;
    $('#fin_consultas').attr("min",startDate);
}
function setFinPeriodLimit() {
    var endDate = document.getElementById("fin_consultas").value;
    $('#inicio_consultas').attr("max",endDate);
}