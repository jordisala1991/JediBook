<?php
    include_once "class/Usuari.class.php";
    include_once "class/GestioFotos.class.php";
    
    session_name("loguejat");
    session_start();
    
    if (!isset($_SESSION["id"]) and isset($_COOKIE["id"])) $_SESSION["id"] = $_COOKIE["id"];
    if (!isset($_SESSION["id"])) header("Location: index.php");
    
    $u = new Usuari((int) $_SESSION["id"]);
    
    if (isset($_POST["editarButton"])) {
        $pass_antic = mysql_real_escape_string($_POST["passwordAntic"]);
        $pass = mysql_real_escape_string($_POST["password"]);
        $sexe = mysql_real_escape_string($_POST["sexe"]);
        $provincia = mysql_real_escape_string($_POST["provincia"]);
        if ($sexe == "Home") $sexe = true;
        else if ($sexe == "Dona") $sexe = false;
        else $sexe = null;
        if ($provincia == "0") $provincia = null;
        if (isset($_FILES["foto"])) $gf = new GestioFotos($_FILES["foto"], true);
        else $gf = $u->getFotoPerfil();
        if (md5($pass_antic) == $u->getPass()) {
            $u->setFotoPerfil ($gf);
            if (!$pass == "") $u->setPass ($pass);
            $u->setProvincia($provincia);
            $u->setSexe($sexe);
            $u->update();
            header("Location: perfil.php?id=".$u->getId());
        }
    }
    
    if (!isset($_POST["idPerfil"]) or (isset($_SESSION["id"]) and $_SESSION["id"] != $_POST["idPerfil"]))
        header('Location: perfil.php?id='.$_SESSION["id"]);
    
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
                <div id="TancarSessio">
                    <form action="index.php" method="post">
                        <input type="submit" class="minimal" name="desconectar" value="Desconecta't">
                    </form>
                </div>
            </div>
            <div id="column">
                <fieldset id="editar">
                    <legend>Editar dades perfil</legend>    
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                            <label for="passwordAntic">Contrasenya Antiga (Obligatoria)</label>
                            <input type="password" name="passwordAntic" id="passwordAntic">
                            <label for="password">Contrasenya</label>
                            <input type="password" name="password" id="password">
                            <label for="foto">Foto de perfil (Max: 8mb 150x150)</label>
                            <input type="file" name="foto" id="foto">
                            <label>Sexe</label>
                            <select name="sexe">
                                <?php
                                    $sexe = $u->getSexe();
                                    if (!isset($sexe)) echo '<option value="0" selected >Selecciona el sexe</option>';
                                    else echo '<option value="0">Selecciona el sexe</option>';
                                    if (!$sexe) echo '<option value="Dona" selected >Dona</option>';
                                    else echo '<option value="Dona">Dona</option>';
                                    if ($sexe) echo '<option value="Home" selected >Home</option>';
                                    else echo '<option value="Home">Home</option>';
                                ?>
                            </select>
                            <label>Provincia</label>
                            <select name="provincia">
                                <?php
                                    $provincia = $u->getProvincia();
                                    if (!isset($provincia)) echo '<option value="0" selected >Selecciona la provincia</option>';
                                    else echo '<option value="0">Selecciona la provincia</option>';
                                    if ($provincia == "Barcelona") echo '<option value="Barcelona" selected >Barcelona</option>';
                                    else echo '<option value="Barcelona">Barcelona</option>';
                                    if ($provincia == "Girona") echo '<option value="Girona" selected >Girona</option>';
                                    else echo '<option value="Girona">Girona</option>';
                                    if ($provincia == "Lleida") echo '<option value="Lleida" selected >Lleida</option>';
                                    else echo '<option value="LLeida">Lleida</option>';
                                    if ($provincia == "Tarragona") echo '<option value="Tarragona" selected >Tarragona</option>';
                                    else echo '<option value="Tarragona">Tarragona</option>';
                                ?>
                            </select>
                        </fieldset>
                        <input type="submit" class="minimal" name="editarButton" value="editarDades">
                    </form>
            </div>
            <div id="footer">
            </div>
        </div>
    </body>
</html>
