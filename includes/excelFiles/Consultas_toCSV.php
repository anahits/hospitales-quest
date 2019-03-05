<?PHP
  namespace Consultas;
  require_once ('../bd_conection.php');
    $result=@mysqli_query($con, "SELECT * FROM consultas ORDER BY id_paciente ASC;");
    $data = array();

      while ($fila = @mysqli_fetch_array($result)) {
        $idPaciente = $fila["id_paciente"];
        $numConsulta = $fila["num_consulta"];
        $tipo_consul = $fila["tipo_consulta"];
        $especialidad= $fila["especialidad"];
        $fecha_consulta = $fila["fecha"] !== '0000-00-00' ? $fila["fecha"]:'';
        $causa = $fila["causa_urgencia"];
        $num_hrs_urgen = $fila["num_horas_urgencias"];
        $requirio_hositali = $fila["hospitaliza_urgencias"];
        $dias_hospitali = $fila["dias_hospital_urgen"];
        $medicam = $fila["medicamento"];
        $tipo_medicam = $fila["tipo_medicamento"];
        $cant_medica = $fila["cantidad_medicamento"];        
        $medida_medica = $fila["medida_medicamento"];
        $cda_hrs = $fila["cada_horas"];
        $drnte_dias = $fila["durante_dias"];
        
        $codigoPaciente = '#'. str_pad($idPaciente,5,"0",STR_PAD_LEFT);  

        $dataRow = array("CODIGO PACIENTE" => $codigoPaciente,  utf8_decode("NÚM DE CONSULTA") => $numConsulta,"TIPO DE CONSULTA" => $tipo_consul, "ESPECIALIDAD" => $especialidad, "FECHA" => $fecha_consulta, utf8_decode("CAUSA O DIAGNÓSTICO") => $causa,  utf8_decode("NÚMERO DE HORAS") => $num_hrs_urgen,  utf8_decode("¿REQUIRIO DE HOSPITALIZACIÓN") => $requirio_hositali,  utf8_decode("DÍAS EN HOSPITALIZACIÓN") => $dias_hospitali, "MEDICAMENTOS" => $medicam,"TIPO MEDICAMENTOS" => $tipo_medicam, "CANTIDAD" => $cant_medica, "MEDIDA" => $medida_medica, "CADA HORAS" => $cda_hrs,  utf8_decode("DURANTE DÍAS") => $drnte_dias);
        array_push($data , $dataRow);
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
  $filename = "consultas_" . date('Ymd') . ".xls";
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