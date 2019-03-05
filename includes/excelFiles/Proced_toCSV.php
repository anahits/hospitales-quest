<?PHP
  namespace Procedimientos;
  require_once ('../bd_conection.php');
    $result=@mysqli_query($con, "SELECT * FROM procedimientos ORDER BY id_paciente ASC;");
    $result2=@mysqli_query($con, "SELECT * FROM procedimientos_tipos ORDER BY tipo_procedimiento ASC;"); 
    
    $proced_tipo = array();
    $num_procedTotales=array(); 
    $idsPaciente = array();
    $procedPacnt = array();  
    $procedmto=array(); 
    $pacienteProcedtos = array(); 
    $data = array();   

  while ($PR = @mysqli_fetch_array($result))
  {
    $idPaciente = isset($PR["id_paciente"]) ? $PR["id_paciente"] : '';
    $tipo_proced_paciente = isset($PR["procedimiento"]) ? $PR["procedimiento"] : '';
    $num_proced = isset($PR["num_proced"]) ? $PR["num_proced"] : '';
       
    $pacienteProcedtos[$PR["id_paciente"]][$PR["tipo_consulta"]][$PR["procedimiento"]] = $PR["num_proced"] ;

    array_push($proced_tipo , $tipo_proced_paciente);
    array_push($num_procedTotales , $num_proced);
    array_push($idsPaciente , $idPaciente);

    $procedynum = array($tipo_proced_paciente => $num_proced);
    array_push($procedPacnt , $procedynum);    
  }

  while ($TP = @mysqli_fetch_array($result2) )
  {
    $tipo_est = isset($TP["tipo_procedimiento"]) ?  $TP["tipo_procedimiento"] : '';
    array_push($procedmto , $tipo_est);
  } 

  $procedTotales = array_merge($procedmto, $proced_tipo);      
  $cantPorceds = sizeof($procedTotales);       
  $ceros = array(); 
  for ($i=0; $i<$cantPorceds;$i++){
    array_push($ceros , '0');
  }

  $totalEst=array_combine($procedTotales, $ceros);     
  foreach ($pacienteProcedtos as $key => $value) {
    foreach ($value as $k => $v) {
        $procedCombinados = array_merge($totalEst, $v); 
        $pacienteProcedtos[$key][$k] = $procedCombinados;
    }
  }     

  foreach ($pacienteProcedtos as $key => &$value) {
    $codigoPaciente = '#'. str_pad($key,5,"0",STR_PAD_LEFT);  
    foreach ($value as $k => $v) {
      $procedsPorPaciente = array('TIPO DE CONSULTA' => $k)+$v;
      $procedsPorPaciente = array('CODIGO PACIENTE' => $codigoPaciente)+$procedsPorPaciente;
      array_push($data , $procedsPorPaciente);
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
  $filename = "procedimientos_" . date('Ymd') . ".xls";
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