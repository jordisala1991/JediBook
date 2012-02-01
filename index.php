<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="http://fonts.googleapis.com/css?family=Baloney" rel="stylesheet" type="text/css" />
        <style type="text/css">
            @font-face {
                font-family: 'BaloneyRegular';
                src: url('fonts/baloney_-webfont.eot');
                src: url('fonts/baloney_-webfont.eot?#iefix') format('embedded-opentype'),
                    url('fonts/baloney_-webfont.woff') format('woff'),
                    url('fonts/baloney_-webfont.ttf') format('truetype'),
                    url('fonts/baloney_-webfont.svg#BaloneyRegular') format('svg');
                font-weight: normal;
                font-style: normal;

            }
            body {
                padding: 0;
                margin:0;
                
                background-color:#FFF8D3; 
            }
            #wrapper {
                width: auto;
                height: 100%;
                margin: auto;

            }
            #header {
                background-color: #222028;
                width: auto;
                height: 80px;
                padding: 5px;
            }
            #title {
                font-family: 'BaloneyRegular';
                font-size: 40px;
                color: white;
                padding-top: 18px;
                padding-left: 45px;
                float: left;
            }
            #main {
                padding: 20px;
                width:100%;
                overflow:hidden;
                height:auto;
            }
            #column {
                margin:0 auto 0 auto;
                background-color: white;
                width:40%;
                padding: 20px;
                border-radius: 10px;  
                -moz-border-radius:10px;  
                -webkit-border-radius:10px;
                -webkit-box-shadow: 2px 2px 5px #999;
                -moz-box-shadow: 2px 2px 5px #999;
                filter: shadow(color=#999999, direction=135, strength=2);                    
                box-shadow: 2px 2px 5px #999;
            }
            #registre {
                font-family: tahoma;
                text-align: right;
            }
            .minimal {
  background: #e3e3e3;
  border: 1px solid #bbb;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  -ms-border-radius: 3px;
  -o-border-radius: 3px;
  border-radius: 3px;
  -webkit-box-shadow: inset 0 0 1px 1px #f6f6f6;
  -moz-box-shadow: inset 0 0 1px 1px #f6f6f6;
  -ms-box-shadow: inset 0 0 1px 1px #f6f6f6;
  -o-box-shadow: inset 0 0 1px 1px #f6f6f6;
  box-shadow: inset 0 0 1px 1px #f6f6f6;
  color: #333;
  font: bold 12px Tahoma, helvetica, arial, sans-serif;
  line-height: 1;
  padding: 8px 0 9px;
  text-align: center;
  text-shadow: 0 1px 0 #fff;
  width: 150px; }
  .minimal:hover {
    background: #d9d9d9;
    -webkit-box-shadow: inset 0 0 1px 1px #eaeaea;
    -moz-box-shadow: inset 0 0 1px 1px #eaeaea;
    -ms-box-shadow: inset 0 0 1px 1px #eaeaea;
    -o-box-shadow: inset 0 0 1px 1px #eaeaea;
    box-shadow: inset 0 0 1px 1px #eaeaea;
    color: #222;
    cursor: pointer; }
  .minimal:active {
    background: #d0d0d0;
    -webkit-box-shadow: inset 0 0 1px 1px #e3e3e3;
    -moz-box-shadow: inset 0 0 1px 1px #e3e3e3;
    -ms-box-shadow: inset 0 0 1px 1px #e3e3e3;
    -o-box-shadow: inset 0 0 1px 1px #e3e3e3;
    box-shadow: inset 0 0 1px 1px #e3e3e3;
    color: #000; }

            
            #registre fieldset {
                text-align: left;
            }
            
            #registre legend{
                font-weight:bold;
                font-size:12px;
                color:#FFFFFF;
                background-color:#000000;
                padding:3px 8px 3px 8px;
                text-align: left;
            }            
            #registre label {
                display:block;
                margin-left: auto;
                margint-right: auto;
                margin-top: 10px;
                margin-bottom:3px;
                font-size: 12px;
            }
            
            #registre input[type=file] {
                filter: Alpha(Opacity=0);
                -moz-opacity: 0;
                opacity: 0;
            }
            
            #contenidorFoto {
                height: 12px;
            }
            
            #registre select {
                font-family: tahoma;
                font-size: 12px;
            }
            #loguin{
               lign:"right";
               float: right;
               padding-top: 18px;
            } 
            a{
                color: white;
                font: tahoma;
                font-size: 12px;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="title">JediBook</div>
                <div id="loguin">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <input type="text" name="nom"  Align=right/>
                    <input type="password" name="password"  Align=right/><br />
                    <input type="checkbox" name="conexio" value="conectat"  Align=right/> <a>Mantén-me connectat &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
                    <input type="submit" name="submit" value ="Inicia sessió"/>
                    </form>
                </div>
            </div>
            <div id="main">
                <div id="column">
                    <fieldset id="registre">
                        <legend>Registre de nou usuari</legend>
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" onSubmit="return validaRegistre(this);">
                                <fieldset>
                                    <legend>Dades de login</legend>
                                    <label for="username">Nom d'usuari</label>
                                    <input type="text" name="username" id="username">
                                    <label for="pass">Contrasenya</label>
                                    <input type="password" name="pass" id="pass">
                                </fieldset>
                                <fieldset>
                                    <legend>Informacio adicional</legend>
                                    <label for="email">Direccio d'email</label>
                                    <input type="text" name="email" id="email">
                                    <label>Sexe</label>
                                    <select name="sexe">
                                        <option value="0">Selecciona el sexe</option>
                                        <option value="Dona">Dona</option>
                                        <option value="Home">Home</option>
                                    </select>
                                    <label>Provincia</label>
                                    <select name="provincia">
                                        <option value="0">Selecciona la provincia</option>
                                        <option value="Barcelona">Barcelona</option>
                                        <option value="Girona">Girona</option>
                                        <option value="Lleida">Lleida</option>
                                        <option value="Tarragona">Tarragona</option>
                                    </select>
                                    <label for="foto">Foto de perfil</label>
                                    <div id="contenidorFoto" class="minimal">PujarFoto<input type="file" name="foto" id="foto"></div>
                                </fieldset>
                                <input type="reset" class="minimal" name="reset" value="Reset">
                                <input type="submit" class="minimal" name="submit" value="Registrar Usuari">
                            </form>
                        </fieldset>
                </div>
            </div>
            <div id="footer">
            </div>
        </div>
        <?php
        // put your code here
        ?>
    </body>
</html>
