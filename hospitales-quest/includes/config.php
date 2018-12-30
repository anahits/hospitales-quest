<?php include("session.php");?>
<?php

if(isset($_POST["submitTodo"]) && $_SERVER["REQUEST_METHOD"] == "POST"){

$id_paciente = $_SESSION['attnum']++;


	$mandar = $_POST["submitTodo"];
	$con =  @mysqli_connect($bd_host, $bd_user, $bd_pass, $bd_name);
	
	function filtrado($datos){
		$datos = trim($datos); // Elimina espacios antes y después de los datos
		$datos = stripslashes($datos); // Elimina backslashes
		$datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
		return $datos;
	}
	
	// DATOS PACIENTES
	$name_hospital = filtrado($_POST["hospitales"]);
		$hospital = substr($name_hospital,0);
	isset($_POST['rfc_paciente']) ? $rfc_paciente = filtrado($_POST['rfc_paciente']) : "";
	$filtred_rfc_paciente= filter_var($rfc_paciente, FILTER_SANITIZE_STRING);
		$rfc = strtoupper($filtred_rfc_paciente); 
	$iniciales_paciente = $_POST["iniciales_paciente"];
    $filtred_iniciales_paciente = filter_var($iniciales_paciente, FILTER_SANITIZE_STRING);
    	$iniciales = strtoupper($filtred_iniciales_paciente);
	$id_genero = filtrado($_POST["generos"]);
		$genero = $generos[$id_genero];
	$id_edad = filtrado($_POST["edades"]);
		if ($id_edad == 0) {
			$edad ='1 a 11 meses';
		}else if ($id_edad == 1) {
			$edad = $id_edad . ' año';
		}else {
			$edad = $id_edad . ' años';
		}
		//$id_ocupacion= mysqli_real_scape_string($con,$_POST["ocupaciones"]);
	$ocupacion = filtrado($_POST["ocupaciones"]);
		$otra_ocupacion = ucfirst(filtrado($_POST["otra_ocupacion"]));
	$escolaridad = filtrado($_POST["escolaridad"]);
		$otra_escolaridad = ucfirst(filtrado($_POST["otra_escolaridad"]));
	if (isset($_POST['residencia'])){
		$lugar_residencia = filtrado($_POST["residencia"]);		
	}

	//CLASIFICACIÓN DE LA ENFERMEDAD

	$id_anio_evol = filtrado($_POST["anios_evol"]);
		if ($id_anio_evol == 0) {
			$anio_evol ='1 a 11 meses';
		}else if ($id_edad == 1) {
			$anio_evol = $id_anio_evol . ' año';
		}else {
			$anio_evol = $id_anio_evol . ' años';
		}

	$id_grado_da = filtrado($_POST["grados_da"]);
		$grado_da = $grados_da[$id_grado_da];

	//Herramientas utilizadas para su clasificación:
	$scorad = $_POST["scorad_calculo"];
    	$scorad_calculo = filter_var($scorad, FILTER_SANITIZE_STRING);
    $bsa = $_POST["bsa_calculo"];
    	$bsa_calculo = filter_var($bsa, FILTER_SANITIZE_STRING);
    $easi = $_POST["easi_calculo"];
    	$easi_calculo = filter_var($easi, FILTER_SANITIZE_STRING);
    $iga = $_POST["iga_calculo"];
    	$iga_calculo = filter_var($iga, FILTER_SANITIZE_STRING);
    $iga_modificado = $_POST["iga_modificado_calculo"];
    	$iga_modificado_calculo = filter_var($iga_modificado, FILTER_SANITIZE_STRING);
	
	//ESTUDIOS
    isset($_POST['estudiosLab']) ? $estudiosLab = $_POST['estudiosLab'] : $estudiosLab = null;
    isset($_POST['cantidadEstLab']) ? $cantidadEstLab = $_POST['cantidadEstLab'] : "";

    isset($_POST['procedimientos']) ? $procedimientos = $_POST['procedimientos'] : $procedimientos = null;
    isset($_POST['cantidadproced']) ? $cantidadProced = $_POST['cantidadproced'] :"";

    isset($_POST['estudiosGab']) ? $estudiosGab = $_POST['estudiosGab'] : $estudiosGab = null;
    isset($_POST['cantidadEstGab']) ? $cantidadEstGab = $_POST['cantidadEstGab'] : "";


	///CONSULTAS
    isset($_POST['tipo_consultaSet']) ? $tipo_consultaSet = $_POST['tipo_consultaSet'] : $tipo_consultaSet ="";
    isset($_POST['especialidadesSet']) ? $especialidadesSet = $_POST['especialidadesSet'] : $especialidadesSet = null;
    isset($_POST['numConsultasSet']) ? $numConsultasSet = $_POST['numConsultasSet'] : $numConsultasSet = "";
    isset($_POST['fechaConsultaSet']) ? $fechaConsultaSet = $_POST['fechaConsultaSet'] : $fechaConsultaSet = "";

	isset($_POST['medicamentoSet']) ? $medicamentoSet = $_POST['medicamentoSet'] : $medicamentoSet = "";
	isset($_POST['medicamentos']) ? $medicamentos = $_POST['medicamentos'] : $medicamentos = "";
    //isset($_POST['cantidadConsultaSet']) ? $cantidadConsultaSet = $_POST['cantidadConsultaSet'] : $cantidadConsultaSet = "";
    //isset($_POST['medidaSet']) ? $medidaSet = $_POST['medidaSet'] : $medidaSet = "";
	/*foreach ($medicamentos as $value  => $medicamento) {
		echo "una" . $value ."dos". $medicamento;
		
	}*/

    isset($_POST['exacerbaciones']) ? $cantExacerbaciones = filtrado($_POST['exacerbaciones']) : "";

	if (isset($_POST['prurito'])){
		$prurito = $_POST["prurito"];		
	}else{
		$prurito ='Sin información';
	}
	if (isset($_POST['depresion'])){
		$depresion = $_POST["depresion"];		
	}else{
		$depresion ='Sin información';
	}

		//Dias Perdidos
	isset($_POST['dias_consul']) ? $dias_consul = filtrado($_POST['dias_consul']) : "";
    isset($_POST['dias_escol']) ? $dias_escol = filtrado($_POST['dias_escol']) : "";
	isset($_POST['dias_acomp']) ? $dias_acomp = filtrado($_POST['dias_acomp']) : "";
    isset($_POST['dias_urgen']) ? $dias_urgen = filtrado($_POST['dias_urgen']) : "";
    isset($_POST['dias_incap']) ? $dias_incap = filtrado($_POST['dias_incap']) : "";

    	isset($_POST['causaVisitUrgen']) ? $causaVisitUrgen = filtrado($_POST['causaVisitUrgen']) : "";
    $causa = filter_var($causaVisitUrgen, FILTER_SANITIZE_STRING);

    isset($_POST['hospitalizacion']) ? $idoptsHospital = $_POST['hospitalizacion'] : "";
	$hospitalizacion = $optsHospi[$idoptsHospital];

    isset($_POST['num_dias']) ? $dias_enHospital = $_POST['num_dias'] : "";
}
?>