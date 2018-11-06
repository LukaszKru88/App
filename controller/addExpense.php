<?php

include 'controller/controller.php';

class ExpenseController extends Controller
{
	public function index(){
		$view = $this->loadView('addExpense');
		$view->index();
	}

	public function addExpense(){
		$model = $this->loadModel('addExpense');
		$model->registerExpense();
		$this->redirect('index.php?task=addExpense&action=index');
	}
}