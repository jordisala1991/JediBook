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
    
    function setId($id){
        if(!is_int($id) || $id <= 0) throw new JediBookException("id foto incorrecte");
        else $this->id = $id;
    }
    
    function setDescripcio($decripcio){
        
    }
    
    function setFoto($foto){
        
    }
    
    function setData($data){
        
    }
    
    function setVotsOK($votsOK){
        
    }
    
    function setVotsKO($votsKO){
        
    }
    
    function setComentaris($comentaris){
        
    }
}

?>
