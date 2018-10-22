<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<title>Aplikacja budżetowa - Rejestracja</title>
		<script src='https://www.google.com/recaptcha/api.js'></script>
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
					<?php include("sessionMessage.php") ?>	

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
							<a class="nav-link" href="index.php">Strona Główna</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?task=login&action=index">Logowanie</a>
						</li>
					</ul>
				</div>
			</nav>
			
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<main>
						<form method = "post" action = "registerLogic.php">
						  <div  id="namebox" class="form-group">
							<input type="text" name="nick" class="form-control" id="formGroupExampleInput" placeholder="login">
						  </div>
						  
						  <div id="mailbox" class="form-group">
							<input type="text" name="email" class="form-control" id="formGroupExampleInput2" placeholder="e-mail">
						  </div>
						  
						  <div id="password1box" class="form-group">
							<input type="password" name="password1" class="form-control" id="formGroupExampleInput2" placeholder="hasło">
						  </div>
						  
						  <div id="password2box" class="form-group">
							<input type="password" name="password2" class="form-control" id="formGroupExampleInput2" placeholder="powtórz hasło">
						  </div>
						  
							<div class="form-group rule">
								<label>	
									<input type="checkbox" name="rules"  data-toggle="modal" data-target="#myModal"/> Akceptuję regulamin
								</label>
							</div>
						  
							<div id="myModal" class="modal" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title">Regulamin korzystania z serwisu</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									  <span aria-hidden="true">&times;</span>
									</button>
								  </div>
								  <div class="modal-body">
									<p>Drogi użytkowniku! Witam Cię na stronie aplikacji budżetowej. Rejestracja i korzystanie z serwisu jest całkowicie darmowe. Aplikacja jest przyjazna nie tylko dla dużych monitorów, ale również dla tabletów i smartfonów.</p><br/>
									<p>Aplikacja jest w ciągłbym rozwoju dlatego czuj się zaproszony do feedbacku. Wszelkie sugestie możesz kierować na mój adres mailowy: <span style="color: green;">lukasz.kruszelnicki@gmail.com</span></p>
									
									Zapraszam!
									</p>
								  </div>
								  <div class="modal-footer">
									<button type="button" class="btn confirm" data-dismiss="modal">Ok</button>
								  </div>
								</div>
							  </div>
							</div>
							
							<div class="g-recaptcha rule" data-sitekey="6Lfjf2kUAAAAAJRu4EpI66Q2Za_xbOIjAhtyqDQo"></div>
						  
							<div class="col-md-6 offset-md-3 text-center"> 
								<button id="registerButton" name="singlebutton" class="btn btn-warning">Zarejestruj się</button> 
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