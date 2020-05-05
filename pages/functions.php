
<?php
// path to file for passwords and logins
$users = 'pages/users.txt';

function register($name, $pass1, $pass2, $email)
{

    //data validation block
    // trim cut spaces in start and end of string
    // htmlspecialchars - exclude script transmission
    $name = trim(htmlspecialchars($name));
    $pass = trim(htmlspecialchars($pass1));
    $confirmPass = trim(htmlspecialchars($pass2));
    $email = trim(htmlspecialchars($email));

    // if validation is failed
    if ($name == '' || $pass == '' || $confirmPass == '' || $email == '') {
        echo " <h3><span style = 'color:red;'>
        Fill All Required Fields! </span> </h3>";
        return false;
    }

    if (strlen($name) < 3 || strlen($name) > 30 || strlen($pass) < 3 || strlen($pass) > 20) {
        echo " <h3><span style = 'color:red;'>
        Values Length Must Be Between 3 and 30 </span> </h3>";
        return false;
    }

    // if ($confirmPass !== $pass) {
    //     echo " <h3><span style = 'color:red;'>
    //     The passwords must be the same </span> </h3>";
    //     return false;
    // } else {
    //     return true;
    // }

    //login uniqueness check block
    // global - show that is outside variable
    global $users;
    // open files with users
    $file = fopen($users, 'a+');


    if ($file) {
        // substr - return part of a string // возвращает подстроку
        // strpos - find the position of the last occurence of a substring in a string // позиция первого вхождения
        // fgets - Gets line from file pointer
        while ($line = fgets($file, 128)) {
            // compare to exist login


            $readname = substr($line, 0, strpos($line, ':'));
            if ($readname === $name) {
                echo "<script>alert(' Such Login Name is already used!')</script>";
               // echo " <h3><span style = 'color:red;'>
              //Such Login Name is already used! </span> </h3>";
                echo ' <script>window.location = "index.php?page=4";</script>';

                return false;
            }
        }
    } else {
        echo " Can't open file ";
    }

    //new user adding block
    // hashing password string 
    // change /*crypt($pass)*/ 
    $hasher = hash('sha256', 'pass');
    $line = $name . ':' . $hasher . ':' . $email . "\r\n";
    //$line = '"Login": {' . $name . '} "pass": {' . crypt($pass) . '} "email": {' . $email . "}\r\n ";
    fputs($file, $line);
    fclose($file);
    return true;
}
