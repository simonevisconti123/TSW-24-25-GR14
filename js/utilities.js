function returnToHome() {
    window.location.href = "../index.php";
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

function check_input_login(modulo) {
    var regex_email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    
    if (!regex_email.test(modulo.inputmail.value)) {
        document.getElementById("label_error").innerHTML = "L'email non è nel formato corretto.";
        return false;
    }

    return true;
}

function check_mail_change(modulo) {
    var regex_email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (!regex_email.test(modulo.new_mail.value)) {
        document.getElementById("label_message").innerHTML = "L'email non è nel formato corretto.";
        return false;
    }

    if(!(modulo.new_mail.value === modulo.new_mail_conf.value)){
        document.getElementById("label_message").innerHTML = "Le due mail non coincidono.";
        return false;
    }

    return true;
}




document.addEventListener("DOMContentLoaded", function () {
    function showSection(sectionId) {
        document.querySelectorAll(".contenutiBlock > div").forEach(div => {
            div.classList.add("hidden");
        });
        document.getElementById(sectionId).classList.remove("hidden");
    }

    document.querySelectorAll(".ilMioAccountBox button, .laMiaAttivitàBox button").forEach(button => {
        button.addEventListener("click", function () {
            let text = this.textContent.trim();
            if (text === "I miei dati") {
                showSection("iMieiDatiBox");
            } else if (text === "Cambia mail") {
                showSection("cambiaMailBox");
            } else if (text === "Cambia password") {
                showSection("cambiaPasswordBox");
            } else if (text === "Cambia username") {
                showSection("cambiaUsernameBox");
            } else if (text === "Topic salvati") {
                showSection("topicSalvatiBox");
            }
        });
    });
});