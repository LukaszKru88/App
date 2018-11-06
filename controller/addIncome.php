<?php

include 'controller/controller.php';

class IncomeController extends Controller
{
	public function index(){
		$view = $this->loadView('addIncome');
		$view->index();
	}

	public function addIncome(){
		$model = $this->loadModel('addIncome');
		$model->registerIncome();
		$this->redirect('index.php?task=addIncome&action=index');
	}
}