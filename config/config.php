<?php
 $mysqli= new mysqli('localhost','raamjaap_test',']ozPr@7G+cPa','raamjaap_test');
//print_r($mysqli);
if($mysqli->connect_error)
{
	echo $mysqli->connect_error;
}
?>