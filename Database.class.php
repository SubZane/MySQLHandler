<?php
/**
 * Query class for MySqlHandler
 * @package Database
 * @author Andreas Norman
 * @version 1.1
 */    
 class Database extends MySqlHandler {

/*************************************************
 * Configuration Variables
 ************************************************/
  private $server   = 'localhost';
  private $database = 'test';
  private $username = 'user';
  private $password = 'password';
  private $use_permanent_connection = false;
  private $xml_encoding = 'ISO-8859-1';
	      
  public function __destruct() {
    return true;
  }

  public function __construct($connect = true) {
    if ($connect) {
      $this->conn();
    }
  }
  
  private function conn() {
    if ($this->use_permanent_connection) {
      $this->pconnect($this->server,$this->username,$this->password, false);
    } else {
      $this->connect($this->server,$this->username,$this->password, false, false);
    }
    
    if (!$this->connection) {
      return false;
    } else {
  	  if (!$this->select_db($this->database, $this->connection)) {
  	   return false;
      } else {
        return true;
      }
    }
  }
  
  public function reconnect() {
    $this->close();
    $this->conn();
  }
  
  public function setServerParameters($server, $database) {
    $this->server=$server;
    $this->database=$database;
  }

  public function setAuthorizationParameters($username, $password) {
    $this->username=$username;
    $this->password=$password;
  }
  

  /**
  * Passes SQL query to MySQLHandler to execute it.
  * @author Andreas Norman
  * @version 1.0
  * @return XML/Dictionary/ResultSet
  * @param string $sql The SQL query
  * @param string $format The format of the return value
  *                       dictionary for Dictionary
  *                       xml for XML
  *                       NULL for ResultSet
  * */
  public function sqlQuery($sql, $format = 'dictionary')	{
	  $results = $this->query($sql);
	  if ($results) {
		  if (eregi("^select",$sql)) {
		    if (is_resource($results) && $this->num_rows($results) > 0) {
	        if ($format == 'xml') {
	          $data = $this->getXmlDocument($results);
	          $this->free_result($results);
	        } else if ($format == 'dictionary') {
	          $data = $this->makeDictionary($results);
	          $this->free_result($results);
	        } else {
	          $data = $results;
	        }
	        return $data;
	      } else {
	        return false;
	      }
	    } else if (eregi("^insert",$sql)) {
	      if ($this->affected_rows($results) > 0) {
	        return $this->insert_id($results);
	      } else {
				  return false;
				}
	    } else if (eregi("^update",$sql) || eregi("^delete",$sql) || eregi("^replace",$sql)) {
	      if ($this->affected_rows($results) > 0) {
		      return $this->affected_rows($results);
	      } else {
				  return false;
				}
	    } else {
	      return $results;
	    }
	  } else {
	    return false;
	  }
	}
	
	private function makeDictionary($results) {
    $i=0;  
    $data = array();
    while ($row = $this->fetch_array($results)) {
      $data[$i] = $row;
    	$i++;
    }
    return $data;
  }

  /**
  * Sets the XML encoding
  * @author Andreas Norman
  * @param string $xml_encoding UTF-8 for example
  * */
  public function setXmlEncoding($xml_encoding) {
    $this->xml_encoding = $xml_encoding;
  }

  private function getXmlDocument($results) {
		$doc = new DOMDocument('1.0', $this->xml_encoding);
		$doc->formatOutput = true;
		$databaseresults = $doc->createElement("database-results");
		
    $i = 0;
    while ($row = $this->fetch_row($results)) {    
			$node = $doc->createElement("row");
			$node->setAttribute("rownumber", $i);
      $j=0;
      for ($j=0; $j<count($row); $j++) {
				$col = $doc->createElement($this->field_name($results, $j));
				if (is_numeric($row[$j])) {
					$col->appendChild($doc->createTextNode($row[$j]));
				} else {
					$col->appendChild($doc->createCDATASection($row[$j]));
				}
				$col->setAttribute("type", $this->field_type($results, $j));
				$node->appendChild($col);
      }
      $i++;
			$databaseresults->appendChild($node);
    }
		
		$doc->appendChild($databaseresults);
		return $doc->saveXML();
  }  
}
?>
