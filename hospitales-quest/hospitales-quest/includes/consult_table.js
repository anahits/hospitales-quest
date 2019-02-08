$(document).ready(function(data){
	$('#tipo_consulta').val('noSelection').trigger('change');

	if ($('select[name=tipo_consulta]').val() == 'noSelection'){
		var o = '<option id="sinTP" value="noSelected" selected>No ha seleccionado un tipo de consulta</option>';
		$('#especialidadSelect').append(o);
		$('#guardarConsulta').css("display", "none");
		$('#add_medicamentoRow').prop('disabled', true);
		$('#remove_medicamentoRow').prop('disabled', true);

	}else if ($('select[name=tipo_consulta]').val() == 'Urgencias'){
		$('#urgenciasDetail').css("display", "block");
		$('#especialidad').css("display", "none");
		$('#guardarConsulta').css("display", "flex");			
		$('#add_medicamentoRow').prop('disabled', false);
		$('#remove_medicamentoRow').prop('disabled', false);
			$.ajax({
	        	type: "POST",
                url: 'includes/urgencias.php',
                dataType: 'html',
           		success: function(response) {
                	$("#urgenciasDetail").html(response);
                }
            });
	}else if ($('select[name=tipo_consulta]').val() == 'Hospitalización'){		
		$('#urgenciasDetail').css("display", "none");
		$('#especialidad').css("display", "flex");
		$('#add_medicamentoRow').prop('disabled', false);
		$('#remove_medicamentoRow').prop('disabled', false);
		$('#guardarConsulta').css("display", "flex");
      	$.ajax({    //create an ajax request to display.php
	      	type: "POST",
	       	url: "includes/consulta_especialidades.php", 
	       	dataType: "html",   //expect html to be returned                
	       	success: function(response){                    
	           	$("#especialidadSelect").html(response); 
	       	}
	    });
      	$('#guardarConsulta').css("visibility", "visible");
	}else{		
		var consult_selected = $('select[name=tipo_consulta]').val();
	    $.ajax({    //create an ajax request to display.php
	        type: "POST",
	        url: "includes/consulta_esp.php",
	        data: {consult_selected:consult_selected},             
	        dataType: "html",   //expect html to be returned                
	        success: function(response){                    
	        	$("#especialidadSelect").html(response); 
	        }
	    });
	}
});

$("#tipo_consulta").change(function(data) {
	if ($('select[name=tipo_consulta]').val() == 'Urgencias'){
		$('#urgenciasDetail').css("display", "block");
		$('#especialidad').css("display", "none");
		$('#guardarConsulta').css("display", "flex");			
		$('#add_medicamentoRow').prop('disabled', false);
		$('#remove_medicamentoRow').prop('disabled', false);
		$.ajax({
	       	type: "POST",
            url: 'includes/urgencias.php',
            dataType: 'html',
        	success: function(response) {
              	$("#urgenciasDetail").html(response);
            }
        });
	}else if ($('select[name=tipo_consulta]').val() == 'Hospitalización'){		
		$('#urgenciasDetail').css("display", "none");
		$('#especialidad').css("display", "flex");
		$('#add_medicamentoRow').prop('disabled', false);
		$('#remove_medicamentoRow').prop('disabled', false);
		$('#guardarConsulta').css("display", "flex");
      	$.ajax({    //create an ajax request to display.php
	      	type: "POST",
	       	url: "includes/consulta_especialidades.php", 
	       	dataType: "html",   //expect html to be returned                
	       	success: function(response){                    
	           	$("#especialidadSelect").html(response); 
	       	}
	    });
      	$('#guardarConsulta').css("visibility", "visible");
	}else if ($('select[name=tipo_consulta]').val() == 'noSelection'){
		$('#urgenciasDetail').css("display", "none");
		$('#especialidad').css("display", "flex");
		var o = '<option id="sinTP" selected>No ha seleccionado un tipo de consulta</option>';
		$('#especialidadSelect option').remove();
		$('#especialidadSelect').append(o);
		$('#guardarConsulta').css("display", "none");	
		$('#add_medicamentoRow').prop('disabled', true);
		$('#remove_medicamentoRow').prop('disabled', true);
	}else {		
		$('#urgenciasDetail').css("display", "none");
		$('#especialidad').css("display", "flex");
		$('#add_medicamentoRow').prop('disabled', false);
		$('#remove_medicamentoRow').prop('disabled', false);
		$('#guardarConsulta').css("display", "flex");
		var consult_selected = $(this).val();               
      	$.ajax({    //create an ajax request to display.php
	      	type: "POST",
	       	url: "includes/consulta_esp.php", 
	       	data: {consult_selected:consult_selected},            
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
        }
	});		
});

 $("ul#medicamentoContainer").on('change','select.medicamentosSelect', function() {
	select = $(this);
	var selectedMedicamento = $(this).val();
	if (selectedMedicamento == '0') {
		select.removeClass('getMedic');
		select.parents(".medicSelect").find('.medicaTipoContainer').text('Otro ¿Cuál?');
		select.siblings('.medicaTipoContainerInpt').removeClass('getTipoMedic');
		$.ajax({
			type: "POST",
        	url: "includes/otro_medic.php",
        	success: function (response) {
				select.parents(".medicSelect").find('.otro_medicamNtipo').append(response);
        	}
     	});
 		select.parents(".medicSelect").find('.otro_medicamNtipo').addClass('setMedic');
	}else{
		select.parents(".medicSelect").find('.otro_medicamNtipo').empty();
		select.parents(".medicSelect").find('.otro_medicamNtipo').removeClass('setMedic');
		select.parents(".listedMedicam").addClass('setMedic');
		select.siblings('.medicaTipoContainerInpt').addClass('getTipoMedic');
		select.addClass('getMedic');
		medic_selected = select.children(":selected").attr("id");
		$.ajax({
			type: "POST",
        	url: "includes/medicamento_tipo.php",
        	data: {medic_selected:medic_selected},
        	success: function (data) {
				select.siblings('.medicaTipoContainer').text(data);
				select.siblings('.medicaTipoContainerInpt').val(data);
        	}
     	});
	}
});

