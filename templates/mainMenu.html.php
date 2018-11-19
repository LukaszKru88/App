<?php
if(!isset($_SESSION['is_logged'])){
	header("Location: ../index.php?task=login&action=index");
}
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
		
		<link rel="stylesheet" href="templates/css/bootstrap.min.css">
		<link rel="stylesheet" href="templates/css/main.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet"> 
		<script src = "js/jquery.js"></script>
		<script type ="text/javascript" src = "templates/js/clock.js"></script>
		
		<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
		<![endif]-->
		
	</head>
	
	<body onload="countdown();">
		<div class="container">
			<header>
				<div class="row">
					<div class="col-md-12">
						<h1 class = "logo">Aplikacja Budżetowa</h1>
					</div>
				</div>
			</header>
			<div class="row">
				<div class="col-md-12">
						<nav class = "topnav">
								<ul class="menu nav justify-content-center">
									  <li class="nav-link"><?='<p>Witaj ' . $_SESSION['username'] . '!'; ?></li>
									  <li class="nav-link">Menu Główne</li>
									  <li class="nav-link" id="clock">12:00:00</li>
								</ul>
						</nav>
				</div>
			</div>				
								
			<main>
					<div class = "mainmenu">
						<div class="col-md-12-6 text-center"> 
							<a href="?task=addIncome&action=index"><button class="mainMenuButton" name="singlebutton" class="btn btn-warning">Dodaj przychód</button></a>
						</div>
						<div class="col-md-12-6 text-center"> 
							<a href = "?task=addExpense&action=index"><button class="mainMenuButton" name="singlebutton" class="btn btn-warning">Dodaj wydatek</button></a>
						</div>
						<div class="col-md-12-6 text-center"> 
							<a href = "?task=showBalance&action=index"><button class="mainMenuButton" name="singlebutton" class="btn btn-warning">Przeglądaj bilans</button></a>
						</div>	
						<div class="col-md-12-6 text-center"> 
							<a href = "settings.php"><button class="mainMenuButton" name="singlebutton" class="btn btn-warning">Ustawienia</button></a>
						</div>
						<div class="col-md-12-6 text-center"> 
							<a href = "templates/logout.php"><button class="mainMenuButton" name="singlebutton" class="btn btn-warning">Wyloguj się</button></a>
						</div>
					</div>
			</main>

			<footer>
				<div class = "info">

					Łukasz Kruszelnicki - Wszelkie prawa zastrzeżone &copy; 2018
				
				</div>
			</footer>
		</div>
	</body>
</html>