<div class="form-group row">
	<?php
        $codigoMenu= generarEstuLab($consulEstuLab);
        echo $codigoMenu;                        
   	?>  
	<input id="get_cantidad_estudlab" type="number" min="0" class="form-control col-sm-1" name="numero_estLab" placeholder="Núm">
	<div id="num_estlab_vacio" style="color: red;">
	  <p>Ingresa una cantidad valida</p>
	</div>
	<button id="agregarEstLab" class="btn btn-success add col-sm-1 ml-3" type="button" onclick="add_estLabRow();">Agregar</button>
	<div id="estLab_duplicado" style="color: red;">
	  <p>Este estudio ya lo has agregado es necesario borrarlo para continuar</p>
	</div>
</div>
<table align='center' cellspacing=2 cellpadding=4 id="estLab_table" border=1 class="table table-bordered table-hover list-group">
	<tr>
		<th class="col-sm-9">Nombre Estudio</th>
		<th class="col-sm-1">Núm de estudios</th>
		<th class="col-sm-2">Eliminar</th>
	</tr>
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
var optEstLabVacio = {
        autoOpen: false,
        modal: true,
        title: 'No ingresaste una catidad'
};
var optEstLabDuplicado = {
        autoOpen: false,
        modal: true,
        title: 'Estudio duplicado'
};


function add_estLabRow() {
	
	if($('#get_cantidad_estudlab').val() == '' || $('#get_cantidad_estudlab').val() == '0'){         
	    $( "#num_estlab_vacio" ).dialog(optEstLabVacio).dialog("open");
   	}else { 
		var estLabSelector = document.getElementById('estudiosLab');
		var estLabSelected = estLabSelector[estLabSelector.selectedIndex].value;
		var set_cantidadProced=document.getElementById("get_cantidad_estudlab").value;
		
		var estLabTable=document.getElementById("estLab_table");
		var estLabTable_len=(estLabTable.rows.length);
		var estLabRow = estLabTable.insertRow(estLabTable_len).outerHTML="<tr id='rowEstLab"+estLabTable_len+"'>" +
			"<td style='padding: 1px;' id='estSelect_row"+estLabTable_len+"' value='"+estLabSelected+"'>"+estLabSelected+"</td><input name='estudiosLab[]' value='"+estLabSelected+"' hidden>"+
			"<td style='padding: 1px;'  id='cantidadEstLab_row"+estLabTable_len+"' value='"+set_cantidadProced+"'>"+set_cantidadProced+"<input id='cantidadEstLab_input"+estLabTable_len+"' name='cantidadEstLab[]' value='"+set_cantidadProced+"' hidden></td>" +
			"<td style='padding: 1px;' >"+
					"<div class='row'><input type='button' id='edit_button"+estLabTable_len+"' value='Editar' class='edit btn btn-info mx-3' onclick='edit_estLabRow("+estLabTable_len+")' hidden>" +
					"<input type='button' id='save_button"+estLabTable_len+"' value='Save' class='save btn btn-success mx-3' onclick='save_estLabRow("+estLabTable_len+")' style='display: none;'>" +
					"<input type='button' value='Borrar' class='delete btn btn-danger mx-2' onclick='delete_estLabRow("+estLabTable_len+")'></div>"+
				"</td>" +"</tr>";

		var selectedEstLab=document.getElementById("estSelect_row"+estLabTable_len);
		var selected_estLabData=selectedEstLab.innerHTML;
		var estLabagregado = $('#estLab_table td:contains('+selected_estLabData+')').length;
		if (estLabagregado > 1) {
			$('#agregarEstLab').prop('disabled', true); 	
	    	$( "#estLab_duplicado" ).dialog(optEstLabDuplicado).dialog( "open" );		            	
		}
	}
}

function edit_estLabRow(no) {
	document.getElementById("edit_button"+no).style.display="none";
	document.getElementById("save_button"+no).style.display="block";
		
	var selectedEstLab=document.getElementById("estSelect_row"+no);
	var cantidad=document.getElementById("cantidadEstLab_row"+no);

	var selected_estLabData=selectedEstLab.innerHTML;
	var cantidad_data=cantidad.innerHTML;
	selectedEstLab.innerHTML='<p style="color:blue;background-color:oldlace;" id="name_text'+no+'">'+selected_estLabData+'</p>';
	cantidad.innerHTML='<p style="color:blue;background-color:oldlace;" id="cantidad_text'+no+'">'+cantidad_data+'</p>';
}

function save_estLabRow(no) {
	var estLabSelector = document.getElementById('estudiosLab');
	var new_estLab = estLabSelector[estLabSelector.selectedIndex].value;
	var new_estLabCantidad=document.getElementById("get_cantidad_estudlab").value;

	document.getElementById("estSelect_row"+no).innerHTML=new_estLab;
	document.getElementById("cantidadEstLab_row"+no).innerHTML=new_estLabCantidad;
	document.getElementById("cantidadEstLab_input"+no).value=new_estLabCantidad;

	document.getElementById("edit_button"+no).style.display="block";
	document.getElementById("save_button"+no).style.display="none";
}

function delete_estLabRow(no,) {
	$("#rowEstLab"+no+"").next('input').remove();
	document.getElementById("rowEstLab"+no+"").outerHTML="";
	$('#agregarEstLab').prop('disabled', false);
}
</script>