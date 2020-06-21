<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: https://ie.usv.ro/~dragusanuv/Examen/testProject/');
}
?>

<!DOCTYPE html>
<html>

<head>
	<title> Adauga</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/adauga.css" rel="stylesheet" type="text/css" media="all" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<script>
		function adauga() {
			autor = document.getElementById('autor').value;
			link = document.getElementById('linkImagine').value;

			var data = "link=" + link + '&autor=' + autor;

			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("toShowErrors").innerHTML = this.responseText;
					if (this.responseText == 'Success') window.location.replace("https://ie.usv.ro/~dragusanuv/Examen/testProject/");
				}
			};
			xmlhttp.open("POST", "php/addContent.php", true);
			xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlhttp.send(data);
		}
	</script>
</head>

<body>
	<div class="padding-all">
		<div class="header">
			<h1>Adaugă fotografii</h1>
		</div>

		<div class="design-w3l">
			<div class="mail-form-agile">
				<input type="text" name="autor" placeholder="Nume autor" id="autor" />
				<input type="text" name="link" class="padding" placeholder="Adaugă link" id="linkImagine" />
				<button type="button" class="btn btn-info" value="Adaugă" onclick="adauga()">Adaugă</button>
				<a href="https://ie.usv.ro/~dragusanuv/Examen/"><input type="button" class="btn btn-danger" value="Acasa"></a>
				<div id="toShowErrors" style="color: red; font-size: 20px"></div>
			</div>
			<div class="clear"> </div>
		</div>
	</div>
</body>

</html>