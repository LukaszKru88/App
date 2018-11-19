<?php
include 'model/model.php';

class addIncomeModel extends Model{

	protected $user_id;

	public function registerIncome()
	{
	    try{
	    	$this->checkIfAmountIsValid();
	    	$income_category_id = $this->getIncomeCategoryId();
	    	$this->addIncomeToDb($income_category_id, $_POST['amount']);
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

	public function getIncomeCategories()
	{
		$user_id = $_SESSION['id'];
        return $this->select('incomes_category_assigned_to_users', '*', "user_id='$user_id'");
    }
}