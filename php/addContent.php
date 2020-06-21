<?php
session_start();
// echo "A mers";
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

if (!isset($_POST['link'], $_POST['autor'])) {
    die('Please fill both the username and password field!');
}

$sql_create = "CREATE TABLE vlad_content(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    link VARCHAR(200) NOT NULL,
    autor VARCHAR(32) NOT NULL
)";


$link_image = $_REQUEST['link'];
$autor = $_REQUEST['autor'];

$sql_insert = "INSERT INTO vlad_content (link, autor) VALUES ('$link_image', '$autor')";

$val = mysqli_query($link, 'select 1 from `vlad_content`');


if ($val !== FALSE) {
    insertUser($link, $sql_insert);
} else {
    if (mysqli_query($link, $sql_create)) {
        echo "Table created successfully." . "</br>";
        insertUser($link, $sql_insert);
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link) . "</br>";
    }
}

function insertUser($_link, $sql_query)
{
    if (mysqli_query($_link, $sql_query)) {
        echo "Am adaugat cu succes!";
    } else {
        echo "ERROR: Could not able to execute $sql_query. " . mysqli_error($_link);
    }
}
