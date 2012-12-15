<?php
require_once('ExceptionHandler.class.php');
require_once('MySqlInterface.interface.php');
require_once('MySQLHandler.class.php');
require_once('Database.class.php');

$Database = new Database();

$data = $Database->sqlQuery("SELECT * FROM test");
print_r($data);
?>