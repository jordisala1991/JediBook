<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<?php 

if(!isset($_GET['id'])) {
    header('index.php');
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
        <style type="text/css">
            
            
            #main {
                padding: 20px;
                overflow:hidden;
                height:auto;
                background-color:#FFF8D3;
            }
            #column_left {
                width:15%;
                background: -moz-linear-gradient(top, #2F3837, #FFF8D3);
                background: -webkit-gradient(linear, 0 0, 0 100%, from(#2F3837),  to(#FFF8D3));
                height:auto;
                float:left;
                border-radius: 10px;  
                -moz-border-radius:10px;  
                -webkit-border-radius:10px;
                -webkit-box-shadow: 2px 2px 5px #999;
                -moz-box-shadow: 2px 2px 5px #999;
                filter: shadow(color=#999999, direction=135, strength=2);
                box-shadow: 2px 2px 5px #999;
                margin-right: 20px;
                padding-bottom: 10px;
            }
           
            #column_right {
                width:60%;
                background: -moz-linear-gradient(top, #2F3837, #FFF8D3);
                background: -webkit-gradient(linear, 0 0, 0 100%, from(#2F3837),  to(#FFF8D3));
                border-radius: 10px;  
                -moz-border-radius:10px;  
                -webkit-border-radius:10px;
                -webkit-box-shadow: 2px 2px 5px #999;
                -moz-box-shadow: 2px 2px 5px #999;
                filter: shadow(color=#999999, direction=135, strength=2);
                box-shadow: 2px 2px 5px #999;
                height: auto;
                float: left;
                text-align: center; 
                margin-left: 150px;
                padding-bottom: 10px;
                    
            }
            
            #column_left #fotoPer{
                padding-top: 5px;
                text-align: center;
            }
            
            #column_left #FerteAmic{
                text-align: center;
                
            }
            
            #header #TancarSessio{
                padding-top: 25px;
                float: right;
                
            }
            
            #column_left #nomUsuari{
                padding-top: 5px;
                text-align: center;
                color: white;
            }
            
            #column_right #titol{
                padding-top: 5px;
                text-align: center;
                color: white;
            }
            
            #column_right .foto{
                padding-bottom: 30px;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
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
                    <div id="FerteAmic"><button type="button" class="minimal" name="ferteAmic">Fer-te amic</button></div>
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
        // put your code here
        ?>
    </body>
</html>
