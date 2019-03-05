<?PHP
  namespace Estudios_gabinete;
  require_once ('../bd_conection.php');
    $result=@mysqli_query($con, "SELECT * FROM estudios_gabinete ORDER BY id_paciente ASC;");
    $result2=@mysqli_query($con, "SELECT * FROM estudios_gabinete_tipos ORDER BY tipo_estudio_gabinete ASC;"); 
    
    $est_tipo = array();
    $num_estdsTotales=array(); 
    $idsPaciente = array();
    $estGabPacnt = array();  
    $est_gab=array();   
    $pacienteEstdios = array();  
    $data = array();

  while ($EG = @mysqli_fetch_array($result))
  {
    $idPaciente = isset($EG["id_paciente"]) ? $EG["id_paciente"] : '';
    $tipo_est_paciente = isset($EG["estudios_gabinete"]) ? $EG["estudios_gabinete"] : '';
    $num_est = isset($EG["num_estudios_gab"]) ? $EG["num_estudios_gab"] : '';
       
    $pacienteEstdios[$EG["id_paciente"]][$EG["tipo_consulta"]][$EG["estudios_gabinete"]] = $EG["num_estudios_gab"] ;

    array_push($est_tipo , $tipo_est_paciente);
    array_push($num_estdsTotales , $num_est);
    array_push($idsPaciente , $idPaciente);

    $estynum = array($tipo_est_paciente => $num_est);
    array_push($estGabPacnt , $estynum);    
  }

  while ($TE = @mysqli_fetch_array($result2) )
  {
    $tipo_est = isset($TE["tipo_estudio_gabinete"]) ?  $TE["tipo_estudio_gabinete"] : '';
    array_push($est_gab , $tipo_est);
  } 

  $estTotales = array_merge($est_gab, $est_tipo);      
  $cantEstds = sizeof($estTotales);       
  $ceros = array(); 
  for ($i=0; $i<$cantEstds;$i++){
    array_push($ceros , '0');
  }

  $totalEst=array_combine($estTotales, $ceros);     
  foreach ($pacienteEstdios as $key => $value) {
    foreach ($value as $k => $v) {
      $estdCombinados = array_merge($totalEst, $v); 
      $pacienteEstdios[$key][$k] = $estdCombinados;
    }
  }     

  foreach ($pacienteEstdios as $key => &$value) {
    $codigoPaciente = '#'. str_pad($key,5,"0",STR_PAD_LEFT);  
    foreach ($value as $k => $v) {
      $estdiosPorPaciente = array('TIPO DE CONSULTA' => $k)+$v;
      $estdiosPorPaciente = array('CODIGO PACIENTE' => $codigoPaciente)+$estdiosPorPaciente;
      array_push($data , $estdiosPorPaciente);
    }
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
  $filename = "estudios_gabinete_" . date('Ymd') . ".xls";
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