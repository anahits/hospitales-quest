<?PHP
  namespace Datos_pacientes;
  require_once ('../bd_conection.php');
    $result=@mysqli_query($con, "SELECT * FROM datos_pacientes ORDER BY iddatos_pacientes ASC;");   
    $result2=@mysqli_query($con, "SELECT * FROM caracterist_enfermedad ORDER BY id_paciente ASC;");

    $data = array();

      while ($DP = @mysqli_fetch_array($result) and $CE = @mysqli_fetch_array($result2)) {
        $idPaciente = $DP["iddatos_pacientes"];
        $hospital = $DP["hospital_paciente"];
        $rfc = $DP["rfc_paciente"];
        $iniciales = $DP["iniciales_paciente"];
        $genero = $DP["genero_paciente"];
        $edad = $DP["edad_paciente"];
        $ocupacion = $DP["paciente_ocupacion"];
        $escolaridad = $DP["escolaridad_paciente"];
        $residencia = $DP["lugar_residencia_paciente"];
        $estado = $DP["estado_pais_paciente"];
        $inicio_consultas =  $DP["inicio_consultas"] !== '0000-00-00' ? 'De '.$DP["inicio_consultas"]:'';
        $fin_consultas =  $DP["fin_consultas"] !== '0000-00-00' ? ' a '.$DP["fin_consultas"]:'';

        $canti_exacerb = $CE["canti_exacerb"];
        $prurito = $CE["prurito"];
        $depresion = $CE["depresion"];
        $dias_consult_perdidos = $CE["dias_consult_perdidos"];
        $dias_escol_perdidos = $CE["dias_escol_perdidos"];
        $dias_acomp_perdidos = $CE["dias_acomp_perdidos"];
        $dias_urgenc_perdidos = $CE["dias_urgenc_perdidos"];
        $dias_incap_perdidos = $CE["dias_incap_perdidos"];
        
        $codigoPaciente = '#'. str_pad($idPaciente,5,"0",STR_PAD_LEFT);  

        $dataRow = array("CODIGO PACIENTE" => $codigoPaciente, "HOSPITAL" => $hospital, "RFC" => $rfc,"INICIALES PACIENTE" => $iniciales, "GENERO" => $genero, "EDAD" => $edad,utf8_decode("OCUPACIÓN") => $ocupacion, "ESCOLARIDAD" => $escolaridad, "LUGAR DE RESIDENCIA" => $residencia, "ESTADO" => $estado, "PERIODO DE TOMA DE DATOS DE EXPEDIENTES" => $inicio_consultas . $fin_consultas,"CANTIDAD DE EXACERBACIONES O BROTES" => $canti_exacerb,"PRESENTO PRURITO" => $prurito,utf8_decode("PRESENTO DEPRESIÓN") => $depresion,utf8_decode("DÍAS DE CONSULTA PERDIDOS") => $dias_consult_perdidos,utf8_decode("DÍAS ESCOLARES PERDIDOS") => $dias_escol_perdidos,utf8_decode("DÍAS DEL ACOMPAÑANTE") => $dias_acomp_perdidos,utf8_decode("DÍAS ASISTENCIA URGENCIAS") => $dias_urgenc_perdidos,utf8_decode("DÍAS DE INCAPACIDAD") => $dias_incap_perdidos);
        array_push($data, $dataRow);
      }

  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.

  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // file name for download
  $filename = "datos_paciente_" . date('Ymd') . ".xls";
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: text/html;charset=UTF-8");
  header("Content-Type: application/vnd.ms-excel");

  $flag = false;
  foreach($data as $row) {
    if(!$flag) {
      // display field/column names as first row
      echo implode("\t", array_keys($row)) . "\n";
      $flag = true;
    }
    array_walk($row, __NAMESPACE__ . '\cleanData');
    echo implode("\t", array_values($row)) . "\n";
  }

  exit;

?>