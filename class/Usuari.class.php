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
    protected $amics;


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
        if(!is_int($id) and isset($id)) throw new JediBookException("id Usuari incorrecte");
        else if($id < 0) throw new JediBookException("id Usuari incorrecte");
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
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new JediBookException("email incorrecte");
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
    
    
    function save(){
        $query = "INSERT INTO `phpbasic`.`usuari`(`id`,`username`,`pass`,`email`,`sexe`, `provincia`, `foto`)
                 VALUES (NULL, '{$this->userName}', '{$this->pass}', '{$this->email}', '{$this->sexe}', '{$this->provincia}', '{$this->fotoPerfil}')";
        if (isset($this->id)) throw new JediBookException("l'usuari ja esta a la bd");
        else {
            $db = new JediBookBD("localhost", "root", "", "phpbasic");
            $this->id = $db->insertSQL($query);
            $db->close();
        }
        
    }
    
    
    function delete(){
        if(!isset($this->id))  throw new JediBookException("l'usuari no esta registrat");
        else {
            $query = "DELETE FROM `phpbasic`.`usuari` WHERE `id`= '{$this->id}'";
            $db = new JediBookBD("localhost", "root", "", "phpbasic");
            $db->deleteSQL($query);
            $db->close();
            $this->id = NULL;
        }
        
    }
    
    function update(){
        if(!isset($this->id))  throw new JediBookException("la foto no esta registrada al sistema");
        else {
            $query = "UPDATE `phpbasic`.`usuari` SET (`pass`='{$this->pass}', `sexe`='{$this->sexe}', `provincia`='{$this->provincia}',`foto`='{$this->fotoPerfil}') WHERE `id`= '{$this->id}'";
            $db = new JediBookBD("localhost", "root", "", "phpbasic");
            $db->deleteSQL($query);
            $db->close();
            $this->id = NULL;
        }
    }
   
    function afegirAmic($nouAmic){
        if(!($nouAmic instanceof Usuari)) throw new JediBookException("es un amic k no es usuari");
        else if(!isset($nouAmic->getId()) || !isset($this->id)) throw new JediBookException("usuaris no registrats");
        else if(array_search($nouAmic, $this->amics) !== FALSE) throw new JediBookException("ja son amics");
        else {
            $query = "INSERT INTO `phpbasic`.`amics`(`id_usuari`, `id_amic`) VALUES ('{$this->id}', '{$nouAmic->getid()}')";
            $db = new JediBookBD("localhost", "root", "", "phpbasic");
            $db->insertSQL($query);
            $this->amics[] = $nouAmic;
            $nouAmic->afegirAmic($this);
        }
    }
    
    
    
}

?>
