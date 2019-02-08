<?php
    $update = false;

    $hospital = "";
    $rfc = "";
    $iniciales = "";
    $genero_id= "";
    $edad = "";
    $ocupacion = "";
    $escolaridad = "";
    $lugar_residencia = "";
    $edo_id = "";
    $inicio_consultas = "";
    $fin_consultas = "";
    
    $canti_exacerb="";
    $prurito = "";
    $depresion = "";
    $dias_consult_perdidos = "";
    $dias_escol_perdidos = "";
    $dias_acomp_perdidos = "";
    $dias_urgenc_perdidos = "";
    $dias_incap_perdidos = "";

    $anios_evolucion = "";
    $tipo_da = "";
    $scorad_calculo = "";
    $bsa_calculo = "";
    $easi_calculo = "";
    $iga_calculo = "";
    $iga_modificado_calculo = "";


    if(isset($_GET["edit"])){
        $id = $_GET['edit'];
        $update = true;
        $datos_pacientes = @mysqli_query($con,"SELECT * FROM datos_pacientes WHERE iddatos_pacientes=$id");
        if (count($datos_pacientes)==1){
            $DP =  $datos_pacientes->fetch_array();
            $hospital = $DP['hospital_paciente'];
            $rfc = $DP['rfc_paciente'];
            $iniciales = $DP['iniciales_paciente'];
            ($DP['genero_paciente'] == 'Mujer') ? $genero_id = '1':$genero_id ='2';
            $edad =  utf8_encode($DP['edad_paciente']);
            $ocupacion = $DP['paciente_ocupacion'];
            $escolaridad = $DP['escolaridad_paciente'];
            $lugar_residencia = $DP['lugar_residencia_paciente'];
            $edo_id = $DP['estado_pais_paciente'];
            $inicio_consultas = $DP['inicio_consultas'];
            $fin_consultas = $DP['fin_consultas'];
        }
        $caracterist_enfermedad = @mysqli_query($con,"SELECT * FROM caracterist_enfermedad WHERE id_paciente=$id");
        if (count($caracterist_enfermedad)==1){
            $CarEnf =  $caracterist_enfermedad->fetch_array();
            $canti_exacerb = $CarEnf['canti_exacerb'];
            $prurito = $CarEnf['prurito'];
            $depresion = $CarEnf['depresion'];
            $dias_consult_perdidos = $CarEnf['dias_consult_perdidos'];
            $dias_escol_perdidos = $CarEnf['dias_escol_perdidos'];
            $dias_acomp_perdidos = $CarEnf['dias_acomp_perdidos'];
            $dias_urgenc_perdidos = $CarEnf['dias_urgenc_perdidos'];
            $dias_incap_perdidos = $CarEnf['dias_incap_perdidos'];
        }
        $clasificacion_enfermedad = @mysqli_query($con,"SELECT * FROM clasificacion_enfermedad WHERE id_paciente=$id");
        if (count($clasificacion_enfermedad)==1){
            $ClasEnf =  $clasificacion_enfermedad->fetch_array();
            $anios_evolucion = $ClasEnf['anios_evolucion']; 
            $tipo_da = utf8_encode($ClasEnf['tipo_da']);
            $scorad_calculo = $ClasEnf['scorad_calculo'];
            $bsa_calculo = $ClasEnf['bsa_calculo'];
            $easi_calculo = $ClasEnf['easi_calculo'];
            $iga_calculo = $ClasEnf['iga_calculo'];
            $iga_modificado_calculo = $ClasEnf['iga_modificado_calculo'];
        }          
    }
