<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
define("RUTA_FOTOS", 'Imatges/');
define("RUTA_FOTOS_PERFIL", 'ImatgesPerfil/');
//define("TAM_MAX_PERFIL", 150);
define("TAM_MAX", 8000000);
/**
 * 
 * Description of GestioFotos
 *
 * @author elena_gratallops
 */
class GestioFotos {
    
    protected $rutaTemporal;
    protected $nom;
    protected $tipus;
    protected $error;
    protected $tamany;
    protected $esPerfil;

    function __construct($file, $esPerfil) {
        $this->nom = $file['name'];
        $this->tipus = $file['type'];
        $this->rutaTemporal = $file['tmp_name'];
        $this->error = $file['error'];
        $this->tamany = $file['size'];
        $this->esPerfil = $esPerfil;
    }
    
    function save(){
        if($this->error == 0) {
            if($this->tamany <= TAM_MAX){
                if($this->tipus == 'image/jpeg' or $this->tipus == 'image/png' or $this->tipus == 'image/gif'){
                    if($this->esPerfil){
                        if (move_uploaded_file($this->rutaTemporal, RUTA_FOTOS_PERFIL.$this->nom)) {
                            return RUTA_FOTOS_PERFIL.$this->nom;
                        }
                    }
                    else if (move_uploaded_file ($this->rutaTemporal, RUTA_FOTOS.$this->nom)){
                        return RUTA_FOTOS.$this->nom; 
                    }
                }
            }
        }
        return false; 
    }
    
    
}

?>
