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

if (!isset($_POST['id'])) {
    die('Please complete yput data');
}



$id = $_REQUEST['id'];

$sql_remove = "DELETE FROM `vlad_utilizatori` WHERE id = " . $id;

$val = mysqli_query($link, 'select 1 from `vlad_content`');

if ($val !== FALSE) {
    insertUser($link, $sql_remove);
} else {
    echo "Tabela nu există";
}

function insertUser($_link, $sql_query)
{
    if (mysqli_query($_link, $sql_query)) {
        echo "Utilizator șters";
    } else {
        echo "ERROR: Could not able to execute $sql_query. " . mysqli_error($_link);
    }
}
