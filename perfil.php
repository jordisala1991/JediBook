<?php 
if(!isset($_GET['id'])) {
    header("Location: index.php");
}
else {
    include_once 'class/Usuari.class.php';
    $usuari = new Usuari((int)$_GET['id']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link type="text/css" rel="stylesheet" href="css/JediStyle.css"/>
        
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="title">JediBook</div>
                <div id="TancarSessio"><button type="button" class="minimal" name="desconectar">Desconnecta't</button></div>
            </div>
            <div id="main">
                <div id="column_left">
                    <div id="nomUsuari"><h3><?php echo $usuari->getUserName();?></h3></div>
                    <div id="fotoPer"> <img src="<?php echo $usuari->getFotoPerfil();?>" alt="mail image" width="150" height="150" border="0" boder="0" /></div>
                    <div id="FerteAmic"><button type="button" class="minimal" name="ferteAmic" onClick="return afegirAmic();">Fer-te amic</button></div>
                </div>
                <div id="column_right">
                    <div id="titol"><h3>Fotos</h3></div>
                    <div class="foto"> <img src="Imatges/foto2.jpg" alt="mail image" width="300" height="300" border="0" boder="0" /></div>
                    <div class="foto"> <img src="Imatges/foto3.jpg" alt="mail image" width="300" height="300" border="0" boder="0" /></div>
                </div>
                <br style="clear:both;">
            </div>
            <div id="footer">
            </div>
        </div>
        <?php
        function afegirAmic(){
            
        }
        ?>
    </body>
</html>
