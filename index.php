<?php
session_start();

// if(isset($_SESSION['is_logged'])){
// 	require 'templates/mainMenu.html.php';
// }
// else {
	if (isset($_GET['task'])){
		switch($_GET['task']){
			case 'login':
				include 'controller/login.php';
				$ob = new LoginController();
				$action = $_GET['action'];
				$ob->$action();
				break;
			case 'register':
				include 'controller/register.php';
				$ob = new RegisterController();
				$action = $_GET['action'];
				$ob->$action();
				break;
			case 'addIncome':
				include 'controller/addIncome.php';
				$ob = new IncomeController();
				$action = $_GET['action'];
				$ob->$action();
				break;
			case 'addExpense':
				include 'controller/addExpense.php';
				$ob = new ExpenseController();
				$action = $_GET['action'];
				$ob->$action();
				break;
			case 'showBalance':
				include 'controller/showBalance.php';
				$ob = new BalanceController();
				$action = $_GET['action'];
				$ob->$action();
				break;
			case 'delete':
				include 'controller/deleteCashFlow.php';
				$ob = new DeleteCashFlowController();
				$action = $_GET['action'];
				$ob->$action();
				break;
			case 'edit':
				if($_GET['type'] == 'incomes')
				{
					include 'controller/editIncome.php';
					$ob = new EditIncomeController();
					$action = $_GET['action'];
					$ob->$action();
					break;
				}
				else if($_GET['type'] == 'expenses')
				{
					include 'controller/editExpense.php';
					$ob = new EditExpenseController();
					$action = $_GET['action'];
					$ob->$action();
					break;
				}
		}
	} 
	else {
		if(isset($_SESSION['is_logged'])){
			require 'templates/mainMenu.html.php';
		} else 
			require "templates/indexMain.html.php";
	}
//}