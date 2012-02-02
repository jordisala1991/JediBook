<?php 
    include_once 'class/Usuari.class.php';
    include_once 'class/JediBookException.class.php';

    session_name("loguejat");
    session_start();
    
    if(!isset($_SESSION["id"]) and isset($_COOKIE["id"])) $_SESSION["id"] = $_COOKIE["id"];

    if(!isset($_GET['id'])) {
        if (isset($_SESSION["id"])) header("Location: perfil.php?id=".$_SESSION["id"]);
        else header("Location: index.php");
    }
    else {
        try {
            $usuari = new Usuari((int)$_GET['id']);
        } catch (JediBookException $e) {
            if (isset($_SESSION["id"]) and $_SESSION["id"] == $_GET["id"]) {
                $_SESSION = array();
                session_destroy();
                setcookie("id", null, -1);
                header("Location: index.php");
            }
            else if (isset($_SESSION["id"])) header("Location: perfil.php?id=".$_SESSION["id"]);
        }
    }
    
    if (isset($_POST["loguin"]) and isset($_POST["nom_log"]) and isset($_POST["pass_log"])) {
        $username = mysql_real_escape_string($_POST["nom_log"]);
        $password = mysql_real_escape_string($_POST["pass_log"]);
        $bd = new JediBookBD();
        $myid = $bd->estaRegistrat($username, md5($password));
        $bd->close();
        if ($myid) {
            $_SESSION["id"] = $myid;
            if (isset($_POST["conexio"])) {
                setcookie("id", $myid, time() + 3600);
            }
            header("Location: perfil.php?id=".$_SESSION[id]);
        }   
    }
    
    if (isset($_POST["ferteAmic"])) {
        $u = new Usuari((int) $_SESSION["id"]);
        $u->afegirAmic((int) $_GET["id"]);
    }
    
    if (isset($_POST["esborrarAmic"])) {
        $u = new Usuari((int) $_SESSION["id"]);
        $u->eliminarAmic((int) $_GET["id"]);
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
                        echo '<form action="index.php" method="post">';
                        echo '<input type="submit" class="minimal" name="desconectar" value="Desconecta\'t"></div>';
                        echo '</form>';
                    }
                ?>
                </div>
            <div id="main">
                <div id="column_left">
                    <div id="nomUsuari"><h3><?php echo $usuari->getUserName();?></h3></div>
                    <div id="fotoPer"> <img src="<?php echo $usuari->getFotoPerfil();?>" alt="mail image" width="150" height="150" border="0" boder="0" /></div>
                    <?php
                        if (isset($_SESSION["id"]) and $_SESSION["id"] != $_GET["id"]) {
                            $bd = new JediBookBD();
                            $var = $bd->sonAmics($_SESSION["id"], $_GET["id"]);
                            $bd->close();
                            if (!$var) {
                                echo '<div id="FerteAmic">';
                                echo '<form action="perfil.php?id='.$_GET["id"].'" method="post">';
                                echo '<input type="submit" class="minimal" name="ferteAmic" value="Fer-te amic">';
                                echo '</form>';
                                echo '</div>';
                            }
                            else {
                                echo '<div id="EsborrarAmic">';
                                echo '<form action="perfil.php?id='.$_GET["id"].'" method="post">';
                                echo '<input type="submit" class="minimal" name="esborrarAmic" value="Esborrar Amic">';
                                echo '</form>';
                                echo '</div>';
                            }
                        }
                    ?>
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
