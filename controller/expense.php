<?php

include 'controller/controller.php';

class ExpenseController extends Controller
{
	public function addExpenseView()
	{
		$view = $this->loadView('expense');
		$view->addExpenseView();
	}

    public function editExpenseView()
	{
		$view = $this->loadView('expense');
		$view->editExpenseView();
	}

	public function addExpense()
	{
		$model = $this->loadModel('expense');
		$model->addExpense();
		$this->redirect('index.php?task=addExpense&action=addExpenseView');
	}

    public function editExpense()
    {
    	$model = $this->loadModel('expense');
    	$model->editExpense();
        $this->redirect('index.php?task=showBalance&action=index');
    }
}