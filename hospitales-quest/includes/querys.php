<?php
$con =  @mysqli_connect($bd_host, $bd_user, $bd_pass, $bd_name);
mysqli_select_db($con,"sumawebd_cuestionario");

if (!$con){
	die('Could not connect: ' . mysqli_error());
}else if (isset($_POST["submitTodo"])){
	$enviar = $_POST["submitTodo"];
	if ($enviar) {
	// process form SELECT COUNT(*) FROM datos_pacientes;
			function existe_ocupacion ($ocupacion){
				include("bd_conection.php");
				$result = @mysqli_query($con, "SELECT * FROM ocupaciones WHERE ocupacion_tipo LIKE '$ocupacion'");
				$rowcount=mysqli_num_rows($result);
				if ($rowcount > 0){	
					while($ocupacionExist = @mysqli_fetch_assoc($result)) {   
						return $ocupacionExist['ocupacion_tipo'];
					}
				}else if ($ocupacion !== "") {
					@mysqli_query($con, "INSERT INTO ocupaciones (ocupacion_tipo) VALUES ('$ocupacion')");			
					return $ocupacion;
				}
			}
			$existe_ocupacion = existe_ocupacion($ocupacion);
			function existe_escolaridad ($escolaridad){
				include("bd_conection.php");
				$result = @mysqli_query($con, "SELECT * FROM escolaridad WHERE escolaridad_nivel LIKE '$escolaridad'");
				$rowcount=mysqli_num_rows($result);
				if ($rowcount > 0){	
					while($escolaridadExist = @mysqli_fetch_assoc($result)) {   
						return $escolaridadExist['escolaridad_nivel'];
					}				
				}else if ($escolaridad !== ""){
					@mysqli_query($con, "INSERT INTO escolaridad (escolaridad_nivel) VALUES ('$escolaridad')");			
					return $escolaridad;
				}
			}
			$existe_escolaridad = existe_escolaridad($escolaridad);

		if  ($id_genero == '0' ||  !isset($lugar_residencia)){
			$campoVacio = '<p class="warning mb-0">Sin esta información no se puede almacenar en la Base de Datos</p>';		
		}else {
			$query = @mysqli_query($con,"INSERT INTO datos_pacientes (hospital_paciente,rfc_paciente,iniciales_paciente, genero_paciente,edad_paciente,paciente_ocupacion,escolaridad_paciente,lugar_residencia_paciente,inicio_consultas,fin_consultas) VALUES (N'$hospital','$rfc','$iniciales','$genero',N'$edad',N'$existe_ocupacion', N'$existe_escolaridad','$lugar_residencia','$inicio_consultas','$fin_consultas');");			
			$paciente_id = $con->insert_id;

				$query = "INSERT INTO clasificacion_enfermedad (id_paciente,anios_evolucion, tipo_da, scorad_calculo, bsa_calculo, easi_calculo, iga_calculo, iga_modificado_calculo) VALUES ('$paciente_id',N'$anio_evol',N'$grado_da','$scorad_calculo','$bsa_calculo','$easi_calculo','$iga_calculo','$iga_modificado_calculo');";

				if($estudiosLab !== null){
					foreach( $estudiosLab as $index => $estudioLab ) {
				  		$query .= "INSERT INTO estudios_laboratorio (id_paciente,tipo_consulta,estudios_laboratorio,num_estudios_lab) VALUES('$paciente_id',N'$tipoConsulEstLab[$index]',N'$estudioLab','$cantidadEstLab[$index]');";
						$query .= @mysqli_query($con,"INSERT INTO estudios_laboratorio_tipos (tipo_estudio_laboratorio) VALUES (N'$estudioLab');");
					}
				}
				if($pruebsAlerg !== null){ 
					foreach( $pruebsAlerg as $index => $pruebAlerg ) {
				  		$query .= "INSERT INTO pruebas_alergia (id_paciente,tipo_consulta,pruebas_alergia,num_prueba_alerg) VALUES('$paciente_id',N'$tipoConsulPruebAlerg[$index]',N'$pruebAlerg','$cantidadpruebAlerg[$index]');";
						$query .= @mysqli_query($con,"INSERT INTO pruebas_alergia_tipos (tipo_prueba_alergia) VALUES (N'$pruebAlerg');");
					}	
				}
				if($estudiosGab !== null){ 
					foreach( $estudiosGab as $index => $estudioGab ) {
					  $query .= "INSERT INTO estudios_gabinete (id_paciente,tipo_consulta,estudios_gabinete,num_estudios_gab) VALUES('$paciente_id',N'$tipoConsulEstGab[$index]',N'$estudioGab','$cantidadEstGab[$index]');";
						$query .= @mysqli_query($con,"INSERT INTO estudios_gabinete_tipos (tipo_estudio_gabinete) VALUES (N'$estudioGab');");
					}	
				}
				if($procedimientos !== null){ 
					foreach( $procedimientos as $index => $procedimiento ) {
				  		$query .=  "INSERT INTO procedimientos (id_paciente,tipo_consulta,procedimiento,num_proced) VALUES('$paciente_id',N'$tipoConsulProced[$index]',N'$procedimiento','$cantidadProced[$index]');";
						$query .= @mysqli_query($con,"INSERT INTO procedimientos_tipos (tipo_procedimiento) VALUES (N'$procedimiento');");
					}	
				}
				if($especialidadesSet !== null && $cantidadConsultas !== null){ 
					foreach( $especialidadesSet as $each => $especialidadSet ) {
						if (!empty($medicamentos[$each]) ){ 
							foreach ($medicamentos[$each] as $medicamentoIdx => $medicamentoVal) {
								$query .= "INSERT INTO consultas (id_paciente,num_consulta,tipo_consulta,fecha,especialidad,medicamento,tipo_medicamento,cantidad_medicamento,medida_medicamento,cada_horas,durante_dias,causa_urgencia,num_horas_urgencias,hospitaliza_urgencias,dias_hospital_urgen) VALUES('$paciente_id','$numConsultasSet[$each]',N'$tipo_consultaSet[$each]','$fechaConsultaSet[$each]',N'$especialidadSet',N'$medicamentoVal',N'".$tipoMedicamentos[$each][$medicamentoIdx]."','".$cantidadMedicamentos[$each][$medicamentoIdx]."','".$medidasMedicamentos[$each][$medicamentoIdx]."','".$porHorasUrgen[$each][$medicamentoIdx]."','".$duranteDiasUrgen[$each][$medicamentoIdx]."',N'$causaConsulta[$each]','$horasUrg[$each]','$hospitalizacion[$each]','$dias_enHospital[$each]');";
								$query .= @mysqli_query($con,"INSERT INTO medicamentos_tipo (medicamento,tipo_medicamento) VALUES (N'$medicamentoVal',N'".$tipoMedicamentos[$each][$medicamentoIdx]."');");
							}
						}else{
							$query .=  "INSERT INTO consultas (id_paciente,num_consulta,tipo_consulta,fecha,especialidad,causa_urgencia,num_horas_urgencias,hospitaliza_urgencias,dias_hospital_urgen) VALUES('$paciente_id','$numConsultasSet[$each]',N'$tipo_consultaSet[$each]','$fechaConsultaSet[$each]',N'$especialidadSet',N'$causaConsulta[$each]','$horasUrg[$each]','$hospitalizacion[$each]','$dias_enHospital[$each]');";
						}
					}
				}
				$query .= "INSERT INTO caracterist_enfermedad (id_paciente,canti_exacerb,prurito,depresion,dias_consult_perdidos,dias_escol_perdidos,dias_acomp_perdidos,dias_urgenc_perdidos,dias_incap_perdidos) VALUES ('$paciente_id','$cantExacerbaciones',N'$prurito',N'$depresion','$diasConsulta','$dias_escol','$dias_acomp','$diasUrgencias','$dias_incap');";
				//var_dump($_POST);

			if (mysqli_multi_query($con, $query) === TRUE && (mysqli_errno($con) !== 1062)) {
				echo '<div class="alert alert-success" style="text-align: center;">¡Hemos recibido sus datos!</div><br>'.$con->error;

			} else{
	    		echo "Error: " . $query . "<br>" . $con->error;

			}	
		}
   
   	mysqli_close($con);
	}
}
?>