function validaRegistre(formulari) {
    var nom = formulari.username.value.replace(/^\s+|\s+$/g, "");
    var pass = formulari.pass.value.replace(/^\s+|\s+$/g, "");
    var email = formulari.email.value.replace(/^\s+|\s+$/g, "");
    var msg = 'S\'han trobat els seguents errors ::\n_____________________________\n\n';
    var error = false;
    if (nom.length == 0) { msg += 'No has introduit un nom d\'usuari\n'; error = true; }
    else if (nom.length < 3) { msg += 'El nom d\'usuari no pot tenir menys de 3 caracters\n'; error = true; }
    else if (nom.length > 30) { msg += 'El nom d\'usuari no pot tenir mes de 30 caracters\n'; error = true; }
    if (pass.length == 0) { msg += 'No has introduit una contrasenya\n'; error = true; }
    else if (pass.length < 3) { msg += 'La contrasenya no pot tenir menys de 3 caracters\n'; error = true; }
    else if (pass.length > 30) { msg += 'La contrasenya no pot tenir mes de 30 caracters\n'; error = true; }
    if (email.length == 0) { msg += 'No has introduit un email\n'; error = true; }
    formulari.username.value = nom;
    formulari.email.value = email;
    if (error) {
        formulari.pass.value = '';
        alert(msg);
    }
    return !error;
}

function validaLoguin(formulari) {
    var nom = formulari.nom_log.value.replace(/^\s+|\s+$/g, "");
    var pass = formulari.pass_log.value.replace(/^\s+|\s+$/g, "");
    var msg = 'S\'han trobat els seguents errors ::\n_____________________________\n\n';
    var error = false;
    if (nom.length == 0) { msg += 'No has introduit un nom d\'usuari\n'; error = true; }
    if (pass.length == 0) { msg += 'No has introduit una contrasenya\n'; error = true; }
    if (error) {
        formulari.pass_log.value = '';
        alert(msg);
    }
    return !error;
}