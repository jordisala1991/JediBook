<?php
include_once 'JediBookException.class.php';
include_once 'JediBookBD.class.php';
include_once 'Foto.class.php';

/**
 * 
 *
 * @author elena
 */
class Usuari {
    protected $id;
    protected $userName;
    protected $pass;
    protected $email;
    protected $sexe;
    protected $provincia;
    protected $fotoPerfil;

    function __construct() {
        $aux = func_get_args();
        if(func_num_args() == 1) {
            $this->setId($aux[0]);
            $this->_load();
        }
        else if(func_num_args() == 7){
            $this->setId($aux[0]);
            $this->setUserName($aux[1]);
            $this->setPass($aux[2]);
            $this->setEmail($aux[3]);
            $this->setSexe($aux[4]);
            $this->setProvincia($aux[5]);
            $this->setFotoPerfil($aux[6]);
        }
        else throw new JediBookException("num parametres incorrecte");
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

    private function _setId($id){
        if(!is_int($id) and isset($id)) throw new JediBookException("id Usuari incorrecte");
        else if($id < 0) throw new JediBookException("id Usuari incorrecte");
        else $this->id = $id;
    }
    
    private function _setUserName($userName){
        if(!is_string($userName) || strlen($userName) < 3 || strlen($userName) >= 30) throw new JediBookException("username incorrecte");
        else $this->userName = $userName;
    }
    
    function setPass($pass){
        if (!is_string($pass)) throw new JediBookException("pass no es un string");
        else if (strlen($pass) == 32) $this->pass = $pass;
        else if (strlen($pass) < 5 || strlen($pass) > 30 || !preg_match("/^[0-9a-zA-Z]+$/",$pass)) throw new JediBookException("Password incorrecte");
        else $this->pass = md5 ($pass);
    }
    
    private function _setEmail($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) throw new JediBookException("email incorrecte");
        else $this->email = $email;
    }
    
    function setSexe($sexe){
        //if(!is_bool($sexe))throw new JediBookException("sexe incorrecte");
        $this->sexe = $sexe;
    }
    
    function setProvincia($provincia){
        if(!is_string($provincia)) throw new JediBookException("provincia incorrecta");
        else $this->provincia = $provincia;
    }
    
    function setFotoPerfil($fotoPerfil){
        if(!is_string($fotoPerfil)) throw new JediBookException("foto de perfil incorrecta");
        else $this->fotoPerfil = $fotoPerfil;
    }
    
    function save(){
        $query = "INSERT INTO `phpbasic`.`usuari`(`id`,`username`,`pass`,`email`,`sexe`, `provincia`, `foto`)
                 VALUES (NULL, '{$this->userName}', '{$this->pass}', '{$this->email}', '{$this->sexe}', '{$this->provincia}', '{$this->fotoPerfil}')";
        if (isset($this->id)) throw new JediBookException("l'usuari ja esta a la bd");
        else {
            $db = new JediBookBD();
            $this->id = $db->insertSQL($query);
            $db->close();
        }
        
    }
    
    
    function delete(){
        if(!isset($this->id))  throw new JediBookException("l'usuari no esta registrat");
        else {
            $query = "DELETE FROM `phpbasic`.`usuari` WHERE `id`= '{$this->id}'";
            $db = new JediBookBD();
            $db->deleteSQL($query);
            $db->close();
            $this->id = NULL;
        }
        
    }
    
    function update(){
        if(!isset($this->id))  throw new JediBookException("la foto no esta registrada al sistema");
        else {
            $query = "UPDATE `phpbasic`.`usuari` SET (`pass`='{$this->pass}', `sexe`='{$this->sexe}', `provincia`='{$this->provincia}',`foto`='{$this->fotoPerfil}') WHERE `id`= '{$this->id}'";
            $db = new JediBookBD();
            $db->deleteSQL($query);
            $db->close();
            $this->id = NULL;
        }
    }
   
   function afegirAmic($idAmic){
        //if(!($nouAmic instanceof Usuari)) throw new JediBookException("es un amic k no es usuari");
        if(!isset($this->id)) throw new JediBookException("usuari no registrat");
        else {
            $query = "INSERT INTO `phpbasic`.`amics`(`id_usuari`, `id_amic`) VALUES ('{$this->id}', '{$idAmic}')";
            $db = new JediBookBD();
            $db->insertSQL($query);
            $db->close();
            $nouAmic->afegirAmic($this);
        }
    }
    
    
    
    function eliminarAmic($idAmic){
        //if(!($amic instanceof Usuari)) throw new JediBookException("no és del tipus usuari");
        if(!isset ($this->id)) throw new JediBookException("no esta registrat");
        else {
            $query = "SELECT `id_amic` FROM `phpbasic`.`amics` WHERE `id_usuari`='{$this->id}'";
            $db = new JediBookBD();
            $var = $db->selectSQL($query);
            if($var == array()) {
                $query2 = "DELETE FROM `phpbasic`.`amics` WHERE `id_usuari`='{$this->id}' AND `id_amic`='{$idAmic}'";
                $db->deleteSQL($query2);
                $db->close();
            }
            else {
                $db->close();
                throw new JediBookException("no són amics");
            }
            
        }
    }
    
    function _load(){
        $query = "SELECT * FROM `phpbasic`.`usuari` WHERE `id`='{$this->id}'";
        $db = new JediBookBD();
        $var = $db->selectSQL($query);
        $db->close();
        if($var === array()) throw new JediBookException("no hi ha usuari amb aquest id");
        else {
            $this->setUserName($var[0]['username']);
            $this->pass = $var[0]['pass'];
            $this->setEmail($var[0]['email']);
            $this->setSexe((boolean) $var[0]['sexe']);
            $this->setProvincia($var[0]['provincia']);
            $this->setFotoPerfil($var[0]['foto']);
        }
    }  
    
}

?>
