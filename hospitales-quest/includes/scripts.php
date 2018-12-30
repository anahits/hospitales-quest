<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("select.ocupacion").change(function(){
	var selectedOcupacion = $(this).children("option:selected").val();
		if (selectedOcupacion == 0) {
			$('#otra_ocupacion').attr("hidden", false);
		} else {
			$('#otra_ocupacion').attr("hidden", true);
		}
	});
});


$(document).ready(function(){
	$("select.escolaridad").change(function(){
	var selectedEscolaridad = $(this).children("option:selected").val();
		if (selectedEscolaridad == 0) {
			$('#otra_escolaridad').attr("hidden", false);
		} else {
			$('#otra_escolaridad').attr("hidden", true);
		}
	});
});


$(document).ready(function(){
	$("#btn").onclick(function(){
		$.ajax({
			url:"Ajax.php",
			type: "POST",
			data:"nombre="+$("#nombre").val(),
			success: function(){
			$("#resultado-ajax").html(opciones);
			}
		})
	});
});

</script>
