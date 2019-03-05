<div class="form-group">
	<div class="form-group row">
		<label class="col-sm-2 col-form-label" for="hrsUrgencia">Número de horas</label>                    
        <div class="col-sm-2">
            <input id="horasUrg" name="horasUrg" class="horasUrg form-control"  type="number" min="1" placeholder="Núm horas">
        </div>
    </div>
	<div class="form-group row">
		<label class="col-sm-3 col-form-label" for="Hospitalizacion">¿Requirio de hospitalización?</label>
		<div class="col-sm-2">
			<select class="form-control" id="hospitalizacion" name="hospitalizacion">
				<option value="NO">NO</option>
				<option value="SI">SI</option>
			</select>
		</div>
		<label class="col-sm-2 col-form-label" id="num_dias_label" for="num_dias" hidden="true">¿Cúantos días?</label>
		<div class="col-sm-2">
			<input id="num_dias" type="number" min="1" step="1" name="num_dias" class="form-control" placeholder="Núm días" hidden="true">
		</div>
	</div>
</div>
<script>
	
		$("select#hospitalizacion").change(function(){
		var optHospi = $(this).children("option:selected").val();
			if (optHospi == 'SI') {
				$('#num_dias').attr("hidden", false);
				$('#num_dias_label').attr("hidden", false);
			} else {
				$('#num_dias').attr("hidden", true);
				$('#num_dias_label').attr("hidden", true);
			}
		}); 
</script>