<?php

include 'controller/controller.php';

class EditExpenseController extends Controller
{
    public function index()
	{
		$view = $this->loadView('editExpense');
		$view->index();
	}

    public function editExpense()
    {
    	$model = $this->loadModel('editExpense');
    	$model->editExpense();
        $this->redirect('index.php?task=showBalance&action=index');
    }
}