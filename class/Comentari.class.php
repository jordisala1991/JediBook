<?php

include_once "JediBookException.class.php";
include_once "Usuari.class.php";

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

    function __construct($id, $text, $data, $usuari) {
        $this->setId($id);
        $this->setText($text);
        $this->setData($data);
        $this->setUsuari($usuari);
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        if (!is_int($id)) throw new JediBookException("id no és un enter");
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
}

?>
