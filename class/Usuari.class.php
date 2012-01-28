<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuari
 *
 * @author elena
 */
class Usuari {
    //put your code here
    protected $id;
    protected $userName;
    protected $pass;
    protected $email;
    protected $sexe;
    protected $provincia;
    protected $fotoPerfil;
    protected $fotos;
    protected $amics;


    function __construct() {
        $this->setId($id);
        $this->setUserName($userName);
        $this->setPass($pass);
        $this->setEmail($email);
        $this->setSexe($sexe);
        $this->setProvincia($provincia);
        $this->setFotoPerfil($fotoPerfil);
        $this->setFotos($fotos);
        $this->setAmics($amics); 
    }


    function getId(){
        return $this->id;
    }
    
    function getUserName(){
        return $this->userName;
    }
    
    function getPass(){
        return $this->pass;
    }
    
    function getEmail(){
        return $this->email;
    }
    
    function getSexe(){
        return $this->sexe;
    }
    
    function getProvincia(){
        return $this->provincia;
    }
    
    function getFotoPerfil(){
        return $this->fotoPerfil;
    }
    
    function getFotos(){
        return $this->fotos;
    }
    
    function getAmics(){
        return $this->amics;
    }



    function setId($id){
        $this->id = $id;
    }
    
    function setUserName($userName){
        
    }
    
    function setPass($pass){
        
    }
    
    function setEmail($email){
        
    }
    
    function setSexe($sexe){
       
    }
    
    function setProvincia($provincia){
        
    }
    
    function setFotoPerfil($fotoPerfil){
        
    }
    
    function setFotos($fotos){
        
    }
    
    function setAmics($amics){
        
    }
    
    
    
}

?>
