<?php
if(!isset($_SESSION['is_logged'])){
	header("location: ../index.php?task=login&action=index");
}

$user_id = $_SESSION['id'];
$current_date = new DateTime();

include "head.html.php";
include "header.html.php";
include "mainNavbar.html.php";
?>
			<main>
				<form method="post" action="<?php
				    if(isset($_GET['type']))
				    	echo "?task=addExpense&action=editExpense&&type=expenses";
				    else
				    	echo "?task=addExpense&action=addExpense";
				?>">
					<div class="row">
						<div class="col-md-6 offset-md-3">
						<?php include("classes/sessionMessage.php") ?>
							<div id="amountbox" class="input-group">
						        <span class="input-group-text"><i class="fa fa-university"></i></span>
						        <input type="number" step="0.01" name ="amount" class="form-control" id="formGroupExampleInput" placeholder="kwota" value="<?php if(isset($this->editExpense['amount'])) $this->printAmount();?>">
								</div>	
								<div id="date" class="input-group">
						        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
						        <input type="date" name ="date" class="form-control" value="<?php if(isset($this->editExpense['date'])) echo $this->printDate(); else echo $current_date->format('Y-m-d')?>"/>
								</div>						
								<div class="categories form-check">Sposób płatności
									<ul class="justify-content-center">
									<?php
									    if(isset($_GET['type']))
											$this->editPaymentMethods('paymentMethods');
										else
											$this->addPaymentMethods('paymentMethods');
									?>							
									</ul>
								</div>
								<div class="categories form-check">Wybierz Kategorię
									<ul class="justify-content-center">
									<?php
									    if(isset($_GET['type']))
									    	$this->editExpenseCategories('expenseCategories');
									    else
									    	$this->addExpenseCategories('expenseCategories');
									?>
									</ul>
								</div>
								<div id="commentbox" class="input-group">
							        <span class="input-group-text"><i class="fa fa-comment" aria-hidden="true"></i></span>
							        <input type="text" name ="comment" class="form-control" id="formGroupExampleInput2" placeholder="komentarz" value="<?php if(isset($this->editExpense['comment'])) $this->printComment();?>">
								</div>
								<div class="row">
								    <div class="col-sm-6 col-md-6 offset-md-3 offset-sm-3 text-center">
											<button id="addButton" class="btn btn-info btn-block" name="add">Dodaj</button>
									</div>
								</div>
							</div>
						</div>		
					</form>
					<div class="row">
						<div class="col-md-6 offset-md-3">
							<dic class="row">
								<div class="col-sm-6 col-md-6 offset-md-3 offset-sm-3 text-center">
									<a href="index.php">
										<button id="cancelButton" class="btn btn-success btn-block" name="cancel">Anuluj</button>
									</a>
								</div>
							</dic>
						</div>
					</div>
				</main>
<?php
include "footer.html.php";
?>