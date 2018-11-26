<?php

include 'controller/controller.php';

class IncomeController extends Controller
{
	public function addIncomeView()
	{
		$view = $this->loadView('income');
		$view->addIncomeView();
	}

    public function editIncomeView()
	{
		$view = $this->loadView('income');
		$view->editIncomeView();
	}

	public function addIncome()
	{
		$model = $this->loadModel('income');
		$model->addIncome();
		$this->redirect('index.php?task=addIncome&action=addIncomeView');
	}

    public function editIncome()
    {
    	$model = $this->loadModel('income');
    	$model->editIncome();
        $this->redirect('index.php?task=showBalance&action=index');
    }
}