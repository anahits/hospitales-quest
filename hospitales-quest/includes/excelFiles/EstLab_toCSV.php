<?PHP
  namespace Estudios_laboratorio;
  require_once ('../bd_conection.php');
    $result=@mysqli_query($con, "SELECT * FROM estudios_laboratorio ORDER BY id_paciente ASC;");
    $result2=@mysqli_query($con, "SELECT * FROM estudios_laboratorio_tipos ORDER BY tipo_estudio_laboratorio ASC;"); 
    
    $est_tipo = array();
    $num_ests_Totales=array(); 
    $idsPaciente = array();
    $estLabPacnt = array();  
    $est_lab=array();    
    $pacienteEstdios = array();    
    $data = array();

  while ($EL = @mysqli_fetch_array($result))
  {
    $idPaciente = isset($EL["id_paciente"]) ? $EL["id_paciente"] : '';
    $tipo_est_paciente = isset($EL["estudios_laboratorio"]) ? $EL["estudios_laboratorio"] : '';
    $num_est = isset($EL["num_estudios_lab"]) ? $EL["num_estudios_lab"] : '';
      
    $pacienteEstdios[$EL["id_paciente"]][$EL["estudios_laboratorio"]] = $EL["num_estudios_lab"];

    array_push($est_tipo , $tipo_est_paciente);
    array_push($num_ests_Totales , $num_est);
    array_push($idsPaciente , $idPaciente);

    $estynum = array($tipo_est_paciente => $num_est);
    array_push($estLabPacnt , $estynum);    
  }

  while ($TE = @mysqli_fetch_array($result2) )
  {
    $tipo_est = isset($TE["tipo_estudio_laboratorio"]) ?  $TE["tipo_estudio_laboratorio"] : '';
    array_push($est_lab , $tipo_est);
  } 

  $estTotales = array_merge($est_lab, $est_tipo);      
  $cantEstds = sizeof($estTotales);       
  $ceros = array(); 
  for ($i=0; $i<$cantEstds;$i++){
    array_push($ceros , '0');
  }

  $totalEst=array_combine($estTotales, $ceros);     
  foreach ($pacienteEstdios as $key => $value) {
    $estdCombinados = array_merge($totalEst, $value); 
    $pacienteEstdios[$key] = $estdCombinados;
  }     

  foreach ($pacienteEstdios as $key => &$value) {
    $codigoPaciente = '#'. str_pad($key,5,"0",STR_PAD_LEFT);  
    $estdiosPorPaciente = array('CODIGO PACIENTE' => $codigoPaciente)+$value;
    array_push($data , $estdiosPorPaciente);
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
  $filename = "estudios_laboratorio_" . date('Ymd') . ".xls";
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