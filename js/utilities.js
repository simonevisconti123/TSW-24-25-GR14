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


function check_input_registration(modulo) {
    var regex_username = /^[a-zA-Z0-9]+$/;
    var regex_email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var regex_pswd = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    if (!regex_username.test(modulo.inputUserName.value)) {
        document.getElementById("label_output").innerHTML = "Il nome può contenere solo lettere e numeri";
        return false;
    }

    if (!regex_email.test(modulo.inputMail.value)) {
        document.getElementById("label_output").innerHTML = "L'email non è nel formato corretto.";
        return false;
    }

    if  (!regex_pswd.test(modulo.inputPassword.value)) {
        document.getElementById("label_output").innerHTML = ` La password non rispetta i requisiti:
    <ul>
        <li>Almeno 8 caratteri</li>
        <li>Almeno 1 maiuscolo</li>
        <li>1 numero e 1 carattere speciale</li>
    </ul>
`;
        return false;
    }

    return true;
}