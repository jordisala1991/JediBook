<?php
    include_once 'class/Foto.class.php';
    include_once 'class/Comentari.class.php';
    include_once 'class/JediBookBD.class.php';
    
    session_name("loguejat");
    session_start();
    
    if(isset($_POST["desconectar"])) {
        $_SESSION = array();
        session_destroy();
        setcookie("id", null, -1);
        header("Location: index.php");
    }
    else $foto = new Foto((int)$_GET['id']);
    
    if (!isset($_SESSION["id"]) and isset($_COOKIE["id"])) $_SESSION["id"] = $_COOKIE["id"];
    
    if(!isset($_GET['id'])) {
        if (isset($_SESSION["id"])) header ("Location: perfil.php?id=".$_SESSION["id"]);
        else header("Location: index.php");
    }

    if(isset ($_POST['votsOK'])){
        $foto->incrementaVotsOK();
        $foto->update();
    }
    if(isset ($_POST['votsKO'])){
        $foto->incrementaVotsKO();
        $foto->update();
    }
    if (isset($_POST["pujaComentari"])) {
        $text = mysql_real_escape_string($_POST["text"]);
        $data = getdate();
        $now = $data["year"]."-".$data["mon"]."-".$data["mday"]." ".$data["hours"].":".$data["minutes"].":".$data["seconds"];
        $c = new Comentari(null, $text, $now, (int) $_SESSION["id"], (int) $_GET["id"]);
        $c->save();
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
                <?php
                    if (!isset($_SESSION["id"])) {
                        echo '<div id="loguin">';
                        echo '<form action="index.php" method="post" onSubmit="return validaLoguin(this)">';
                        echo '<label for="nom_log" style="margin-left:2px">usuari</label>';
                        echo '<label for="pass_log" style="margin-left:125px">contrasenya</label><br/>';
                        echo '<input type="text" name="nom_log" id="nom_log">';
                        echo '<input type="password" name="pass_log" id="pass_log"><br/>';
                        echo '<input type="checkbox" name="conexio" value="conectat" id="conexio">';
                        echo '<label for="conexio">Mantén-me connectat</label>';
                        echo '<input type="submit" class="minimal" name="loguin" value="Inicia sessió">';
                        echo '</form>';
                        echo '</div>';
                    }
                    else {
                        echo '<div id="TancarSessio">';
                        echo '<a href="perfil.php?id='.$_SESSION["id"].'">Anar a Perfil</a>';
                        echo '<form action="index.php" method="post">';
                        echo '<input type="submit" class="minimal" name="desconectar" value="Desconecta\'t">';
                        echo '</form></div>';
                    }
                ?>
            </div>
            <div id="main">
                <div id="columna">
                    <div id="titol"><h3>Foto</h3></div>
                    <div class="foto"><img src="<?php echo $foto->getFoto();?>" alt="mail image" width="500" height="500" border="0" boder="0" /></div>
                    <div id="descripcio"><label for="descripcio"><?php echo $foto->getDescripcio();?></label></div>
                    <div id="dataFoto"><label for="dataFoto"><?php echo $foto->getData(); ?></label></div>
                    <?php
                        if (isset($_SESSION["id"])) {
                            echo '<div id="votsOK">';
                            echo '<form action="mostraFoto.php?id='.$_GET["id"].'" method="post">';
                            echo '<input type="submit" class="minimal" name="votsOK" value="VotsOK">';
                            echo '</form>';
                            echo '</div>';
                        }
                        else {
                            echo '<div id="votsOK">';
                            echo '<form action="mostraFoto.php?id='.$_GET["id"].'" method="post">';
                            echo '<input type="submit" class="minimal" name="votsOK" value="VotsOK" disabled >';
                            echo '</form>';
                            echo '</div>';
                        }
                        echo $foto->getVotsOK();
                    ?>
                    <?php 
                        if (isset($_SESSION["id"])) {
                            echo '<div id="votsKO">';
                            echo '<form action="mostraFoto.php?id='.$_GET["id"].'" method="post">';
                            echo '<input type="submit" class="minimal" name="votsKO" value="VotsKO">';
                            echo '</form>';
                            echo '</div>';
                        }
                        else {
                            echo '<div id="votsKO">';
                            echo '<form action="mostraFoto.php?id='.$_GET["id"].'" method="post">';
                            echo '<input type="submit" class="minimal" name="votsKO" value="VotsKO" disabled >';
                            echo '</form>';
                            echo '</div>';
                        }
                        echo $foto->getVotsKO();
                    ?>
                    <?php 
                        $comentaris = array();
                        $bd = new JediBookBD();
                        $comentaris[] = $bd->getComentaris((int)$_GET['id']);
                        
                        for ($i = 0; $i < sizeof($comentaris[0]); ++$i){
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
                    <?php
                        if (isset($_SESSION["id"])) {
                            echo '<div id="sendComentari">';
                            echo '<form action="mostraFoto.php?id='.$_GET["id"].'" method="post">';
                            echo '<textarea name="text" cols="35" rows="4" id="text"></textarea><br/>';
                            echo '<input type="submit" class="minimal" name="pujaComentari" value="Pujar Comentari">';
                            echo '</form></div>';
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