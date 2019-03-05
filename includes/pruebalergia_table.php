<label for="pruebas_alergia" class="col-sm-3"><strong>4.2. </strong>PRUEBAS DE ALERGIA</label>
<div class="form-group row">
	<select class="form-control col-sm-2 tipo_consulta_estLab" id="tipoConsulPruebAlergSelect" name="tipo_consulta_pruebAlerg">';
       <?php foreach( $tipo_consultas_estudios as $value => $tipo_consul_est): 
          echo '<option value="'.$value.'">'. $tipo_consul_est.'</option>';
        endforeach;?>
	</select>
	<?php
        $codigoMenu= generarPruebAlerg($consulPruebAlerg);
        echo $codigoMenu;                        
   	?>    
	<input id="get_cantidad_pruebAlerg" type="number" min="1" class="form-control col-sm-1" name="numero_pruebAlerg" style="height: 50%;" placeholder="Núm">
	<div id="num_pruebAlerg_vacio" style="color: red;" title="No ingresaste una catidad">
	  <p>Ingresa una cantidad valida</p>
	</div>
	<button id="agregarpruebAlerg" class="btn btn-success add col-sm-1 ml-3" type="button" style="height: 50%;" onclick="add_pruebAlerg();">Agregar</button>
	<div id="pruebAlerg_duplicado" style="color: red;" title="Prueba de alergia duplicado">
	  <p>Esta prueba ya la has agregado, no la puedes agregar de nuevo</p>
	</div>	
	<div id="prueba_vacia" style="color: red;">
		<p>No has ingresado una prueba</p>
	</div>
</div>
<table align='center' cellspacing=2 cellpadding=4 id="pruebAlerg_table" border=1 class="table table-bordered table-hover list-group">
	<tr>		
		<th class="col-sm-2">Tipo de Consulta</th>
		<th class="col-sm-7">Nombre Estudio</th>
		<th class="col-sm-1">Núm de pruebas</th>
		<th class="col-sm-2">Eliminar</th>
	</tr>
</table>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$( "#num_pruebAlerg_vacio" ).dialog({
	autoOpen: false
});	 
$( "#pruebAlerg_duplicado" ).dialog({
	autoOpen: false
});
$( "#prueba_vacia" ).dialog({
	autoOpen: false
	});
var pruebaVacia = {
	autoOpen: false,
	modal: true,
	title: 'No ingresaste una prueba'
};	
var optpruebAlergVacio = {
        autoOpen: false,
        modal: true,
        title: 'No ingresaste una catidad'
};
var optpruebAlergDuplicado = {
        autoOpen: false,
        modal: true,
        title: 'Prueba de alergia duplicada'
};

function getPruebAlergPacnte() {
	var idP = $('#pacienteId').val();
	var action = 'pruebas_alergia';
	$.ajax({
	    type: "POST",
	    url: "includes/estudios.php",
	    data:{idP:idP,action:action},
	    dataType: "json",	
	    success : function(data){ 
			createPruebAlergRow(data.data);
		}
	});
}
if ($('#pacienteId').val() !== '') {
	getPruebAlergPacnte();
}

