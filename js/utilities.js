function returnToHome() {
    window.location = "index.html";
}

function returnToLogin() {
    window.location = "login.html";
}

function check_input(modulo){
    var regex_username = "^[a-zA-Z0-9]+$";
    var regex_email = "[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}";
    if(modulo.nome.value == "" || !(modulo.nome.value.match(regex_username))){
        if(modulo.email.value == "" || !(modulo.email.value.match(regex_email))){
            document.getElementById("label_functional").innerHTML = "Mail e username sono nel formato scorretto!";
            return false;
        }else{
            document.getElementById("label_functional").innerHTML = "Lo username è nel formato scorretto!";
            return false;
        }
    }else if(modulo.email.value == "" || !(modulo.email.value.match(regex_email))){
        document.getElementById("label_functional").innerHTML = "La mail è nel formato scorretto!";
        return false;
    }else{
        return true;
    }
}