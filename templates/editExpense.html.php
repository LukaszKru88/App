<?php
if(!isset($_SESSION['is_logged'])){
	header("location: ../index.php?task=login&action=index");
}

$user_id = $_SESSION['id'];
?>

<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<title>Aplikacja budżetowa - Dodaj Wydatek</title>
		<meta name="description" content="Aplikacja budżetowa dla każdego">
		<meta name="keywords" content="Aplikacja, Budżetowa, oszczędzanie, pieniądze">
		<meta name="author" content="ŁK">
		<meta http-equiv="X-Ua-Compatible" content="IE=edge">
		
		<link rel="stylesheet" href="templates/css/bootstrap.min.css">
		<link rel="stylesheet" href="templates/css/main.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet"> 
		<script src = "js/jquery.js"></script>
		
		<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
		<![endif]-->
		
	</head>

	<body onload = "countdown();">
		<div class="container">
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
					<ul class=" sidemenu menu nav justify-content-center">
						<li class="nav-item">
							<a class="nav-link" href="index.php">Menu Główne</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?task=addIncome&action=index">Dodaj przychód</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?task=addExpense&action=index">Dodaj wydatek</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?task=showBalance&action=index">Przeglądaj bilans</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Ustawienia</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="templates/logout.php">Wyloguj się</a>
						</li>			
					</ul>
				</div>
			</nav>
			
			<main>
				<form method="post" action="?task=edit&action=editExpense&type=expenses">
					<div class="row">
						<div class="col-md-6 offset-md-3">
							<div class = "mainmenu">
								<div  id="amountbox" class="form-group">
									<input type="number" step="0.01" name="amount"class="form-control" id="formGroupExampleInput" placeholder="kwota" value="<?php if(isset($this->editExpense['amount'])) $this->printAmount();?>">
								</div>	
									  
								<div  id = "date" class="form-group">
									<input class="form-control" name="date"type="date" value="<?php if(isset($this->editExpense['date'])) echo $this->printDate(); else echo $current_date->format('Y-m-d')?>"/>
								</div>						
								<div class="categories form-check">Sposób płatności
									<ul class="justify-content-center">
									<?php
									$this->printPaymentMethods('paymentMethods');
									?>							
									</ul>
								</div>
						
								<div class="categories form-check">Kategorie
									<ul class="justify-content-center">
									<?php
									    $this->printExpenseCategories('expenseCategories');
									?>
									</ul>
								</div>
							</div>
					
							<div id="commentbox" class="form-group">
								<input type="text" name="comment"class="form-control" id="formGroupExampleInput2" placeholder="komentarz" value="
								    <?php if(isset($this->editExpense['comment'])) $this->printComment();?>">
							</div>
						</div>
					</div>
												
					<div class="col-md-6 offset-md-3 text-center"> 
						<button id="addButton" name="singlebutton" class="btn btn-warning">Edytuj</button> 
				</form>
						<button id="cancelButton" name="cancel" class="btn btn-warning"><a href="index.php">Anuluj</a></button> 
					</div>
					<?php include("classes/sessionMessage.php") ?>
			</main>
				
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