$("#remove_medicamentoRow").click(function(data) {
	$('.medicSelect').last().remove();
});

$( "#no_medic_selected" ).dialog({
	autoOpen: false
}); 
$( "#consulta_duplicada" ).dialog({
	autoOpen: false
});
$( "#otro_medic_vacio" ).dialog({
	autoOpen: false
});
$( "#otro_tipomedic_vacio" ).dialog({
	autoOpen: false
}); 
var optTipoMedicVacio = {
        autoOpen: false,
        modal: true,
        title: 'Ingresa una tipo de medicamento'
};	 
var optMedicVacio = {
        autoOpen: false,
        modal: true,
        title: 'Ingresa una medicamento'
};	
var optNoMedicaSelected = {
        autoOpen: false,
        modal: true,
        title: 'Selecciona un medicamento'
};

var optConsultaDuplicado = {
        autoOpen: false,
        modal: true,
        title: 'Consulta duplicada'
};

function getConsultasPacnte() {
	var idP = $('#pacienteId').val();
	var action = 'consultas';
	$.ajax({
	    type: "POST",
	    url: "includes/estudios.php",
	    data:{idP:idP,action:action},
	    dataType: "json",	
	    success : function(data){ 
			createConsultRow(data.data);
		}
	});
}
if ($('#pacienteId').val() !== '') {
	getConsultasPacnte();
}


