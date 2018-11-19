<?php

include 'controller/controller.php';

class EditIncomeController extends Controller
{
    public function index()
	{
		$view = $this->loadView('editIncome');
		$view->index();
	}

    public function editIncome()
    {
    	$model = $this->loadModel('editIncome');
    	$model->editIncome();
        $this->redirect('index.php?task=showBalance&action=index');
    }
}