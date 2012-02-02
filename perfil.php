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
        <link type="text/css" rel="stylesheet" href="css/JediStyle.css"/>
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
            }
            #main {
                padding: 20px;
                width:100%;
                overflow:hidden;
                height:auto;
                background-color:#FFF8D3; 
            }
            #column_left {
                width:15%;
                background: -moz-linear-gradient(top, #2F3837, #FFF8D3);
                background: -webkit-gradient(linear, 0 0, 0 100%, from(#2F3837),  to(#FFF8D3));
                height:500px;
                float:left;
                border-radius: 10px;  
                -moz-border-radius:10px;  
                -webkit-border-radius:10px;
                -webkit-box-shadow: 2px 2px 5px #999;
                -moz-box-shadow: 2px 2px 5px #999;
                filter: shadow(color=#999999, direction=135, strength=2);                    
                box-shadow: 2px 2px 5px #999;
            }
           
            #colum_right {
                width:85%;
                height: 400px;
            }
            
            #column_left #fotoPer{
                padding-top: 15px;
                text-align: center;
            }
            
            #column_left #FerteAmic{
                padding-top: 300px;
                text-align: center;
                
            }
            
            #header #TancarSessio{
                padding-top: 25px;
                float: right;
                
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
                    <div id="fotoPer"> <img src="ImatgesPerfil/p.jpg" alt="mail image" width="150" height="150" border="0" boder="0" />
                    <div id="FerteAmic"><button type="button" class="minimal" name="ferteAmic">Fer-te amic</button></div>
                </div>
                <div id="column_right">
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
