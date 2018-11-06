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
		}
	} 
	else {
		if(isset($_SESSION['is_logged'])){
			require 'templates/mainMenu.html.php';
		} else 
		    require "templates/indexMain.html.php";
	}
//}