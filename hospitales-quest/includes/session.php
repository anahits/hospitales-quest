<?php
   session_start();
   // Page was not reloaded via a button press
   if (!isset($_POST['submitTodo'])) {
       $id_paciente = $_SESSION['attnum'] = uniqid(); // Reset counter
   }
?>