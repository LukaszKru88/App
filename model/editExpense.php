<?php

include 'model/model.php';

class EditExpenseModel extends Model
{
	public function editExpense()
	{
		try{
			$this->checkIfAmountIsValid();
		    $payment_method_id = $this->getPaymentMethodId();
			$expense_category_id = $this->getExpenseCategoryId();
			$this->editExpenseInDb($payment_method_id, $expense_category_id, $_POST['amount']);

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

	private function editExpenseInDb($payment_method_id, 
		$expense_category_id, $amount)
	{
		$date = $_POST['date'];
		$comment = $_POST['comment'];
		$user_id = $_SESSION['id'];
		$edit_id = $_SESSION['edit_id'];

		$query = "UPDATE expenses SET ";
		$query .= "user_id = '$user_id', ";
		$query .= "expense_category_assigned_to_user_id = '$expense_category_id', ";
		$query .= "payment_method_assigned_to_user_id = '$payment_method_id', ";
		$query .= "amount = '$amount', ";
		$query .= "date = '$date', ";
		$query .= "comment = '$comment' "; 
		$query .= "WHERE id='$edit_id'";
		
		if($this->dbo->query($query)){
			$_SESSION['income_approved'] = true;
			unset($_SESSION['edit_id']);
		}
		else
			throw new Exception('Błąd zapytania! Przepraszamy za niedogodności i prosimy o próbę edycji wydatku 
				w innym terminie!');
	}

	public function getExpense()
	{
		$id = $_GET['id'];
		$type = $_GET['type'];
		$query = "SELECT * ";
		$query .= "FROM $type WHERE id='$id'";
		try{
		    if($expense = $this->dbo->query($query)){
			    $expense = mysqli_fetch_assoc($expense);
			    $_SESSION['edit_id'] = $id;
		        return $expense;
		    }
		    else
		    	throw new Exception('Nie odnaleziono poszukiwanego wydatku w bazie.');
	    } catch (Exception $e) {
	        $_SESSION['message'] = $e->getMessage();
	    }
	}

    public function getCategoryName($editExpense)
	{
		$query = "SELECT name ";
		$query .= "FROM expenses_category_assigned_to_users WHERE id='$editExpense[expense_category_assigned_to_user_id]'";
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

	public function getPayment($editExpense)
	{
		$query = "SELECT name ";
		$query .= "FROM payment_methods_assigned_to_users WHERE id='$editExpense[payment_method_assigned_to_user_id]'";
		try{
		    if($paymentMethod = $this->dbo->query($query)){
			    $paymentMethod = mysqli_fetch_assoc($paymentMethod);
		        return $paymentMethod;
		    }
		    else
		    	throw new Exception('Wystąpił błąd zapytania.');
	    } catch (Exception $e) {
	        $_SESSION['message'] = $e->getMessage();
	    }
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