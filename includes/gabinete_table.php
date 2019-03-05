<label for="estudios_gabinete" class="col-sm-3"><strong>4.3. </strong>ESTUDIOS DE GABINETE</label>
<div class="form-group row">
	<select class="form-control col-sm-2 tipo_consulta_estGab" id="tipoConsulEstGabSelect" name="tipo_consulta_estGab">';
       <?php foreach( $tipo_consultas_estudios as $value => $tipo_consul_est): 
          echo '<option value="'.$value.'">'. $tipo_consul_est.'</option>';
        endforeach;?>
	</select>
	<?php
        $codigoMenu= generarEstuGab($consulEstuGab);
        echo $codigoMenu;                        
   	?>  
	<input id="get_cantidad_estudGab" type="number" min="1" class="form-control col-sm-1" name="numero_estGab" style="height: 50%;" placeholder="Núm">
	<div id="num_estGab_vacio" style="color: red;">
	  <p>Ingresa una cantidad valida</p>
	</div>
	<button id="agregarEstGab" class="btn btn-success add col-sm-1 ml-3" type="button" style="height: 50%;" onclick="add_estGab();">Agregar</button>
	<div id="estGab_duplicado" style="color: red;">
	  <p>Este estudio ya lo has agregado, no lo puedes agregar de nuevo</p>
	</div>	
	<div id="estGab_vacio" style="color: red;">
		<p>No has ingresado un estudio</p>
	</div>
</div>
<table align='center' cellspacing=2 cellpadding=4 id="estGab_table" border=1 class="table table-bordered table-hover list-group">
	<tr>	
		<th class="col-sm-2">Tipo de Consulta</th>
		<th class="col-sm-7">Nombre Estudio</th>
		<th class="col-sm-1">Núm de estudios</th>
		<th class="col-sm-2">Eliminar</th>
	</tr>
</table>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$( "#num_estGab_vacio" ).dialog({
	autoOpen: false
});	 
$( "#estGab_duplicado" ).dialog({
	autoOpen: false
});
$( "#estGab_vacio" ).dialog({
	autoOpen: false
});
var estGabVacio = {
	autoOpen: false,
	modal: true,
	title: 'No ingresaste un estudio'
};	
var optEstGabVacio = {
        autoOpen: false,
        modal: true,
        title: 'No ingresaste una catidad'
};
var optEstGabDuplicado = {
        autoOpen: false,
        modal: true,
        title: 'Estudio duplicado'
};

function getEstGabsPacnte() {
	var idP = $('#pacienteId').val();
	var action = 'estudios_gab';
	$.ajax({
	    type: "POST",
	    url: "includes/estudios.php",
	    data:{idP:idP,action:action},
	    dataType: "json",	
	    success : function(data){ 
			createEstGabRow(data.data);
		}
	});
}
if ($('#pacienteId').val() !== '') {
	getEstGabsPacnte();
}

