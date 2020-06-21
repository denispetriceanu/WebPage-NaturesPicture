<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: https://ie.usv.ro/~dragusanuv/Examen/');
} else {
    if ($_SESSION['rol'] == 0) {
        header('Location: https://ie.usv.ro/~dragusanuv/Examen/');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/showUser.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script>
        function sendNewUser() {
            nume = document.getElementById('nameInput').value;
            email = document.getElementById('inputEmail1').value;
            parola = document.getElementById('inputPassword1').value;
            rePassword = document.getElementById('inputPasswordRetype').value;
            rol = document.getElementById('inputRol').value;
            if (rePassword != parola) {
                document.getElementById('showEroor').style.display = 'block';
                document.getElementById('showEroor').innerHTML = "Parolele nu corespund";
                ascundeEroare();
            } else {
                var data = "username=" + nume + '&password=' + parola + '&email=' + email + "&rol=" + rol;

                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("showEroor").innerHTML = this.responseText;
                        if (this.responseText == 'Contul a fost creat!') window.location.replace("https://ie.usv.ro/~dragusanuv/Examen/showUser.php");
                        ascundeEroare();
                    }
                };
                xmlhttp.open("POST", "php/register.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send(data);
            }
        }

        username_vechi = "";
        parol_veche = "";

        function getFirstData() {
            username_vechi = document.getElementById('nameInputEdit').value;
        }

        function sendEditUser() {
            nume = document.getElementById('nameInputEdit').value;
            email = document.getElementById('inputEmail1Edit').value;
            parola = document.getElementById('inputPassword1Edit').value;
            rePassword = document.getElementById('inputPasswordRetypeEdit').value;
            rol = document.getElementById('inputRolEdit').value;

            var data = "username=" + nume + '&username_vechi=' + username_vechi + '&password=' + rePassword + '&password_veche=' + parola + '&email=' + email + "&rol=" + rol;

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("errorOnEdit").style.display = "block";
                    document.getElementById("errorOnEdit").innerHTML = this.responseText;
                    if (this.responseText == 'Success') window.location.replace("https://ie.usv.ro/~dragusanuv/Examen/showUser.php");
                    setTimeout(function() {
                        document.getElementById('errorOnEdit').style.display = 'none';
                    }, 3000)
                }
            };
            xmlhttp.open("POST", "php/modifyUserEdit.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(data);
        }
        // }

        function getEditUser(id) {
            if (id == "") {
                document.getElementById("showEroorEdit").innerHTML = "Parametru trimis gresit";
                ascundeEroare();
                return;
            }
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText != "") {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                        setTimeout(function() {
                            getFirstData();
                        }, 500)
                    }
                }
            }
            xmlhttp.open("GET", "php/getuser.php?id=" + id, true);
            xmlhttp.send();
        }

        function stergeUser(id) {
            a = confirm("Sunteti sigur ca doriț să stergeți utilizatorul cu id-ul: " + id);
            if (a == true) {
                var data = "id=" + id;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("toShowErrors").innerHTML = this.responseText;
                        if (this.responseText == 'Utilizatorul a fost sters cu success!') window.location.replace("https://ie.usv.ro/~dragusanuv/Examen/showUser.php");
                        ascundeEroare();
                    }
                };
                xmlhttp.open("POST", "php/modifyUser.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send(data);
            } else {
                document.getElementById('showEroorEdit').innerHTML = "Nu am efectuat nici o modificare";
                ascundeEroare();
            }
        }

        function ascundeEroare() {
            setTimeout(function() {
                document.getElementById('showEroor').style.display = 'none';
            }, 3000)
        }
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <img src="images/logo_low.png" alt="Nature's pictures" style="width: 100px;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="https://ie.usv.ro/~dragusanuv/Examen/">Acasă
                            </a>
                        </li>
                        <li class="nav-item ">
                            <?php
                            if (isset($_SESSION['loggedin'])) {
                                echo '<a class="nav-link" href="https://ie.usv.ro/~dragusanuv/Examen/listPost.php">Postări</a>';
                            }
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION['loggedin'])) {
                                echo '<a class="nav-link" href="php/logout.php">Deloghează-te</a>';
                            } else {
                                echo '<a class="nav-link" href="https://ie.usv.ro/~dragusanuv/Examen/login.html">Loghează-te</a>';
                            }
                            ?>
                        </li>
                        <li class="nav-item active">
                            <?php
                            if (isset($_SESSION['loggedin'])) {
                                if ($_SESSION['rol'] == 1) {
                                    echo '<a class="nav-link" href="https://ie.usv.ro/~dragusanuv/Examen/showUser.php">Utilizatori</a>';
                                }
                            }
                            ?>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION['loggedin'])) {
                                echo '<a class="nav-link" href="https://ie.usv.ro/~dragusanuv/Examen/adauga.php">Adaugă conținut</a>';
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <div id="adaugaUser">
        <button href="#" class="myButton" data-toggle="modal" data-target="#exampleModal">Adaugă</button>
    </div>

    <table class="greyGridTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nume</th>
                <th>Email</th>
                <th>Rol</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php
            $link = mysqli_connect("localhost", "app2", "1234", "teme");
            if (!$link) {
                echo "Eroare: Nu a fost posibilă conectarea la MySQL." . PHP_EOL . "</br>";
                echo "Valoarea error: " . mysqli_connect_errno() . PHP_EOL . "</br>";
                echo "Valoarea error: " . mysqli_connect_error() . PHP_EOL . "</br>";
                exit;
            }
            $sql = "SELECT * FROM vlad_utilizatori";
            $result = $link->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";

                    echo "<td>" . $row["id"] . "</td>" . "<td>" . $row["user_name"] . "</td>" . "<td>" . $row["email"] . "</td>" . "<td>" . $row["rol"] . "</td>" .
                        '<td class="buttonInTable">';
                    if ($_SESSION['id'] != $row['id']) {
                        echo '<button class="btn btn-danger" onclick="stergeUser(' . $row["id"] . ')">Sterge</button>';
                    } else {
                        echo '<button class="btn btn-danger" onclick="stergeUser(' . $row["id"] . ')" disabled>Sterge</button>';
                    }
                    echo '<button class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter" onclick="getEditUser(' . $row["id"] . ')">Editeaza</button></td>';
                }
            } else {
                echo "Nu users";
            }
            $link->close();
            ?>
        </tbody>
        </tr>
    </table>
    <h6 id="toShowErrors"></h6>


    <!-- modal adauga -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adaugă utilizator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nameInput">Nume</label>
                        <input type="email" class="form-control" id="nameInput" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail1">Email</label>
                        <input type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="inputRol">Rol</label>
                        <input type="email" class="form-control" id="inputRol" aria-describedby="emailHelp">
                        <small id="emailHelp" class="form-text text-muted">Rolul pe care îl va avea utilizatorul,
                            posibilitatile pot fi ADMIN sau USER.</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword1">Parolă</label>
                        <input type="password" class="form-control" id="inputPassword1">
                        <small id="emailHelp" class="form-text text-muted">Parola pe care o introduceți trebuie să fie
                            din minim 6 caractere, să conțină minim o literă mare și minim o cifră</small>
                    </div>
                    <div class="form-group">
                        <label for="inputPasswordRetype">Rescrie parola</label>
                        <input type="password" class="form-control" id="inputPasswordRetype">
                    </div>
                </div>
                <div id="showEroor" class="alert alert-danger" style="display: none;"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="sendNewUser()">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal editare -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editează utilizator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="txtHint">
                    <div id="errorOnEdit" style="color: red"></div>
                </div>
            </div>
        </div>
</body>

</html>