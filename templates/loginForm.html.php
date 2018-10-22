<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<title>Aplikacja budżetowa - Logowanie</title>
		<meta name="description" content="Aplikacja budżetowa dla każdego">
		<meta name="keywords" content="Aplikacja, Budżetowa, oszczędzanie, pieniądze">
		<meta name="author" content="ŁK">
		<meta http-equiv="X-Ua-Compatible" content="IE=edge">
		
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet"> 
		<script src = "js/jquery.js"></script>
		
		<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
		<![endif]-->
		
	</head>

	<body>
		<div class = "container">
			<header>
				<div class="row">
					<div class="col-md-12">
						<h1 class="logo">Aplikacja Budżetowa</h1>
					</div>
				</div>
			</header>
		
			<nav class="navbar navbar-expand-sm navbar-light">
				<button class="navbar-toggler menu" type="button" data-toggle="collapse" data-target="#navigationMenu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				 </button>
				 
				<div class="collapse navbar-collapse justify-content-center menu"  id="navigationMenu">
					<ul class="menu nav justify-content-center">
						<li class="nav-item">
							<a class="nav-link" href="../index.php">Strona Główna</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?task=register&action=index">Rejestracja</a>
						</li>
					</ul>
				</div>
			</nav>
			<div class="row">
				<div class="col-md-6 offset-md-3 justify-content-center ">
					<main>
						<form method = "post" action="?task=login&action=login">
						  <div  id="login" class="form-group">
							<input name ="login" type="text" class="form-control" id="formGroupExampleInput" placeholder="login">
						  </div>
						  
						  <div id="password" class="form-group">
							<input name = "password" type="password" class="form-control" id="formGroupExampleInput2" placeholder="hasło">
						  </div>
						  
							<div class="col-md-6 offset-md-3 text-center"> 
								<button id="logButton" name="singlebutton" class="btn btn-warning">Zaloguj się</button>
								<?php include("classes/sessionMessage.php") ?>		
							</div>
						</form>
					</main>
				</div>
			</div>
			<footer>
				<div class = "info">

					Łukasz Kruszelnicki - Wszelkie prawa zastrzeżone &copy; 2018
				
				</div>
			</footer>
		</div>
	
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>