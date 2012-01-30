<?php
include_once 'class/Usuari.class.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prova
 *
 * @author elena_gratallops
 */
class prova {
    //put your code here
    
    $u = new Usuari("1", "elena", "123456ok","elena_gratallops@hotmail.com",FALSE,"tarragona","foropep");
    
    var_dump($u);
    
}

?>
