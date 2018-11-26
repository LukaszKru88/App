<?php
if(isset($_SESSION['is_logged'])){
	header("Location: templates/mainMenu.html.php");
}

include "head.html.php";
include "header.html.php";
include "formNavbar.html.php";
?>			
			<div class="row">
				<div class="col-md-6 col-sm-6 offset-md-3 offset-sm-3 justify-content-center ">
					<main>
						<form method = "post" action="?task=login&action=login">
						    <div id="login" class="input-group">
						  	    <span class="input-group-text"><i class="fa fa-user"></i></span>
							    <input name ="login" type="text" class="form-control" id="formGroupExampleInput" placeholder="login">
						    </div>
						  
						    <div id="password" class="input-group">
							    <span class="input-group-text"><i class="fa fa-lock"></i></span>
							    <input name = "password" type="password" class="form-control" id="formGroupExampleInput2" placeholder="hasło">
						    </div>
						  	<div class="indexMain text-center">
								<button id="logButton" class="btn btn-info" name="singlebutton"><i class="icon-login"></i> Zaloguj się</button>	
							</div>
							<?php include("classes/sessionMessage.php") ?>
						</form>
					</main>
				</div>
			</div>
<?php
include "footer.html.php";
?>