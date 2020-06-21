<?php
session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'app2';
$DATABASE_PASS = '1234';
$DATABASE_NAME = 'teme';

$link = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (!$link) {
    echo "Eroare: Nu a fost posibilă conectarea la MySQL." . PHP_EOL . "</br>";
    echo "Valoarea error: " . mysqli_connect_errno() . PHP_EOL . "</br>";
    echo "Valoarea error: " . mysqli_connect_error() . PHP_EOL . "</br>";
    exit;
}

if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['rol'])) {
    registerUser($link);
} else {
    registUserByAdmin($link);
}

function registerUser($link)
{
    $sql_create = "CREATE TABLE vlad_utilizatori(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(30) NOT NULL,
    password VARCHAR(32) NOT NULL,
    email VARCHAR(70) NOT NULL UNIQUE,
    rol Boolean NOT NULL DEFAULT 0 )";

    $user_name = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Formatul emailului este invalid");
    }

    if (strlen($user_name) < 4) {
        die("Numele este prea scurt");
    }

    $cod_passw = md5($password);

    $sql_insert = "INSERT INTO vlad_utilizatori (user_name, password, email) VALUES ('$user_name', '$cod_passw', '$email')";

    $val = mysqli_query($link, 'select 1 from `vlad_utilizatori`');


    if ($val !== FALSE) {
        insertUser($link, $sql_insert);
    } else {
        if (mysqli_query($link, $sql_create)) {
            echo "Table created successfully." . "</br>";
            insertUser($link, $sql_insert);
        } else {
            echo "ERROR: Could not able to execute $sql_insert. " . mysqli_error($link) . "</br>";
        }
    }
}

function registUserByAdmin($link)
{
    $sql_create = "CREATE TABLE vlad_utilizatori(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        user_name VARCHAR(30) NOT NULL,
        password VARCHAR(32) NOT NULL,
        email VARCHAR(70) NOT NULL UNIQUE,
        rol Boolean NOT NULL DEFAULT 0 )";

    $user_name = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Formatul emailului este invalid");
    }

    if (strlen($user_name) < 4) {
        die("Numele este prea scurt");
    }

    $cod_passw = md5($password);

    $sql_insert = "INSERT INTO vlad_utilizatori (user_name, password, email, rol) VALUES ('$user_name', '$cod_passw', '$email', '$rol')";

    $val = mysqli_query($link, 'select 1 from `vlad_utilizatori`');


    if ($val !== FALSE) {
        insertUser($link, $sql_insert);
    } else {
        if (mysqli_query($link, $sql_create)) {
            echo "Table created successfully." . "</br>";
            insertUser($link, $sql_insert);
        } else {
            echo "ERROR: Could not able to execute $sql_insert. " . mysqli_error($link) . "</br>";
        }
    }
}


function insertUser($_link, $sql_query)
{
    if (mysqli_query($_link, $sql_query)) {
        echo "Contul a fost creat!";
    } else {
        echo "ERROR: Could not able to execute $sql_query. " . mysqli_error($_link);
    }
}
