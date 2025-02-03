function returnToHome() {
    window.location = "index.html";
}

function returnToLogin() {
    window.location = "login.html";
}

function check_input(modulo) {
    var regex_username = /^[a-zA-Z0-9]+$/;
    var regex_email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!regex_username.test(modulo.nome.value)) {
        document.getElementById("label_functional").innerHTML = "Il nome non è nel formato corretto";
        return false;
    }

    if (!regex_email.test(modulo.email.value)) {
        document.getElementById("label_functional").innerHTML = "L'email non è nel formato corretto.";
        return false;
    }

    if(modulo.messaggio.value.trim() === ""){
        document.getElementById("label_functional").innerHTML = "Il messaggio è vuoto";
        return false;
    }
    return true;
}

  