<?php
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["inputUserName"], $_POST["inputMail"], $_POST["inputPassword"])) {
    $user = $_POST["inputUserName"];
    $email = $_POST["inputMail"];
    $pswd = $_POST["inputPassword"];

    $host = 'localhost';
    $port = '5432';
    $db = 'gruppo14';
    $username = 'www';
    $password = 'tw2024';
    $connection_string = "host=$host dbname=$db user=$username password=$password";

    $db = pg_connect($connection_string)
    or die('Impossibile connettersi al database: ' . pg_last_error());

        $secret_salt = "you_will_never_guess_me";
        $hashed_pswd = hash('sha256', $secret_salt . $pswd);

        $result = pg_prepare($db, "Check_if_exists", "SELECT nome_utente, email FROM utenti WHERE nome_utente = $1 OR email = $2;");
        $execution = pg_execute($db, "Check_if_exists", array($user, $email));

        $returned_row = pg_fetch_assoc($execution);
        if ($returned_row) {
            if ($returned_row["nome_utente"] === $user) {
                $message = "Username già utilizzato";
            }
            if ($returned_row["email"] === $email) {
                $message = "Email già utilizzata";
            }
        } else {
            $result = pg_prepare($db, "Insertion", "INSERT INTO utenti VALUES ($1, 'url_pro_pic_here', $2, $3, '23,24,25');");
            $ret = pg_execute($db, "Insertion", array($user, $email, $hashed_pswd));

            if ($ret === false) {
                $message = "Errore nella query";
            } else {
                $message = "Registrazione avvenuta con successo <br><br> <a href='login.html'>Vai al login</a>";
            }
        }
} else {
    $user = "";
    $email = "";
    $pswd = "";
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati</title>
    <link rel="stylesheet" href="css/registration_style.css">
    <script src="js/utilities.js"></script>
</head>
<body>
    <div class="centerBlock">
        <div class="signupBox">
            <h1>REGISTRATI</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" onsubmit="return check_input_registration(this)" id="form_register">
                <label for="username">Inserisci il tuo Username:</label>
                <input type="text" id="inputUserName" name="inputUserName" placeholder="Username">
                
                <label for="email">Inserisci la tua e-mail:</label>
                <input type="text" id="inputMail" name="inputMail" placeholder="E-mail">
                
                <label for="password">Inserisci la tua Password:</label>
                <input type="password" id="inputPassword" name="inputPassword" placeholder="Password">
                
                <div class="buttonsBox">
                    <button type="button" class="signupCancelButton" onclick="returnToLogin()">Annulla</button>
                    <button type="submit" class="signupConfirmationButton">Registrati</button>
                </div>
                <p id="label_output"><?php echo $message; ?></p>
            </form>
        </div>
    </div>
</body>
</html>
