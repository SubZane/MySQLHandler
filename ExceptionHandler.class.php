<?php
/**
 * Handles exceptions/errors
 * @package ExceptionHandler
 * @author Andreas Norman
 * @version 1.1
 */ 
class ExceptionHandler extends Exception {
  private static $database_error = array();
  private static $debug = true;
  
  public static function appendDatabaseError($sql, $error) {
    self::$database_error[count(self::$database_error)] = $error;
    if (self::$debug) {
			echo "<pre>SQL: ".$sql."\nError: ".$error."</pre>";
    }
  }
  
  private static function getDatabaseError() {
    return self::$database_error;
  }
  
  public static function printDatabaseErrors() {
    echo '<pre>';
    print_r(self::getDatabaseError());
    echo '</pre>';
  }

}
?>
