<?php

include 'view/view.php';

class AddIncomeView extends View
{
	public function index()
	{
		$incomeCategories = $this->loadModel('addIncome');
		$this->set('incomeCategories', $incomeCategories->getIncomeCategories());
	    $this->render('addIncome');
	}
}