<?php
if(!isset($_SESSION['is_logged'])){
	header("Location: ../index.php?task=login&action=index");
}

include "head.html.php";
include "header.html.php";
?>			
			<main>	
				<div class="row">
					<div class="col-sm-6 col-md-5 offset-md-1 text-center">
						<p class="mainMenuText">Otrzymałeś przypływ gotówki? Dodaj go tutaj!</p>
						<label class="indexMain mainMenuIcon">
							<a href="?task=addIncome&action=addIncomeView"><p><i class="icon-money"></i></p><button name="singlebutton" class="btn btn-info mainMenuButton">Dodaj przychód</button></a>
						</label>
					</div>

					<div class="col-sm-6 col-md-5 text-center"> 
						<p class="mainMenuText">Byłeś na zakupach? Koniecznie je dodaj!</p>
						<label class="indexMain mainMenuIcon">
							<a href="?task=addExpense&action=addExpenseView"><p><i class="icon-basket"></i></p><button name="singlebutton" class="btn btn-info mainMenuButton">Dodaj wydatek</button></a>
					</label>
					</div>

					<div class="col-sm-6 col-md-4 text-center">
						<p class="mainMenuText">Zobacz jak Ci idzie oszczędzanie!</p>
						<label class="indexMain mainMenuIcon">
							<a href="?task=showBalance&action=index"><p><i class="icon-chart-pie"></i></p><button name="singlebutton" class="btn btn-info mainMenuButton">Przeglądaj bilans</button></a>
					</label>
					</div>	

					<div class="col-sm-6 col-md-4 text-center"> 
						<p class="mainMenuText">Tu wprowadzisz wszelkie zmiany!</p>
						<label class="indexMain mainMenuIcon">
							<a href="settings.php"><p><i class="icon-cog-alt"></i></p><button name="singlebutton" class="btn btn-info mainMenuButton">Ustawienia</button></a>
					</label>
					</div>

					<div class="col-sm-12 col-md-4 text-center"> 
						<p class="mainMenuText">Do zobaczenia!</p>
						<label class="indexMain mainMenuIcon">
							<a href="templates/logout.php"><p><i class="icon-logout"></i></p><button name="singlebutton" class="btn btn-info mainMenuButton">Wyloguj się</button></a>
					</label>
					</div>
				</div>
			</main>
<?php 
include "footer.html.php";
?>