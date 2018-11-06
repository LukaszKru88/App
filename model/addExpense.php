<?php

include 'model/model.php';

class addExpenseModel extends Model
{
	protected $user_id;

	public function registerExpense()
	{
		try{
		    $this->checkIfAmountIsValid();
		    $payment_method_id = $this->getPaymentMethodId();
			$expense_category_id = $this->getExpenseCategoryId();
			$this->addExpenseToDb($payment_method_id, $expense_category_id, $_POST['amount']);
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

	private function getPaymentMethodId()
	{
		$payment_method = $_POST['payment_method'];
		$user_id = $_SESSION['id'];

		$query = "SELECT id ";
		$query .= "FROM payment_methods_assigned_to_users WHERE user_id='$user_id' AND name='$payment_method'";

		$result = $this->dbo->query($query);
		if(!empty($result)){
			$result = mysqli_fetch_assoc($result);
			$payment_method_id = $result['id'];
			return $payment_method_id;
		}
		else
			throw new Exception('Wystąpił błąd podczas ustalania kategorii!');
	}

	private function getExpenseCategoryId()
	{
		$category = $_POST['category'];
		$user_id = $_SESSION['id'];	
			
		$query = "SELECT id ";
		$query .= "FROM expenses_category_assigned_to_users WHERE user_id='$user_id' AND name='$category'";

		$result = $this->dbo->query($query);
		if(!empty($result)){
			$result = mysqli_fetch_assoc($result);
			$expense_category_id = $result['id'];
			return $expense_category_id;
		}
		else
			throw new Exception('Wystąpił błąd podczas ustalania kategorii!');
	}

	private function addExpenseToDb($payment_method_id, 
		$expense_category_id, $amount)
	{
		$date = $_POST['date'];
		$comment = $_POST['comment'];
		$user_id = $_SESSION['id'];

		$query = "INSERT INTO expenses
				  VALUES(NULL, '$user_id', '$expense_category_id', 
				  '$payment_method_id' , '$amount', '$date', '$comment')";

		if($this->dbo->query($query))
			$_SESSION['expense_approved'] = true;
		else
			throw new Exception('Błąd zapytania! Przepraszamy za niedogodności i prosimy o próbę dodania wydatku 
				w innym terminie!');
	}

	public function getExpenseCategories() {
		$user_id = $_SESSION['id'];
        return $this->select('expenses_category_assigned_to_users', '*', "user_id='$user_id'");
    }

    public function getPaymentMethods() {
		$user_id = $_SESSION['id'];
        return $this->select('payment_methods_assigned_to_users', '*', "user_id='$user_id'");
    }
}