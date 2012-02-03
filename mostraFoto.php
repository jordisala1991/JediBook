<?php
    include_once 'class/Foto.class.php';
    include_once 'class/Comentari.class.php';
    include_once 'class/JediBookBD.class.php';
    if(!isset($_GET['id'])) {
        header("Location: perfil.php");
    }
    else {

        $foto = new Foto((int)$_GET['id']);
        $comentaris = array();
        $bd = new JediBookBD();
        $comentaris[] = $bd->getComentaris((int)$_GET['id']);
        //$bd->close();
    }

    if(isset ($_POST['votsOK'])){
        $foto->incrementaVotsOK();
        $foto->update();
    }
    if(isset ($_POST['votsKO'])){
        $foto->incrementaVotsKO();
        $foto->update();
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
                    <div class="foto"><img src="<?php echo $foto->getFoto();?>" alt="mail image" width="500" height="500" border="0" boder="0" /></div>
                    <div id="descripcio"><label for="descripcio"><?php echo $foto->getDescripcio();?></label></div>
                    <?php
                        echo '<div id="votsOK">';
                        echo '<form action="mostraFoto.php?id='.$_GET["id"].'" method="post">';
                        echo '<input type="submit" class="minimal" name="votsOK" value="VotsOK">';
                        echo '</form>';
                        echo '</div>';
                    ?>
                    <?php 
                        echo '<div id="votsKO">';
                        echo '<form action="mostraFoto.php?id='.$_GET["id"].'" method="post">';
                        echo '<input type="submit" class="minimal" name="votsKO" value="VotsKO">';
                        echo '</form>';
                        echo '</div>';
                    
                    ?>
                    <?php 
                        for ($i = 0; $i < sizeof($comentaris); ++$i){
                               echo '<div class="comentari">';
                               $u = $comentaris[0][$i]->getUsuari();
                               echo '<p>';
                               echo $u->getUserName();
                               echo $comentaris[0][$i]->getData();
                               echo " ";
                               echo '</p>';
                               echo '<p>';
                               echo $comentaris[0][$i]->getText();
                               echo " ";
                               echo '</p>';
                               echo '</div>';
                               echo '<br><br>';
                        }
                    ?>  
                </div>
                <br style="clear:both;">
            </div>
            <div id="footer">
            </div>
        </div>
    </body>
</html>