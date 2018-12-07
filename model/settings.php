<?php

include 'model/model.php';

class SettingsModel extends Model
{
	public function getCategories(){
		$query = $this->getCategoriesQuery();
		
		if($result = $this->dbo->query($query)){
			$result->fetch_all(MYSQLI_ASSOC);
			return $result;
		} else
			throw new exception('Błąd zapytania! Przepraszamy za niedogodności!');
	}

	public function addCategory() {
		$this->isNotEmpty($_POST['newCategory']);
		$this->isCategoryExisting($_POST['newCategory']);
		$this->addCategoryToDb();
	}

	public function editCategory(){
		$this->isNotEmpty($_POST['newName']);
		$query = $this->getEditingIdQuery();
		$categoryId = $this->getCategoryId($query);
		$this->editCategoryInDb($categoryId);
	}

	public function deleteCategory() {
		$this->checkValues();
		$suggestedCategoryQuery = $this->getDeletingIdQuery($_POST['suggestion']);
		$deleteCategoryIdQuery = $this->getDeletingIdQuery($_POST['deleteCategory']);
		$suggestedCategoryId = $this->getCategoryId($suggestedCategoryQuery);
		$deleteCategoryId = $this->getCategoryId($deleteCategoryIdQuery);
		$changeIdQuery = $this->changeCategoriesIdQuery($suggestedCategoryId, $deleteCategoryId);
		$this->changeCategoriesId($changeIdQuery);
		$this->deleteCategoryInDb($deleteCategoryId);
	}

