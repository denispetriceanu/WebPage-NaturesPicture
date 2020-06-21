<?php

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'app2';
$DATABASE_PASS = '1234';
$DATABASE_NAME = 'teme';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['username'], $_POST['username_vechi'], $_POST['password_veche'], $_POST['email'], $_POST['rol'])) {
    echo 'Nu s-au completat toate datele';
}

if (isset($_POST['username_vechi'])) {
    if ($stmt = $con->prepare('SELECT id, password FROM vlad_utilizatori WHERE user_name = ?')) {
        $stmt->bind_param('s', $_POST['username_vechi']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password);
            $stmt->fetch();

            $receive = md5($_POST['password_veche']);

            if ($receive === $password) {
                if ($_POST['password'] == "") {

                    $query = "UPDATE vlad_utilizatori SET user_name='" . $_POST['username'] . "', password ='" . $receive . "', email='" . $_POST['email'] . "', rol='" . $_POST['rol'] . "' WHERE id=" . $id;


                    if (mysqli_query($con, $query)) {
                        echo 'Success';
                    } else {
                        echo $query;
                        echo "Modificarea datelor nu a avut loc";
                    }
                } else {

                    $newPass = md5($_POST['password']);

                    $query = "UPDATE vlad_utilizatori SET user_name='" . $_POST['username'] . "', password ='" . $newPass . "', email='" . $_POST['email'] . "', rol='" . $_POST['rol'] . "' WHERE id=" . $id;

                    if (mysqli_query($con, $query)) {
                        echo 'Success';
                    } else {
                        echo "Modificarea parolei nu a avut loc";
                    }
                }
            } else {
                echo 'Parola incorecta!';
            }
        } else {
            echo 'Nume incorect';
        }
    } else {
        echo "'SELECT id, password FROM vlad_utilizatori WHERE id = ?'";
        echo $stmt;
    }
} else {
    echo "Datele sunt gresite";
}

$stmt->close();
