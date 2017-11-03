<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 'on');
ini_set('max_execution_time','420');  
ini_set('memory_limit','100M');
$conexion = mssql_connect("127.0.0.1","sa","somela2005") or die("Error");
mssql_select_db("prueba");
?>