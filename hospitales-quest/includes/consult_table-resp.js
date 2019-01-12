$(document).ready(function(){
	if ($('select[name=tipo_consulta]').val() == 'noSelection'){
		var o = '<option id="no" selected>No ha seleccionado un tipo de consulta</option>';
		$('#especialidadSelect').append(o);
		$('#guardarConsulta').css("visibility", "hidden");
		$('#add_medicamentoRow').prop('disabled', true);
		$('#remove_medicamentoRow').prop('disabled', true);

	}else {		
		$('#add_medicamentoRow').prop('disabled', false);
		$('#remove_medicamentoRow').prop('disabled', false);
		var consult_selected = $('select[name=tipo_consulta]').val();
	    $.ajax({    //create an ajax request to display.php
	        type: "POST",
	        data: {consult_selected:consult_selected},
	        url: "includes/consulta_esp.php",             
	        dataType: "html",   //expect html to be returned                
	        success: function(response){                    
	        	$("#especialidadSelect").html(response); 
	        }
	    });
	}
});

$("#tipo_consulta").change(function(data) {
    if ($('select[name=tipo_consulta]').val() == 'noSelection'){
		var o = '<option id="no" selected>No ha seleccionado un tipo de consulta</option>';
		$('#especialidadSelect option').remove();
		$('#especialidadSelect').append(o);
		$('#guardarConsulta').css("visibility", "hidden");	
		$('#add_medicamentoRow').prop('disabled', true);
		$('#remove_medicamentoRow').prop('disabled', true);
	}else {
		$('#add_medicamentoRow').prop('disabled', false);
		$('#remove_medicamentoRow').prop('disabled', false);
		var consult_selected = $(this).val();               
      		$.ajax({    //create an ajax request to display.php
        	type: "POST",
        	data: {consult_selected:consult_selected},
        	url: "includes/consulta_esp.php",             
        	dataType: "html",   //expect html to be returned                
        	success: function(response){                    
            	$("#especialidadSelect").html(response); 
        	}
    	});
      	$('#guardarConsulta').css("visibility", "visible");
	}
});

$("#add_medicamentoRow").click(function(data) {
	var select;
   	$.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "includes/medicamento.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){ 
        	$("#medicamentoContainer").append('<li class="medicSelect mb-2">'+response+'</li>');               
		    $("select#medicamentosSelect").change(function() {
		    	select = $(this);
		    	medic_selected = select.children(":selected").attr("id");
		    	$.ajax({
			        type: "POST",
			        url: "includes/medicamento_tipo.php",
			        data: {medic_selected:medic_selected},
			        success: function (data) {
						select.siblings('.medicaTipoContainer').text(data);
			        }
	        	});
			});
			
        }
	});		
});


$("#remove_medicamentoRow").click(function(data) {
	$('.medicSelect').last().remove();
});

$( "#num_consulta_vacio" ).dialog({
	autoOpen: false
});	
$( "#canti_medic_vacio" ).dialog({
	autoOpen: false
}); 
$( "#consulta_duplicada" ).dialog({
	autoOpen: false
});	
var optConsultaVacio = {
        autoOpen: false,
        modal: true,
        title: 'Ingresa una cantidad valida'
};
var optMedicVacio = {
        autoOpen: false,
        modal: true,
        title: 'Ingresa una cantidad valida'
};

var optConsultaDuplicado = {
        autoOpen: false,
        modal: true,
        title: 'Consulta duplicada'
};


