<?php
/*  
 MySQLHandler :: MySql Wrapper. Version 2.1
 Copyright (C) 2002-2006 Andreas Norman. All rights reserved.
Visit http://www.subzane.com for more information about this script.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License Version 2, as 
published by the Free Software Foundation in June 1991.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along 
with this program (intouch-license-gpl.txt); if not, write to the 

	Free Software Foundation, Inc., 
	59 Temple Place, 
	Suite 330, 
	Boston, 
	MA 02111-1307 USA
 */
 
 
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