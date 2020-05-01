
<?php
// path to file for passwords and logins
$users = 'pages/users.txt';

function register($name, $pass, $email)
{

    //data validation block
    // trim cut spaces in start and end of string
    // htmlspecialchars - exclude script transmission
    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass));
    $email = trim(htmlspecialchars($email));

    // if validation is failed
    if ($name == '' || $pass == '' || $email == '') {
        echo " <h3><span style = 'color:red;'>
        Fill All Required Fields! </span> </h3>";
        return false;
    }

    if (strlen($name) < 3 || strlen($name) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo " <h3><span style = 'color:red;'>
        Values Length Must Be Between 3 and 30 </span> </h3>";
        return false;
    }

    

    //login uniqueness check block
    // global - show that is outside variable
    global $users;
    // open files with users
    $file = fopen($users, 'a+');
    // substr - return part of a string // возвращает подстроку
    // strpos - find the position of the last occurence of a substring in a string // позиция первого вхождения
    while ($line = fgets($file, 128)) {
        // compare to exist login
        $readname = substr($line, 0, strpos($line, ': '));
        if ($readname === $name) {
            echo " <h3><span style = 'color:red;'>
            Such Login Name is already used! </span> </h3>";
            return false;
        }
    }
    //new user adding block
    // hashing password string
    $line = $name . ': ' . crypt($pass) . ': ' . $email . "\r\n";
    //$line = '"Login": {' . $name . '} "pass": {' . crypt($pass) . '} "email": {' . $email . "}\r\n ";
    fputs($file, $line);
    fclose($file);
    return true;
}