function createConsultRow(data = false,medicamento = false,tipo_medicamento = false) {

   		var tipo_consultasSelector = document.getElementById("tipo_consulta");
		var tipo_consultaSelected = tipo_consultasSelector[tipo_consultasSelector.selectedIndex].value;
		
		if(tipo_consultaSelected == 'Urgencias'){
			var especialidadSelected = 'Sin especialidad';
			var num_hrs_urgen = document.getElementById("horasUrg").value;
			var requHospiSelector = document.getElementById("hospitalizacion");	
			var requHospiSelected = requHospiSelector[requHospiSelector.selectedIndex].value;
			var num_dias_Hospi = document.getElementById("num_dias").value;
		}else if (tipo_consultaSelected !== 'Urgencias') {
			var especialidadesSelector = document.getElementById("especialidadSelect");
			 var especialidadSelected = especialidadesSelector[especialidadesSelector.selectedIndex].value;
			var num_hrs_urgen = "";
			var requHospiSelector = "";	
			var requHospiSelected = "";
			var num_dias_Hospi = "";
		}

		var causa_urgen = document.getElementById("causaConsulta").value;
		var set_fecha=document.getElementById("fecha_consulta").value;

		var ConsultaTable=document.getElementById("consultas_table");
		var rows = ConsultaTable.getElementsByTagName('tr');
			if(rows.length > 1) {
				var lastrow = rows[rows.length - 1];
				var ConsultaTable_len=(parseInt(lastrow.dataset.numconsulta) + 1);
			} else {
				var ConsultaTable_len=1;
			}		
		
		if(data !== false){	

			var datos = data.reduce(function (obj, item) {
			    obj[item.num_consulta] = [];	    	  
			    obj[item.num_consulta].push(item.tipo_consulta);
			    obj[item.num_consulta].push(item.especialidad);	    
			    obj[item.num_consulta].push(item.fecha);
			    obj[item.num_consulta].push(item.causa_urgencia);
			    obj[item.num_consulta].push(item.num_horas_urgencias);
			    obj[item.num_consulta].push(item.hospitaliza_urgencias);
			    obj[item.num_consulta].push(item.dias_hospital_urgen);
			    return obj;
			}, {});
		
			var medicamento = data.reduce(function (obj, item) {
			    obj[item.num_consulta] = obj[item.num_consulta] || [];
			    obj[item.num_consulta].push(item.medicamento);
			    return obj;
			}, {});

			var tipo_medicamento = data.reduce(function (obj, item) {
			    obj[item.num_consulta] = obj[item.num_consulta] || [];
			    obj[item.num_consulta].push(item.tipo_medicamento);
			    return obj;
			}, {});

			var cantidad = data.reduce(function (obj, item) {
			    obj[item.num_consulta] = obj[item.num_consulta] || [];
			    obj[item.num_consulta].push(item.cantidad_medicamento);
			    return obj;
			}, {});

			var medida = data.reduce(function (obj, item) {
			    obj[item.num_consulta] = obj[item.num_consulta] || [];
			    obj[item.num_consulta].push(item.medida_medicamento);
			    return obj;
			}, {});

			var cadahoras = data.reduce(function (obj, item) {
			    obj[item.num_consulta] = obj[item.num_consulta] || [];
			    obj[item.num_consulta].push(item.cada_horas);
			    return obj;
			}, {});

			var durantedias = data.reduce(function (obj, item) {
			    obj[item.num_consulta] = obj[item.num_consulta] || [];
			    obj[item.num_consulta].push(item.durante_dias);
			    return obj;
			}, {});

			$.each( datos, function( key, value ) {	
	
				var consultaIdentifier = btoa(value[0]+value[1]+ConsultaTable_len);

				var ConsultaRow = ConsultaTable.insertRow(rows.length).outerHTML="<tr class='especialidadRow center-aligned' data-numconsulta='"+ConsultaTable_len+"' id='rowConsulta"+ConsultaTable_len+"'>" +
					"<td style='padding: 1px;' class='center-aligned num_consultas' id='numConsultas_row"+ConsultaTable_len+"'>"+key+"<input id='numConsulta_input"+ConsultaTable_len+"' name='numConsultasSet[]' value='"+key+"' hidden></td>" +	

					"<td style='padding: 1px;' class='center-aligned' id='tipo_consult_row"+ConsultaTable_len+"'>"+value[0]+"<input name='consultasIdsSet[]' value='"+consultaIdentifier+"' hidden> "+
					"<input id='tipo_consultaSet' name='tipo_consultaSet[]' value='"+value[0]+"' hidden>	</td>" +
					
					"<td style='padding: 1px;'  id='especialidad_row"+ConsultaTable_len+"'>"+value[1]+"<input  id='hiddenInpt"+ConsultaTable_len+"' name='especialidadesSet[]' value='"+value[1]+"' hidden></td>"+
						
					"<td style='padding: 1px;'  id='fechaConsulta_row"+ConsultaTable_len+"'>"+value[2]+"<input id='fechaConsulta_input"+ ConsultaTable_len+"'name='fechaConsultaSet[]' value='"+value[2]+"' hidden></td>" +
				
						
					"<td style='padding: 1px;'  id='causaUrgen_row"+ConsultaTable_len+"'>"+value[3]+"<input id='causaUrgen_input"+ ConsultaTable_len+"'name='causaUrgenSet[]' value='"+value[3]+"' hidden></td>" +			

					"<td style='padding: 1px;'  id='num_hrsUrgen_row"+ConsultaTable_len+"'>"+value[4]+"<input id='num_hrsUrgen_input"+ ConsultaTable_len+"'name='num_hrsUrgenSet[]' value='"+value[4]+"' hidden></td>" +			

					"<td style='padding: 1px;'  id='requHospi_row"+ConsultaTable_len+"'>"+value[5]+"<input  id='requHospi_input"+ConsultaTable_len+"' name='requHospiSet[]' value='"+value[5]+"' hidden></td>"+

					"<td style='padding: 1px;'  id='diasHospi_row"+ConsultaTable_len+"'>"+value[6]+"<input id='diasHospi_input"+ ConsultaTable_len+"'name='diasHospiSet[]' value='"+value[6]+"' hidden></td>" +			

					"<td style='padding: 1px;' id='medicamento_row"+ConsultaTable_len+"'></td>" +		
					
					"<td style='padding: 1px;' id='cantidadMedicam_row"+ConsultaTable_len+"'></td>" +

					"<td style='padding: 1px;' id='medida_row"+ConsultaTable_len+"'></td>"+	
					
					"<td style='padding: 1px;' id='porHoras_row"+ConsultaTable_len+"'></td>" +
					
					"<td style='padding: 1px;' id='duranteDias_row"+ConsultaTable_len+"'></td>" +
					
					"<td style='padding: 1px;'>"+
							/*"<div class='row'><input type='button' id='edit_button"+ConsultaTable_len+"' value='Editar' class='edit btn btn-info mx-3' onclick='edit_ConsultaRow("+ConsultaTable_len+")' hidden>" +
							"<input type='button' id='save_button"+ConsultaTable_len+"' value='Save' class='save btn btn-success mx-3' onclick='save_ConsultaRow("+ConsultaTable_len+")' style='display: none;'>" +*/
							"<input type='button' id='delete_button"+ConsultaTable_len+"' value='Borrar' class='delete btn btn-danger ml-4' onclick='delete_Consulta("+ConsultaTable_len+")'></div>"+
						"</td>" +"</tr>";
				
					jQuery.each( medicamento[key], function( i, val ) {
					  	$( "#medicamento_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="medicamentos'+consultaIdentifier+'[]" value="'+ val +'" id="medicamento'+i+'" hidden>' );
					});
					 
					jQuery.each( tipo_medicamento[key], function( i, val ) {
					  	$( "#medicamento_row"+ConsultaTable_len+"" ).append( '<input name="tipo_medicamentos'+consultaIdentifier+'[]" value="'+ val +'" id="tipo_medic'+i+'" hidden>' );
					});

					jQuery.each( cantidad[key], function( i, val ) {
					  	$( "#cantidadMedicam_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="cantidades'+consultaIdentifier+'[]" value="'+ val +'" id="cantidad'+i+'" hidden>');
					});
					 
					jQuery.each( medida[key], function( i, val) {
					 	$( "#medida_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="medidas'+ consultaIdentifier+'[]" value="'+ val +'" id="medida'+i+'" hidden>');
					});
					 
					jQuery.each( cadahoras[key], function( i, val ) {
					  	$( "#porHoras_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="porHoras'+consultaIdentifier+'[]" value="'+ val +'" id="horas'+i+'" hidden>');
					});				
				
	    			jQuery.each( durantedias[key], function( i, val ) {
					  	$( "#duranteDias_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="duranteDias'+consultaIdentifier+'[]" value="'+ val +'" id="dias'+i+'" hidden>');
					
					});

				ConsultaTable_len++;
			});
			data = false;
		} else {

			var consultaIdentifier = btoa(tipo_consultaSelected+especialidadSelected+ConsultaTable_len);

			var ConsultaRow = ConsultaTable.insertRow(rows.length).outerHTML="<tr class='especialidadRow center-aligned' data-numconsulta='"+ConsultaTable_len+"' id='rowConsulta"+ConsultaTable_len+"'>" +
				"<td style='padding: 1px;' class='center-aligned num_consultas' id='numConsultas_row"+ConsultaTable_len+"'>"+ConsultaTable_len+"<input id='numConsulta_input"+ConsultaTable_len+"' name='numConsultasSet[]' value='"+ConsultaTable_len+"' hidden></td>" +	

				"<td style='padding: 1px;' class='center-aligned' id='tipo_consult_row"+ConsultaTable_len+"'>"+tipo_consultaSelected+"<input name='consultasIdsSet[]' value='"+consultaIdentifier+"' hidden> "+
				"<input id='tipo_consultaSet' name='tipo_consultaSet[]' value='"+tipo_consultaSelected+"' hidden>	</td>" +
				
				"<td style='padding: 1px;'  id='especialidad_row"+ConsultaTable_len+"'>"+especialidadSelected+"<input  id='hiddenInpt"+ConsultaTable_len+"' name='especialidadesSet[]' value='"+especialidadSelected+"' hidden></td>"+
					
				"<td style='padding: 1px;'  id='fechaConsulta_row"+ConsultaTable_len+"'>"+set_fecha+"<input id='fechaConsulta_input"+ ConsultaTable_len+"'name='fechaConsultaSet[]' value='"+set_fecha+"' hidden></td>" +
			
					
				"<td style='padding: 1px;'  id='causaUrgen_row"+ConsultaTable_len+"'>"+causa_urgen+"<input id='causaUrgen_input"+ ConsultaTable_len+"'name='causaUrgenSet[]' value='"+causa_urgen+"' hidden></td>" +			

				"<td style='padding: 1px;'  id='num_hrsUrgen_row"+ConsultaTable_len+"'>"+num_hrs_urgen+"<input id='num_hrsUrgen_input"+ ConsultaTable_len+"'name='num_hrsUrgenSet[]' value='"+num_hrs_urgen+"' hidden></td>" +			

				"<td style='padding: 1px;'  id='requHospi_row"+ConsultaTable_len+"'>"+requHospiSelected+"<input  id='requHospi_input"+ConsultaTable_len+"' name='requHospiSet[]' value='"+requHospiSelected+"' hidden></td>"+

				"<td style='padding: 1px;'  id='diasHospi_row"+ConsultaTable_len+"'>"+num_dias_Hospi+"<input id='diasHospi_input"+ ConsultaTable_len+"'name='diasHospiSet[]' value='"+num_dias_Hospi+"' hidden></td>" +			


				"<td style='padding: 1px;' id='medicamento_row"+ConsultaTable_len+"'></td>" +		
				
				"<td style='padding: 1px;' id='cantidadMedicam_row"+ConsultaTable_len+"'></td>" +

				"<td style='padding: 1px;' id='medida_row"+ConsultaTable_len+"'></td>"+	
				
				"<td style='padding: 1px;' id='porHoras_row"+ConsultaTable_len+"'></td>" +
				
				"<td style='padding: 1px;' id='duranteDias_row"+ConsultaTable_len+"'></td>" +
				
				"<td style='padding: 1px;'>"+
						/*"<div class='row'><input type='button' id='edit_button"+ConsultaTable_len+"' value='Editar' class='edit btn btn-info mx-3' onclick='edit_ConsultaRow("+ConsultaTable_len+")' hidden>" +
						"<input type='button' id='save_button"+ConsultaTable_len+"' value='Save' class='save btn btn-success mx-3' onclick='save_ConsultaRow("+ConsultaTable_len+")' style='display: none;'>" +*/
						"<input type='button' id='delete_button"+ConsultaTable_len+"' value='Borrar' class='delete btn btn-danger ml-4' onclick='delete_Consulta("+ConsultaTable_len+")'></div>"+
					"</td>" +"</tr>";
				
				var cantidad = $('input[name^=cantidadMedicamento]').map(function(idx, elem) {
				    return $(elem).val();
				}).get();

				var medida = $('select[name^=medidasMedicamento]').map(function(idx, elem) {
				    return $(elem).val();
				}).get();

				var cadahoras = $('input.cantidadHoras').map(function(idx, elem) {
				    return $(elem).val();
				}).get();

				var durantedias = $('input.cantidadDias').map(function(idx, elem) {
				    return $(elem).val();
				}).get();
				
				if(tipo_consultaSelected == 'Urgencias'){
					$("#horasUrg").val('');
					$("#num_dias").val('');
				}
				$(".otro_medicamento").val('');
				$(".otro_tipo_medica").val('');

				$("#causaConsulta").val('');
				$('.medicSelect').remove();	

				jQuery.each( medicamento, function( i, val ) {
				  	$( "#medicamento_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="medicamentos'+consultaIdentifier+'[]" value="'+ val +'" id="medicamento'+i+'" hidden>' );
				});
				 
				jQuery.each( tipo_medicamento, function( i, val ) {
				  	$( "#medicamento_row"+ConsultaTable_len+"" ).append( '<input name="tipo_medicamentos'+consultaIdentifier+'[]" value="'+ val +'" id="tipo_medic'+i+'" hidden>' );
				});

				jQuery.each( cantidad, function( i, val ) {
				  	$( "#cantidadMedicam_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="cantidades'+consultaIdentifier+'[]" value="'+ val +'" id="cantidad'+i+'" hidden>');
				});
				 
				jQuery.each( medida, function( i, val) {
				 	$( "#medida_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="medidas'+ consultaIdentifier+'[]" value="'+ val +'" id="medida'+i+'" hidden>');
				});
				 
				jQuery.each( cadahoras, function( i, val ) {
				  	$( "#porHoras_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="porHoras'+consultaIdentifier+'[]" value="'+ val +'" id="horas'+i+'" hidden>');
				});				
			
    			jQuery.each( durantedias, function( i, val ) {
				  	$( "#duranteDias_row"+ConsultaTable_len+"" ).append( '<p>'+ val +'</p><input name="duranteDias'+consultaIdentifier+'[]" value="'+ val +'" id="dias'+i+'" hidden>');
				
				});	
	}
    			
			    
}

function add_Consulta() {
	//var consultasTotal = $('#consultas_table tr').length;
	var medicamentosSelected = $(".medicamentosSelect");
	for (i = 0; i < medicamentosSelected.length; i++) {
        if ($(medicamentosSelected[i]).val() == '-Selecciona un medicamento-') {
			$( "#no_medic_selected" ).dialog(optNoMedicaSelected).dialog("open");
            return false;
        }        
    } 

	var tipo_medicGet = [];
	var getTipoMedicamento = $('.getTipoMedic');		 
	for (i = 0; i < getTipoMedicamento.length; i++) {
	    var tipoMedicmto = $(getTipoMedicamento[i]).val();		      
		if (tipoMedicmto.trim().length == 0) {
			$( "#otro_tipomedic_vacio" ).dialog(optTipoMedicVacio).dialog("open");
			return false;
		}else{
			tipo_medicGet.push(tipoMedicmto);
		}			
	}	
	var tipo_medicamento = tipo_medicGet.map(function(elem) {
		return elem;				
	});

    var medicamentoGet = [];
	var setMedicamento = $(".setMedic").find('.getMedic');
	for (i = 0; i < setMedicamento.length; i++) {
	    var medicmto = $(setMedicamento[i]).val();
		if (medicmto.trim().length == 0) {
			$( "#otro_medic_vacio" ).dialog(optMedicVacio).dialog("open");
			return false;
		}else{
			medicamentoGet.push(medicmto);
		}
	}   
   	var medicamento = medicamentoGet.map(function(elem) {
	   	return elem;				
	});

	if($(".especialidadRow").length && $("#sinTP").length){
		var especialidadSelector = document.getElementById("especialidadSelect");
		var valor = especialidadSelector[especialidadSelector.selectedIndex].value;
		var Consultaagregado = $('#consultas_table td:contains('+valor+')').length;
		if (Consultaagregado > 0 ){	
			$( "#consulta_duplicada" ).dialog(optConsultaDuplicado).dialog( "open" );
		return false;
		}else { 
			createConsultRow(false,medicamento,tipo_medicamento);			
		}  					
	 }else{
		createConsultRow(false,medicamento,tipo_medicamento);	
	 }
}

function delete_Consulta(no) {
	$(".delete").parents("#rowConsulta"+no+"").remove();
	$('#guardarConsulta').prop('disabled', false);
	$('.medicSelect').remove();
}