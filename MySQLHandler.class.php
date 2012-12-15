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
 * Wrapper for MySQL
 * @package MySqlHandler
 * @author Andreas Norman
 * @version 1.0
 */   
class MySqlHandler implements MySqlInterface {
  protected $connection;
  
  public function connect($server, $username, $password, $new_connection, $client_flags) {
    if ($new_connection && $client_flags) {
      $this->connection = mysql_connect($server, $username, $password, $new_connection, $client_flags);
    } else if ($new_connection && !$client_flags) {
      $this->connection = mysql_connect($server, $username, $password, $new_connection);
    } else {
      $this->connection = mysql_connect($server, $username, $password);
    }
    
  }

  public function pconnect($server, $username, $password, $client_flags) {
    if ($client_flags) {
      $this->connection = mysql_pconnect($server, $username, $password, $client_flags);
    } else {
      $this->connection = mysql_pconnect($server, $username, $password);
    }
  }

  public function errno() {
    if ($this->connection) {
      return mysql_errno($this->connection);
    }
  }

  public function error() {
    if ($this->connection) {
      return mysql_error($this->connection);
    }
  }

  public static function escape_string($string) {
    return mysql_real_escape_string($string);
  }

  public function query($query) {
    $rs = mysql_query($query, $this->connection);
  	if (!$rs) {
 	 	  ExceptionHandler::appendDatabaseError($query, $this->error());
 	 	  return false;
		} else {
	    return $rs;
		}
  }

  public function fetch_array($result, $result_type = false) {
    if ($result_type) {
      return mysql_fetch_array($result, $result_type);
    } else {
      return mysql_fetch_array($result);
    }
  }

  public function fetch_row($result) {
    return mysql_fetch_row($result);
  }

  public function fetch_assoc($result) {
    return mysql_fetch_assoc($result);
  }

  public function fetch_object($result) {
    return mysql_fetch_object($result);
  }

  public function affected_rows() {
    return mysql_affected_rows($this->connection);
  }

  public function num_rows($result) {
    return mysql_num_rows($result);
  }

  public function close() {
    return mysql_close($this->connection);
  }
  
  public function change_user($username, $password, $database) {
    return mysql_change_user($username, $password, $database);
  }

  public function client_encoding() { 
    return mysql_client_encoding($this->connection);
  }
  
  public function create_db($database_name) { 
    return mysql_create_db($database_name, $this->connection);
  }
  
  public function data_seek($result, $row_number) { 
    return mysql_data_seek($result, $row_number);
  }
  
  public function db_name($result, $row, $field = false) { 
    if ($field) {
      return mysql_db_name($result, $row, $field);
    } else {
      return mysql_db_name($result, $row);
    }
  }
  
  public function drop_db($database_name) { 
    return mysql_drop_db($database_name, $this->connection);
  }
  
  public function fetch_field($result, $field_offset = false) { 
    if ($field_offset) {
      return mysql_fetch_field($result, $field_offset);
    } else {
      return mysql_fetch_field($result);
    }
  }
  
  public function fetch_lengths($result) { 
    return mysql_fetch_lengths($result);
  }
  
  public function field_flags($result, $field_offset) { 
    return mysql_field_flags($result, $field_offset);
  }
  
  public function field_len($result, $field_offset) { 
    return mysql_field_len($result, $field_offset);
  }
  
  public function field_name($result, $field_offset) { 
    return mysql_field_name($result, $field_offset);
  }
  
  public function field_seek($result, $field_offset) { 
    return mysql_field_seek($result, $field_offset);
  }
  
  public function field_table($result, $field_offset) { 
    return mysql_field_table($result, $field_offset);
  }
  
  public function field_type($result, $field_offset) { 
    return mysql_field_type($result, $field_offset);
  }
  
  public function free_result($result) { 
    return mysql_free_result($result);
  }
  
  public function get_client_info() { 
    return mysql_get_client_info();
  }
  
  public function get_host_info() { 
    return mysql_get_host_info($this->connection);
  }
  
  public function get_proto_info() { 
    return mysql_get_proto_info($this->connection);
  }
  
  public function get_server_info() { 
    return mysql_get_server_info($this->connection);
  }
  
  public function info() { 
    return mysql_info($this->connection);
  }
  
  public function insert_id() { 
    return mysql_insert_id($this->connection);
  }
  
  public function list_dbs() { 
    return mysql_list_dbs($this->connection);
  }
  
  public function list_fields($database_name, $table_name) { 
    return mysql_list_fields($database_name, $table_name, $this->connection);
  }
  
  public function list_processes() { 
    return mysql_list_processes($this->connection);
  }
  
  public function list_tables($database_name) { 
    return mysql_list_tables($database_name, $this->connection);
  }
  
  public function num_fields($result) { 
    return mysql_num_fields($result);
  }
  
  public function ping() { 
    return mysql_ping($this->connection);
  }
  
  public static function real_escape_string($unescaped_string) { 
    return mysql_real_escape_string($unescaped_string);
  }
  
  public function result($result, $row, $field = false) { 
    if ($field) {
      return mysql_result($result, $row, $field);
    } else {
      return mysql_result($result, $row);
    }
  }
  
  public function select_db($database_name) { 
    return mysql_select_db($database_name, $this->connection);
  }
  
  public function stat() { 
    return mysql_stat($this->connection);
  }
  
  public function tablename($result, $i) { 
    return mysql_tablename($result, $i);
  }
  
  public function thread_id() { 
    return mysql_thread_id($this->connection);
  }
  
  public function unbuffered_query($query) { 
    return mysql_unbuffered_query($query);
  }  
}


?>