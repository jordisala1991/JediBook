<?php
include_once 'JediBookException.class.php';
include_once 'JediBookBD.class.php';
include_once 'Foto.class.php';
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
    //protected $fotos;
   // protected $amics;


    function __construct($id, $userName, $pass, $email, $sexe, $provincia, $fotoPerfil/*, $fotos, $amics*/) {
        $this->setId($id);
        $this->setUserName($userName);
        $this->setPass($pass);
        $this->setEmail($email);
        $this->setSexe($sexe);
        $this->setProvincia($provincia);
        $this->setFotoPerfil($fotoPerfil);
       // $this->setFotos($fotos);
       // $this->setAmics($amics); 
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
        if(!is_int($id) || $id <= 0 || isset($id)) throw new JediBookException("id Usuari incorrecte");
        else $this->id = $id;
    }
    
    function setUserName($userName){
        if(!is_string($userName) || strlen($userName) < 3 || strlen($userName) >= 30) throw new JediBookException("username incorrecte");
        else $this->userName = $userName;
    }
    
    function setPass($pass){
        if(strlen($pass) < 5 || strlen($pass) > 30 || !preg_match("/^[0-9a-zA-Z]+$/",$pass)) throw new JediBookException("Password incorrecte");
        else $this->pass = md5 ($pass);
    }
    
    function setEmail($email){
        if(!filter_var($e, FILTER_VALIDATE_EMAIL)) throw new JediBookException("email incorrecte");
        else $this->email = $email;
    }
    
    function setSexe($sexe){
        if(!is_bool($sexe))throw new JediBookException("sexe incorrecte");
        else $this->sexe = $sexe;
    }
    
    function setProvincia($provincia){
        if(!is_string($provincia)) throw new JediBookException("provincia incorrecta");
        else $this->provincia = $provincia;
    }
    
    function setFotoPerfil($fotoPerfil){
        if(!is_string($fotoPerfil)) throw new JediBookException("foto de perfil incorrecta");
        else $this->fotoPerfil = $fotoPerfil;
    }
    
    function setFotos($fotos){
        if(!is_array($fotos)) throw new JediBookException("fotos incorrectes");
        else {
            for ($i = 0;$i < count($fotos);$i++) {
               if(!($fotos[$i] instanceof Comentari)) throw new JediBookException("no son fotos");
           }
           $this->fotos = $fotos;
        }    
    }
    
    function setAmics($amics){
        if(!is_array($amics)) throw new JediBookException("amcis incorrectes");
        else {
           for ($i = 0;$i < count($amics);$i++) {
               if(!($amics[$i] instanceof Comentari)) throw new JediBookException("no son amics");
           }
           $this->amics = $amics;
        }
    }
    
   
    /*function afegirAmic($nouAmic){
        if(!($nouAmic instanceof Usuari)) throw new JediBookException("es un amic k no es usuari");
        else array_push($this->amics, $nouAmic);
    }*/
    
    
    
}

?>
