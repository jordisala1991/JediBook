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
    
    function __construct($host = "localhost", $user = "jedi", $pass = "jedi", $db = "phpbasic") {
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
        if (sizeof($res) > 0) {
            $aux .= " '".$res[sizeof($res)-1]['id_amic']."' ";
            $query2 = "SELECT * FROM `phpbasic`.`usuari` WHERE `id` IN ( ".$aux." )";
            $res2 = $this->selectSQL($query2);
            $res3 = array();
            foreach ($res2 as $u) {
                $res3[] = new Usuari((int) $u['id'], $u['username'], $u['pass'], 
                                    $u['email'], (boolean) $u['sexe'], $u['provincia'], $u['foto'], $u['datanaixement']);
            }
            return $res3;
        }
        return array();
    }
    
    function sonAmics($idUsuari, $idAmic) {
        $query = "SELECT * FROM `phpbasic`.`amics` WHERE `id_usuari`='{$idUsuari}' AND `id_amic`='{$idAmic}'";
        $res = $this->selectSQL($query);
        return !($res === array());
    }
    
    function getFotos($idUsuari) {
        $query = "SELECT * FROM `phpbasic`.`foto` WHERE `id_usuari`='{$idUsuari}'";
        $res = $this->selectSQL($query);
        $res2 = array();
        foreach ($res as $f) {
            $res2[] = new Foto((int) $f['id'], $f['descripcio'], $f['foto'], $f['data'], (int)$f['votsOK'], (int)$f['votsKO'], (int)$f['id_usuari']);
        }
        return $res2;
    }
    
    function getComentaris($idFoto) {
        $query = "SELECT * FROM `phpbasic`.`comentari` WHERE `id_foto`='{$idFoto}'";
        $res = $this->selectSQL($query);
        $res2 = array();
        foreach ($res as $c) {
            $res2[] = new Comentari((int)$c['id'], $c['text'], $c['data'], (int)$c['id_usuari'], (int)$c['id_foto']);
        }
        return $res2;
    }
    
    function estaRegistrat($userName, $pass) {
        $query = "SELECT `id` FROM `phpbasic`.`usuari` WHERE `username`='{$userName}' AND `pass`='{$pass}'";
        if (($res = $this->selectSQL($query)) === array()) return false;
        return (int) $res[0]['id'];
    }
    
    function close() {
        mysql_close($this->idConnection);
    }        
}
?>