function createEstGabRow(data = false){ 	 
		var tipoConsulEstGabSelector= document.getElementById('tipoConsulEstGabSelect');
		var tipoConsulEstGabSelected = tipoConsulEstGabSelector[tipoConsulEstGabSelector.selectedIndex].value;
		var estGabSelector = document.getElementById('estudiosGabSelect');
		var Selected = estGabSelector[estGabSelector.selectedIndex].value;
		if (Selected == '0' ){
			var otroEstGab =  document.getElementById('otro_estudio_gab');
			var estGabSelected = otroEstGab.value;
		}else{
			var estGabSelected = estGabSelector[estGabSelector.selectedIndex].value;
		}
		var set_cantidadEstGab=document.getElementById("get_cantidad_estudGab").value;
		
		var estGabTable=document.getElementById("estGab_table");
		var estGabTable_len=(estGabTable.rows.length);
	if(data !== false){
		$.each( data, function( key, value ) {
			var estGabRow = estGabTable.insertRow(estGabTable_len).outerHTML="<tr id='rowEstGab"+estGabTable_len+"' class='estGabRow'>" +
				"<td style='padding: 1px;'>"+value.tipo_consulta+"</td><input name='tipoConsulEstGab[]' value='"+value.tipo_consulta+"' hidden>"+
				"<td style='padding: 1px;'>"+value.estudios_gabinete+"</td><input name='estudiosGab[]' value='"+value.estudios_gabinete+"' hidden>"+
				"<td style='padding: 1px;'>"+value.num_estudios_gab+"<input id='cantidadEstGab_input"+estGabTable_len+"' name='cantidadEstGab[]' value='"+value.num_estudios_gab+"' hidden></td>" +
				"<td class='consultaNEstudioGab' hidden>"+value.tipo_consulta+value.estudios_gabinete+"</td>"+
				"<td style='padding: 1px;' >"+
					"<input type='button' value='Borrar' class='delete btn btn-danger mx-2' onclick='delete_estGab("+estGabTable_len+")'></div>"+
				"</td>" +"</tr>";
			estGabTable_len++;
		});
		data = false;
	}else if($('#get_cantidad_estudGab').val() == '' || $('#get_cantidad_estudGab').val() < 1){         
	    $( "#num_estGab_vacio" ).dialog(optEstGabVacio).dialog("open");
   	}else {
		var estGabRow = estGabTable.insertRow(estGabTable_len).outerHTML="<tr id='rowEstGab"+estGabTable_len+"' class='estGabRow'>" +
			"<td style='padding: 1px;'>"+tipoConsulEstGabSelected+"</td><input name='tipoConsulEstGab[]' value='"+tipoConsulEstGabSelected+"' hidden>"+
			"<td style='padding: 1px;'>"+estGabSelected+"</td><input name='estudiosGab[]' value='"+estGabSelected+"' hidden>"+
			"<td style='padding: 1px;'>"+set_cantidadEstGab+"<input name='cantidadEstGab[]' value='"+set_cantidadEstGab+"' hidden></td>" +
			"<td class='consultaNEstudioGab' hidden>"+tipoConsulEstGabSelected+estGabSelected+"</td>"+
			"<td style='padding: 1px;' >"+
				"<input type='button' value='Borrar' class='delete btn btn-danger mx-2' onclick='delete_estGab("+estGabTable_len+")'></div>"+
			"</td>" +"</tr>";
	}
	$('#otro_estudio_gab').val('');	
 } 

function add_estGab() { 
	var tipoConsulEstGabSelector= document.getElementById('tipoConsulEstGabSelect');
	var tipoConsulEstGabSelected = tipoConsulEstGabSelector[tipoConsulEstGabSelector.selectedIndex].value;
	var estGabSelector = document.getElementById('estudiosGabSelect');
	var Selected = estGabSelector[estGabSelector.selectedIndex].value;
	if (Selected == '0' ){
		var otroEstGab =  document.getElementById('otro_estudio_gab');
		var estGabSelected = otroEstGab.value;
	}else{
		var estGabSelected = estGabSelector[estGabSelector.selectedIndex].value;
	}
	function compare(a, b) {
		    return typeof a === 'string' && typeof b === 'string'
		        ? a.localeCompare(b, undefined, { sensitivity: 'accent' }) === 0
		        : a === b;
		}
		var cYe = $(".consultaNEstudioGab");
		for (i = 0; i < cYe.length; i++) {
		    if ($(cYe[i]).text().length) {
   				var iguales = compare($(cYe[i]).text(), tipoConsulEstGabSelected+estGabSelected);
				if (iguales == true){
					$( "#estGab_duplicado" ).dialog(optEstGabDuplicado).dialog( "open" );
					return false;
				}
			} 
		}
	var consultaNEstudioGab = $('#estGab_table td:contains('+tipoConsulEstGabSelected+estGabSelected+')').length;
	if (estGabSelected !== ""){
		if($(".estGabRow").length){
			if (consultaNEstudioGab > 0){
				$( "#estGab_duplicado" ).dialog(optEstGabDuplicado).dialog( "open" );
			return false;
			}else {
				createEstGabRow();
			}
		}else{
			createEstGabRow();
		}		
	}else{
		$( "#estGab_vacio" ).dialog(estGabVacio).dialog( "open" );		
	}
}

function delete_estGab(no,) {
	$("#rowEstGab"+no+"").next('input').remove();
	$("#rowEstGab"+no+"").next('input').remove();
	$("#rowEstGab"+no+"").next('input').remove();
	document.getElementById("rowEstGab"+no+"").outerHTML="";
	$('#agregarEstGab').prop('disabled', false);
}
</script>