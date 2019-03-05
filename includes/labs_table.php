<label for="estudios_laboratorio" class="col-sm-3"><strong>4.1. </strong>ESTUDIOS DE LABORATORIO</label>
<div class="form-group row">	
	<select class="form-control col-sm-2 tipo_consulta_estLab" id="tipoConsulEstLabSelect" name="tipo_consulta_estLab">';
       <?php foreach( $tipo_consultas_estudios as $value => $tipo_consul_est): 
          echo '<option value="'.$value.'">'. $tipo_consul_est.'</option>';
        endforeach;?>
	</select>
	<?php
		$codigoMenu= generarEstuLab($consulEstuLab);
		echo $codigoMenu;
	?>
	<input id="get_cantidad_estudlab" name="numero_estLab" type="number" min="1" class="form-control col-sm-1" style="height: 50%;" placeholder="Núm">
	<div id="num_estlab_vacio" style="color: red;">
		<p>Ingresa una cantidad valida</p>
	</div>
	<button id="agregarEstLab" class="btn btn-success add col-sm-1 ml-3" type="button" style="height: 50%;" onclick="add_estLab();">Agregar</button>
	<div id="estLab_duplicado" style="color: red;">
		<p>Este estudio ya lo has agregado, no lo puedes agregar de nuevo</p>
	</div>	
	<div id="estLab_vacio" style="color: red;">
		<p>No has ingresado un estudio</p>
	</div>
</div>
<table align='center' cellspacing=2 cellpadding=4 id="estLab_table" border=1 class="table table-bordered table-hover list-group">
	<thead><tr>		
		<th class="col-sm-2">Tipo de Consulta</th>
		<th class="col-sm-7">Nombre Estudio</th>
		<th class="col-sm-1">Núm de estudios</th>
		<th class="col-sm-2">Eliminar</th>
	</tr></thead>
</table>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$( "#num_estlab_vacio" ).dialog({
	autoOpen: false
});
$( "#estLab_duplicado" ).dialog({
	autoOpen: false
});
$( "#estLab_vacio" ).dialog({
	autoOpen: false
});
var estLabVacio = {
	autoOpen: false,
	modal: true,
	title: 'No ingresaste un estudio'
};
var cantEstLabVacio = {
	autoOpen: false,
	modal: true,
	title: 'No ingresaste una catidad'
};
var optEstLabDuplicado = {
	autoOpen: false,
	modal: true,
	title: 'Estudio duplicado'
};

function getEstLabsPacnte() {
	var idP = $('#pacienteId').val();
	var action = 'estudios_lab';
	$.ajax({
	    type: "POST",
	    url: "includes/estudios.php",
	    data:{idP:idP,action:action},
	    dataType: "json",	
	    success : function(data){ 
			createEstLabRow(data.data);
		}
	});
}
if ($('#pacienteId').val() !== '') {
	getEstLabsPacnte();
}

function createEstLabRow(data = false){
	var tipoConsulEstLabSelector= document.getElementById('tipoConsulEstLabSelect');
	var tipoConsulEstLabSelected = tipoConsulEstLabSelector[tipoConsulEstLabSelector.selectedIndex].value;
	var estLabSelector= document.getElementById('estudiosLabSelect');
	var Selected = estLabSelector[estLabSelector.selectedIndex].value;
	if (Selected == '0' ){
		var otroEstLab =  document.getElementById('otro_estudio_lab');
		var estLabSelected = otroEstLab.value;
	}else{
		var estLabSelected = estLabSelector[estLabSelector.selectedIndex].value;
	}
	var set_cantidadEstLab=document.getElementById("get_cantidad_estudlab").value;

	var estLabTable=document.getElementById("estLab_table");
	var estLabTable_len=(estLabTable.rows.length);
	if(data !== false){
		$.each( data, function( key, value ) {
			var estLabRow = estLabTable.insertRow(estLabTable_len).outerHTML="<tr id='rowEstLab"+estLabTable_len+"' class='estLabRow'>" +
				"<td style='padding: 1px;' id='tipoConsulEstLabSelect_row"+estLabTable_len+"'>"+value.tipo_consulta+"</td><input name='tipoConsulEstLab[]' value='"+value.tipo_consulta+"' hidden>"+
				"<td style='padding: 1px;' id='estSelect_row"+estLabTable_len+"'>"+value.estudios_laboratorio+"</td><input name='estudiosLab[]' value='"+value.estudios_laboratorio+"' hidden>"+
				"<td style='padding: 1px;'  id='cantidadEstLab_row"+estLabTable_len+"'>"+value.num_estudios_lab+"<input id='cantidadEstLab_input"+estLabTable_len+"' name='cantidadEstLab[]' value='"+value.num_estudios_lab+"' hidden></td>" +
				"<td id='consultaNEstudio"+estLabTable_len+"' class='consultaNEstudio' hidden>"+value.tipo_consulta+value.estudios_laboratorio+"</td>"+
				"<td style='padding: 1px;' >"+
					/*"<div class='row'><input type='button' id='edit_button"+estLabTable_len+"' value='Editar' class='edit btn btn-info mx-3' onclick='edit_estLabRow("+estLabTable_len+")' hidden>" +
					"<input type='button' id='save_button"+estLabTable_len+"' value='Save' class='save btn btn-success mx-3' onclick='save_estLabRow("+estLabTable_len+")' style='display: none;'>" +*/
					"<input type='button' value='Borrar' class='delete btn btn-danger mx-2' onclick='delete_estLab("+estLabTable_len+")'></div>"+
				"</td>" +"</tr>";
			estLabTable_len++;
		});
		data = false;
	}else if($('#get_cantidad_estudlab').val() == '' || $('#get_cantidad_estudlab').val() < 1 ){
		$( "#num_estlab_vacio" ).dialog(cantEstLabVacio).dialog("open");
	}else {
		var estLabRow = estLabTable.insertRow(estLabTable_len).outerHTML="<tr id='rowEstLab"+estLabTable_len+"' class='estLabRow'>" +
			"<td style='padding: 1px;' id='tipoConsulEstLabSelect_row"+estLabTable_len+"'>"+tipoConsulEstLabSelected+"</td><input name='tipoConsulEstLab[]' value='"+tipoConsulEstLabSelected+"' hidden>"+
			"<td style='padding: 1px;' id='estSelect_row"+estLabTable_len+"'>"+estLabSelected+"</td><input name='estudiosLab[]' value='"+estLabSelected+"' hidden>"+
			"<td style='padding: 1px;'  id='cantidadEstLab_row"+estLabTable_len+"'>"+set_cantidadEstLab+"<input id='cantidadEstLab_input"+estLabTable_len+"' name='cantidadEstLab[]' value='"+set_cantidadEstLab+"' hidden></td>" +
			"<td id='consultaNEstudio"+estLabTable_len+"' class='consultaNEstudio' hidden>"+tipoConsulEstLabSelected+estLabSelected+"</td>"+
			"<td style='padding: 1px;' >"+
				/*"<div class='row'><input type='button' id='edit_button"+estLabTable_len+"' value='Editar' class='edit btn btn-info mx-3' onclick='edit_estLabRow("+estLabTable_len+")' hidden>" +
				"<input type='button' id='save_button"+estLabTable_len+"' value='Save' class='save btn btn-success mx-3' onclick='save_estLabRow("+estLabTable_len+")' style='display: none;'>" +*/
				"<input type='button' value='Borrar' class='delete btn btn-danger mx-2' onclick='delete_estLab("+estLabTable_len+")'></div>"+
			"</td>" +"</tr>";
		$('#otro_estudio_lab').val('');
	}
}



