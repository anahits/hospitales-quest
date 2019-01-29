<?php
	$bd_host  = 'localhost';
	$bd_user = 'root';
	$bd_pass = '';
	$bd_name = 'sumawebd_cuestionario';

	// 1. Create a database connection
$con = @mysqli_connect($bd_host, $bd_user, $bd_pass, $bd_name);
if (!$con) {
    die("Database connection failed");
} else{
	    		echo mysqli_error($con);

			}

// 2. Select a database to use 
$db_select = @mysqli_select_db($con,$bd_name);
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($con));
} else{
	    		echo mysqli_error($con);

			}

?>