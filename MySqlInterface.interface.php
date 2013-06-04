<?php
/**
 * Interface for MySQL
 * @package MySqlInterface
 * @author Andreas Norman
 * @version 1.0
 */  
interface MySqlInterface {
    public function connect($server, $username, $password, $new_connection, $client_flags);
    public function error();
    public function errno();
    public static function escape_string($string);
    public function query($query);
    public function fetch_array($result, $result_type = false);
    public function fetch_row($result);
    public function fetch_assoc($result);
    public function fetch_object($result);
    public function num_rows($result);
    public function close();
    public function affected_rows();
    public function change_user($username, $password, $database);
    public function client_encoding();
    public function create_db($database_name);
    public function data_seek($result, $row_number);
    public function db_name($result, $row, $field = false);
    public function drop_db($database_name);
    public function fetch_field($result, $field_offset = false);
    public function fetch_lengths($result);
    public function field_flags($result, $field_offset);
    public function field_len($result, $field_offset);
    public function field_name($result, $field_offset);
    public function field_seek($result, $field_offset);
    public function field_table($result, $field_offset);
    public function field_type($result, $field_offset);
    public function free_result($result);
    public function get_client_info();
    public function get_host_info();
    public function get_proto_info();
    public function get_server_info();
    public function info();
    public function insert_id();
    public function list_dbs();
    public function list_fields($database_name, $table_name);
    public function list_processes();
    public function list_tables($database_name);
    public function num_fields($result);
    public function pconnect($server, $username, $password, $client_flags);
    public function ping();
    public static function real_escape_string($unescaped_string);
    public function result($result, $row, $field = false);
    public function select_db($database_name);
    public function stat();
    public function tablename($result, $i);
    public function thread_id();
    public function unbuffered_query($query);
}
?>
