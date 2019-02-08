<label for="procedimientos" class="col-sm-3"><strong>4.4. </strong>PROCEDIMIENTOS</label>
<div class="form-group row">
	<select class="form-control col-sm-2 tipo_consulta_proced" id="tipoConsulProcedSelect" name="tipo_consulta_Proced">';
       <?php foreach( $tipo_consultas_estudios as $value => $tipo_consul_est): 
          echo '<option value="'.$value.'">'. $tipo_consul_est.'</option>';
        endforeach;?>
	</select>
	<?php
        $codigoMenu= generarProced($consulProced);
        echo $codigoMenu;                        
   	?>    
	<input id="get_cantidad_proced" type="number" min="1" class="form-control col-sm-1" name="numero_proced" style="height: 50%;" placeholder="Núm">
	<div id="num_proced_vacio" style="color: red;" title="No ingresaste una catidad">
	  <p>Ingresa una cantidad valida</p>
	</div>
	<button id="agregarproced" class="btn btn-success add col-sm-1 ml-3" type="button" style="height: 50%;" onclick="add_Proced();">Agregar</button>
	<div id="proced_duplicado" style="color: red;" title="Procedimiento duplicado">
	  <p>Este procedimiento ya lo has agregado, no lo puedes agregar de nuevo</p>
	</div>	
	<div id="proced_vacio" style="color: red;">
		<p>No has ingresado un procedimiento</p>
	</div>
</div>
<table align='center' cellspacing=2 cellpadding=4 id="proced_table" border=1 class="table table-bordered table-hover list-group">
	<tr>		
		<th class="col-sm-2">Tipo de Consulta</th>
		<th class="col-sm-9">Nombre Procedimiento</th>
		<th class="col-sm-1">Núm de procedimientos</th>
		<th class="col-sm-2">Eliminar</th>
	</tr>
</table>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
$( "#num_proced_vacio" ).dialog({
	autoOpen: false
});	 
$( "#proced_duplicado" ).dialog({
	autoOpen: false
});
$( "#proced_vacio" ).dialog({
	autoOpen: false
});
var procedVacio = {
	autoOpen: false,
	modal: true,
	title: 'No ingresaste un procedimiento'
};	
var optProcedVacio = {
        autoOpen: false,
        modal: true,
        title: 'No ingresaste una catidad'
};
var optProcedDuplicado = {
        autoOpen: false,
        modal: true,
        title: 'Procedimiento duplicado'
};

function createProcedRow(){
	 if($('#get_cantidad_proced').val() == '' || $('#get_cantidad_proced').val() < 1){         
	    $( "#num_proced_vacio" ).dialog(optProcedVacio).dialog("open");
   	}else { 
		var tipoConsulProcedSelector= document.getElementById('tipoConsulProcedSelect');
		var tipoConsulProcedSelected = tipoConsulProcedSelector[tipoConsulProcedSelector.selectedIndex].value;
		var procedSelector = document.getElementById('procedSelect');
		var Selected = procedSelector[procedSelector.selectedIndex].value;			
		if (Selected == '0' ){
			var otroProced =  document.getElementById('otro_proced');
			var procedSelected = otroProced.value;
		}else{
			var procedSelected = procedSelector[procedSelector.selectedIndex].value;
		}
		var set_cantidadProced=document.getElementById("get_cantidad_proced").value;
		
		var procedTable=document.getElementById("proced_table");
		var procedTable_len=(procedTable.rows.length);
		var procedRow = procedTable.insertRow(procedTable_len).outerHTML="<tr id='rowProced"+procedTable_len+"' class='estProcedRow'>" +
			"<td style='padding: 1px;' id='tipoConsulProcedSelect_row"+procedTable_len+"'>"+tipoConsulProcedSelected+"</td><input name='tipoConsulProced[]' value='"+tipoConsulProcedSelected+"' hidden>"+
			"<td style='padding: 1px;' id='procedSelect_row"+procedTable_len+"'>"+procedSelected+"</td><input name='procedimientos[]' value='"+procedSelected+"' hidden>"+
			"<td style='padding: 1px;'  id='cantidadProced_row"+procedTable_len+"'>"+set_cantidadProced+"<input id='cantidadProced_input"+procedTable_len+"' name='cantidadProced[]' value='"+set_cantidadProced+"' hidden></td>" +
			"<td style='padding: 1px;' >"+
					"<div class='row'><input type='button' id='edit_button"+procedTable_len+"' value='Editar' class='edit btn btn-info mx-3' onclick='edit_procedRow("+procedTable_len+")' hidden>" +
					"<input type='button' id='save_button"+procedTable_len+"' value='Save' class='save btn btn-success mx-3' onclick='save_procedRow("+procedTable_len+")' style='display: none;'>" +
					"<input type='button' value='Borrar' class='delete btn btn-danger mx-2' onclick='delete_Proced("+procedTable_len+")'></div>"+
				"</td>" +"</tr>";
	}
	$('#otro_proced').val('');	
 } 

function add_Proced() {
	var tipoConsulProcedSelector= document.getElementById('tipoConsulProcedSelect');
	var tipoConsulProcedSelected = tipoConsulProcedSelector[tipoConsulProcedSelector.selectedIndex].value;
	var procedSelector = document.getElementById('procedSelect');
	var Selected = procedSelector[procedSelector.selectedIndex].value;
	if (Selected == '0' ){
		var otroProced =  document.getElementById('otro_proced');
		var procedSelected = otroProced.value;
	}else{
		var procedSelected = procedSelector[procedSelector.selectedIndex].value;
	}
	var Consultaagregado = $('#proced_table td:contains('+procedSelected+')').length;
	var tipoConsultAgregada = $('#proced_table td:contains('+tipoConsulProcedSelected+')').length;

	if (procedSelected !== ""){
		if($(".estProcedRow").length){
			if (Consultaagregado > 0 && tipoConsultAgregada > 0 ){
				$( "#proced_duplicado" ).dialog(optProcedDuplicado).dialog( "open" );
			return false;
			}else {
				createProcedRow();
			}
		}else{
			createProcedRow();
		}		
	}else{
		$( "#proced_vacio" ).dialog(procedVacio).dialog( "open" );		
	}
}

function delete_Proced(no,) {
	$("#rowProced"+no+"").next('input').remove();
	$("#rowProced"+no+"").next('input').remove();
	$("#rowProced"+no+"").next('input').remove();
	document.getElementById("rowProced"+no+"").outerHTML="";
	$('#agregarproced').prop('disabled', false);
}
</script>