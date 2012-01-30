<?php

/**
 * Description of JediBookBD
 *
 * @author elena i jordi 
 */
class JediBookBD {
    protected $idConnection;
    protected $user;
    protected $pass;
    protected $db;
    protected $host;
    
    function __construct($host, $user, $pass, $db) {
        $this->db = $db;
        $this->host = $host;
        $this->pass = $pass;
        $this->user = $user;
        $this->idConnection = mysql_connect($host, $user, $pass); 
        mysql_select_db($db, $this->idConnection);
    }
    
    function selectSQL($query) {
        $consulta = mysql_query($query, $this->idConnection);
        $res = array();
        $aux = array();
        while (($aux = mysql_fetch_assoc($consulta)) !== false) {
            $res[] = $aux;
        }
        return $res;
    }
    
    function allSQL($query){
        mysql_query($query, $this->idConnection);
        return mysql_affected_rows($this->idConnection);
    }
    
    function close() {
        mysql_close($this->idConnection);
    }        
}

?>
