<?php
	require_once ('bd_conection.php');

	if (isset($_POST["updateTodo"])){
	// process form SELECT COUNT(*) FROM datos_pacientes;
        $paciente_id = $_POST['pacienteId'];

			function existe_registro ($valor,$tabla,$columna){
				include("bd_conection.php");
				$result = @mysqli_query($con, "SELECT * FROM $tabla WHERE $columna LIKE '$valor'");
				$rowcount=mysqli_num_rows($result);
				if ($rowcount > 0){	
					while($existeValor = @mysqli_fetch_assoc($result)) {   
						return $existeValor[$columna];
					}
				}else if ($valor !== "") {
					@mysqli_query($con, "INSERT INTO $tabla ($columna) VALUES ('$valor')");			
					return $valor;
				}
			}
			$existe_ocupacion = existe_registro($valor=utf8_decode($ocupacion),$tabla = 'ocupaciones', $columna = 'ocupacion_tipo');
			$existe_escolaridad = existe_registro($valor=utf8_decode($escolaridad),$tabla = 'escolaridad', $columna = 'escolaridad_nivel');	

		$query = "UPDATE datos_pacientes SET hospital_paciente=N'$hospital',rfc_paciente='$rfc',iniciales_paciente='$iniciales', genero_paciente='$genero',edad_paciente=N'$edad',paciente_ocupacion='$existe_ocupacion',escolaridad_paciente='$existe_escolaridad',lugar_residencia_paciente='$lugar_residencia',estado_pais_paciente='$estado',inicio_consultas='$inicio_consultas',fin_consultas='$fin_consultas' WHERE iddatos_pacientes=$paciente_id;";

		$query .= "UPDATE caracterist_enfermedad SET canti_exacerb='$cantExacerbaciones',prurito=N'$prurito',depresion=N'$depresion',dias_consult_perdidos='$diasConsultaTotal',dias_escol_perdidos='$dias_escol',dias_acomp_perdidos='$dias_acomp',dias_urgenc_perdidos='$diasUrgenciasTotal',dias_incap_perdidos='$dias_incap' WHERE id_paciente=$paciente_id;";
		 		
		$query .= "DELETE FROM estudios_laboratorio WHERE id_paciente=$paciente_id;";
		if($estudiosLab !== null){
			foreach( $estudiosLab as $index => $estudioLab ) {
				$existe_estudioLab = existe_registro($valor=utf8_decode($estudioLab),$tabla = 'estudios_laboratorio_tipos', $columna = 'tipo_estudio_laboratorio');
				$query .= "INSERT INTO estudios_laboratorio (id_paciente,tipo_consulta,estudios_laboratorio,num_estudios_lab) VALUES('$paciente_id',N'$tipoConsulEstLab[$index]','$existe_estudioLab','$cantidadEstLab[$index]');";
			}
		}
		
		$query .= "DELETE FROM pruebas_alergia WHERE id_paciente=$paciente_id;";
		if($pruebsAlerg !== null){ 
			foreach( $pruebsAlerg as $index => $pruebAlerg ) {
				$existe_pruebAlerg = existe_registro($valor = utf8_decode($pruebAlerg), $tabla='pruebas_alergia_tipos', $columna='tipo_prueba_alergia');
		  		$query .= "INSERT INTO pruebas_alergia (id_paciente,tipo_consulta,pruebas_alergia,num_prueba_alerg) VALUES('$paciente_id',N'$tipoConsulPruebAlerg[$index]','$existe_pruebAlerg','$cantidadpruebAlerg[$index]');";
			}	
		}

		$query .= "DELETE FROM estudios_gabinete WHERE id_paciente=$paciente_id;";
		if($estudiosGab !== null){ 
			foreach( $estudiosGab as $index => $estudioGab ) {
				$existe_estudioGab = existe_registro($valor = utf8_decode($estudioGab), $tabla='estudios_gabinete_tipos', $columna='tipo_estudio_gabinete');
			  	$query .= "INSERT INTO estudios_gabinete (id_paciente,tipo_consulta,estudios_gabinete,num_estudios_gab) VALUES('$paciente_id',N'$tipoConsulEstGab[$index]','$existe_estudioGab','$cantidadEstGab[$index]');";
			}	
		}

		$query .= "DELETE FROM procedimientos WHERE id_paciente=$paciente_id;";
		if($procedimientos !== null){ 
			foreach( $procedimientos as $index => $procedimiento ) {
				$existe_proced= existe_registro($valor = utf8_decode($procedimiento), $tabla='procedimientos_tipos', $columna='tipo_procedimiento');
		  		$query .=  "INSERT INTO procedimientos (id_paciente,tipo_consulta,procedimiento,num_proced) VALUES('$paciente_id',N'$tipoConsulProced[$index]','$existe_proced','$cantidadProced[$index]');";
			}	
		}

		$query .= "DELETE FROM consultas WHERE id_paciente=$paciente_id;";
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
				
		if($anio_evol !== '' || $grado_da !== '' || $scorad_calculo !== '' || $bsa_calculo !== '' || $easi_calculo !== '' || $iga_calculo !== '' || $iga_modificado_calculo) { 
			$query .= "UPDATE clasificacion_enfermedad SET anios_evolucion=N'$anio_evol', tipo_da=N'$grado_da', scorad_calculo='$scorad_calculo', bsa_calculo='$bsa_calculo', easi_calculo='$easi_calculo', iga_calculo='$iga_calculo', iga_modificado_calculo='$iga_modificado_calculo' WHERE id_paciente=$paciente_id;";
		}

        if (@mysqli_multi_query($con, $query) === TRUE && (@mysqli_errno($con) !== 1062)) {
			echo '<div class="alert alert-success" style="text-align: center;">¡Hemos actualizado sus datos!</div><br>'.$con->error;
		} else {
	    	echo "Error: " . $query . "<br>" . $con->error;
		}	
  
   	mysqli_close($con);
}
?>