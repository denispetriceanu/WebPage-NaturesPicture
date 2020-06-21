<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: https://ie.usv.ro/~dragusanuv/Examen/');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Postari</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
        function showImage(link, autor) {
            document.getElementById("imagine_modal").src = link;
            document.getElementById("autorShow").innerHTML = autor;
            console.log("Am intrat");
        }
    </script>

    <style>
        .img-thumbnail {
            max-width: 250px !important;
            min-height: 300px;
            max-height: 300px !important;
        }

        .gallery {
            margin-top: 80px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <img src="images/logo_low.png" alt="Nature's pictures" style="width: 100px;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="https://ie.usv.ro/~dragusanuv/Examen/">Acasă
                        </a>
                    </li>
                    <li class="nav-item active">
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
                    <li class="nav-item">
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
    </nav>
    <div class="container">
        <div class="gallery">
            <h1 class="font-weight-light text-center text-lg-left mt-4 mb-0">Postări</h1>
            <hr class="mt-2 mb-5">
            <div class="row text-center text-lg-left">
                <?php
                $link = mysqli_connect("localhost", "app2", "1234", "teme");
                if (!$link) {
                    echo "Eroare: Nu a fost posibilă conectarea la MySQL." . PHP_EOL . "</br>";
                    echo "Valoarea error: " . mysqli_connect_errno() . PHP_EOL . "</br>";
                    echo "Valoarea error: " . mysqli_connect_error() . PHP_EOL . "</br>";
                    exit;
                }


                $sql = "SELECT * FROM vlad_content";
                $result = $link->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="col-lg-3 col-md-4 col-6"><a href="javascript:void(0)" class="d-block mb-4 h-100">';
                        $linkImage = "'" . $row['link'] . "'";
                        $parameters = "'" . $row['link'] . "', '" . $row['autor'] . "'";
                        echo '<img src=' . $linkImage . ' alt="Avatar" class="img-responsive img-thumbnail" onclick="showImage(' . $parameters . ')" styie="height:600px" data-toggle="modal" data-target="#exampleModal"';
                        echo "</a></div>";
                    }
                } else {
                    echo "Nu users";
                }
                $link->close();
                ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 70%; max-height: 70%;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Autor: <span id="autorShow"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center; max-width: 100%;">
                    <img id="imagine_modal" src="" alt="NoLoad" height="600px" style="max-width: 96%;">
                </div>
            </div>
        </div>
    </div>
</body>

</html>