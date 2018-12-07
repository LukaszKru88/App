<?php
if(!isset($_SESSION['is_logged'])){
	header("Location: ../index.php?task=login&action=index");
}

include "head.html.php";
include "header.html.php";
include "mainNavbar.html.php";
?>
<div class="col-lg-6 offset-lg-3 text-center">
	<div id="success-message"></div>
</div>

<div class="col-md-6 offset-md-3 col-sm-6 offset-sm-3 text-center">
	<div class="tablesHeading">Kategorie przychodów</div>
</div>

<div class="row">
	<div class="col-md-6 offset-md-3 col-sm-6 offset-sm-3 text-center">
		<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		  <input id="incomeAddButton" type="button" class="btn btn-info addButton" value="Dodaj">
		  <input id="incomeEditButton" onclick="getCategories('settings', 'getCategories', 'incomes')" type="button" class="btn btn-success editButton" value="Edytuj">
		  <input id="incomeDeleteButton" onclick="getCategories('settings', 'getCategories', 'incomes')" type="button" class="btn btn-dark deleteButton" value="Usuń">
		</div>
	</div>
</div>

<div class="col-md-6 offset-md-3 col-sm-6 offset-sm-3 text-center"">
	<div class="tablesHeading">Kategorie wydatków</div>
</div>

<div class="row">
	<div class="col-sm-6 col-md-6 offset-md-3 offset-sm-3 text-center">
		<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		  <input id="expenseAddButton" onclick="" type="button" class="btn btn-info addButton" value="Dodaj">
		  <input id="expenseEditButton" onclick="getCategories('settings', 'getCategories', 'expenses')" type="button" class="btn btn-success editButton" value="Edytuj">
		  <input id="expenseDeleteButton" onclick="getCategories('settings', 'getCategories', 'expenses')" type="button" class="btn btn-dark deleteButton" value="Usuń">
		</div>
	</div>
</div>

<div class="col-md-6 offset-md-3 col-sm-6 offset-sm-3 text-center"">
	<div class="tablesHeading">Kategorie sposobów płatności</div>
</div>

<div class="row">
	<div class="col-sm-6 col-md-6 offset-md-3 offset-sm-3 text-center">
		<div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
		  <input id="paymentAddButton" onclick="" type="button" class="btn btn-info addButton" value="Dodaj">
		  <input id="paymentEditButton" onclick="getCategories('settings', 'getCategories', 'payment_methods')" type="button" class="btn btn-success editButton" value="Edytuj">
		  <input id="paymentDeleteButton" onclick="getCategories('settings', 'getCategories', 'payment_methods')" type="button" class="btn btn-dark deleteButton" value="Usuń">
		</div>
	</div>
</div>

<div id="incomes" class="modal">
	<div class="modal-dialog">
		<form action="index.php" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<input id="categoryType" value="" type="hidden"/><h2 class="modal-title text-center">Category Action</h2>
				</div>
				<div class="modal-body">
					<p class="userInfo text-center"></p>
					<input type="text" class="form-control" name="category" placeholder="Nazwa kategorii..." id="categoryName">
					<p class="form-message text-center"></p>
					<div class="categories form-check">Wybierz Kategorię
						<ul id="categoryList" class="justify-content-center">
							
						</ul>
					</div>
					<div id="deleteCategorie" class="form-group text-center">
						<label for="suggestedCategories">Wybierz gdzie zostaną przypisane wpisy z usuwanej kategorii</label>
					    <select class="form-control" id="suggestedCategories">

					    </select>
					</div>

				</div>
				<div class="modal-footer">
					<input type="button" id="addBtnModal" onclick="addCategory()" value="DODAJ" class="btn btn-info" style="display: none;">
	                <input type="button" id="editBtnModal" onclick="editCategory()" value="EDYTUJ" class="btn btn-success" style="display: none;">
	                <input type="button" id="deleteBtnModal" onclick="deleteCategory()" value="USUŃ" class="btn btn-danger" style="display: none;">
	                <input type="button" id="closeBtn" data-dismiss="modal" value="ANULUJ" class="btn btn-dark">
	            </div>
			</div>
		</form>
	</div>
</div>
<?php
include "footer.html.php";
?>