function createPruebAlergRow(data = false){

		var tipoConsulPruebAlergSelector= document.getElementById('tipoConsulPruebAlergSelect');
		var tipoConsulPruebAlergSelected = tipoConsulPruebAlergSelector[tipoConsulPruebAlergSelector.selectedIndex].value;
		var pruebAlergSelector = document.getElementById('pruebAlergSelect');
		var Selected = pruebAlergSelector[pruebAlergSelector.selectedIndex].value;
		if (Selected == '0' ){
			var otraPruebaAler =  document.getElementById('otra_prueb_alerg');
			var pruebAlergSelected = otraPruebaAler.value;
		}else{
			var pruebAlergSelected = pruebAlergSelector[pruebAlergSelector.selectedIndex].value;
		} 
		var set_cantidadPruebAlerg=document.getElementById("get_cantidad_pruebAlerg").value;
		
		var pruebAlergTable=document.getElementById("pruebAlerg_table");
		var pruebAlergTable_len=(pruebAlergTable.rows.length);
	if(data !== false){
		$.each( data, function( key, value ) {
			var pruebAlergRow = pruebAlergTable.insertRow(pruebAlergTable_len).outerHTML="<tr id='rowpruebAlerg"+pruebAlergTable_len+"' class='pruebAlergRow'>" +
				"<td style='padding: 1px;'>"+value.tipo_consulta+"</td><input name='tipoConsulPruebAlerg[]' value='"+value.tipo_consulta+"' hidden>"+
				"<td style='padding: 1px;'>"+value.pruebas_alergia+"</td><input name='pruebAlerg[]' value='"+value.pruebas_alergia+"' hidden>"+
				"<td style='padding: 1px;'>"+value.num_prueba_alerg+"<input name='cantidadpruebAlerg[]' value='"+value.num_prueba_alerg+"' hidden></td>" +
				"<td class='consultaNPruebAlerg' hidden>"+value.tipo_consulta+value.pruebas_alergia+"</td>"+
				"<td style='padding: 1px;' >"+
					"<input type='button' value='Borrar' class='delete btn btn-danger mx-2' onclick='delete_pruebAlerg("+pruebAlergTable_len+")'></div>"+
				"</td>" +"</tr>";
			pruebAlergTable_len++;
		});
		data = false;
	}else if($('#get_cantidad_pruebAlerg').val() == '' || $('#get_cantidad_pruebAlerg').val() < 1){         
	    $( "#num_pruebAlerg_vacio" ).dialog(optpruebAlergVacio).dialog("open");
   	}else {   		
		var pruebAlergRow = pruebAlergTable.insertRow(pruebAlergTable_len).outerHTML="<tr id='rowpruebAlerg"+pruebAlergTable_len+"' class='pruebAlergRow'>" +
			"<td style='padding: 1px;'>"+tipoConsulPruebAlergSelected+"</td><input name='tipoConsulPruebAlerg[]' value='"+tipoConsulPruebAlergSelected+"' hidden>"+
			"<td style='padding: 1px;'>"+pruebAlergSelected+"</td><input name='pruebAlerg[]' value='"+pruebAlergSelected+"' hidden>"+
			"<td style='padding: 1px;'>"+set_cantidadPruebAlerg+"<input name='cantidadpruebAlerg[]' value='"+set_cantidadPruebAlerg+"' hidden></td>" +
			"<td class='consultaNPruebAlerg' hidden>"+value.tipoConsulPruebAlergSelected+value.pruebAlergSelected+"</td>"+
			"<td style='padding: 1px;' >"+
					"<input type='button' value='Borrar' class='delete btn btn-danger mx-2' onclick='delete_pruebAlerg("+pruebAlergTable_len+")'></div>"+
			"</td>" +"</tr>";
	}
	$('#otra_prueb_alerg').val('');	
 } 

function add_pruebAlerg() {
	var tipoConsulPruebAlergSelector= document.getElementById('tipoConsulPruebAlergSelect');
	var tipoConsulPruebAlergSelected = tipoConsulPruebAlergSelector[tipoConsulPruebAlergSelector.selectedIndex].value;
	var pruebAlergSelector = document.getElementById('pruebAlergSelect');
	var Selected = pruebAlergSelector[pruebAlergSelector.selectedIndex].value;
	if (Selected == '0' ){
		var otraPruebaAler =  document.getElementById('otra_prueb_alerg');
		var pruebAlergSelected = otraPruebaAler.value;
	}else{
		var pruebAlergSelected = pruebAlergSelector[pruebAlergSelector.selectedIndex].value;
	}
	function compare(a, b) {
		    return typeof a === 'string' && typeof b === 'string'
		        ? a.localeCompare(b, undefined, { sensitivity: 'accent' }) === 0
		        : a === b;
		}
		var cYe = $(".consultaNPruebAlerg");
		for (i = 0; i < cYe.length; i++) {
		    if ($(cYe[i]).text().length) {
   				var iguales = compare($(cYe[i]).text(), tipoConsulPruebAlergSelected+pruebAlergSelected);
				if (iguales == true){
					$( "#estLab_duplicado" ).dialog(optEstLabDuplicado).dialog( "open" );
					return false;
				}
			} 
		}
	var consultaNPruebAlerg = $('#pruebAlerg_table td:contains('+tipoConsulPruebAlergSelected+pruebAlergSelected+')').length;

	if (pruebAlergSelected !== ""){
		if($(".pruebAlergRow").length){
			if (consultaNPruebAlerg > 0){	
				$( "#pruebAlerg_duplicado" ).dialog(optpruebAlergDuplicado).dialog( "open" );
			return false;
			}else { 
				createPruebAlergRow();			
			}  					
	 	}else{
			createPruebAlergRow();	
		}		
	}else{
		$( "#prueba_vacia" ).dialog(pruebaVacia).dialog( "open" );		
	}
}
function delete_pruebAlerg(no,) {
	$("#rowpruebAlerg"+no+"").next('input').remove();
	$("#rowpruebAlerg"+no+"").next('input').remove();
	$("#rowpruebAlerg"+no+"").next('input').remove();
	document.getElementById("rowpruebAlerg"+no+"").outerHTML="";
	$('#agregarpruebAlerg').prop('disabled', false);
}
</script>