	private function addCategoryToDb() {
		$query = $this->addCategoryQuery();

		if($this->dbo->query($query)){
			exit("success");
		}
		else
			exit('Błąd zapytania! Przepraszamy za niedogodności i prosimy o próbę edycji kategorii 
				w innym terminie!');
	}	

	private function editCategoryInDb($categoryId) {
		$query = $this->editCategoryQuery($categoryId);

		if($this->dbo->query($query)){
			exit("success");
		}
		else
			exit('Błąd zapytania! Przepraszamy za niedogodności i prosimy o próbę edycji kategorii 
				w innym terminie!');
	}

	private function deleteCategoryInDb($categoryId) {
		$query = $this->deleteCategoryQuery($categoryId);

		if($this->dbo->query($query)){
			exit("success");
		}
		else
			exit('Błąd zapytania! Przepraszamy za niedogodności i prosimy o próbę edycji kategorii 
				w innym terminie!');
	}

	private function isNotEmpty($data) {
		if(empty($data)) {
			echo "<span class='input-error'>Wypełnij pole z nazwą kategorii!</span>";
			exit();
		}
	}

	private function isCategoryExisting($newCategory) {
		$query = $this->isExistingQuery();
		$result = $this->dbo->query($query);
		if($result->num_rows > 0) {
			echo "<span class='input-error'>Istnieje już kategoria o podanej nazwie!</span>";
			exit();
		}
	}

	private function checkValues(){
		if(!isset($_POST['deleteCategory'])) {
			echo "<span class='input-error'>Nie zaznaczyłeś kategorii którą zamierzasz usunąć!</span>";
			exit();
		}
		if(isset($_POST['deleteCategory']) && $_POST['deleteCategory'] == $_POST['suggestion']) {
			echo "<span class='input-error'>Kategoria do której chcesz przenieść wpisy jest identyczna z usuwaną. Zaznaczone kategorie musza być różne.</span>";
			exit();
		}
	}

	private function getCategoryId($query) {
		$result = $this->dbo->query($query);
		if(!empty($result)){
			$result = mysqli_fetch_assoc($result);
		    $categoryId = $result['id'];
			return $categoryId;
		} else 
			throw new Exception('Wystąpił błąd podczas ustalania kategorii!');
	}

	private function changeCategoriesId($query) {
		$this->dbo->query($query);
	}

	private function getEditingIdQuery() {
		$categoryType = $_POST['categoryType'];
		$oldName = $_POST['oldName'];
		$user_id = $_SESSION['id'];

		if($categoryType == "incomes") {
			$query = "SELECT id ";
			$query .= "FROM incomes_category_assigned_to_users WHERE user_id='$user_id' AND name='$oldName'";
		} else if($categoryType == "expenses") {
			$query = "SELECT id ";
			$query .= "FROM expenses_category_assigned_to_users WHERE user_id='$user_id' AND name='$oldName'";
		} else if($categoryType == "payment_methods") {
			$query = "SELECT id ";
			$query .= "FROM payment_methods_assigned_to_users WHERE user_id='$user_id' AND name='$oldName'";
		}
		return $query;
	}

	private function getDeletingIdQuery($categoryName) {
		$categoryType = $_POST['categoryType'];
		$user_id = $_SESSION['id'];

		if($categoryType == "incomes"){
			$query = "SELECT id ";
			$query .= "FROM incomes_category_assigned_to_users WHERE user_id='$user_id' AND name='$categoryName'";
		} else if($categoryType == "expenses"){
			$query = "SELECT id ";
			$query .= "FROM expenses_category_assigned_to_users WHERE user_id='$user_id' AND name='$categoryName'";
		} else if($categoryType == "payment_methods"){
			$query = "SELECT id ";
			$query .= "FROM payment_methods_assigned_to_users WHERE user_id='$user_id' AND name='$categoryName'";
		}
		return $query;
	}

	private function isExistingQuery() {
		$categoryType = $_POST['categoryType'];
		$newCategory = $_POST['newCategory'];
		$user_id = $_SESSION['id'];

		if($categoryType == "incomes"){
			$query = "SELECT name ";
			$query .= "FROM incomes_category_assigned_to_users WHERE user_id='$user_id' AND name='$newCategory'";
		} else if($categoryType == "expenses"){
			$query = "SELECT name ";
			$query .= "FROM expenses_category_assigned_to_users WHERE user_id='$user_id' AND name='$newCategory'";
		} else if($categoryType == "payment_methods"){
			$query = "SELECT name ";
			$query .= "FROM payment_methods_assigned_to_users WHERE user_id='$user_id' AND name='$newCategory'";
		}
		return $query;
	}

	private function addCategoryQuery() {
		$categoryType = $_POST['categoryType'];
		$newCategory = $_POST['newCategory'];
		$user_id = $_SESSION['id'];

		if($categoryType == "incomes"){
			$query = "INSERT INTO incomes_category_assigned_to_users ";
			$query .= "VALUES(NULL, '$user_id', '$newCategory')";
		} else if($categoryType == "expenses"){
			$query = "INSERT INTO expenses_category_assigned_to_users ";
			$query .= "VALUES(NULL, '$user_id', '$newCategory')";
		} else if($categoryType == "payment_methods"){
			$query = "INSERT INTO payment_methods_assigned_to_users ";
			$query .= "VALUES(NULL, '$user_id', '$newCategory')";
		}
		return $query;
	}

	private function editCategoryQuery($categoryId) {
		$categoryType = $_POST['categoryType'];
		$newName = $_POST['newName'];

		if($categoryType == "incomes"){
			$query = "UPDATE incomes_category_assigned_to_users SET ";
			$query .= "name = '$newName' ";
			$query .= "WHERE id='$categoryId'";
		} else if($categoryType == "expenses"){
			$query = "UPDATE expenses_category_assigned_to_users SET ";
			$query .= "name = '$newName' ";
			$query .= "WHERE id='$categoryId'";
		} else if($categoryType == "payment_methods"){
			$query = "UPDATE payment_methods_assigned_to_users SET ";
			$query .= "name = '$newName' ";
			$query .= "WHERE id='$categoryId'";
		}
		return $query;
	}

	private function deleteCategoryQuery($categoryId) {
		$categoryType = $_POST['categoryType'];

		if($categoryType == "incomes"){
			$query = "DELETE FROM incomes_category_assigned_to_users WHERE id='$categoryId'";
		} else if($categoryType == "expenses"){
			$query = "DELETE FROM expenses_category_assigned_to_users WHERE id='$categoryId'";
		} else if($categoryType == "payment_methods"){
			$query = "DELETE FROM payment_methods_assigned_to_users WHERE id='$categoryId'";
		}

		return $query;
	}

	private function getCategoriesQuery() {
		$categoryType = $_GET['categoryType'];
		$user_id = $_SESSION['id'];

		if($categoryType == "incomes"){
			$categoryType = "incomes_category_assigned_to_users";
		} else if($categoryType == "expenses"){
			$categoryType = "expenses_category_assigned_to_users";
		} else if($categoryType == "payment_methods"){
			$categoryType = "payment_methods_assigned_to_users";
		}

		$query = "SELECT * ";
		$query .= "FROM $categoryType WHERE user_id='$user_id'";
		return $query;
	}

	private function changeCategoriesIdQuery($suggestedCategoryId, $deleteCategoryId) {
		$categoryType = $_POST['categoryType'];
		$user_id = $_SESSION['id'];

		if($categoryType == 'incomes'){
			$query = "UPDATE incomes ";
			$query .= "SET income_category_assigned_to_user_id = $suggestedCategoryId WHERE user_id = $user_id AND income_category_assigned_to_user_id = $deleteCategoryId";
		} else if($categoryType == 'expenses'){
			$query = "UPDATE expenses ";
			$query .= "SET expense_category_assigned_to_user_id = $suggestedCategoryId WHERE user_id = $user_id AND expense_category_assigned_to_user_id = $deleteCategoryId";
		} else if($categoryType == 'payment_methods'){
			$query = "UPDATE expenses ";
			$query .= "SET payment_method_assigned_to_user_id = $suggestedCategoryId WHERE user_id = $user_id AND payment_method_assigned_to_user_id = $deleteCategoryId";
		}
		return $query;
	}
}