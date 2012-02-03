<?php 
    include_once 'class/Usuari.class.php';
    include_once 'class/JediBookException.class.php';
    include_once 'class/GestioFotos.class.php';

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
        $bd4 = new JediBookBD();
        $myid = $bd4->estaRegistrat($username, md5($password));
        $bd4->close();
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
    
    if (isset($_POST["pujaFoto"])) {
        $gf = new GestioFotos($_FILES["novaFoto"], false);
        $ruta = $gf->save();
        $now = getdate();
        $data = $now["year"]."-".$now["mon"]."-".$now["mday"];
        $f = new Foto(null, $_POST["descripcio"], $ruta, $data, 0, 0, (int) $_SESSION["id"]);
        $f->save();
    }
    
    function myTruncate($string, $limit) {
        if(strlen($string) <= $limit) return $string;
        else {
            $res = substr($string, 0, $limit);
        }
        return $res;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JediBook</title>
        <link type="text/css" rel="stylesheet" href="css/JediStyle.css"/>
        <script type="text/javascript" src="javascript/comprovacioRegistre.js"></script>
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
                <div id="column_left">
                    <div id="nomUsuari"><h3><?php echo $usuari->getUserName();?></h3></div>
                    <div id="fotoPer"> <img src="<?php echo $usuari->getFotoPerfil();?>" alt="mail image" width="150" height="150" border="0" boder="0" /></div>
                    <?php
                        if (isset($_SESSION["id"]) and $_SESSION["id"] != $_GET["id"]) {
                            $bd3 = new JediBookBD();
                            $var = $bd3->sonAmics($_SESSION["id"], $_GET["id"]);
                            $bd3->close();
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
                        else if (isset($_SESSION["id"])) {
                            echo '<div id ="EditarPerfil">';
                            echo '<form action="editarPerfil.php" method="post">';
                            echo '<input type="hidden" name="idPerfil" value="'.$_SESSION["id"].'">';
                            echo '<input type="submit" class="minimal" name="editarPerfil" value="Editar Perfil">';
                            echo '</form>';
                            echo '</div>';
                        }
                        ?>
                    <?php
                        $bd = new JediBookBD();
                        $amics = $bd->getAmics($usuari->getId());
                        $bd->close();
                        echo '<div id="Amics">';
                        foreach($amics as $amic) echo '<a href="perfil.php?id='.$amic->getId().'">'.$amic->getUserName().'</a>';
                        echo '</div>';
                    ?>
                </div>
                <div id="column_right">
                    <div id="titol"><h3>Fotos</h3></div>
                    <?php
                        if (isset($_SESSION["id"]) and $_GET["id"] == $_SESSION["id"]) {
                            echo '<div id="sendFoto">';
                            echo '<form action="perfil.php?id='.$_GET["id"].'" method="post" enctype="multipart/form-data">';
                            echo '<label for="novaFoto">Selecciona Foto</label>';
                            echo '<input type="file" name="novaFoto" id="novaFoto">';
                            echo '<label for="descripcio">Descripcio</label>';
                            echo '<textarea name="descripcio" cols="35" rows="6" id="descripcio"></textarea><br/>';
                            echo '<input type="submit" class="minimal" name="pujaFoto" value="Pujar Foto">';
                            echo '</form></div>';
                        }
                    ?>
                    <?php
                        $bd2 = new JediBookBD();
                        $fotos = $bd2->getFotos($usuari->getId());
                        foreach ($fotos as $f) {
                            echo '<a href="mostraFoto.php?id='.$f->getId().'"><img src="'.$f->getFoto().'" height="300" width="300" class="foto"></a>';
                            echo '<div class="descripcioC">';
                            echo '<p>';
                            $s = $f->getDescripcio();
                            echo myTruncate($s, 10).'..';
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
