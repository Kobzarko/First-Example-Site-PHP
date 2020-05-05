<?php
session_start();

function login($login, $password)
{

    $name = trim(htmlspecialchars($login));
    $pass = trim(htmlspecialchars($password));

    if ($name == '' || $pass == '') {
        echo " <h3><span style = 'color:red;'>
        Fill All Required Fields! </span> </h3>";
        return false;
    }

    if (strlen($name) < 3 || strlen($name) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo " <h3><span style = 'color:red;'>
        Values Length Must Be Between 3 and 30 </span> </h3>";
        return false;
    }
    //file with users
    global $users;
    $var = 5;
    //read file with users
    $file = fopen($users, 'r');

    if ($file) {

        while ($line = fgets($file, 128)) {
            // compare to exist login
            $hasher = hash('sha256', 'pass');
            $readstring = substr($line, 0, strpos($line, ':'));
            var_dump($readstring);
            if ($readstring === $name && $readstring === $hasher) {
                $_SESSION['registered_user'] = $name;
                // var_dump($_SESSION['registered_user']);
            } else {
                echo ' <script>window.location = "index.php?page=4";</script>';
            }
        }
    } else {
        echo " <script> alert('Can't open file')</script> ";
        return false;
    }
    //Closes an open file pointer
    fclose($file);
}
