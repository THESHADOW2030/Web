<?php
    require_once('database.php');
    $username = $_POST['usernameRegistration'] ?? '';
    $password = $_POST['passwordRegistration'] ?? '';
    $isUsernameValid = filter_var(  $username,
                                FILTER_VALIDATE_REGEXP,
                                    ["options" => ["regexp" => "/^[a-z\d_]{3,20}$/i"]]);
    $pwdLenght = mb_strlen($password);
    if (empty($username) || empty($password))
    {
        $msg = 'Compila tutti i campi %s';
    }
    elseif (false === $isUsernameValid)
    {
        $msg = 'Lo username non è valido. Sono ammessi solamente caratteri 
                alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.
                Lunghezza massima 20 caratteri';
    }
    elseif ($pwdLenght < 8 || $pwdLenght > 20)
    {
        $msg = 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
    }


?>