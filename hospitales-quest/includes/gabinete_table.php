<div class="form-group row">
	<?php
        $codigoMenu= generarEstuGab($consulEstuGab);
        echo $codigoMenu;                        
   	?>  
	<input id="get_cantidad_estudGab" type="number" min="0" class="form-control col-sm-1" name="numero_estGab" placeholder="Núm">
	<div id="num_estGab_vacio" style="color: red;">
	  <p>Ingresa una cantidad valida</p>
	</div>
	<button id="agregarEstGab" class="btn btn-success add col-sm-1 ml-3" type="button" onclick="add_estGabRow();">Agregar</button>
	<div id="estGab_duplicado" style="color: red;">
	  <p>Este estudio ya lo has agregado es necesario borrarlo para continuar</p>
	</div>
</div>
<table align='center' cellspacing=2 cellpadding=4 id="estGab_table" border=1 class="table table-bordered table-hover list-group">
	<tr>
		<th class="col-sm-9">Nombre Estudio</th>
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


function add_estGabRow() {
	
	if($('#get_cantidad_estudGab').val() == '' || $('#get_cantidad_estudGab').val() == '0'){         
	    $( "#num_estGab_vacio" ).dialog(optEstGabVacio).dialog("open");
   	}else { 
		var estGabSelector = document.getElementById('estudiosGabSelect');
		var estGabSelected = estGabSelector[estGabSelector.selectedIndex].value;
		var set_cantidadProced=document.getElementById("get_cantidad_estudGab").value;
		
		var estGabTable=document.getElementById("estGab_table");
		var estGabTable_len=(estGabTable.rows.length);
		var estGabRow = estGabTable.insertRow(estGabTable_len).outerHTML="<tr id='rowEstGab"+estGabTable_len+"'>" +
			"<td style='padding: 1px;' id='estSelect_row"+estGabTable_len+"' value='"+estGabSelected+"'>"+estGabSelected+"</td><input name='estudiosGab[]' value='"+estGabSelected+"' hidden>"+
			"<td style='padding: 1px;'  id='cantidadEstGab_row"+estGabTable_len+"' value='"+set_cantidadProced+"'>"+set_cantidadProced+"<input id='cantidadEstGab_input"+estGabTable_len+"' name='cantidadEstGab[]' value='"+set_cantidadProced+"' hidden></td>" +
			"<td style='padding: 1px;' >"+
					"<div class='row'><input type='button' id='edit_button"+estGabTable_len+"' value='Editar' class='edit btn btn-info mx-3' onclick='edit_estGabRow("+estGabTable_len+")' hidden>" +
					"<input type='button' id='save_button"+estGabTable_len+"' value='Save' class='save btn btn-success mx-3' onclick='save_estGabRow("+estGabTable_len+")' style='display: none;'>" +
					"<input type='button' value='Borrar' class='delete btn btn-danger mx-2' onclick='delete_estGabRow("+estGabTable_len+")'></div>"+
				"</td>" +"</tr>";

		var selectedEstGab=document.getElementById("estSelect_row"+estGabTable_len);
		var selected_estGabData=selectedEstGab.innerHTML;
		var estGabagregado = $('#estGab_table td:contains('+selected_estGabData+')').length;
		if (estGabagregado > 1) {
			$('#agregarEstGab').prop('disabled', true); 	
	    	$( "#estGab_duplicado" ).dialog(optEstGabDuplicado).dialog( "open" );		            	
		}
	}
}

function delete_estGabRow(no,) {
	$("#rowEstGab"+no+"").next('input').remove();
	document.getElementById("rowEstGab"+no+"").outerHTML="";
	$('#agregarEstGab').prop('disabled', false);
}
</script>