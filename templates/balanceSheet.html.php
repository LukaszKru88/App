<?php
if(!isset($_SESSION['is_logged'])){
	header("location: ../index.php?task=login&action=index");
}

$user_id = $_SESSION['id'];

include "head.html.php";
include "header.html.php";
include "balanceNavbar.html.php";
?>
		    <main>
		    	<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-12 mainMenuText">Aktualnie przeglądasz bilans za: <?php echo $_SESSION['timePeriod']; unset($_SESSION['timePeriod']);?></div>
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
						
							<div class="col-lg-6 float-left">
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
				</div>
			</main>
<?php
include "footer.html.php";
?>
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
	<script type="text/javascript">
		$(document).ready(function() {
			$(".table").DataTable();
		});

	</script>