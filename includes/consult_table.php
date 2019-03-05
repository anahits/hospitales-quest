<div class="form-group row">
	<label class="col-sm-2 col-form-label" for="tipo_consulta"><strong>5.1</strong> Tipo de consulta</label>
	<div class="col-sm-4">
		<select class="form-control" id="tipo_consulta" name="tipo_consulta">
			<option value="noSelection" selected="selected">-Selecciona un tipo de consulta-</option>
			<?php foreach( $tipo_consultas as $tipo => $tipo_consulta): ?>
			<?php echo '<option value="'.$tipo.'">'. $tipo_consulta.'</option>';
			?>
			<?php endforeach; ?>
		</select>
	</div>
	<div id="consulta_duplicada" class="warning">
		<p>Esta especialidad ya la has agregado, no la puedes agregar de nuevo</p>
	</div>
	<label class="col-form-label" for="fecha_consulta">Fecha</label>
	<div class="col-sm-2">
		<input id="fecha_consulta" class="form-control" type="date" width="276" name="fecha_consulta">
	</div>
</div>
<div id="urgenciasDetail"></div>
<div id="especialidad" class="form-group row">
	<label for="especialidad" class="col-sm-2 col-form-label">Especialidad</label>
	<div class="row col">
		<div class="col-sm-6">
			<select class="form-control" id="especialidadSelect" name="especialidadSelect"></select>
		</div>
	</div>
</div>
<div class="form-group row">
<label class="col-sm-2 col-form-label" for="causaConsulta">Causa o diagnostico</label>
<div class="col">
	<?php
	echo '<input type="text" id="causaConsulta" name="causaConsulta" class="form-control" placeholder="Ingrese el motivo">';
	?>
</div>
</div>
<div class="form-group row">
<label for="medicamentos" class="col-sm-2 col-form-label"><strong>5.2. </strong>Medicamentos</label>
<div class="col-sm-4">
	<button type="button" id="add_medicamentoRow" class="btn btn-success btn-circle btn-md">Agregar</button>
	<button type="button" id="remove_medicamentoRow" class="btn btn-danger btn-circle btn-md">Remover</button>
	<div id="no_medic_selected" class="warning">
		<p>No seleccionaste medicamento</p>
	</div>
	<div id="otro_medic_vacio" class="warning">
		<p>No ingresaste un medicamento nuevo</p>
	</div>	
	<div id="otro_tipomedic_vacio" class="warning">
		<p>No ingresaste un tipo de medicamento nuevo</p>
	</div>
</div>
</div>
<div class="form-group row">
<ul id="medicamentoContainer" class="col-sm-12"></ul>
<button id="guardarConsulta" style="height: 100%;" class="btn btn-success add col-sm-2" type="button" onclick="add_Consulta();" data-count='0'>Guardar Consulta</button>
</div>
<table align='center' cellspacing=2 cellpadding=4 id="consultas_table" border=1 class="table table-bordered table-hover list-group">
<tr>
<th class="col-sm-1">Núm de consulta</th>
<th class="col-sm-2">Tipo de consulta</th>
<th class="col-sm-2">Especialidad</th>
<th class="col-sm-1">Fecha</th>
<th class="col-sm-1">Causa o diagnostico de la Urgencia</th>
<th class="col-sm-2">Número de horas</th>
<th class="col-sm-2">¿Requirio de hospitalización?</th>
<th class="col-sm-2">Días en hospitalizacion</th>
<th class="col-sm-6">Medicamentos</th>
<th class="col-sm-1">Cantidad</th>
<th class="col-sm-2">Medida</th>
<th class="col-sm-2">Cada Horas</th>
<th class="col-sm-2">Durante Días</th>
<th class="col-sm-2">Eliminar</th>
</tr>
</table>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="includes/consult_table.js?v=1.0.1"></script>