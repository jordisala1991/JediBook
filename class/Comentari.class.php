<?php

include_once "JediBookException.class.php";
include_once "JediBookBD.class.php";
include_once "Usuari.class.php";
include_once "Foto.class.php";

define("TAM_MAX_TEXT", 300);
define("TAM_MIN_TEXT", 3);

/**
 * Description of Comentari
 *
 * @author Jordi
 */
class Comentari {
    protected $id;
    protected $text;
    protected $data;
    protected $usuari;
    protected $foto;

    function __construct($id, $text, $data, $usuari, $foto) {
        $this->setId($id);
        $this->setText($text);
        $this->setData($data);
        $this->setUsuari($usuari);
        $this->setFoto($foto);
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
        $query = "UPDATE `phpbasic`.`comentari` SET (`text`={$this->text},`data`={$this->data}) 
                 WHERE `id`={$this->id}"; 
        if (!isset($this->id)) 
            throw new JediBookException("el comentari no esta a la bd");
        else {
            $bd = new JediBookBD("localhost", "root", "", "phpbasic");
            $bd->updateSQL($query);
            $bd->close();
        }
    }
    
    function delete() {
        if (!isset($this->id))
            throw new JediBookException("el comentari no esta a la bd");
        else {
            //
        }
    }
}

?>
