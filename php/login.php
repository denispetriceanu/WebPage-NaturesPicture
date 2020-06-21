<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'app2';
$DATABASE_PASS = '1234';
$DATABASE_NAME = 'teme';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (!$con) {
    echo "Eroare: Nu a fost posibilă conectarea la MySQL." . PHP_EOL . "</br>";
    echo "Valoarea error: " . mysqli_connect_errno() . PHP_EOL . "</br>";
    echo "Valoarea error: " . mysqli_connect_error() . PHP_EOL . "</br>";
    exit;
}

if (!isset($_POST['username'], $_POST['password'])) {
    die('Datele nu sunt trimise');
}

$sql_query = 'SELECT rol, password, email FROM vlad_utilizatori WHERE id = ?';

if ($stmt = $con->prepare('SELECT rol, password, id FROM vlad_utilizatori WHERE user_name = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($rol, $password, $id);
        $stmt->fetch();
        $receive = md5($_POST['password']);
        if ($receive === $password) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['rol'] = $rol;
            $_SESSION['id'] = $id;
            echo 'Success';
        } else {
            echo 'Incorrect password!';
        }
    } else {
        echo 'Incorrect username!';
    }
    $stmt->close();
}