function add_estLab() {

	var tipoConsulEstLabSelector= document.getElementById('tipoConsulEstLabSelect');
	var tipoConsulEstLabSelected = tipoConsulEstLabSelector[tipoConsulEstLabSelector.selectedIndex].value;
	var estLabSelector= document.getElementById('estudiosLabSelect');
	var Selected = estLabSelector[estLabSelector.selectedIndex].value;
	if (Selected == '0' ){
		var otroEstLab =  document.getElementById('otro_estudio_lab');
		var estLabSelected = otroEstLab.value;
	}else{
		var estLabSelected = estLabSelector[estLabSelector.selectedIndex].value;
	}
		function compare(a, b) {
		    return typeof a === 'string' && typeof b === 'string'
		        ? a.localeCompare(b, undefined, { sensitivity: 'accent' }) === 0
		        : a === b;
		}
		var cYe = $(".consultaNEstudio");
		for (i = 0; i < cYe.length; i++) {
		    if ($(cYe[i]).text().length) {
   				var iguales = compare($(cYe[i]).text(), tipoConsulEstLabSelected+estLabSelected);
				if (iguales == true){
					$( "#estLab_duplicado" ).dialog(optEstLabDuplicado).dialog( "open" );
					return false;
				}
			} 
		}
	var consultaNEstudio = $('#estLab_table td:contains('+tipoConsulEstLabSelected+estLabSelected+')').length;
	if (estLabSelected !== ""){
		if($(".estLabRow").length){
			if (consultaNEstudio > 0){
				$( "#estLab_duplicado" ).dialog(optEstLabDuplicado).dialog( "open" );
			return false;
			}else {
				createEstLabRow();
			}
		}else{
			createEstLabRow();
		}		
	}else{
		$( "#estLab_vacio" ).dialog(estLabVacio).dialog( "open" );		
	}
}
	/*function edit_estLab(no) {
		document.getElementById("edit_button"+no).style.display="none";
		document.getElementById("save_button"+no).style.display="block";
			
		var selectedEstLab=document.getElementById("estSelect_row"+no);
		var cantidad=document.getElementById("cantidadEstLab_row"+no);
		var selected_estLabData=selectedEstLab.innerHTML;
		var cantidad_data=cantidad.innerHTML;
		selectedEstLab.innerHTML='<p style="color:blue;background-color:oldlace;" id="name_text'+no+'">'+selected_estLabData+'</p>';
		cantidad.innerHTML='<p style="color:blue;background-color:oldlace;" id="cantidad_text'+no+'">'+cantidad_data+'</p>';
	}
	function save_estLab(no) {
		var estLabSelector = document.getElementById('estudiosLab');
		var new_estLab = estLabSelector[estLabSelector.selectedIndex].value;
		var new_estLabCantidad=document.getElementById("get_cantidad_estudlab").value;
		document.getElementById("estSelect_row"+no).innerHTML=new_estLab;
		document.getElementById("cantidadEstLab_row"+no).innerHTML=new_estLabCantidad;
		document.getElementById("cantidadEstLab_input"+no).value=new_estLabCantidad;
		document.getElementById("edit_button"+no).style.display="block";
		document.getElementById("save_button"+no).style.display="none";
	}*/
	function delete_estLab(no,) {
		$("#rowEstLab"+no+"").next('input').remove();
		$("#rowEstLab"+no+"").next('input').remove();
		$("#rowEstLab"+no+"").next('input').remove();
		document.getElementById("rowEstLab"+no+"").outerHTML="";
		$('#agregarEstLab').prop('disabled', false);
	}
	</script>