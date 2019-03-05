<?PHP
  namespace Clasificacion_enfermedad;
  require_once ('../bd_conection.php');
    $result=@mysqli_query($con, "SELECT * FROM clasificacion_enfermedad ORDER BY id_paciente ASC;");
    $data = array();

      while ($fila = @mysqli_fetch_array($result)) {
        $idPaciente = utf8_encode($fila["id_paciente"]);
        $a_evol = utf8_encode($fila["anios_evolucion"]);
        $tipo_da = utf8_encode($fila["tipo_da"]);
        $scorad = utf8_encode($fila["scorad_calculo"]);
        $bsa = utf8_encode($fila["bsa_calculo"]);
        $easi = utf8_encode($fila["easi_calculo"]);
        $iga = utf8_encode($fila["iga_calculo"]);
        $iga_modif = utf8_encode($fila["iga_modificado_calculo"]);
        
        $codigoPaciente = '#'. str_pad($idPaciente,5,"0",STR_PAD_LEFT);  

        $dataRow = array("CODIGO PACIENTE" => $codigoPaciente, utf8_decode("AÑOS EVOLUCIÓN") => $a_evol, "INICIALMENTE CONSIDERADO UNA DA" => $tipo_da,"SCORAD" => $scorad, "Solo porcentaje de superficie corporal afectada (BSA)" => $bsa,"EASI" => $easi, "IGA" => $iga, "No utiliza - Calculo de IGA modificado" => $iga_modif);
        array_push($data , $dataRow);
      }
  // Original PHP code by Chirp Internet: www.chirp.com.au
  // Please acknowledge use of this code by including this header.

  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    $str = utf8_decode( $str);
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  // file name for download
  $filename = "clasificacion_enfermedad_" . date('Ymd') . ".xls";
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