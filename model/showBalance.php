<?php

include 'model/model.php';

class ShowBalanceModel extends Model 
{
	public function showBalance()
	{
		try{
			$time_period = $this->setTimePeriod();
			$data_table = $this->getBalanceData($time_period);
			return $data_table;
		} catch (Exception $e) {
			$_SESSION['message'] = $e->getMessage();
		}
	}

	private function setTimePeriod()
	{
		if(isset($_GET['timePeriod'])){
		    switch($_GET['timePeriod']){
			    case('lastMonth'):
				    $start_date=date("Y-m-d", 
				    	strtotime("first day of last month"));
				    $end_date=date("Y-m-d", strtotime("last day of last month"));
				    $_SESSION['timePeriod'] = "Poprzedni Miesiąc";
				    break;
			    case('thisYear'):
				    $start_date=date("Y-m-d", 
					  strtotime('first day of January'. date('Y')));
				    $end_date=date("Y-m-d");
				    $_SESSION['timePeriod'] = "Bieżący Rok";
				    break;
			    case('another'):
				    if((isset($_POST['start_date'])) && (isset($_POST['end_date']))){
					    $start_date=$_POST['start_date'];
					    $end_date=$_POST['end_date'];
					    $_SESSION['timePeriod'] = "Niestandardowy Zakres Dat";	
				    }
				    else
				    {
					    throw new exception('Wybrałeś niestandardowy zakres dat bilansu bez ich uprzedniego wskazania. Spróbuj jeszcze raz!');
				    }
				    break;	
				default:
				    $start_date=date("Y-m-d", 
					    strtotime("first day of this month"));
				    $end_date=date("Y-m-d");
				    $_SESSION['timePeriod'] = "Bieżący Miesiąc";
				    break;			
		    }
		    $time_period = array($start_date, $end_date);
		    return $time_period;
		}
		else
			$time_period = $this->setDefaultTimePeriod();
			return $time_period;
	}

	private function setDefaultTimePeriod()
	{
		$start_date=date("Y-m-d", strtotime("first day of this month"));
		$end_date=date("Y-m-d");
		$time_period = array($start_date, $end_date);
		$_SESSION['timePeriod'] = "Bieżący Miesiąc";
		return $time_period;
	}

	private function getBalanceData($time_period)
	{
		$start_date = $time_period[0];
		$end_date = $time_period[1];
		$user_id = $_SESSION['id'];

		$all_incomes = $this->
				getAllIncomes($start_date, $end_date, $user_id);
		$grouped_incomes = $this->
				getGroupedIncomes($start_date, $end_date, $user_id);
		$incomes_sum = $this->
				getIncomeSum($start_date, $end_date, $user_id);
		$all_expenses = $this->
				getAllExpenses($start_date, $end_date, $user_id);
		$grouped_expenses = $this->
				getGroupedExpenses($start_date, $end_date, $user_id);
		$expenses_sum = $this->
				getExpenseSum($start_date, $end_date, $user_id);

		$data_table = array(
			'all_incomes' => $all_incomes, 
			'grouped_incomes' => $grouped_incomes,
			'incomes_sum' => $incomes_sum,
			'all_expenses' => $all_expenses,
			'grouped_expenses' => $grouped_expenses,
			'expenses_sum' => $expenses_sum
		);
		return $data_table;
	}

	public function selectData($query)
	{
		if($result = $this->dbo->query($query)){
			$result->fetch_all(MYSQLI_ASSOC);
			return $result;
		} else
			throw new exception('Błąd zapytania! Przepraszamy za niedogodności!');
	}

	private function getAllIncomes($start_date, $end_date, $user_id)
	{
		$query = "SELECT incomes.id, incomes.date, incomes.amount,incomes_category_assigned_to_users.name, incomes.comment 
			FROM incomes, incomes_category_assigned_to_users 
			WHERE incomes.user_id='$user_id' 
			AND incomes.user_id = incomes_category_assigned_to_users.user_id 
			AND incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id 
			AND date BETWEEN '$start_date' AND '$end_date' 
			ORDER BY incomes.date DESC";

		$result = $this->selectData($query);
		return $result;
	}

	private function getGroupedIncomes($start_date, $end_date, $user_id)
	{
		$query = "SELECT SUM(incomes.amount) 
			AS total, incomes_category_assigned_to_users.name 
			FROM incomes, incomes_category_assigned_to_users 
			WHERE incomes.user_id='$user_id' 
			AND incomes.date BETWEEN '$start_date' AND '$end_date' 
			AND incomes.income_category_assigned_to_user_id=incomes_category_assigned_to_users.id 
			GROUP BY incomes_category_assigned_to_users.name";

		$result = $this->selectData($query);
		return $result;
	}

	private function getIncomeSum($start_date, $end_date, $user_id)
	{
		$query = "SELECT SUM(amount) 
			AS total 
			FROM incomes 
			WHERE user_id='$user_id' 
			AND date BETWEEN '$start_date' AND '$end_date'";

		$result = $this->selectData($query);
		return $result;
	}

	private function getAllExpenses($start_date, $end_date, $user_id)
	{
		$query = "SELECT expenses.id, expenses.date, expenses.amount, expenses_category_assigned_to_users.name, expenses.comment 
			FROM expenses, expenses_category_assigned_to_users 
			WHERE expenses.user_id='$user_id' 
			AND expenses.user_id = expenses_category_assigned_to_users.user_id 
			AND expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id 
			AND date BETWEEN '$start_date' AND '$end_date'
			ORDER BY expenses.date DESC";

	    $result = $this->selectData($query);
		return $result;	
	}

	private function getGroupedExpenses($start_date, $end_date, $user_id)
	{
		$query = "SELECT SUM(expenses.amount) 
			AS total, expenses_category_assigned_to_users.name 
			FROM expenses, expenses_category_assigned_to_users 
			WHERE expenses.user_id='$user_id' 
			AND expenses.date BETWEEN '$start_date' AND '$end_date' 
			AND expenses.expense_category_assigned_to_user_id=expenses_category_assigned_to_users.id 
			GROUP BY expenses_category_assigned_to_users.name";	

	    $result = $this->selectData($query);
		return $result;
	}

	private function getExpenseSum($start_date, $end_date, $user_id)
	{
		$query = "SELECT SUM(amount) 
			AS total 
			FROM expenses 
			WHERE user_id='$user_id' 
			AND date BETWEEN '$start_date' AND '$end_date'";

	    $result = $this->selectData($query);
		return $result;
	}
}