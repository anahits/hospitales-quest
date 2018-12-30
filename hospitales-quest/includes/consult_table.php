<div class="form-group row">
	<label class="col-sm-2 col-form-label" for="tipo_consulta"><strong>5.1</strong> Tipo de consulta</label>
	<div class="col-sm-4">
		<select class="form-control" id="tipo_consulta" name="tipo_consulta">
			<?php foreach( $tipo_consultas as $tipo => $tipo_consulta): ?>
			<?php echo '<option value="'.$tipo.'">'. $tipo_consulta.'</option>';
			?>
			<?php endforeach; ?>
		</select>
	</div>
	<div id="consulta_duplicada" class="col-sm-2" style="color: red;">
	  <p>Esta especialidad ya la has agregado es necesario borrarla para continuar</p>
	</div>
	<label class="col-sm-2 col-form-label" for="fecha_consulta">Fecha</label>
	<div class="col-sm-2">
		<input id="fecha_consulta" class="form-control" type="date" width="276" name="fecha_consulta">
	</div>
</div>
<div class="form-group row">
	<label for="especialidad" class="col-sm-2 col-form-label">Especialidad</label>
	<div class="row col">
		<div class="col-sm-6">
			<select class="form-control" id="especialidadSelect" name="especialidadSelect"></select>
		</div>
		<div class="col-sm-3">
       		<input id="numConsult" type="number" min="0" class="form-control" placeholder="Número de consultas" >
       		<div id="num_consulta_vacio" style="color: red;" >
	  			<p>No ingresaste número de consultas</p>
			</div>
		</div>
	</div>
</div>
<div class="form-group row">
	<label for="medicamentos" class="col-sm-2 col-form-label"><strong>5.2. </strong>Medicamentos</label>
	<div class="col-sm-2">
		<button type="button" id="add_medicamentoRow" class="btn btn-success btn-circle btn-md">+</button>
		<button type="button" id="remove_medicamentoRow" class="btn btn-danger btn-circle btn-md">-</button>
	</div>
</div>
<div class="form-group row">
	<div id="medicamentoContainer"></div>
</div>



<div class="form-group row" style="justify-content: end;">
	<button id="guardarConsulta" class="btn btn-success add" type="button" onclick="add_consultRow();">Guardar Consulta</button>
</div>
<table align='center' cellspacing=2 cellpadding=4 id="consultas_table" border=1 class="table table-bordered table-hover list-group">
	<tr>
		<th class="col-sm-1">Tipo de consulta</th>
		<th class="col-sm-4">Especialidad</th>
		<th class="col-sm-1">Núm de consulta</th>
		<th class="col-sm-1">Fecha</th>
		<th class="col-sm-6">Medicamentos</th>		
		<th class="col-sm-1">Cantidad</th>
		<th class="col-sm-2">Medida</th>
		<th class="col-sm-2">Eliminar</th>
	</tr>
</table>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="includes/consult_table.js"></script>