function createConsultRow() {
	var inputs = $(".cantidadMedicamento");
	for (i = 0; i < inputs.length; i++) {
        if ($(inputs[i]).val().trim().length == 0) {
			$( "#canti_medic_vacio" ).dialog(optMedicVacio).dialog("open");
            return false;
        }        
    }        
	if($('#numConsult').val() == ''){         
	    $( "#num_consulta_vacio" ).dialog(optConsultaVacio).dialog("open");
	}else {
   		var tipo_consultasSelector = document.getElementById("tipo_consulta");
		var tipo_consultaSelected = tipo_consultasSelector[tipo_consultasSelector.selectedIndex].value;
		var especialidadesSelector = document.getElementById("especialidadSelect");
		var especialidadSelected = especialidadesSelector[especialidadesSelector.selectedIndex].value;
		var set_numConsultas=document.getElementById("numConsult").value;
		var set_fecha=document.getElementById("fecha_consulta").value;
		var ConsultaTable=document.getElementById("consultas_table");
		var ConsultaTable_len=(ConsultaTable.rows.length);

		var consultaIdentifier = btoa(tipo_consultaSelected+especialidadSelected+ConsultaTable_len);

		var ConsultaRow = ConsultaTable.insertRow(ConsultaTable_len).outerHTML="<tr class='especialidadRow center-aligned' id='rowConsulta"+ConsultaTable_len+"'>" +
			"<td style='padding: 1px;' class='center-aligned' id='tipo_cofnsult_row"+ConsultaTable_len+"'>"+tipo_consultaSelected+"<input name='consultasIdsSet[]' value='"+consultaIdentifier+"' hidden> "+
			"<input name='tipo_consultaSet[]' value='"+tipo_consultaSelected+"' hidden>	</td>" +
			
			"<td style='padding: 1px;'  id='especialidad_row"+ConsultaTable_len+"'>"+especialidadSelected+"<input  id='hiddenInpt"+ConsultaTable_len+"' name='especialidadesSet[]' value='"+especialidadSelected+"' hidden></td>"+
			
			"<td style='padding: 1px;' class='center-aligned' id='numConsultas_row"+ConsultaTable_len+"'>"+set_numConsultas+"<input id='numConsulta_input"+ConsultaTable_len+"' name='numConsultasSet[]' value='"+set_numConsultas+"' hidden></td>" +	
			
			"<td style='padding: 1px;'  id='fechaConsulta_row"+ConsultaTable_len+"'>"+set_fecha+"<input id='fechaConsulta_input"+ ConsultaTable_len+"'name='fechaConsultaSet[]' value='"+set_fecha+"' hidden></td>" +
			
			"<td style='padding: 1px;' id='medicamento_row"+ConsultaTable_len+"'><input id='medicam_input"+ ConsultaTable_len+"' name='medicamentoSet[]' value='medicams"+ConsultaTable_len+"' hidden></div></td>" +		
			
			"<td style='padding: 1px;' id='cantidadMedicam_row"+ConsultaTable_len+"'></td>" +	

			"<td style='padding: 1px;' id='medida_row"+ConsultaTable_len+"'></td>"+
			
			"<td style='padding: 1px;'>"+
					"<div class='row'><input type='button' id='edit_button"+ConsultaTable_len+"' value='Editar' class='edit btn btn-info mx-3' onclick='edit_ConsultaRow("+ConsultaTable_len+")' hidden>" +
					"<input type='button' id='save_button"+ConsultaTable_len+"' value='Save' class='save btn btn-success mx-3' onclick='save_ConsultaRow("+ConsultaTable_len+")' style='display: none;'>" +
					"<input type='button' value='Borrar' class='delete btn btn-danger ml-4' onclick='delete_Consulta("+ConsultaTable_len+")'></div>"+
				"</td>" +"</tr>";

			   	var medicamento = $('select[name^=medicamentosSelect]').map(function(idx, elem) {
				    return $(elem).val();
				}).get();

				var cantidad = $('input[name^=cantidadMedicamento]').map(function(idx, elem) {
				    return $(elem).val();
				}).get();

				var medida = $('select[name^=medidasMedicamento]').map(function(idx, elem) {
				    return $(elem).val();
				}).get();


				jQuery.each( medicamento, function( i, val ) {
				  	$( "#medicamento_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="medicamentos'+consultaIdentifier+'[]" value="'+ val +'" id="medicamento'+i+'" hidden>' );
				});
				 
				jQuery.each( cantidad, function( i, val ) {
				  	$( "#cantidadMedicam_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="cantidades'+consultaIdentifier+'[]" value="'+ val +'" id="cantidad'+i+'" hidden>');
				});
				 
				jQuery.each( medida, function( i, val) {
				 	$( "#medida_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="medidas'+ consultaIdentifier+'[]" value="'+ val +'" id="medida'+i+'" hidden>');
				});
		$('.medicSelect').remove();
	}
}

function add_Consulta() {
	if($(".especialidadRow").length){
		var tipo_consultasSelector = document.getElementById("especialidadSelect");
		var valor = tipo_consultasSelector[tipo_consultasSelector.selectedIndex].value;
		var Consultaagregado = $('#consultas_table td:contains('+valor+')').length;
		if (Consultaagregado > 0 ){	
			$( "#consulta_duplicada" ).dialog(optConsultaDuplicado).dialog( "open" );
		return false;
		}else { 
			createConsultRow();			
		}  					
	 }else{
		createConsultRow();	
	 }
}


function delete_Consulta(no) {
	$(".delete").parents("#rowConsulta"+no+"").remove();
	$('#guardarConsulta').prop('disabled', false);
	$('.medicSelect').remove();	

}
