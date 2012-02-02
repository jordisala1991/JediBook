<?php
if(!isset($_GET['id'])) {
    header("Location: perfil.php");
}
else {
    include_once 'class/Foto.class.php';
    include_once 'class/Comentari.class.php';
    include_once 'class/JediBookBD.class.php';
    $foto = new Foto((int)$_GET['id']);
    $comentaris = array();
    $bd = new JediBookBD();
    $comentaris[] = $bd->getComentaris($_GET['id']);
    $bd->close();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JediBook</title>
        <link type="text/css" rel="stylesheet" href="css/JediStyle.css"/>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="title">JediBook</div>
                <div id="TancarSessio"><button type="button" class="minimal" name="desconectar">Desconnecta't</button></div>
            </div>
            <div id="main">
                <div id="columna">
                    <div id="titol"><h3>Foto</h3></div>
                    <div class="foto"><img src="<?php echo $f->getFoto();?>" alt="mail image" width="500" height="500" border="0" boder="0" /></div>
                    <div id="descripcio"><label for="descripcio"><?php echo $f->getDescripcio();?></label></div>
<!--                    <div id="comentari"><label for="comentari">-->
                    <?php 
                        foreach ($comentaris as $c){
                               $t = $c->getText();
                               echo $t;
                               echo " ";
                               $d = $c->getData();
                               echo $d;
                               echo " ";
                               $u = $c->getUsuari();
                               $us = $u->getUserName();
                               echo $us;
                               echo " ";
                               echo '<br><br>';
                        }
                    ?>
<!--</label></div>-->
                </div>
                <br style="clear:both;">
            </div>
            <div id="footer">
            </div>
        </div>
    </body>
</html>