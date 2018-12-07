<?php
session_start();

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
				include 'controller/income.php';
				$ob = new IncomeController();
				$action = $_GET['action'];
				$ob->$action();
				break;
			case 'addExpense':
				include 'controller/expense.php';
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
					include 'controller/income.php';
					$ob = new IncomeController();
					$action = $_GET['action'];
					$ob->$action();
					break;
				}
				else if($_GET['type'] == 'expenses')
				{
					include 'controller/expense.php';
					$ob = new ExpenseController();
					$action = $_GET['action'];
					$ob->$action();
					break;
				}
			case 'settings':
				include 'controller/settings.php';
				$ob = new SettingsController();
				$action = $_GET['action'];
				$ob->$action();
				break;
		}
	} 
	else {
		if(isset($_SESSION['is_logged'])){
			require 'templates/mainMenu.html.php';
		} else 
			require "templates/indexMain.html.php";
	}
