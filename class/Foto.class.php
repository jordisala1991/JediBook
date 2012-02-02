<?php
include_once 'JediBookException.class.php';
include_once 'JediBookBD.class.php';
include_once 'Comentari.class.php';
include_once 'Usuari.class.php';

define("TAM_MAX_DESCRIPCIO", 300);
define("TAM_MIN_DECRIPCIO", 3);

/**
 * 
 *
 * @author elena
 */
class Foto {
   
    protected $id;
    protected $descripcio;
    protected $foto;
    protected $data;
    protected $votsOK;
    protected $votsKO;
    protected $usuari;

    function __construct() {
        $aux = func_get_args();
        if(func_num_args() == 1) {
            $this->_setId($aux[0]);
            $this->_load();
        }
        else if(func_num_args() == 7){
            $this->_setId($aux[0]);
            $this->setDescripcio($aux[1]);
            $this->_setFoto($aux[2]);
            $this->_setData($aux[3]);
            $this->_setVotsOK($aux[4]);
            $this->_setVotsKO($aux[5]);
            $this->_setUsuari(new Usuari($aux[6]));
        }
        else throw new JediBookException("num parametres incorrecte");
    }


    function getId(){
        return $this->id;
    }
    
    function getDescripcio(){
        return $this->descripcio;
    }
    
    function getFoto(){
        return $this->foto;
    }
    
    function getData(){
        return $this->data;
    }    
    
    function getVotsOK(){
        return $this->votsOK;
    }
    
    function getVotsKO(){
        return $this->votsKO;
    }
    
    
    function getUsuari(){
        return $this->usuari;
    }


    private function _setId($id){
        if(!is_int($id) and isset($id)) throw new JediBookException("id foto incorrecte");
        else if($id < 0) throw new JediBookException("id foto incorrecte");
        else $this->id = $id;
    }
    
    function setDescripcio($decripcio){
        if(!is_string($decripcio)) throw new JediBookException("descripcio incorrecta");
        if (strlen($decripcio) > TAM_MAX_DESCRIPCIO)
            throw new JediBookException("la descripcio te un tamany superior a ".TAM_MAX_DESCRIPCIO);
        if (strlen($decripcio) < TAM_MIN_DECRIPCIO)
            throw new JediBookException("la descripcio te un tamany inferior a ".TAM_MIN_DECRIPCIO);
        else $this->descripcio = $decripcio;
    }
    
    private function _setFoto($foto){ 
        if(!is_string($foto)) throw new JediBookException("ruta foto icorrecte");
        else $this->foto = $foto;
    }
    
    private function _setData($data){
        $this->data = $data;
    }
    
    private function _setVotsOK($votsOK){
        if(!is_int($votsOK) || $votsOK < 0) throw new JediBookException("votsOK incorrectes");
        else $this->votsOK = $votsOK;
    }
    
    private function _setVotsKO($votsKO){
        if(!is_int($votsKO) || $votsKO < 0) throw new JediBookException("votsKO incorrectes");
        else $this->votsKO = $votsKO;
    }
    
    private function _setUsuari($usuari) {
        if($usuari instanceof Usuari) $this->usuari = $usuari;
        else throw new JediBookException("usuar incorrecte");
    }
    
    function incrementaVotsOK(){
        ++$this->votsOK;
    }
    
    function incrementaVotsKO(){
        ++$this->votsKO;
    }
    
    function save(){
        $query = "INSERT INTO `phpbasic`.`foto`(`id`,`descripcio`,`foto`,`data`,`votsOK`, `votsKO`, `id_usuari`)
                 VALUES (NULL, '{$this->descripcio}', '{$this->foto}', '{$this->data}', '{$this->votsOK}', '{$this->votsKO}', '{$this->usuari->getId()}')";
        if (isset($this->id)) throw new JediBookException("la foto ja esta a la bd");
        else {
            $db = new JediBookBD();
            $this->id = $db->insertSQL($query);
            $db->close();
        }
        
    }
    
    function delete(){
        if(!isset($this->id))  throw new JediBookException("la foto no esta registrada al sistema");
        else {
            $query = "DELETE FROM `phpbasic`.`foto` WHERE `id`= '{$this->id}'";
            $db = new JediBookBD();
            $db->deleteSQL($query);
            $db->close();
            $this->id = NULL;
        }
        
    }
    
    function update(){
        if(!isset($this->id))  throw new JediBookException("la foto no esta registrada al sistema");
        else {
            $query = "UPDATE `phpbasic`.`foto` SET `descripcio`='{$this->descripcio}', `votsOK`='{$this->votsOK}', `votsKO`='{$this->votsKO}' WHERE `id`='{$this->id}'";
            $db = new JediBookBD();
            $db->updateSQL($query);
            $db->close();
        }
    }
    
    private function _load(){
        $query = "SELECT * FROM `phpbasic`.`foto` WHERE `id`='{$this->id}'";
        $db = new JediBookBD();
        $var = $db->selectSQL($query);
        $db->close();
        if($var === array()) throw new JediBookException("no hi ha foto amb aquest id");
        else {
            $this->setDescripcio($var[0]['descripcio']);
            $this->_setFoto($var[0]['foto']);
            $this->_setData($var[0]['data']);
            $this->_setVotsOK((int)$var[0]['votsOK']);
            $this->_setVotsKO((int)$var[0]['votsKO']);
            $this->_setUsuari(new Usuari((int)$var[0]['id_usuari']));
        }
    }    
}

?>
