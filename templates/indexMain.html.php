<?php
if(isset($_SESSION['is_logged'])){
	header("Location: templates/mainMenu.html.php");
}

include "head.html.php";
include "header.html.php";
?>
		<section>
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<section>
						<div class = "appInfo">
							<h3>Dołącz do użytkowników aplikacji</h3>
							<p>Zarejestruj się już dziś i rozpocznij kontorlę nad swoimi finansami. Będziesz mógł:<br>
								- dodawać przychody i wydatki,<br>
								- przeglądać bilans w czasie,<br>
								- zarządzać kategoriami,<br>
								- dodawać i edytować wpisy,<br>
							A to wszytsko zupełnie za darmo!</p>
						</div>
					</section>
				</div>
			</div>
		</section>
		<section>
			<main>
				<div class="row">
					<div class="col-sm-5 col-md-5 offset-md-1 offset-sm-1">
						<label class="indexMain">	
							<a href="?task=login&action=index"><p>Jeżeli już posiadasz konto:</p>
							<button id="logButton" type="button" class="btn btn-info btn-block"><i class="icon-login"></i> Logowanie</button></a>
						</label>	
					</div>
					<div class="col-sm-5 col-md-5">
						<label class="indexMain">
							<a href="?task=register&action=index"><p>Jeżeli jeszcze nie masz konta:</p>
							<button id="registerButton" type="button" class="btn btn-success btn-block"><i class="icon-user-plus"></i> Rejestracja</button></a>
						</label>
					</div>
				</div>
			</main>
		</section>
		<section>
			<div class="row">
				<div class="col-md-10 offset-md-1">
					<div id="quote" class = "quote">
						<blockquote>
							<p>"Nawyk oszczędzania jest sam w sobie edukacją; sprzyja każdej cnocie, uczy wyrzeczeń, kultywuje poczucie porządku, wykształca chęć rozwoju, a więc poszerza umysł. "</p>
							<footer><cite title="Source Title">T.T. Munger</cite></footer>
						</blockquote>
					</div>
				</div>
		</section>
<?php
include "footer.html.php";
?>