<?php
include_once 'JediBookException.class.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Foto
 *
 * @author elena
 */
class Foto {
    //put your code here
    protected $id;
    protected $descripcio;
    protected $foto;
    protected $data;
    protected $votsOK;
    protected $votsKO;
    protected $comentaris;
    protected $usuari;


    function __construct($id, $decripcio, $foto, $data, $votsOK, $votsKO, $comentaris) {
        $this->setId($id);
        $this->setDescripcio($decripcio);
        $this->setFoto($foto);
        $this->setData($data);
        $this->setVotsOK($votsOK);
        $this->setVotsKO($votsKO);
        $this->setComentaris($comentaris);
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
    
    function getComentaris(){
        return $this->comentaris;
    }
    
    function getUsuari(){
        return $this->usuari;
    }


    function setId($id){
        if(!is_int($id) || $id <= 0) throw new JediBookException("id foto incorrecte");
        else $this->id = $id;
    }
    
    function setDescripcio($decripcio){
        if(!is_string($decripcio)) throw new JediBookException("descripcio incorrecta");
        else $this->descripcio = $decripcio;
    }
    
    function setFoto($foto){
        
    }
    
    function setData($data){
        
    }
    
    function setVotsOK($votsOK){
        if(!is_int($votsOK) || $votsOK <= 0) throw new JediBookException("votsOK incorrectes");
        else $this->votsOK = $votsOK;
    }
    
    function setVotsKO($votsKO){
        if(!is_int($votsKO) || $votsKO <= 0) throw new JediBookException("votsKO incorrectes");
        else $this->votsKO = $votsKO;
    }
    
    function setComentaris($comentaris){
       if(!is_array($comentaris)) throw new JediBookException("comentaris incorrectes");
       else {
           for ($i = 0;$i < count($comentaris);$i++) if(!($comentaris[$i] instanceof Comentari)) throw new JediBookException("no son comentaris");
       }
       $this->comentaris = $comentaris;
    }
    
    function setUsuari($usuari) {
        if($usuari instanceof Usuari) $this->usuari = $usuari;
        else throw new JediBookException("usuar incorrecte");
    }
    
    function incrementaVotsOK(){
        ++$this->votsOK;
    }
    
    function incrementaVotsKO(){
        ++$this->votsKO;
    }
    
    
    
    
}

?>
