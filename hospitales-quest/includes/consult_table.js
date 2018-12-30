if ($('select[name=tipo_consulta]').val() == 'noSelection'){
		var o = '<option id="no">No ha seleccionado un tipo de consulta</option>';
		$('#especialidadSelect option').remove();
		$('#especialidadSelect').append(o);
	}
   $("#tipo_consulta").change(function(data) {
      if ($('select[name=tipo_consulta]').val() == 'noSelection'){
		var o = '<option id="no">No ha seleccionado un tipo de consulta</option>';
		$('#especialidadSelect option').remove();
		$('#especialidadSelect').append(o);
	}else {
		var consult_selected = $(this).val();               
      		$.ajax({    //create an ajax request to display.php
        	type: "POST",
        	data: {consult_selected:consult_selected},
        	url: "includes/consulta.php",             
        	dataType: "html",   //expect html to be returned                
        	success: function(response){                    
            $("#especialidadSelect").html(response); 
            //alert(response);
        	}
    	});
	}
});

$("#add_medicamentoRow").click(function(data) {
	var so = '<div class="medicSelect"></div>';
	$('#medicamentoContainer').append(so);

   	$.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "includes/medicamento.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
        $(".medicSelect").html(response); 
           //alert(response);
        }
    });
});


$("#remove_medicamentoRow").click(function(data) {
	$('.medicSelect').remove();
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


function add_consultRow() {

	if($('#numConsult').val() == '' || $('#numConsult').val() == '0'){         
	    $( "#num_consulta_vacio" ).dialog(optConsultaVacio).dialog("open");
   	//}else if ($('#cantidadMedicamento').val() == '' || $('#cantidadMedicamento').val() == '0'){
		//$( "#canti_medic_vacio" ).dialog(optMedicVacio).dialog("open");
   	}else {
   		var tipo_consultasSelector = document.getElementById("tipo_consulta");
		var tipo_consultaSelected = tipo_consultasSelector[tipo_consultasSelector.selectedIndex].value;
		var especialidadesSelector = document.getElementById("especialidadSelect");
		var especialidadSelected = especialidadesSelector[especialidadesSelector.selectedIndex].value;
		var set_numConsultas=document.getElementById("numConsult").value;
		var set_fecha=document.getElementById("fecha_consulta").value;
		var ConsultaTable=document.getElementById("consultas_table");
		var ConsultaTable_len=(ConsultaTable.rows.length);
		var ConsultaRow = ConsultaTable.insertRow(ConsultaTable_len).outerHTML="<tr id='rowConsulta"+ConsultaTable_len+"'>" +
			"<td style='padding: 1px;' id='tipo_cofnsult_row"+ConsultaTable_len+"' value='"+tipo_consultaSelected+"'>"+tipo_consultaSelected+"<input class='hiddenInpt"+ConsultaTable_len+"' name='tipo_consultaSet[]' value='"+tipo_consultaSelected+"' hidden></td>" +
			
			"<td style='padding: 1px;' id='especialidad_row"+ConsultaTable_len+"' value='"+especialidadSelected+"'>"+especialidadSelected+"<input class='hiddenInpt"+ConsultaTable_len+"' name='especialidadesSet[]' value='"+especialidadSelected+"' hidden></td>"+
			
			"<td style='padding: 1px;'  id='numConsultas_row"+ConsultaTable_len+"' value='"+set_numConsultas+"'>"+set_numConsultas+"<input class='hiddenInpt"+ConsultaTable_len+"' id='numConsulta_input"+ConsultaTable_len+"' name='numConsultasSet[]' value='"+set_numConsultas+"' hidden></td>" +	
			
			"<td style='padding: 1px;'  id='fechaConsulta_row"+ConsultaTable_len+"' value='"+set_fecha+"'>"+set_fecha+"<input id='fechaConsulta_input"+ ConsultaTable_len+"' class='hiddenInpt"+ConsultaTable_len+"' name='fechaConsultaSet[]' value='"+set_fecha+"' hidden></td>" +
			
			"<td style='padding: 1px;' id='medicamento_row"+ConsultaTable_len+"'><div id='totalMedics"+ConsultaTable_len+"'><input id='medicam_input"+ ConsultaTable_len+"' class='hiddenInpt"+ConsultaTable_len+"' name='medicamentoSet[]' value='medicams"+ConsultaTable_len+"' hidden></div></td>" +		
			
			"<td style='padding: 1px;' id='cantidadMedicam_row"+ConsultaTable_len+"'></td>" +	

			"<td style='padding: 1px;' id='medida_row"+ConsultaTable_len+"'></td>"+
			
			"<td style='padding: 1px;'>"+
					"<div class='row'><input type='button' id='edit_button"+ConsultaTable_len+"' value='Editar' class='edit btn btn-info mx-3' onclick='edit_ConsultaRow("+ConsultaTable_len+")' hidden>" +
					"<input type='button' id='save_button"+ConsultaTable_len+"' value='Save' class='save btn btn-success mx-3' onclick='save_ConsultaRow("+ConsultaTable_len+")' style='display: none;'>" +
					"<input type='button' value='Borrar' class='delete btn btn-danger ml-4' onclick='delete_ConsultaRow("+ConsultaTable_len+")'></div>"+
				"</td>" +"</tr>";

		var selectedConsulta=document.getElementById("especialidad_row"+ConsultaTable_len);
		var selected_ConsultaData=selectedConsulta.innerHTML;
		var Consultaagregado = $('#consultas_table td:contains('+selected_ConsultaData+')').length;

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
		  	$( "#totalMedics"+ConsultaTable_len+"" ).append( '<input name="medicamentos[]" value="'+ val +'" id="medicamento'+i+'">' );
		 	});
		 
		 jQuery.each( cantidad, function( i, val ) {
		  	$( "#cantidadMedicam_row"+ConsultaTable_len+"" ).append( '<input name="cantidades[]" value="'+ val +'" id="cantidad'+i+'">');
		 	});
		 
		  jQuery.each( medida, function( i, val) {
		  	$( "#medida_row"+ConsultaTable_len+"" ).append( '<input name="medidas[]" value="'+ val +'" id="medida'+i+'">');
		 	});

		if (Consultaagregado > 1) {
			$('#agregarConsulta').prop('disabled', true); 	
	    	$( "#consulta_duplicada" ).dialog(optConsultaDuplicado).dialog( "open" );		            	
		}
		$('.medicSelect').remove();
	}
		  event.preventDefault(); 

}

function delete_ConsultaRow(no) {
	$("#rowConsulta"+no+"").children('td').remove();
	$("#rowConsulta"+no+"").siblings(".hiddenInpt"+no+"").remove();
	$('#agregarConsulta').prop('disabled', false);
	$('.medicSelect').remove();	

}
