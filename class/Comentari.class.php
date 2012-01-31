<?php

include_once "JediBookException.class.php";
include_once "JediBookBD.class.php";
include_once "Usuari.class.php";
include_once "Foto.class.php";

define("TAM_MAX_TEXT", 300);
define("TAM_MIN_TEXT", 3);

/**
 * 
 *
 * @author Jordi
 */
class Comentari {
    protected $id;
    protected $text;
    protected $data;
    protected $usuari;
    protected $foto;
    
    function __construct() {
        $aux = func_get_args();
        if (func_num_args() == 1) {
            $this->setId($aux[0]);
            $this->_load();
        } 
        else if (func_num_args() == 5) {
            $this->setId($aux[0]);
            $this->setText($aux[1]);
            $this->setData($aux[2]);
            $this->setUsuari(new Usuari((int) $aux[3]));
            $this->setFoto(new Foto((int) $aux[4]));
        } else throw new JediBookException("numero de parametres incorrecte");
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        if (!is_int($id) and isset($id)) throw new JediBookException("id no és un enter");
        if ($id < 0) throw new JediBookException("id no és positiu");
        $this->id = $id;
    }

    function getText() {
        return $this->text;
    }

    function setText($text) {
        if (!is_string($text)) throw new JediBookException("text no es un string");
        if (strlen($text) > TAM_MAX_TEXT)
            throw new JediBookException("text te un tamany superior a ".TAM_MAX_TEXT);
        if (strlen($text) < TAM_MIN_TEXT)
            throw new JediBookException("text te un tamany inferior a ".TAM_MIN_TEXT);
        $this->text = $text;
    }

    function getData() {
        return $this->data;
    }

    function setData($data) {
        $this->data = $data;
    }

    function getUsuari() {
        return $this->usuari;
    }

    function setUsuari($usuari) {
        if (!($usuari instanceof Usuari))
            throw new JediBookException("usuari no es un objecte de la classe Usuari");
        $this->usuari = $usuari;
    }
    
    function getFoto() {
        return $this->foto;
    }
    
    function setFoto($foto) {
        if (!($foto instanceof Foto))
            throw new JediBookException("foto no es un objecte de la clase Foto");
        $this->foto = $foto;
    }
    
    function save() {
        $query = "INSERT INTO `phpbasic`.`comentari`(`id`,`text`,`data`,`id_usuari`,`id_foto`)
                 VALUES (NULL, '{$this->text}', '{$this->data}', '{$this->usuari->getId()}', '{$this->foto->getId()}')";
        if (isset($this->id))
            throw new JediBookException("el comentari ja esta a la bd");
        else {
            $bd = new JediBookBD("localhost", "root", "", "phpbasic");
            $this->id = $bd->insertSQL($query);
            $bd->close();
        }
    }
    
    function update() {
        $query = "UPDATE `phpbasic`.`comentari` SET (`text`='{$this->text}',`data`='{$this->data}') 
                 WHERE `id`='{$this->id}'"; 
        if (!isset($this->id)) 
            throw new JediBookException("el comentari no esta a la bd");
        else {
            $bd = new JediBookBD("localhost", "root", "", "phpbasic");
            $bd->updateSQL($query);
            $bd->close();
        }
    }
    
    function delete() {
        $query = "DELETE FROM `phpbasic`.`comentari` WHERE `id` = '{$this->id}'";
        if (!isset($this->id))
            throw new JediBookException("el comentari no esta a la bd");
        else {
            $bd = new JediBookBD("localhost", "root", "", "phpbasic");
            $bd->deleteSQL($query);
            $bd->close();
            $this->id = null;
        }
    }
    
    private function _load() {
        $query = "SELECT * FROM `phpbasic`.`comentari` WHERE `id` = '{$this->id}'";
        $bd = new JediBookBD("localhost", "root", "", "phpbasic");
        $res = $bd->selectSQL($query);
        $bd->close();
        if ($res === array()) throw new JediBookException("el comentari no existeix a la bd");
        else {
            $this->setText($res[0]['text']);
            $this->setData($res[0]['data']);
            $this->setUsuari(new Usuari((int) $res[0]['id_usuari']));
            $this->setFoto(new Foto((int) $res[0]['id_foto']));
        }
    }
}

?>
