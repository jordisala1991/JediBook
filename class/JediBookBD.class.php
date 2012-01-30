<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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
        mysql_connect($host, $user, $pass); 
    }
    
    
    
}

?>
