<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Nature's Pictures</title>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/cookie.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <script>
    function showCookie() {
      document.getElementById('cookieConsent').style.display = 'block';
    }

    function hideCookie() {
      document.getElementById('cookieConsent').style.display = 'none';
    }

    function getMessageFromCookie() {
      seteaza_cookie();
      hideCookie();
    }

    function seteaza_cookie() {
      dataCurenta = new Date();
      acum = dataCurenta.getTime();
      dataCurenta.setTime(acum + 120 * 1000); //valabil 120 s
      dataCurenta = dataCurenta.toUTCString();
      expira = "expires=" + dataCurenta;
      document.cookie = "name=agree;" + expira;
    }
  </script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="images/logo_low.png" alt="Nature's pictures" style="width: 80px; height: 40px;"></a>
      <button class=" navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
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
    </div>
  </nav>

  <header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="carousel-item active" style="background-image: url('https://cosmos-images2.imgix.net/file/spina/photo/20565/191010_nature.jpg?ixlib=rails-2.1.4&auto=format&ch=Width%2CDPR&fit=max&w=835')">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item" style="background-image: url(https://wallpaperaccess.com/full/1209273.jpg)">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
        <div class="carousel-item" style="background-image: url('https://i.pinimg.com/originals/65/d3/0c/65d30c740b422adfe00f49b006f50f4c.jpg')">
          <div class="carousel-caption d-none d-md-block">
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </header>

  <!-- Page Content -->
  <section class="py-5">
    <div class="container">
      <?php
      if (isset($_SESSION['loggedin'])) {
        echo '<h1 class="display-4">Salut! Bine ai revenit la noi, ' . $_SESSION['name'] . '!</h1>';
        echo '<p>Avem o multitudine de imagini cu frumusețea naturii, poți fi chiar și tu un contribuitor al galeriei noastre, apasă <a href="https://ie.usv.ro/~dragusanuv/Examen/listPost.php">aici</a>!</p>';
      } else {
        echo '<h1 class="display-4">Salut! Bine ai venit la noi!</h1>';
        echo '<p>Avem o multitudine de imagini cu frumusețea naturii, poți fi chiar și tu un contribuitor al galeriei noastre, apasă <a href="https://ie.usv.ro/~dragusanuv/Examen/login.html">aici</a>!</p>';
      }
      ?>
    </div>
  </section>

  <div id="cookieConsent">
    <div id="closeCookieConsent" onclick="hideCookie()">x</div>
    This website is using cookies. <a href="#" target="_blank">More info</a>. <a class="cookieConsentOK" onclick="getMessageFromCookie()">That's Fine</a>
  </div>

  <script>
    //document.cookie="name=agree";
    ca = document.cookie.split(";");
    gasit = false;
    for (i = 0; i < ca.length; i++) {
      if (ca[i].indexOf("name") != -1) {
        gasit = true;
        hideCookie();
        seteaza_cookie();
      }
    }
    if (gasit == false) {
      seteaza_cookie();
      showCookie();
    }
  </script>

</body>
</html>