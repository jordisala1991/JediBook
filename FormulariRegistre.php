<!DOCTYPE html>
<html>
    <head>
        <title>FormulariRegistre</title>
        <style type="text/css">
            #registre label {
                display:block;
            }
        </style>
        <script language="javascript" type="text/javascript">
            function validaRegistre(formulari) {
                var nom = formulari.username.value.replace(/^\s+|\s+$/g, "");
                var pass = formulari.pass.value.replace(/^\s+|\s+$/g, "");
                var email = formulari.email.value.replace(/^\s+|\s+$/g, "");
                var msg = 'S\'han trobat els seguents errors ::\n_____________________________\n\n';
                var error = false;
                if (nom.length == 0) { msg += 'No has introduit un nom d\'usuari\n'; error = true; }
                if (pass.length == 0) { msg += 'No has introduit una contrasenya\n'; error = true; }
                formulari.username.value = nom;
                formulari.email.value = email;
                if (error) alert(msg);
                return !error;
            }
        </script>
    </head>
    <body>
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
                    <input type="file" name="foto" id="foto">
                </fieldset>
                <input type="reset" name="reset" value="Reset">
                <input type="submit" name="submit" value="Registrar Usuari">
            </form>
        </fieldset>
    </body>
</html>
