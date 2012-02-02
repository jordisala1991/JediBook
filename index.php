<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
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
                font-family: tahoma;
            }
            
            #wrapper {
                width: auto;
                height: 100%;
                margin: auto;

            }
            
            #header {
                background-color: #222028;
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
                text-align: right;
                padding-top:20px;
                padding-bottom:20px;
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
                padding: 5px 0 7px;
                text-align: center;
                text-shadow: 0 1px 0 #fff;
                width: 120px; 
            }
            .minimal:hover {
                background: #d9d9d9;
                -webkit-box-shadow: inset 0 0 1px 1px #eaeaea;
                -moz-box-shadow: inset 0 0 1px 1px #eaeaea;
                -ms-box-shadow: inset 0 0 1px 1px #eaeaea;
                -o-box-shadow: inset 0 0 1px 1px #eaeaea;
                box-shadow: inset 0 0 1px 1px #eaeaea;
                color: #222;
                cursor: pointer; 
            }
            .minimal:active {
                background: #d0d0d0;
                -webkit-box-shadow: inset 0 0 1px 1px #e3e3e3;
                -moz-box-shadow: inset 0 0 1px 1px #e3e3e3;
                -ms-box-shadow: inset 0 0 1px 1px #e3e3e3;
                -o-box-shadow: inset 0 0 1px 1px #e3e3e3;
                box-shadow: inset 0 0 1px 1px #e3e3e3;
                color: #000; 
            }

            #registre fieldset {
                text-align: left;
                margin-bottom: 20px;
            }
            
            #registre legend{
                font-weight:bold;
                font-size:12px;
                color:#FFFFFF;
                background-color:#000000;
                padding:3px 8px 3px 8px;
                text-align: left;
                border-radius: 7px;  
                -moz-border-radius:7px;  
                -webkit-border-radius:7px;
                -webkit-box-shadow: 2px 2px 5px #999;
                -moz-box-shadow: 2px 2px 5px #999;
                filter: shadow(color=#999999, direction=135, strength=2);                    
                box-shadow: 2px 2px 5px #999;
            }
            
            #registre label {
                display:block;
                margin-left: auto;
                margin-right: auto;
                margin-top: 10px;
                margin-bottom:3px;
                font-size: 12px;
            }
            
            #registre select {
                font-family: tahoma;
                font-size: 12px;
            }
            #loguin{
               float: right;
            } 
            #loguin label{
                color: white;
                font: tahoma;
                font-size: 12px;
            }
            #loguin input[type=submit] {
                margin-left: 50px;
                margin-top: 5px;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div id="title">JediBook</div>
                <div id="loguin">
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                        <label for="nom_log" style="margin-left:2px">usuari</label>
                        <label for="pass_log" style="margin-left:125px">contrasenya</label><br/>
                        <input type="text" name="nom" id="nom_log"/>
                        <input type="password" name="password" id="pass_log"/><br/>
                        <input type="checkbox" name="conexio" value="conectat" id="conexio"/>
                        <label for="conexio">Mantén-me connectat</label>
                        <input type="submit" class="minimal" name="submit" value ="Inicia sessió"/>
                    </form>
                </div>
            </div>
            <div id="main">
                <div id="column">
                    <fieldset id="registre">
                        <legend>Registre de nou usuari</legend>
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" onSubmit="return validaRegistre(this);">
                                <fieldset>
                                    <legend>Informacio obligatoria</legend>
                                    <label for="username">Nom d'usuari</label>
                                    <input type="text" name="username" id="username">
                                    <label for="pass">Contrasenya</label>
                                    <input type="password" name="pass" id="pass">
                                    <label for="email">Direccio d'email</label>
                                    <input type="text" name="email" id="email">
                                </fieldset>
                                <fieldset>
                                    <legend>Informacio adicional</legend>
                                    <label>Data de naixement</label>
                                    <select name="dia">
                                        <option value="0">Dia</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                    <select name="mes">
                                        <option value="0">Mes</option>
                                        <option value="1">gener</option>
                                        <option value="2">febrer</option>
                                        <option value="3">març</option>
                                        <option value="4">abril</option>
                                        <option value="5">maig</option>
                                        <option value="6">juny</option>
                                        <option value="7">juliol</option>
                                        <option value="8">agost</option>
                                        <option value="9">setembre</option>
                                        <option value="10">octubre</option>
                                        <option value="11">novembre</option>
                                        <option value="12">desembre</option>
                                    </select>
                                    <select name="any">
                                        <option value="0">Any</option>
                                        <option value="2012">2012</option>
                                        <option value="2011">2011</option>
                                        <option value="2010">2010</option>
                                        <option value="2009">2009</option>
                                        <option value="2008">2008</option>
                                        <option value="2007">2007</option>
                                        <option value="2006">2006</option>
                                        <option value="2005">2005</option>
                                        <option value="2004">2004</option>
                                        <option value="2003">2003</option>
                                        <option value="2002">2002</option>
                                        <option value="2001">2001</option>
                                        <option value="2000">2000</option>
                                        <option value="1999">1999</option>
                                        <option value="1998">1998</option>
                                        <option value="1997">1997</option>
                                        <option value="1996">1996</option>
                                        <option value="1995">1995</option>
                                        <option value="1994">1994</option>
                                        <option value="1993">1993</option>
                                        <option value="1992">1992</option>
                                        <option value="1991">1991</option>
                                        <option value="1990">1990</option>
                                        <option value="1989">1989</option>
                                        <option value="1988">1988</option>
                                        <option value="1987">1987</option>
                                        <option value="1986">1986</option>
                                        <option value="1985">1985</option>
                                        <option value="1984">1984</option>
                                        <option value="1983">1983</option>
                                        <option value="1982">1982</option>
                                        <option value="1981">1981</option>
                                        <option value="1980">1980</option>
                                        <option value="1979">1979</option>
                                        <option value="1978">1978</option>
                                        <option value="1977">1977</option>
                                        <option value="1976">1976</option>
                                        <option value="1975">1975</option>
                                        <option value="1974">1974</option>
                                        <option value="1973">1973</option>
                                        <option value="1972">1972</option>
                                        <option value="1971">1971</option>
                                        <option value="1970">1970</option>
                                        <option value="1969">1969</option>
                                        <option value="1968">1968</option>
                                        <option value="1967">1967</option>
                                        <option value="1966">1966</option>
                                        <option value="1965">1965</option>
                                        <option value="1964">1964</option>
                                        <option value="1963">1963</option>
                                        <option value="1962">1962</option>
                                        <option value="1961">1961</option>
                                        <option value="1960">1960</option>
                                        <option value="1959">1959</option>
                                        <option value="1958">1958</option>
                                        <option value="1957">1957</option>
                                        <option value="1956">1956</option>
                                        <option value="1955">1955</option>
                                        <option value="1954">1954</option>
                                        <option value="1953">1953</option>
                                        <option value="1952">1952</option>
                                        <option value="1951">1951</option>
                                        <option value="1950">1950</option>
                                        <option value="1949">1949</option>
                                        <option value="1948">1948</option>
                                        <option value="1947">1947</option>
                                        <option value="1946">1946</option>
                                        <option value="1945">1945</option>
                                        <option value="1944">1944</option>
                                        <option value="1943">1943</option>
                                        <option value="1942">1942</option>
                                        <option value="1941">1941</option>
                                        <option value="1940">1940</option>
                                        <option value="1939">1939</option>
                                        <option value="1938">1938</option>
                                        <option value="1937">1937</option>
                                        <option value="1936">1936</option>
                                        <option value="1935">1935</option>
                                        <option value="1934">1934</option>
                                        <option value="1933">1933</option>
                                        <option value="1932">1932</option>
                                        <option value="1931">1931</option>
                                        <option value="1930">1930</option>
                                        <option value="1929">1929</option>
                                        <option value="1928">1928</option>
                                        <option value="1927">1927</option>
                                        <option value="1926">1926</option>
                                        <option value="1925">1925</option>
                                        <option value="1924">1924</option>
                                        <option value="1923">1923</option>
                                        <option value="1922">1922</option>
                                        <option value="1921">1921</option>
                                        <option value="1920">1920</option>
                                        <option value="1919">1919</option>
                                        <option value="1918">1918</option>
                                        <option value="1917">1917</option>
                                        <option value="1916">1916</option>
                                        <option value="1915">1915</option>
                                        <option value="1914">1914</option>
                                        <option value="1913">1913</option>
                                        <option value="1912">1912</option>
                                        <option value="1911">1911</option>
                                        <option value="1910">1910</option>
                                        <option value="1909">1909</option>
                                        <option value="1908">1908</option>
                                        <option value="1907">1907</option>
                                        <option value="1906">1906</option>
                                        <option value="1905">1905</option>
                                    </select>
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
                                    <input type="file" name="foto" id="foto">
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
