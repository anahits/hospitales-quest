<script type="text/javascript">
	$(document).ready(function(){
		var selectedOcupacion = $("select.ocupacion").children("option:selected").val();
		if (selectedOcupacion == '0') {
			$('#otra_ocupacion').attr("hidden", false);
		} else {
			$('#otra_ocupacion').attr("hidden", true);
		}
		$("select.ocupacion").change(function(){
		var selectedOcupacion = $(this).children("option:selected").val();
			if (selectedOcupacion == '0') {
				$('#otra_ocupacion').attr("hidden", false);
			} else {
				$('#otra_ocupacion').attr("hidden", true);
			}
		});

		var selectedEscolaridad = $("select.escolaridad").children("option:selected").val();
		if (selectedEscolaridad == '0') {
			$('#otra_escolaridad').attr("hidden", false);
		} else {
			$('#otra_escolaridad').attr("hidden", true);
		}
		$("select.escolaridad").change(function(){
		var selectedEscolaridad = $(this).children("option:selected").val();
			if (selectedEscolaridad == '0') {
				$('#otra_escolaridad').attr("hidden", false);
			} else {
				$('#otra_escolaridad').attr("hidden", true);
			}
		});
		
		var selectedEstLab = $("select#estudiosLabSelect").children("option:selected").val();
		if (selectedEstLab == '0') {
			$('#otro_estudio_lab').attr("hidden", false);
		} else {
			$('#otro_estudio_lab').attr("hidden", true);
		}
		$("select#estudiosLabSelect").change(function(){
		var selectedEstLab = $(this).children("option:selected").val();
			if (selectedEstLab == '0') {
				$('#otro_estudio_lab').attr("hidden", false);
			} else {
				$('#otro_estudio_lab').attr("hidden", true);
			}
		});
		
		var selectedPruebAler = $("select#pruebAlergSelect").children("option:selected").val();
		if (selectedPruebAler == '0') {
			$('#otra_prueb_alerg').attr("hidden", false);
		} else {
			$('#otra_prueb_alerg').attr("hidden", true);
		}
		$("select#pruebAlergSelect").change(function(){
		var selectedPruebAler = $(this).children("option:selected").val();
			if (selectedPruebAler == '0') {
				$('#otra_prueb_alerg').attr("hidden", false);
			} else {
				$('#otra_prueb_alerg').attr("hidden", true);
			}
		});
		
		var selectedEstGab = $("select#estudiosGabSelect").children("option:selected").val();
		if (selectedEstGab == '0') {
			$('#otro_estudio_gab').attr("hidden", false);
		} else {
			$('#otro_estudio_gab').attr("hidden", true);
		}
		$("select#estudiosGabSelect").change(function(){
		var selectedEstGab = $(this).children("option:selected").val();
			if (selectedEstGab == '0') {
				$('#otro_estudio_gab').attr("hidden", false);
			} else {
				$('#otro_estudio_gab').attr("hidden", true);
			}
		});
		
		var selectedProced = $("select#procedSelect").children("option:selected").val();
		if (selectedProced == '0') {
			$('#otro_proced').attr("hidden", false);
		} else {
			$('#otro_proced').attr("hidden", true);
		}
		$("select#procedSelect").change(function(){
		var selectedProced = $(this).children("option:selected").val();
			if (selectedProced == '0') {
				$('#otro_proced').attr("hidden", false);
			} else {
				$('#otro_proced').attr("hidden", true);
			}
		});	
	});
</script>