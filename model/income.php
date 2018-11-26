<?php

include 'model/model.php';

class IncomeModel extends Model{

	protected $user_id;

	public function addIncome()
	{
	    try{
	    	$this->checkIfAmountIsValid();
	    	$income_category_id = $this->getIncomeCategoryId();
	    	$this->addIncomeToDb($income_category_id, $_POST['amount']);
	    } catch (Exception $e) {
	        $_SESSION['message'] = $e->getMessage();
	    }
	}

	public function editIncome()
	{
	    try{
	    	$this->checkIfAmountIsValid();
	    	$income_category_id = $this->getIncomeCategoryId();
	    	$this->editIncomeInDb($income_category_id, $_POST['amount']);
	    } catch (Exception $e) {
	        $_SESSION['message'] = $e->getMessage();
	    }
	}

	private function checkIfAmountIsValid()
	{
		$amount = $_POST['amount'];
	    if($amount == null || $amount <= 0)
	        throw new Exception('Nie podano właściwej kwoty!');
	}

	private function getIncomeCategoryId()
	{
		$category = $_POST['category'];
		$user_id = $_SESSION['id'];

		$query = "SELECT id ";
		$query .= "FROM incomes_category_assigned_to_users WHERE user_id='$user_id' AND name='$category'";

		$result = $this->dbo->query($query);
		if(!empty($result)){
			$result = mysqli_fetch_assoc($result);
		    $income_category_id = $result['id'];
			return $income_category_id;
		} else 
			throw new Exception('Wystąpił błąd podczas ustalania kategorii!');
	}

	private function addIncomeToDb($income_category_id, $amount)
	{
		$date = $_POST['date'];
		$comment = $_POST['comment'];
		$user_id = $_SESSION['id'];

		$query = "INSERT INTO incomes 
				  VALUES(NULL, '$user_id', '$income_category_id', '$amount', '$date', '$comment')";

		if($this->dbo->query($query))
			$_SESSION['income_approved'] = true;
		else
			throw new Exception('Błąd zapytania! Przepraszamy za niedogodności i prosimy o próbę dodania przychodu 
				w innym terminie!');
	}

	private function editIncomeInDb($income_category_id, $amount)
	{
		$date = $_POST['date'];
		$comment = $_POST['comment'];
		$user_id = $_SESSION['id'];
		$edit_id = $_SESSION['edit_id'];

		$query = "UPDATE incomes SET ";
		$query .= "user_id = '$user_id', ";
		$query .= "income_category_assigned_to_user_id = '$income_category_id', "; 
		$query .= "amount = '$amount', ";
		$query .= "date = '$date', ";
		$query .= "comment = '$comment' "; 
		$query .= "WHERE id='$edit_id'";

		if($this->dbo->query($query)){
			$_SESSION['income_approved'] = true;
			unset($_SESSION['edit_id']);
		}
		else
			throw new Exception('Błąd zapytania! Przepraszamy za niedogodności i prosimy o próbę edycji przychodu 
				w innym terminie!');
	}

	public function getIncomeCategories()
	{
		$user_id = $_SESSION['id'];
        return $this->select('incomes_category_assigned_to_users', '*', "user_id='$user_id'");
    }

	public function getIncome()
	{
		$id = $_GET['id'];
		$type = $_GET['type'];
		$query = "SELECT * ";
		$query .= "FROM $type WHERE id='$id'";
		try{
		    if($income = $this->dbo->query($query)){
			    $income = mysqli_fetch_assoc($income);
			    $_SESSION['edit_id'] = $id;
		        return $income;
		    }
		    else
		    	throw new Exception('Nie odnaleziono poszukiwanego przychodu w bazie.');
	    } catch (Exception $e) {
	        $_SESSION['message'] = $e->getMessage();
	    }
	}

	public function getCategoryName($editIncome)
	{
		$query = "SELECT name ";
		$query .= "FROM incomes_category_assigned_to_users WHERE id='$editIncome[income_category_assigned_to_user_id]'";
		try{
		    if($categoryName = $this->dbo->query($query)){
			    $categoryName = mysqli_fetch_assoc($categoryName);
		        return $categoryName;
		    }
		    else
		    	throw new Exception('Wystąpił błąd zapytania.');
	    } catch (Exception $e) {
	        $_SESSION['message'] = $e->getMessage();
	    }
	}
}