<?php

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitTodo"]) ||  isset($_POST["updateTodo"])) {
	(isset($_POST["updateTodo"])) ? $id = $_POST['pacienteId'] : '';

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
		if ($id_edad == '') {
			$edad ='';
		}else if ($id_edad == 1) {
			$edad = $id_edad . ' año';
		}else {
			$edad = $id_edad . ' años';
		}
	
	//$id_ocupacion= mysqli_real_scape_string($con,$_POST["ocupaciones"]);
	$ocupacionSelected = filtrado($_POST["ocupaciones"]) ;
	($ocupacionSelected !== '0' ) ?	$ocupacion = $ocupacionSelected : $ocupacion = ucfirst(filtrado($_POST["otra_ocupacion"]));
	
	$escolaridadSelected = filtrado($_POST["escolaridad"]);
	($escolaridadSelected !== '0' ) ?	$escolaridad = $escolaridadSelected : $escolaridad = ucfirst(filtrado($_POST["otra_escolaridad"]));

	if (isset($_POST['residencia'])){
		$lugar_residencia = filtrado($_POST["residencia"]);		
	}

	($_POST['estados'] !== 'null' )? $estado = filtrado($_POST["estados"]):$estado = null;

	///PERIODO
    isset($_POST['inicio_consultas']) ? $inicio_consultas = $_POST['inicio_consultas'] : $inicio_consultas = "";
    isset($_POST['fin_consultas']) ? $fin_consultas = $_POST['fin_consultas'] : $fin_consultas ="";

	//CLASIFICACIÓN DE LA ENFERMEDAD

	$id_anio_evol = filtrado($_POST["anios_evol"]);
		if ($id_anio_evol == '') {
			$anio_evol ='';
		}else if ($id_anio_evol == 1) {
			$anio_evol = $id_anio_evol . ' año';
		}else {
			$anio_evol = $id_anio_evol . ' años';
		}

	$id_grado_da = filtrado($_POST["grados_da"]);
		if ($id_grado_da == 'noOption') {
			$grado_da ='';
		}else {			
			$grado_da = $grados_da[$id_grado_da];
		}

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
    isset($_POST['tipoConsulEstLab']) ? $tipoConsulEstLab = $_POST['tipoConsulEstLab'] : "";
    isset($_POST['cantidadEstLab']) ? $cantidadEstLab = $_POST['cantidadEstLab'] : "";    
	
	isset($_POST['pruebAlerg']) ? $pruebsAlerg = $_POST['pruebAlerg'] : $pruebsAlerg = null;   
    isset($_POST['tipoConsulPruebAlerg']) ? $tipoConsulPruebAlerg = $_POST['tipoConsulPruebAlerg'] : "";
    isset($_POST['cantidadpruebAlerg']) ? $cantidadpruebAlerg = $_POST['cantidadpruebAlerg'] :"";

    isset($_POST['estudiosGab']) ? $estudiosGab = $_POST['estudiosGab'] : $estudiosGab = null;   
    isset($_POST['tipoConsulEstGab']) ? $tipoConsulEstGab = $_POST['tipoConsulEstGab'] : "";
    isset($_POST['cantidadEstGab']) ? $cantidadEstGab = $_POST['cantidadEstGab'] : "";

    isset($_POST['procedimientos']) ? $procedimientos = $_POST['procedimientos'] : $procedimientos = null;   
    isset($_POST['tipoConsulProced']) ? $tipoConsulProced = $_POST['tipoConsulProced'] : "";
    isset($_POST['cantidadProced']) ? $cantidadProced = $_POST['cantidadProced'] :"";
	
	///CONSULTAS
    isset($_POST['numConsultasSet']) ? $numConsultasSet = $_POST['numConsultasSet'] : $numConsultasSet = "";
    isset($_POST['tipo_consultaSet']) ? $tipo_consultaSet = $_POST['tipo_consultaSet'] : $tipo_consultaSet =null;
    isset($_POST['especialidadesSet']) ? $especialidadesSet = $_POST['especialidadesSet'] : $especialidadesSet = "";
    isset($_POST['fechaConsultaSet']) ? $fechaConsultaSet = $_POST['fechaConsultaSet'] : $fechaConsultaSet = "";
	
	///CONSULTAS Urgencias
    isset($_POST['causaUrgenSet']) ? $causaConsulta = $_POST['causaUrgenSet'] : $causaConsulta ="";
   	isset($_POST['num_hrsUrgenSet']) ? $horasUrg = $_POST['num_hrsUrgenSet'] : $horasUrg = "";
    isset($_POST['requHospiSet']) ? $hospitalizacion = $_POST['requHospiSet'] : $hospitalizacion = "";
    isset($_POST['diasHospiSet']) ? $dias_enHospital = $_POST['diasHospiSet'] : $dias_enHospital = "";

	///CONSULTAS medicamentos
	$medicamentos = array();
	$tipoMedicamentos = array();
	$cantidadMedicamentos = array();
	$medidasMedicamentos = array();
	$porHorasUrgen = array();
	$duranteDiasUrgen = array();

	isset($_POST['consultasIdsSet']) ?

		$cantidadConsultas =  sizeOf($_POST['consultasIdsSet']): $cantidadConsultas = null;

		if($cantidadConsultas > 0 ){		
			for ($i=0; $i < $cantidadConsultas; $i++) { 

				$indiceTipoMedicamentos = 'tipo_medicamentos'.$_POST['consultasIdsSet'][$i];
				isset($_POST[$indiceTipoMedicamentos]) ? $tipoMedicamAdd = $_POST[$indiceTipoMedicamentos] : $tipoMedicamAdd ="";
				array_push($tipoMedicamentos , $tipoMedicamAdd);

				$indiceMedicamentos = 'medicamentos'.$_POST['consultasIdsSet'][$i];
				isset($_POST[$indiceMedicamentos]) ? $medicamAdd = $_POST[$indiceMedicamentos] : $medicamAdd ="";
				array_push($medicamentos , $medicamAdd);
				
				$indiceCantidadMedicamentos = 'cantidades'.$_POST['consultasIdsSet'][$i];
				isset($_POST[$indiceCantidadMedicamentos]) ? $cantidadMedicamAdd = $_POST[$indiceCantidadMedicamentos] : $cantidadMedicamAdd ="";
				array_push($cantidadMedicamentos , $cantidadMedicamAdd);

				$indiceMedidasMedicamentos = 'medidas'.$_POST['consultasIdsSet'][$i];
				isset($_POST[$indiceMedidasMedicamentos]) ? $medidaMedicamAdd = $_POST[$indiceMedidasMedicamentos] : $medidaMedicamAdd ="";
				array_push($medidasMedicamentos , $medidaMedicamAdd);
				
				$indicePorHoras = 'porHoras'.$_POST['consultasIdsSet'][$i];
				isset($_POST[$indicePorHoras]) ? $porHorasMedicamAdd = $_POST[$indicePorHoras] : $porHorasMedicamAdd ="";
				array_push($porHorasUrgen , $porHorasMedicamAdd);
				
				$indiceDuranteDias = 'duranteDias'.$_POST['consultasIdsSet'][$i];
				isset($_POST[$indiceDuranteDias]) ? $duranteDiasMedicamAdd = $_POST[$indiceDuranteDias] : $duranteDiasMedicamAdd ="";
				array_push($duranteDiasUrgen , $duranteDiasMedicamAdd);
			}
		}								
    isset($_POST['exacerbaciones']) ? $cantExacerbaciones = filtrado($_POST['exacerbaciones']) : "";
	isset($_POST['prurito']) ? $prurito = filtrado($_POST["prurito"]) : $prurito = "NO";
	isset($_POST['depresion']) ? $depresion = filtrado($_POST["depresion"]) : $depresion = "NO";

		//Dias Perdidos
 	if ($tipo_consultaSet !== null){
		$numMismaConsulta=array_count_values($tipo_consultaSet);
	}
		$diasConsulta_general = isset($numMismaConsulta['Consulta General']) ? $numMismaConsulta['Consulta General'] : "0";

		$diasInterconsulta = isset($numMismaConsulta['Interconsulta']) ? $numMismaConsulta['Interconsulta'] : "0";

	$diasConsultaTotal = $diasConsulta_general + $diasInterconsulta; 

	$diasUrgenciasTotal = isset($numMismaConsulta['Urgencias']) ? $numMismaConsulta['Urgencias'] : "0";
	

	//isset($_POST['dias_consul']) ? $dias_consul = filtrado($_POST['dias_consul']) : "0";
    isset($_POST['dias_escol']) ? $dias_escol = filtrado($_POST['dias_escol']) : "0";
	isset($_POST['dias_acomp']) ? $dias_acomp = filtrado($_POST['dias_acomp']) : "0";
    //isset($_POST['dias_urgen']) ? $dias_urgen = filtrado($_POST['dias_urgen']) : "0";
    isset($_POST['dias_incap']) ? $dias_incap = filtrado($_POST['dias_incap']) : "0";

}
?>