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

		<title>Aplikacja budżetowa - Przeglądaj Bilans</title>
		<meta name="description" content="Aplikacja budżetowa dla każdego">
		<meta name="keywords" content="Aplikacja, Budżetowa, oszczędzanie, pieniądze">
		<meta name="author" content="ŁK">
		<meta http-equiv="X-Ua-Compatible" content="IE=edge">

		<link rel="stylesheet" href="templates/css/bootstrap.min.css">
		<link rel="stylesheet" href="templates/css/main.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
		<script src = "templates/js/jquery.js"></script>
			<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

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
		    <?php include("classes/sessionMessage.php") ?>
			<form method = "post" action = "?task=showBalance&action=index">
				<div class="row">
					<div class="col-md-3 offset-md-9">
						<div class="showBalance form-check float-right">Zakres bilansu
							<ul class="justify-content-center">
								<li><label class="form-check-label" for="exampleRadios1"><input class="form-check-input" type="radio" name="time_period" id="exampleRadios1"  value="this_month" checked>Bieżący miesiąc</label></li>

								<li><label class="form-check-label" for="exampleRadios2"><input class="form-check-input" type="radio" name="time_period" id="exampleRadios2"  value="last_month"<?php if((isset($_POST['time_period'])) && ($_POST['time_period']=='last_month')){echo "checked";}?>>Poprzedni miesiąc</label></li>
																
								<li><label class="form-check-label" for="exampleRadios3"><input class="form-check-input" type="radio" name="time_period" id="exampleRadios3"  value="this_year" <?php if((isset($_POST['time_period'])) && ($_POST['time_period']=='this_year')){echo "checked";}?>>Bieżący rok</label></li>							
								
								<li><label class="form-check-label" for="exampleRadios4"><input class="form-check-input" type="radio" name="time_period" id="exampleRadios4"  value="another" data-toggle="modal" data-target="#myModal"
								<?php if((isset($_POST['start_date'])) && (isset($_POST['end_date']))){echo "checked";}?>>Niestandardowy</label></li>
							</ul>
							<button class="btn confirm">Potwierdź</button> 
						</div>			
					</div>			
				</div>		
			</form>
						
			<form method="post" action = "?task=showBalance&action=index">
				<div  id="myModal" class="modal" tabindex="-1" role="dialog">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<div class="col-lg-6 col-md-12  float-left">
									<div class="tablesHeading">Data początkowa
										<input class="form-control" name="start_date" type="date" 
										value="<?php echo $current_date=date("Y-m-d", strtotime("first day of this month"))?>"/>
									</div>
								</div>
								<div class="col-lg-6 col-md-12  float-left">
									<div class="tablesHeading">Data końcowa
										<input class="form-control" name="end_date" type="date" 
										value="<?php echo $current_date=date("Y-m-d")?>"/>
									</div>
								</div>
							</div>
						</div>
					  </div>
					  <div class="modal-footer">
						<button class="btn confirm" name="time_period" value="another">Potwierdź</button> 
						<button type="button" class="btn confirm" data-dismiss="modal">Wróć</button>
					  </div>
					</div>
				  </div>
				</div>
			</form>		

			<main>
				<div class="row">
					<div class="col-md-12">
						<div class="col-lg-6  float-left">
						<div class="tablesHeading">Przychody</div>
							<div class="tablesHeading">Suma za wybrany okres: 
							    <span style="color: green;">
								<?php 
									$this->printTotals('incomes_sum')
								?>
								</span>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-body">
											<canvas id="chDonut1"></canvas>
										</div>
									</div>
								</div>
							</div>	
						</div>
					
						<div class="col-lg-6  float-left">
						<div class="tablesHeading">Wydatki</div>
							<div class="tablesHeading">Suma za wybrany okres: 
							    <span style="color: green;">
								<?php 
									$this->printTotals('expenses_sum')
								?>
								</span>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-body">
											<canvas id="chDonut2"></canvas>
										</div>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>	

				<div class="row">
					<div class="col-md-12">
						<div class="col-lg-6 col-md-12 float-left">
							<div class="tablesHeading">Przychody</div>
							<table class="table table-responsive-md table-hover table-dark">
							    <thead>
									<tr class="tables">
										<th scope="col">#</th>
										<th scope="col">Data</th>
										<th scope="col">Kwota</th>
										<th scope="col">Kategoria</th>
										<th scope="col">Komentarz</th>
										<th scope="col">Akcja</th>
								    </tr>
							    </thead>
							    <tbody>
									<?php
								    	$this->printTable('all_incomes');
								  	?>
							    </tbody>
							</table>
						</div>
								
						<div class="col-lg-6 col-md-12 float-left">
							<div class="tablesHeading">Wydatki</div>
							<table class="table table-responsive-md table-hover table-dark">
							    <thead>
									<tr class="tables">
										<th scope="col">#</th>
										<th scope="col">Data</th>
										<th scope="col">Kwota</th>
										<th scope="col">Kategoria</th>
										<th scope="col">Komentarz</th>
										<th scope="col">Akcja</th>
								    </tr>
							    </thead>
							    <tbody>
									<?php
								    	$this->printTable('all_expenses');
								  	?>
							    </tbody>
							</table>
						</div>		
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

		<script>
			/* chart.js chart examples */

			// chart colors
			var colors = ['#16a085','#27ae60','#2980b9', '#8e44ad', '#2c3e50', '#f39c12', '#d35400', '#c0392b', '#bdc3c7', '#7f8c8d'];

			/* 2 donut charts */
			var donutOptions = {
			  cutoutPercentage: 50, 
			  legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
			};

			// donut 1
			var chDonutData1 = {
				labels: [<?php
				 		    $this->fillChartLabels('grouped_incomes');
						?>],
				datasets: [
				  {
					backgroundColor: colors.slice(0,9),
					borderWidth: 0,
					data: [<?php 
							$this->fillChartData('grouped_incomes');
						  ?>]
				  }
				]
			};

			var chDonut1 = document.getElementById("chDonut1");
			if (chDonut1) {
			  new Chart(chDonut1, {
				  type: 'pie',
				  data: chDonutData1,
				  options: donutOptions
			  });
			}

			// donut 2
			var chDonutData2 = {
				labels: [<?php 
							$this->fillChartLabels('grouped_expenses');
					?>],
				datasets: [
				  {
					backgroundColor: colors.slice(0,9),
					borderWidth: 0,
					data: [<?php 
							$this->fillChartData('grouped_expenses');
					?>]
				  }
				]
			};

			var chDonut2 = document.getElementById("chDonut2");
			if (chDonut2) {
			  new Chart(chDonut2, {
				  type: 'pie',
				  data: chDonutData2,
				  options: donutOptions
			  });
			}
			
			var chDonut3 = document.getElementById("chDonut3");
			if (chDonut3) {
			  new Chart(chDonut3, {
				  type: 'pie',
				  data: chDonutData3,
				  options: donutOptions
			  });
			}
		</script>	
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

		<script>
			$( "td" ).click(function() {
			  $( this ).replaceWith( "<input type = 'text' value = " + $( this ).text() +">" );
			});
		</script>
		
		<script src="templates/js/bootstrap.min.js"></script>
</html>