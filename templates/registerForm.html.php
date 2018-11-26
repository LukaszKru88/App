<?php
include "head.html.php";
include "header.html.php";
include "formNavbar.html.php";
?>
			<div class="row">
				<div class="col-md-6 offset-md-3">
					<main>
						<form method = "post" action="?task=register&action=register">
						    <div id="login" class="input-group">
						        <span class="input-group-text"><i class="fa fa-user"></i></span>
						        <input name ="nick" type="text" class="form-control" id="formGroupExampleInput" placeholder="login: minimum 3 znaki">
						    </div>
						    <div id="mailbox" class="input-group">
						        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
						        <input name ="email" type="text" class="form-control" id="formGroupExampleInput" placeholder="e-mail">
						    </div>
						    <div id="password" class="input-group">
						        <span class="input-group-text"><i class="fa fa-lock"></i></span>
						        <input name ="password1" type="password" class="form-control" id="formGroupExampleInput" placeholder="hasło: minimum 6 znaków">
						    </div>
						    <div id="password" class="input-group">
						        <span class="input-group-text"><i class="fa fa-lock"></i></span>
						        <input name ="password2" type="password" class="form-control" id="formGroupExampleInput2" placeholder="powtórz hasło">
						    </div>						  
													  
							<div class="form-group rule">
								<label>	
									<input type="checkbox" name="rules"  data-toggle="modal" data-target="#myModal"/>	Akceptuję regulamin
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
									<button type="button" class="btn btn-info" data-dismiss="modal">OK</button>
								  </div>
								</div>
							  </div>
							</div>
							
							<div class="recaptcha">
								<div class="g-recaptcha" data-sitekey="6Lfjf2kUAAAAAJRu4EpI66Q2Za_xbOIjAhtyqDQo"></div>
							</div>
						  	<div class="col-md-6 offset-md-3 indexMain text-center">
								<button id="registerButton" class="btn btn-success" name="singlebutton"><i class="icon-user-plus"></i> Zarejestruj się</button>	
							</div>
							<?php include("classes/sessionMessage.php") ?>	
						</form>
					</main>
				</div>
			</div>
<?php
include "footer.html.php";
?>