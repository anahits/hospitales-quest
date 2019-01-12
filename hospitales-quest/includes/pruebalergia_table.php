<div class="form-group row">
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
		<th class="col-sm-9">Nombre Prueba</th>
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

function createPruebAlergRow(){
	if($('#get_cantidad_pruebAlerg').val() == '' || $('#get_cantidad_pruebAlerg').val() < 1){         
	    $( "#num_pruebAlerg_vacio" ).dialog(optpruebAlergVacio).dialog("open");
   	}else {
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
		var pruebAlergRow = pruebAlergTable.insertRow(pruebAlergTable_len).outerHTML="<tr id='rowpruebAlerg"+pruebAlergTable_len+"' class='estPruebAlergRow'>" +
			"<td style='padding: 1px;' id='pruebAlergSelect_row"+pruebAlergTable_len+"' value='"+pruebAlergSelected+"'>"+pruebAlergSelected+"</td><input name='pruebAlerg[]' value='"+pruebAlergSelected+"' hidden>"+
			"<td style='padding: 1px;'  id='cantidadpruebAlerg_row"+pruebAlergTable_len+"' value='"+set_cantidadPruebAlerg+"'>"+set_cantidadPruebAlerg+"<input id='cantidadpruebAlerg_input"+pruebAlergTable_len+"' name='cantidadpruebAlerg[]' value='"+set_cantidadPruebAlerg+"' hidden></td>" +
			"<td style='padding: 1px;' >"+
					"<div class='row'><input type='button' id='edit_button"+pruebAlergTable_len+"' value='Editar' class='edit btn btn-info mx-3' onclick='edit_pruebAlergRow("+pruebAlergTable_len+")' hidden>" +
					"<input type='button' id='save_button"+pruebAlergTable_len+"' value='Save' class='save btn btn-success mx-3' onclick='save_pruebAlergRow("+pruebAlergTable_len+")' style='display: none;'>" +
					"<input type='button' value='Borrar' class='delete btn btn-danger mx-2' onclick='delete_pruebAlerg("+pruebAlergTable_len+")'></div>"+
				"</td>" +"</tr>";
	}
	$('#otra_prueb_alerg').val('');	
 } 

function add_pruebAlerg() {
	var pruebAlergSelector = document.getElementById('pruebAlergSelect');
	var Selected = pruebAlergSelector[pruebAlergSelector.selectedIndex].value;
	if (Selected == '0' ){
		var otraPruebaAler =  document.getElementById('otra_prueb_alerg');
		var pruebAlergSelected = otraPruebaAler.value;
	}else{
		var pruebAlergSelected = pruebAlergSelector[pruebAlergSelector.selectedIndex].value;
	}
	var Consultaagregado = $('#pruebAlerg_table td:contains('+pruebAlergSelected+')').length;
	if (pruebAlergSelected !== ""){
		if($(".estPruebAlergRow").length){
			if (Consultaagregado > 0 ){	
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
	document.getElementById("rowpruebAlerg"+no+"").outerHTML="";
	$('#agregarpruebAlerg').prop('disabled', false);
}
</script>