<?php
$con =  @mysqli_connect($bd_host, $bd_user, $bd_pass, $bd_name);
mysqli_select_db($con,"sumawebd_cuestionario");

if (!$con){
	die('Could not connect: ' . mysqli_error());
}else if (isset($_POST["submitTodo"])){
	$enviar = $_POST["submitTodo"];
	if ($enviar) {
	// process form SELECT COUNT(*) FROM datos_pacientes;
	$result = mysqli_query($con, "SELECT id_paciente FROM datos_pacientes WHERE id_paciente = '$id_paciente';");

		if  ($id_genero == '0' ||  !isset($lugar_residencia)){
			$campoVacio = '<p class="warning mb-0">Sin esta información no se puede almacenar en la Base de Datos</p>';		
		}else if (mysqli_num_rows($result) > 0) {
			'<p class="warning mb-0">Estos datos ya los has almacenado</p>';		
		}else if ($ocupacion == '0' && $escolaridad !== '0' ){
			$query = "INSERT INTO datos_pacientes (id_paciente,hospital_paciente,rfc_paciente,iniciales_paciente, genero_paciente,edad_paciente,paciente_ocupacion,escolaridad_paciente,lugar_residencia_paciente) VALUES ('$id_paciente',N'$hospital','$rfc','$iniciales','$genero',N'$edad','$otra_ocupacion', N'$escolaridad','$lugar_residencia');INSERT INTO ocupaciones (ocupacion_tipo) VALUES ('$otra_ocupacion');INSERT INTO enfermedad_clasificacion (anios_evolucion, tipo_da, scorad_calculo, bsa_calculo, easi_calculo, iga_calculo, iga_modificado_calculo, id_paciente) VALUES (N'$anio_evol',N'$grado_da','$scorad_calculo','$bsa_calculo','$easi_calculo','$iga_calculo','$iga_modificado_calculo','$id_paciente');";
				if($estudiosLab !== null){
					foreach( $estudiosLab as $index => $estudioLab ) {
				  		$query .= mysqli_query($con,"INSERT INTO estudios_laboratorio (id_paciente,estudios_laboratorio,num_estudios_lab) VALUES('$id_paciente',N'$estudioLab','$cantidadEstLab[$index]');");
					}
				}
				if($procedimientos !== null){ 
					foreach( $procedimientos as $key => $procedimiento ) {
				  		$query .= mysqli_query($con,"INSERT INTO procedimientos (id_paciente,procedimiento,num_proced) VALUES('$id_paciente',N'$procedimiento','$cantidadProced[$key]');");
					}	
				}
				if($estudiosGab !== null){ 
				foreach( $estudiosGab as $indice => $estudioGab ) {
				  $query .= mysqli_query($con,"INSERT INTO estudios_gabinete (id_paciente,estudios_gabinete,num_estudios_gab) VALUES('$id_paciente',N'$estudioGab','$cantidadEstGab[$indice]');");
					}	
				}
				if($especialidadesSet !== null){ 
				foreach( $especialidadesSet as $each => $especialidadSet ) {
					$query .= mysqli_query($con,"INSERT INTO consultas (id_paciente,tipo_consulta,especialidad,num_consultas,fecha,medicamento,cantidad_medicamento,medida_medicamento) VALUES('$id_paciente','$tipo_consultaSet[$each]',N'$especialidadSet','$numConsultasSet[$each]','$fechaConsultaSet[$each]',N'$medicamentoSet[$each]','$cantidadConsultaSet[$each]','$medidaSet[$each]');");
					} 	
				}
				$query .= mysqli_query($con,"INSERT INTO caracterist_enfermedad (id_paciente,canti_exacerb,prurito,depresion,dias_consult_perdidos,dias_escol_perdidos,dias_acomp_perdidos,dias_urgenc_perdidos,dias_incap_perdidos,causa_visit_urgencia,hospitalizacion,dias_hospitalizacion) VALUES ('$id_paciente','$cantExacerbaciones',N'$prurito',N'$depresion','$dias_consul','$dias_escol','$dias_acomp','$dias_urgen','$dias_incap','$causa','$hospitalizacion','$dias_enHospital');");	
			if ($con->multi_query($query) === TRUE && (mysqli_errno($con) !== 1062)) {
				echo '<p style="text-align: center;">¡Hemos recibido sus datos!</p><br>';	
			} else {
			    //echo "Error: " . $query . "<br>" . $con->error;
			}
		}else if ($escolaridad == '0' && $ocupacion !== '0' ){
			$query = "INSERT INTO datos_pacientes (id_paciente,hospital_paciente,rfc_paciente,iniciales_paciente, genero_paciente,edad_paciente,paciente_ocupacion,escolaridad_paciente,lugar_residencia_paciente) VALUES ('$id_paciente',N'$hospital','$rfc','$iniciales','$genero',N'$edad','$ocupacion', N'$otra_escolaridad','$lugar_residencia');INSERT INTO escolaridad (escolaridad_nivel) VALUES ('$otra_escolaridad');INSERT INTO enfermedad_clasificacion (anios_evolucion, tipo_da, scorad_calculo, bsa_calculo, easi_calculo, iga_calculo, iga_modificado_calculo, id_paciente) VALUES (N'$anio_evol',N'$grado_da','$scorad_calculo','$bsa_calculo','$easi_calculo','$iga_calculo','$iga_modificado_calculo','$id_paciente');";
				if($estudiosLab !== null){
					foreach( $estudiosLab as $index => $estudioLab ) {
				  		$query .= mysqli_query($con,"INSERT INTO estudios_laboratorio (id_paciente,estudios_laboratorio,num_estudios_lab) VALUES('$id_paciente',N'$estudioLab','$cantidadEstLab[$index]');");
					}
				}
				if($procedimientos !== null){ 
					foreach( $procedimientos as $key => $procedimiento ) {
				  		$query .= mysqli_query($con,"INSERT INTO procedimientos (id_paciente,procedimiento,num_proced) VALUES('$id_paciente',N'$procedimiento','$cantidadProced[$key]');");
					}	
				}
				if($estudiosGab !== null){ 
				foreach( $estudiosGab as $indice => $estudioGab ) {
				  $query .= mysqli_query($con,"INSERT INTO estudios_gabinete (id_paciente,estudios_gabinete,num_estudios_gab) VALUES('$id_paciente',N'$estudioGab','$cantidadEstGab[$indice]');");
					}	
				}
				if($especialidadesSet !== null){ 
				foreach( $especialidadesSet as $each => $especialidadSet ) {
					$query .= mysqli_query($con,"INSERT INTO consultas (id_paciente,tipo_consulta,especialidad,num_consultas,fecha,medicamento,cantidad_medicamento,medida_medicamento) VALUES('$id_paciente','$tipo_consultaSet[$each]',N'$especialidadSet','$numConsultasSet[$each]','$fechaConsultaSet[$each]',N'$medicamentoSet[$each]','$cantidadConsultaSet[$each]','$medidaSet[$each]');");
					} 	
				}
				$query .= mysqli_query($con,"INSERT INTO caracterist_enfermedad (id_paciente,canti_exacerb,prurito,depresion,dias_consult_perdidos,dias_escol_perdidos,dias_acomp_perdidos,dias_urgenc_perdidos,dias_incap_perdidos,causa_visit_urgencia,hospitalizacion,dias_hospitalizacion) VALUES ('$id_paciente','$cantExacerbaciones',N'$prurito',N'$depresion','$dias_consul','$dias_escol','$dias_acomp','$dias_urgen','$dias_incap','$causa','$hospitalizacion','$dias_enHospital');");	
			if ($con->multi_query($query) === TRUE && (mysqli_errno($con) !== 1062)) {
				echo '<p style="text-align: center;">¡Hemos recibido sus datos!</p><br>';	
			} else {
			    //echo "Error: " . $query . "<br>" . $con->error;		    
			}
		}else if ($ocupacion == '0' && $escolaridad == '0' ){
			$query = "INSERT INTO datos_pacientes (id_paciente,hospital_paciente,rfc_paciente,iniciales_paciente, genero_paciente,edad_paciente,paciente_ocupacion,escolaridad_paciente,lugar_residencia_paciente) VALUES ('$id_paciente',N'$hospital','$rfc','$iniciales','$genero',N'$edad','$otra_ocupacion', N'$otra_escolaridad','$lugar_residencia');INSERT INTO ocupaciones (ocupacion_tipo) VALUES (N'$otra_ocupacion');INSERT INTO escolaridad (escolaridad_nivel) VALUES (N'$otra_escolaridad');INSERT INTO enfermedad_clasificacion (anios_evolucion, tipo_da, scorad_calculo, bsa_calculo, easi_calculo, iga_calculo, iga_modificado_calculo, id_paciente) VALUES (N'$anio_evol',N'$grado_da','$scorad_calculo','$bsa_calculo','$easi_calculo','$iga_calculo','$iga_modificado_calculo','$id_paciente');";
				if($estudiosLab !== null){
					foreach( $estudiosLab as $index => $estudioLab ) {
				  		$query .= mysqli_query($con,"INSERT INTO estudios_laboratorio (id_paciente,estudios_laboratorio,num_estudios_lab) VALUES('$id_paciente',N'$estudioLab','$cantidadEstLab[$index]');");
					}
				}
				if($procedimientos !== null){ 
					foreach( $procedimientos as $key => $procedimiento ) {
				  		$query .= mysqli_query($con,"INSERT INTO procedimientos (id_paciente,procedimiento,num_proced) VALUES('$id_paciente',N'$procedimiento','$cantidadProced[$key]');");
					}	
				}
				if($estudiosGab !== null){ 
				foreach( $estudiosGab as $indice => $estudioGab ) {
				  $query .= mysqli_query($con,"INSERT INTO estudios_gabinete (id_paciente,estudios_gabinete,num_estudios_gab) VALUES('$id_paciente',N'$estudioGab','$cantidadEstGab[$indice]');");
					}	
				}
				if($especialidadesSet !== null){ 
				foreach( $especialidadesSet as $each => $especialidadSet ) {
					$query .= mysqli_query($con,"INSERT INTO consultas (id_paciente,tipo_consulta,especialidad,num_consultas,fecha,medicamento,cantidad_medicamento,medida_medicamento) VALUES('$id_paciente','$tipo_consultaSet[$each]',N'$especialidadSet','$numConsultasSet[$each]','$fechaConsultaSet[$each]',N'$medicamentoSet[$each]','$cantidadConsultaSet[$each]','$medidaSet[$each]');");
					} 	
				}
				$query .= mysqli_query($con,"INSERT INTO caracterist_enfermedad (id_paciente,canti_exacerb,prurito,depresion,dias_consult_perdidos,dias_escol_perdidos,dias_acomp_perdidos,dias_urgenc_perdidos,dias_incap_perdidos,causa_visit_urgencia,hospitalizacion,dias_hospitalizacion) VALUES ('$id_paciente','$cantExacerbaciones',N'$prurito',N'$depresion','$dias_consul','$dias_escol','$dias_acomp','$dias_urgen','$dias_incap','$causa','$hospitalizacion','$dias_enHospital');");		
			if ($con->multi_query($query) === TRUE && (mysqli_errno($con) !== 1062)) {
				echo '<p style="text-align: center;">¡Hemos recibido sus datos!</p><br>';	
			} else {
			    //echo "Error: " . $query . "<br>" . $con->error;
			}
		}else {
			$query = "INSERT INTO datos_pacientes (id_paciente,hospital_paciente,rfc_paciente,iniciales_paciente, genero_paciente,edad_paciente,paciente_ocupacion,escolaridad_paciente,lugar_residencia_paciente) VALUES ('$id_paciente',N'$hospital','$rfc','$iniciales','$genero',N'$edad','$ocupacion', N'$escolaridad','$lugar_residencia');INSERT INTO enfermedad_clasificacion (id_paciente,anios_evolucion, tipo_da, scorad_calculo, bsa_calculo, easi_calculo, iga_calculo, iga_modificado_calculo) VALUES ('$id_paciente',N'$anio_evol',N'$grado_da','$scorad_calculo','$bsa_calculo','$easi_calculo','$iga_calculo','$iga_modificado_calculo');";
				if($estudiosLab !== null){
					foreach( $estudiosLab as $index => $estudioLab ) {
				  		$query .= mysqli_query($con,"INSERT INTO estudios_laboratorio (id_paciente,estudios_laboratorio,num_estudios_lab) VALUES('$id_paciente',N'$estudioLab','$cantidadEstLab[$index]');");
					}
				}
				if($procedimientos !== null){ 
					foreach( $procedimientos as $key => $procedimiento ) {
				  		$query .= mysqli_query($con,"INSERT INTO procedimientos (id_paciente,procedimiento,num_proced) VALUES('$id_paciente',N'$procedimiento','$cantidadProced[$key]');");
					}	
				}
				if($estudiosGab !== null){ 
				foreach( $estudiosGab as $indice => $estudioGab ) {
				  $query .= mysqli_query($con,"INSERT INTO estudios_gabinete (id_paciente,estudios_gabinete,num_estudios_gab) VALUES('$id_paciente',N'$estudioGab','$cantidadEstGab[$indice]');");
					}	
				}
				if($especialidadesSet !== null){ 
				foreach( $especialidadesSet as $each => $especialidadSet ) {
					$query .= mysqli_query($con,"INSERT INTO consultas (id_paciente,tipo_consulta,especialidad,num_consultas,fecha,medicamento,cantidad_medicamento,medida_medicamento) VALUES('$id_paciente','$tipo_consultaSet[$each]',N'$especialidadSet','$numConsultasSet[$each]','$fechaConsultaSet[$each]',N'$medicamentoSet[$each]','$cantidadConsultaSet[$each]','$medidaSet[$each]');");
					} 	
				}
				$query .= mysqli_query($con,"INSERT INTO caracterist_enfermedad (id_paciente,canti_exacerb,prurito,depresion,dias_consult_perdidos,dias_escol_perdidos,dias_acomp_perdidos,dias_urgenc_perdidos,dias_incap_perdidos,causa_visit_urgencia,hospitalizacion,dias_hospitalizacion) VALUES ('$id_paciente','$cantExacerbaciones',N'$prurito',N'$depresion','$dias_consul','$dias_escol','$dias_acomp','$dias_urgen','$dias_incap','$causa','$hospitalizacion','$dias_enHospital');");

			if ($con->multi_query($query) === TRUE && (mysqli_errno($con) !== 1062)) {
				echo '<p style="text-align: center;">¡Hemos recibido sus datos!</p><br>';

			} else{
	    		echo "Error: " . $query . "<br>" . $con->error;

			}	
		}
   
   	mysqli_close($con);
	}
}
?>