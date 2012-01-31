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
    
    function insertSQL($query) {
        mysql_query($query, $this->idConnection);
        return mysql_insert_id($this->idConnection);        
    }
    
    function updateSQL($query) {
        mysql_query($query, $this->idConnection);
        return mysql_affected_rows($this->idConnection);        
    }
    
    function deleteSQL($query){
        mysql_query($query, $this->idConnection);
        return mysql_affected_rows($this->idConnection);
    }
    
    function getAmics($idUsuari) {
        $query = "SELECT `id_amic` FROM `phpbasic`.`amics` WHERE `id_usuari`='{$idUsuari}'";
        $res = $this->selectSQL($query);
        $aux = "";
        for ($i = 0; $i < sizeof($res)-1; $i++) $aux .= " '".$res[$i]['id_amic']."',";
        if (sizeof($res) > 0) $aux .= " '".$res[sizeof($res)-1]['id_amic']."' ";
        $query2 = "SELECT * FROM `phpbasic`.`usuari` WHERE `id` IN ( ".$aux." )";
        return $this->selectSQL($query2);
    }
    
    function getFotos($idUsuari) {
        $query = "SELECT * FROM `phpbasic`.`foto` WHERE `id_usuari`='{$idUsuari}'";
        return $this->selectSQL($query);
    }
    
    function getComentaris($idFoto) {
        $query = "SELECT * FROM `phpbasic`.`comentari` WHERE `id_foto`='{$idFoto}'";
        return $this->selectSQL($query);
    }
    
    function close() {
        mysql_close($this->idConnection);
    }        
}

?>
